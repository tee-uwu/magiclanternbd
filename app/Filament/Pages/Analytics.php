<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\PageViewsOverTimeChart;
use App\Filament\Widgets\PurchasesOverTimeChart;
use Filament\Pages\Page;
use App\Models\TrackingEvent;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;

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
            ->get(['id', 'event_name', 'session_id', 'metadata', 'occurred_at', 'created_at']);
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