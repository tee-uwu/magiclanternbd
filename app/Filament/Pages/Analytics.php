<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Order;
use Carbon\Carbon;

class Analytics extends Page
{
    protected static bool $shouldRegisterNavigation = true;
    protected static ?string $navigationLabel = 'Analytics';
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?int $navigationSort = 3;

    protected static string $view = 'filament.pages.analytics';

    public $todayOrders;
    public $monthOrders;
    public $totalOrders;
    public $cancelledOrders;
    public $insideOrders;
    public $outsideOrders;
    public $favoriteColor;
    public $favoriteColorCount;

    public function mount()
    {
        $this->todayOrders = Order::whereDate('created_at', Carbon::today())->count();
        $this->monthOrders = Order::whereMonth('created_at', now()->month)->count();
        $this->totalOrders = Order::count();
        $this->cancelledOrders = Order::where('status', 'cancelled')->count();

        $this->insideOrders = Order::where('delivery_area', 'inside')->count();
        $this->outsideOrders = Order::where('delivery_area', 'outside')->count();

        $topColorOrder = Order::select('color')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('color')
            ->orderByDesc('total')
            ->first();

        $this->favoriteColor = $topColorOrder?->color ?? 'N/A';
        $this->favoriteColorCount = $topColorOrder?->total ?? 0;
    }

    public function getChartData()
    {
        $orders = Order::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(6))
            ->groupBy('date')
            ->pluck('count', 'date');

        $data = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $data[] = $orders[$date] ?? 0;
        }

        return $data;
    }
}