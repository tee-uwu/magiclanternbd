<x-filament::page class="space-y-6">
    <x-filament::card class="p-5">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="space-y-1">
                <div class="text-2xl font-bold text-gray-900 dark:text-gray-100">Analytics</div>
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    Real-time event tracking from your database ({{ $this->rangeLabel() }}).
                </div>
            </div>

            <div class="w-full sm:w-64">
                <select
                    wire:model="range"
                    class="w-full rounded-xl border-gray-200 bg-white px-3 py-2 text-sm shadow-sm outline-none transition focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 dark:border-gray-700 dark:bg-gray-900"
                >
                    <option value="today">Today</option>
                    <option value="7d">Last 7 days</option>
                    <option value="30d">Last 30 days</option>
                </select>
            </div>
        </div>
    </x-filament::card>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <x-filament::card class="p-5">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs uppercase tracking-widest text-gray-400">Revenue</p>
                    <h2 class="mt-2 text-3xl font-bold">
                        ৳ {{ number_format($this->revenueTotal, 2) }}
                    </h2>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">From Purchase events</p>
                </div>
                <div class="rounded-xl bg-success-500/10 p-2 text-success-600 dark:text-success-400">
                    <x-heroicon-o-banknotes class="h-6 w-6" />
                </div>
            </div>
        </x-filament::card>

        <x-filament::card class="p-5">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs uppercase tracking-widest text-gray-400">PageView</p>
                    <h2 class="mt-2 text-3xl font-bold">{{ $this->pageViewCount }}</h2>
                </div>
                <div class="rounded-xl bg-primary-500/10 p-2 text-primary-600 dark:text-primary-400">
                    <x-heroicon-o-eye class="h-6 w-6" />
                </div>
            </div>
        </x-filament::card>

        <x-filament::card class="p-5">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs uppercase tracking-widest text-gray-400">ViewContent</p>
                    <h2 class="mt-2 text-3xl font-bold">{{ $this->viewContentCount }}</h2>
                </div>
                <div class="rounded-xl bg-info-500/10 p-2 text-info-600 dark:text-info-400">
                    <x-heroicon-o-document-text class="h-6 w-6" />
                </div>
            </div>
        </x-filament::card>

        <x-filament::card class="p-5">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs uppercase tracking-widest text-gray-400">AddToCart</p>
                    <h2 class="mt-2 text-3xl font-bold">{{ $this->addToCartCount }}</h2>
                </div>
                <div class="rounded-xl bg-warning-500/10 p-2 text-warning-700 dark:text-warning-400">
                    <x-heroicon-o-shopping-cart class="h-6 w-6" />
                </div>
            </div>
        </x-filament::card>

        <x-filament::card class="p-5">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs uppercase tracking-widest text-gray-400">Purchase</p>
                    <h2 class="mt-2 text-3xl font-bold">{{ $this->purchaseCount }}</h2>
                </div>
                <div class="rounded-xl bg-success-500/10 p-2 text-success-600 dark:text-success-400">
                    <x-heroicon-o-check-circle class="h-6 w-6" />
                </div>
            </div>
        </x-filament::card>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-filament::card class="p-5 lg:col-span-1">
            <div class="text-sm font-semibold text-gray-900 dark:text-gray-100">Conversion rates</div>
            <div class="mt-4 space-y-4">
                <div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600 dark:text-gray-300">ViewContent → AddToCart</span>
                        <span class="font-semibold">{{ number_format($this->conversionViewToCart * 100, 2) }}%</span>
                    </div>
                    <div class="mt-2 h-2 rounded-full bg-gray-100 dark:bg-gray-800">
                        <div class="h-2 rounded-full bg-info-500" style="width: {{ min(100, max(0, $this->conversionViewToCart * 100)) }}%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600 dark:text-gray-300">AddToCart → Purchase</span>
                        <span class="font-semibold">{{ number_format($this->conversionCartToPurchase * 100, 2) }}%</span>
                    </div>
                    <div class="mt-2 h-2 rounded-full bg-gray-100 dark:bg-gray-800">
                        <div class="h-2 rounded-full bg-success-500" style="width: {{ min(100, max(0, $this->conversionCartToPurchase * 100)) }}%"></div>
                    </div>
                </div>
            </div>
        </x-filament::card>

        <x-filament::card class="p-5 lg:col-span-2">
            <div class="flex items-center justify-between">
                <div class="text-sm font-semibold text-gray-900 dark:text-gray-100">Events over time</div>
                <div class="text-xs text-gray-500 dark:text-gray-400">Grouped daily ({{ $this->rangeLabel() }})</div>
            </div>
            <div class="mt-4" style="height: 320px;">
                <canvas id="eventsLineChart"></canvas>
            </div>
        </x-filament::card>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-filament::card class="p-5 lg:col-span-1">
            <div class="flex items-center justify-between">
                <div class="text-sm font-semibold text-gray-900 dark:text-gray-100">Funnel</div>
                <div class="text-xs text-gray-500 dark:text-gray-400">ViewContent → AddToCart → Purchase</div>
            </div>
            <div class="mt-4" style="height: 320px;">
                <canvas id="funnelChart"></canvas>
            </div>
        </x-filament::card>

        <x-filament::card class="p-5 lg:col-span-2">
            <div class="flex items-center justify-between">
                <div class="text-sm font-semibold text-gray-900 dark:text-gray-100">Revenue over time</div>
                <div class="text-xs text-gray-500 dark:text-gray-400">From Purchase events</div>
            </div>
            <div class="mt-4" style="height: 320px;">
                <canvas id="revenueLineChart"></canvas>
            </div>
        </x-filament::card>
    </div>

    <x-filament::card class="p-5">
        <div class="mb-4">
            <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">Recent events</div>
            <div class="text-sm text-gray-500 dark:text-gray-400">Latest tracking events (sorted newest first).</div>
        </div>

        <div class="-mx-5 overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800">
                <thead class="bg-gray-50 dark:bg-gray-950/40">
                    <tr>
                        <th class="whitespace-nowrap px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Event
                        </th>
                        <th class="whitespace-nowrap px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            UUID
                        </th>
                        <th class="whitespace-nowrap px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Session
                        </th>
                        <th class="whitespace-nowrap px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            URL
                        </th>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Metadata
                        </th>
                        <th class="whitespace-nowrap px-5 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Time
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white dark:divide-gray-800 dark:bg-gray-900">
                    @forelse($this->recentEvents as $event)
                        <tr class="hover:bg-gray-50/60 dark:hover:bg-gray-950/30">
                            <td class="whitespace-nowrap px-5 py-3 align-top">
                                <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-1 text-xs font-semibold text-gray-700 dark:bg-gray-800 dark:text-gray-200">
                                    {{ $event->event_name }}
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-5 py-3 align-top text-sm text-gray-500 dark:text-gray-400">
                                @if($event->event_uuid)
                                    <span class="font-mono text-xs">{{ \Illuminate\Support\Str::limit($event->event_uuid, 18, '…') }}</span>
                                @else
                                    <span class="text-gray-400">—</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-5 py-3 align-top text-sm text-gray-500 dark:text-gray-400">
                                @if($event->session_id)
                                    <span class="font-mono text-xs">{{ \Illuminate\Support\Str::limit($event->session_id, 18, '…') }}</span>
                                @else
                                    <span class="text-gray-400">—</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-5 py-3 align-top text-xs text-gray-500 dark:text-gray-400">
                                @if($event->page_url)
                                    <span class="block max-w-[36ch] truncate" title="{{ $event->page_url }}">{{ $event->page_url }}</span>
                                    @if($event->referrer)
                                        <span class="block max-w-[36ch] truncate text-gray-400" title="{{ $event->referrer }}">ref: {{ $event->referrer }}</span>
                                    @endif
                                @else
                                    <span class="text-gray-400">—</span>
                                @endif
                                <span class="block text-gray-400">
                                    {{ $event->user_ip }} · {{ \Illuminate\Support\Str::limit($event->user_agent, 28, '…') }}
                                </span>
                            </td>
                            <td class="px-5 py-3 align-top">
                                @php($pretty = $event->metadata ? json_encode($event->metadata, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) : null)
                                @if($pretty)
                                    <pre class="max-w-[72ch] overflow-auto rounded-xl bg-gray-50 p-3 text-xs text-gray-700 ring-1 ring-gray-200 dark:bg-gray-950 dark:text-gray-200 dark:ring-gray-800">{{ $pretty }}</pre>
                                @else
                                    <span class="text-sm text-gray-400">—</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-5 py-3 text-right align-top text-sm text-gray-500 dark:text-gray-400">
                                {{ optional($event->occurred_at ?? $event->created_at)->diffForHumans() }}
                                <div class="text-xs text-gray-400">
                                    {{ optional($event->occurred_at ?? $event->created_at)->format('Y-m-d H:i:s') }}
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-10 text-center text-sm text-gray-500">
                                No tracking events found for this range.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-filament::card>

    @php($series = $this->dailySeries)
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script>
        (function () {
            const labels = @json($series['labels'] ?? []);
            const pageViews = @json($series['pageViews'] ?? []);
            const viewContent = @json($series['viewContent'] ?? []);
            const addToCart = @json($series['addToCart'] ?? []);
            const purchases = @json($series['purchases'] ?? []);
            const revenue = @json($series['revenue'] ?? []);

            const isDark = document.documentElement.classList.contains('dark');
            const grid = isDark ? 'rgba(71,85,105,0.28)' : 'rgba(148,163,184,0.2)';
            const tick = isDark ? '#94a3b8' : '#64748b';

            const eventsCtx = document.getElementById('eventsLineChart');
            if (eventsCtx) {
                new Chart(eventsCtx, {
                    type: 'line',
                    data: {
                        labels,
                        datasets: [
                            { label: 'PageViews', data: pageViews, borderColor: '#3b82f6', backgroundColor: 'rgba(59,130,246,0.12)', fill: true, tension: 0.35, pointRadius: 2 },
                            { label: 'ViewContent', data: viewContent, borderColor: '#06b6d4', backgroundColor: 'rgba(6,182,212,0.10)', fill: true, tension: 0.35, pointRadius: 2 },
                            { label: 'AddToCart', data: addToCart, borderColor: '#f59e0b', backgroundColor: 'rgba(245,158,11,0.10)', fill: true, tension: 0.35, pointRadius: 2 },
                            { label: 'Purchase', data: purchases, borderColor: '#22c55e', backgroundColor: 'rgba(34,197,94,0.10)', fill: true, tension: 0.35, pointRadius: 2 },
                        ],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { position: 'bottom' } },
                        scales: {
                            x: { grid: { color: grid }, ticks: { color: tick } },
                            y: { beginAtZero: true, grid: { color: grid }, ticks: { color: tick, precision: 0 } },
                        },
                    },
                });
            }

            const revCtx = document.getElementById('revenueLineChart');
            if (revCtx) {
                new Chart(revCtx, {
                    type: 'line',
                    data: {
                        labels,
                        datasets: [
                            { label: 'Revenue (BDT)', data: revenue, borderColor: '#0ea5e9', backgroundColor: 'rgba(14,165,233,0.12)', fill: true, tension: 0.35, pointRadius: 2 },
                        ],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            x: { grid: { color: grid }, ticks: { color: tick } },
                            y: { beginAtZero: true, grid: { color: grid }, ticks: { color: tick } },
                        },
                    },
                });
            }

            const funnelCtx = document.getElementById('funnelChart');
            if (funnelCtx) {
                new Chart(funnelCtx, {
                    type: 'bar',
                    data: {
                        labels: ['ViewContent', 'AddToCart', 'Purchase'],
                        datasets: [{
                            data: [@json($this->viewContentCount), @json($this->addToCartCount), @json($this->purchaseCount)],
                            backgroundColor: ['rgba(6,182,212,0.6)', 'rgba(245,158,11,0.6)', 'rgba(34,197,94,0.6)'],
                            borderColor: ['#06b6d4', '#f59e0b', '#22c55e'],
                            borderWidth: 1,
                            borderRadius: 10,
                        }],
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            x: { beginAtZero: true, grid: { color: grid }, ticks: { color: tick, precision: 0 } },
                            y: { grid: { display: false }, ticks: { color: tick } },
                        },
                    },
                });
            }
        })();
    </script>
</x-filament::page>
