<x-filament::page class="space-y-8">
    <x-filament::card>
        <div class="space-y-2">
            <h1 class="text-2xl font-bold">Analytics</h1>
            <p class="text-sm text-gray-500">Detailed insights and metrics for your store performance.</p>
        </div>
    </x-filament::card>

    {{-- Main Stats (like dashboard) --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <x-filament::card class="p-5">
            <p class="text-xs uppercase tracking-widest text-gray-400">Today Orders</p>
            <h2 class="text-3xl font-bold">{{ $this->todayOrders }}</h2>
        </x-filament::card>

        <x-filament::card class="p-5">
            <p class="text-xs uppercase tracking-widest text-gray-400">This Month</p>
            <h2 class="text-3xl font-bold">{{ $this->monthOrders }}</h2>
        </x-filament::card>

        <x-filament::card class="p-5">
            <p class="text-xs uppercase tracking-widest text-gray-400">Total Orders</p>
            <h2 class="text-3xl font-bold">{{ $this->totalOrders }}</h2>
        </x-filament::card>

        <x-filament::card class="p-5">
            <p class="text-xs uppercase tracking-widest text-gray-400">Cancelled</p>
            <h2 class="text-3xl font-bold text-red-500">{{ $this->cancelledOrders }}</h2>
        </x-filament::card>
    </div>

    {{-- Delivery Breakdown --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <x-filament::card class="p-5">
            <p class="text-xs uppercase tracking-widest text-gray-400">Inside Dhaka Orders</p>
            <h2 class="text-3xl font-bold">{{ $this->insideOrders }}</h2>
            <p class="text-sm text-gray-500 mt-1">
                {{ round(($this->insideOrders / max(1, $this->totalOrders)) * 100) }}% of total
            </p>
        </x-filament::card>

        <x-filament::card class="p-5">
            <p class="text-xs uppercase tracking-widest text-gray-400">Outside Dhaka Orders</p>
            <h2 class="text-3xl font-bold">{{ $this->outsideOrders }}</h2>
            <p class="text-sm text-gray-500 mt-1">
                {{ round(($this->outsideOrders / max(1, $this->totalOrders)) * 100) }}% of total
            </p>
        </x-filament::card>
    </div>

    {{-- Favorite Color --}}
    <x-filament::card class="p-5">
        <p class="text-xs uppercase tracking-widest text-gray-400 mb-2">Most Popular Color</p>
        <div class="space-y-1">
            <h3 class="text-lg font-bold">{{ ucfirst(str_replace('#', '', $this->favoriteColor ?? 'N/A')) }} — {{ $this->favoriteColorCount }} orders</h3>
            <p class="text-sm text-gray-500">
                {{ $this->favoriteColorCount > 0 ? round(($this->favoriteColorCount / max(1, $this->totalOrders)) * 100) : 0 }}% preference
            </p>
        </div>
    </x-filament::card>

    {{-- Chart (matching dashboard green theme) --}}
    <x-filament::card>
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold">Orders Last 7 Days</h3>
            <span class="px-2 py-1 text-xs font-bold uppercase tracking-wide text-white bg-green-500 rounded">Live Data</span>
        </div>
        <div style="height:320px;" class="relative">
            <canvas id="ordersChart"></canvas>
        </div>
    </x-filament::card>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const chartData = @json($this->getChartData() ?? []);
        const safeData = (Array.isArray(chartData) && chartData.length) ? chartData : [0, 0, 0, 0, 0, 0, 0];

        const isDark = document.documentElement.classList.contains('dark');
        
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
                    pointBackgroundColor: '#22c55e',
                    pointBorderColor: isDark ? '#0f172a' : '#ffffff',
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: isDark ? 'rgba(15, 23, 42, 0.96)' : 'rgba(255,255,255,0.98)',
                        titleColor: isDark ? '#ffffff' : '#0f172a',
                        bodyColor: isDark ? '#cbd5e1' : '#334155',
                        borderColor: '#22c55e',
                        borderWidth: 1,
                        cornerRadius: 8,
                        padding: 12
                    }
                },
                scales: {
                    x: {
                        grid: { color: isDark ? 'rgba(71,85,105,0.28)' : 'rgba(148,163,184,0.2)' },
                        ticks: { 
                            color: isDark ? '#94a3b8' : '#64748b',
                            font: { size: 12 }
                        },
                        border: { display: false }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: isDark ? 'rgba(71,85,105,0.28)' : 'rgba(148,163,184,0.2)' },
                        ticks: { 
                            color: isDark ? '#94a3b8' : '#64748b',
                            font: { size: 12 }
                        },
                        border: { display: false }
                    }
                }
            }
        });
    </script>
</x-filament::page>
