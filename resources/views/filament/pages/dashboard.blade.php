<x-filament::page class="space-y-8">
    <x-filament::card>
        <div class="space-y-2">
            <h1 class="text-2xl font-bold">Dashboard</h1>
            <p class="text-sm text-gray-500">Quick store stats and chart overview.</p>
        </div>
    </x-filament::card>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <x-filament::card class="p-5">
            <p class="text-xs uppercase tracking-widest text-gray-400">Today's Orders</p>
            <h2 class="text-3xl font-bold">{{ $this->todayOrders ?? 0 }}</h2>
        </x-filament::card>

        <x-filament::card class="p-5">
            <p class="text-xs uppercase tracking-widest text-gray-400">This Month</p>
            <h2 class="text-3xl font-bold">{{ $this->monthOrders ?? 0 }}</h2>
        </x-filament::card>

        <x-filament::card class="p-5">
            <p class="text-xs uppercase tracking-widest text-gray-400">Cancelled</p>
            <h2 class="text-3xl font-bold">{{ $this->cancelledOrders ?? 0 }}</h2>
        </x-filament::card>

        <x-filament::card class="p-5">
            <p class="text-xs uppercase tracking-widest text-gray-400">Total Orders</p>
            <h2 class="text-3xl font-bold">{{ $this->totalOrders ?? 0 }}</h2>
        </x-filament::card>
    </div>

    <x-filament::card>
        <h3 class="text-lg font-semibold mb-2">Orders Last 7 Days</h3>
        <div style="height:320px;" class="relative">
            <canvas id="ordersChart"></canvas>
        </div>
    </x-filament::card>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const chartData = @json($this->getChartData() ?? []);
        const safeData = (Array.isArray(chartData) && chartData.length) ? chartData : [0, 0, 0, 0, 0, 0, 0];

        const chart = new Chart(document.getElementById('ordersChart'), {
            type: 'line',
            data: {
                labels: ['6 days ago', '5 days ago', '4 days ago', '3 days ago', '2 days ago', 'Yesterday', 'Today'],
                datasets: [{
                    label: 'Orders',
                    data: safeData,
                    borderColor: '#22c55e',
                    backgroundColor: 'rgba(34, 197, 94, 0.2)',
                    fill: true,
                    tension: 0.3,
                    borderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: true }
                },
                scales: {
                    x: {
                        grid: { color: 'rgba(148, 163, 184, 0.2)' },
                        ticks: { color: '#64748b' }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(148, 163, 184, 0.2)' },
                        ticks: { color: '#64748b' }
                    }
                }
            }
        });
    </script>
</x-filament::page>
