<x-filament::page>

    <div class="space-y-8">

        <!-- HERO -->
        <div class="dashboard-hero p-8 rounded-2xl">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-semibold text-white">
                        Dashboard
                    </h1>
                    <p class="mt-2 text-sm text-slate-400">
                        Overview of your store performance
                    </p>
                </div>

                <a href="/admin/analytics"
                   class="btn-primary">
                    View Analytics →
                </a>
            </div>
        </div>

        <!-- STATS -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

            <div class="stats-card">
                <p class="label">Today Orders</p>
                <p class="value text-indigo-400">{{ $todayOrders }}</p>
            </div>

            <div class="stats-card">
                <p class="label">This Month</p>
                <p class="value text-green-400">{{ $monthOrders }}</p>
            </div>

            <div class="stats-card">
                <p class="label">Total Orders</p>
                <p class="value text-blue-400">{{ $totalOrders }}</p>
            </div>

            <div class="stats-card">
                <p class="label">Cancelled</p>
                <p class="value text-red-400">{{ $cancelledOrders }}</p>
            </div>

        </div>

        <!-- CHART -->
        <div class="dashboard-card p-6 rounded-2xl">
            <h3 class="text-lg font-semibold text-white mb-4">
                Orders Last 7 Days
            </h3>

            <canvas id="ordersChart"></canvas>
        </div>

    </div>

</x-filament::page>