<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TrackingEvent;
use Carbon\CarbonImmutable;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TrackingEventController extends Controller
{
    private const ALLOWED_EVENTS = [
        'PageView',
        'ViewContent',
        'AddToCart',
        'Purchase',
        'page_view',
        'view_item',
        'add_to_cart',
        'purchase',
    ];

    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_name' => ['required', 'string', 'max:50', 'in:' . implode(',', self::ALLOWED_EVENTS)],
            'metadata' => ['nullable', 'array', 'max:100'],
            'event_uuid' => ['nullable', 'uuid'],
            'session_id' => ['nullable', 'string', 'max:64'],
            'page_url' => ['nullable', 'string', 'max:2048'],
            'referrer' => ['nullable', 'string', 'max:2048'],
            'occurred_at' => ['nullable', 'date'],
        ]);

        $metadata = $validated['metadata'] ?? null;

        // Keep payloads bounded in production (avoid oversized JSON inserts)
        if ($metadata !== null) {
            $encoded = json_encode($metadata);
            if ($encoded === false || strlen($encoded) > 32_768) {
                return response()->json([
                    'message' => 'Invalid metadata payload.',
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        }

        $occurredAt = null;
        if (!empty($validated['occurred_at'])) {
            $candidate = CarbonImmutable::parse($validated['occurred_at']);
            // Bound timestamps to reduce garbage / abuse.
            if ($candidate->greaterThan(CarbonImmutable::now()->addMinutes(10))) {
                $candidate = CarbonImmutable::now();
            }
            if ($candidate->lessThan(CarbonImmutable::now()->subDays(90))) {
                $candidate = CarbonImmutable::now();
            }
            $occurredAt = $candidate;
        }

        try {
            TrackingEvent::create([
                'event_uuid' => $validated['event_uuid'] ?? null,
                'event_name' => $validated['event_name'],
                'session_id' => $validated['session_id'] ?? null,
                'page_url' => $validated['page_url'] ?? null,
                'referrer' => $validated['referrer'] ?? null,
                'occurred_at' => $occurredAt,
                'metadata' => $metadata,
                'user_ip' => $request->ip(),
                'user_agent' => (string) $request->userAgent(),
            ]);
        } catch (QueryException $e) {
            // Idempotency: if a client retries the same event_uuid, treat as success.
            if (($validated['event_uuid'] ?? null) !== null && (string) $e->getCode() === '23000') {
                return response()->json(['ok' => true, 'deduped' => true], Response::HTTP_OK);
            }
            throw $e;
        }

        return response()->json(['ok' => true], Response::HTTP_CREATED);
    }
}

