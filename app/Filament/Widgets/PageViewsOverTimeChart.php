<?php

namespace App\Filament\Widgets;

use App\Models\TrackingEvent;
use Carbon\CarbonImmutable;
use Filament\Widgets\ChartWidget;

class PageViewsOverTimeChart extends ChartWidget
{
    protected static ?string $heading = 'PageViews over time';

    public string $range = 'today'; // today|7d|30d

    protected int | string | null $height = '320px';

    protected $listeners = [
        'analyticsRangeUpdated' => 'setRange',
    ];

    public function setRange(string $range): void
    {
        $this->range = in_array($range, ['today', '7d', '30d'], true) ? $range : 'today';
    }

    protected function getData(): array
    {
        [$labels, $counts] = $this->countsByDay(['PageView', 'page_view']);

        return [
            'datasets' => [
                [
                    'label' => 'PageViews',
                    'data' => $counts,
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.15)',
                    'fill' => true,
                    'tension' => 0.35,
                    'borderWidth' => 2,
                    'pointRadius' => 3,
                    'pointHoverRadius' => 5,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'plugins' => [
                'legend' => ['display' => false],
                'tooltip' => [
                    'mode' => 'index',
                    'intersect' => false,
                ],
            ],
            'interaction' => [
                'mode' => 'index',
                'intersect' => false,
            ],
            'scales' => [
                'x' => [
                    'grid' => ['display' => false],
                    'ticks' => ['maxRotation' => 0],
                ],
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => ['precision' => 0],
                ],
            ],
        ];
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

    private function countsByDay(array $eventNames): array
    {
        $start = $this->startAt();
        $days = match ($this->range) {
            '7d' => 7,
            '30d' => 30,
            default => 1,
        };

        $rows = TrackingEvent::query()
            ->selectRaw('DATE(created_at) as d, COUNT(*) as c')
            ->whereBetween('created_at', [$start, CarbonImmutable::now()])
            ->whereIn('event_name', $eventNames)
            ->groupBy('d')
            ->pluck('c', 'd');

        $labels = [];
        $counts = [];
        for ($i = 0; $i < $days; $i++) {
            $date = $start->addDays($i)->format('Y-m-d');
            $labels[] = $start->addDays($i)->format('M j');
            $counts[] = (int) ($rows[$date] ?? 0);
        }

        return [$labels, $counts];
    }
}

