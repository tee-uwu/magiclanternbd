<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Order;
use Carbon\Carbon;

class Dashboard extends Page
{
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?int $navigationSort = 0;

    protected static string $view = 'filament.pages.dashboard';

    public $todayOrders;
    public $monthOrders;
    public $totalOrders;
    public $cancelledOrders;

    public function mount()
    {
        $this->todayOrders = Order::whereDate('created_at', Carbon::today())->count();
        $this->monthOrders = Order::whereMonth('created_at', now()->month)->count();
        $this->totalOrders = Order::count();
        $this->cancelledOrders = Order::where('status', 'cancelled')->count();
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
