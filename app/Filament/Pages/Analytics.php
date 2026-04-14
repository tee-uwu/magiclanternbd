<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\PageViewsOverTimeChart;
use App\Filament\Widgets\PurchasesOverTimeChart;
use Filament\Pages\Page;
use App\Models\TrackingEvent;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Analytics extends Page
{
    protected static bool $shouldRegisterNavigation = true;
    protected static ?string $navigationLabel = 'Analytics';
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?int $navigationSort = 3;

    protected static string $view = 'filament.pages.analytics';

    public string $range = 'today'; // today|7d|30d
    public int $refreshKey = 0;

    public function mount(): void
    {
        $this->range = 'today';
        $this->emit('analyticsRangeUpdated', $this->range);
    }

    public function updatedRange(): void
    {
        // Trigger a Livewire re-render even if counts end up identical.
        $this->refreshKey++;
        $this->emit('analyticsRangeUpdated', $this->range);
    }

    private function startAt(): CarbonImmutable
    {
        $now = CarbonImmutable::now();

        return match ($this->range) {
            '7d' => $now->subDays(6)->startOfDay(),
            '30d' => $now->subDays(29)->startOfDay(),
            default => $now->startOfDay(),
        };
    }

    private function baseQuery()
    {
        $start = $this->startAt();
        $end = CarbonImmutable::now();

        return TrackingEvent::query()
            ->whereBetween('created_at', [$start, $end]);
    }

    private function aggregateRow(): array
    {
        $q = $this->baseQuery();

        // MySQL JSON extraction for revenue from metadata.event.value
        $revenueExpr = "COALESCE(CAST(JSON_UNQUOTE(JSON_EXTRACT(metadata, '$.event.value')) AS DECIMAL(18,2)), 0)";

        $row = $q->selectRaw("
            SUM(CASE WHEN event_name IN ('PageView','page_view') THEN 1 ELSE 0 END) AS page_views,
            SUM(CASE WHEN event_name IN ('ViewContent','view_item') THEN 1 ELSE 0 END) AS view_content,
            SUM(CASE WHEN event_name IN ('AddToCart','add_to_cart') THEN 1 ELSE 0 END) AS add_to_cart,
            SUM(CASE WHEN event_name IN ('Purchase','purchase') THEN 1 ELSE 0 END) AS purchases,
            SUM(CASE WHEN event_name IN ('Purchase','purchase') THEN {$revenueExpr} ELSE 0 END) AS revenue
        ")->first();

        return [
            'page_views' => (int) ($row->page_views ?? 0),
            'view_content' => (int) ($row->view_content ?? 0),
            'add_to_cart' => (int) ($row->add_to_cart ?? 0),
            'purchases' => (int) ($row->purchases ?? 0),
            'revenue' => (float) ($row->revenue ?? 0),
        ];
    }

    public function getRevenueTotalProperty(): float
    {
        return $this->aggregateRow()['revenue'];
    }

    public function getConversionViewToCartProperty(): float
    {
        $agg = $this->aggregateRow();
        return $agg['view_content'] > 0 ? ($agg['add_to_cart'] / $agg['view_content']) : 0.0;
    }

    public function getConversionCartToPurchaseProperty(): float
    {
        $agg = $this->aggregateRow();
        return $agg['add_to_cart'] > 0 ? ($agg['purchases'] / $agg['add_to_cart']) : 0.0;
    }

    private function countFor(array $names): int
    {
        return (int) $this->baseQuery()
            ->whereIn('event_name', $names)
            ->count();
    }

    public function getPageViewCountProperty(): int
    {
        return $this->countFor(['PageView', 'page_view']);
    }

    public function getViewContentCountProperty(): int
    {
        return $this->countFor(['ViewContent', 'view_item']);
    }

    public function getAddToCartCountProperty(): int
    {
        return $this->countFor(['AddToCart', 'add_to_cart']);
    }

    public function getPurchaseCountProperty(): int
    {
        return $this->countFor(['Purchase', 'purchase']);
    }

    public function getRecentEventsProperty(): Collection
    {
        return $this->baseQuery()
            ->orderByDesc('created_at')
            ->limit(50)
            ->get(['id', 'event_uuid', 'event_name', 'session_id', 'page_url', 'referrer', 'metadata', 'user_ip', 'user_agent', 'occurred_at', 'created_at']);
    }

    public function getDailySeriesProperty(): array
    {
        $start = $this->startAt();
        $days = match ($this->range) {
            '7d' => 7,
            '30d' => 30,
            default => 1,
        };

        $revenueExpr = "COALESCE(CAST(JSON_UNQUOTE(JSON_EXTRACT(metadata, '$.event.value')) AS DECIMAL(18,2)), 0)";

        $rows = $this->baseQuery()
            ->selectRaw("
                DATE(created_at) AS d,
                SUM(CASE WHEN event_name IN ('PageView','page_view') THEN 1 ELSE 0 END) AS page_views,
                SUM(CASE WHEN event_name IN ('ViewContent','view_item') THEN 1 ELSE 0 END) AS view_content,
                SUM(CASE WHEN event_name IN ('AddToCart','add_to_cart') THEN 1 ELSE 0 END) AS add_to_cart,
                SUM(CASE WHEN event_name IN ('Purchase','purchase') THEN 1 ELSE 0 END) AS purchases,
                SUM(CASE WHEN event_name IN ('Purchase','purchase') THEN {$revenueExpr} ELSE 0 END) AS revenue
            ")
            ->groupBy('d')
            ->orderBy('d')
            ->get()
            ->keyBy('d');

        $labels = [];
        $pageViews = [];
        $viewContent = [];
        $addToCart = [];
        $purchases = [];
        $revenue = [];

        for ($i = 0; $i < $days; $i++) {
            $date = $start->addDays($i);
            $key = $date->format('Y-m-d');
            $labels[] = $date->format('M j');
            $r = $rows->get($key);
            $pageViews[] = (int) ($r->page_views ?? 0);
            $viewContent[] = (int) ($r->view_content ?? 0);
            $addToCart[] = (int) ($r->add_to_cart ?? 0);
            $purchases[] = (int) ($r->purchases ?? 0);
            $revenue[] = (float) ($r->revenue ?? 0);
        }

        return compact('labels', 'pageViews', 'viewContent', 'addToCart', 'purchases', 'revenue');
    }

    public function rangeLabel(): string
    {
        return match ($this->range) {
            '7d' => 'Last 7 days',
            '30d' => 'Last 30 days',
            default => 'Today',
        };
    }

    protected function getHeaderWidgets(): array
    {
        return [
            PageViewsOverTimeChart::class,
            PurchasesOverTimeChart::class,
        ];
    }

    protected function getHeaderWidgetsColumns(): int
    {
        return 2;
    }
}