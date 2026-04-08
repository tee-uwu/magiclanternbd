@props([
    'maxContentWidth' => null,
])

<x-filament::layouts.base :title="$title">

    <!-- 🌗 DARK MODE STYLE -->
    <style>
        html {
            transition: background-color 0.4s ease, color 0.4s ease;
        }
        body {
            transition: all 0.4s ease;
        }
    </style>

    <div class="filament-app-layout flex h-full w-full overflow-x-clip">

        <div
            x-data="{}"
            x-cloak
            x-show="$store.sidebar.isOpen"
            x-transition.opacity.500ms
            x-on:click="$store.sidebar.close()"
            class="filament-sidebar-close-overlay fixed inset-0 z-20 h-full w-full bg-gray-900/50 lg:hidden"
        ></div>

        <x-filament::layouts.app.sidebar />

        <div
            @if (config('filament.layout.sidebar.is_collapsible_on_desktop'))
                x-data="{}"
                x-bind:class="{
                    'lg:pl-[var(--collapsed-sidebar-width)] rtl:lg:pr-[var(--collapsed-sidebar-width)]':
                        ! $store.sidebar.isOpen,
                    'filament-main-sidebar-open lg:pl-[var(--sidebar-width)] rtl:lg:pr-[var(--sidebar-width)]':
                        $store.sidebar.isOpen,
                }"
                x-bind:style="'display: flex'"
            @endif
            @class([
                'filament-main w-screen flex-1 flex-col gap-y-6 rtl:lg:pl-0',
                'hidden h-full transition-all' => config('filament.layout.sidebar.is_collapsible_on_desktop'),
                'flex lg:pl-[var(--sidebar-width)] rtl:lg:pr-[var(--sidebar-width)]' => ! config('filament.layout.sidebar.is_collapsible_on_desktop'),
            ])
        >

            <!-- 🔥 TOPBAR + TOGGLE -->
            <div class="flex items-center justify-between px-4 md:px-6 lg:px-8">

                <x-filament::topbar :breadcrumbs="$breadcrumbs" />

                <!-- 🌗 TOGGLE BUTTON -->
                <button id="themeToggle"
                    class="ml-4 px-3 py-2 rounded-full bg-gray-200 dark:bg-gray-700 
                           transition-all duration-300 hover:scale-110 shadow">

                    <span class="dark:hidden">🌙</span>
                    <span class="hidden dark:inline">☀️</span>

                </button>

            </div>

            <!-- CONTENT -->
            <div
                @class([
                    'filament-main-content mx-auto w-full flex-1 px-4 md:px-6 lg:px-8',
                    match ($maxContentWidth ??= config('filament.layout.max_content_width')) {
                        null, '7xl', '' => 'max-w-7xl',
                        'xl' => 'max-w-xl',
                        '2xl' => 'max-w-2xl',
                        '3xl' => 'max-w-3xl',
                        '4xl' => 'max-w-4xl',
                        '5xl' => 'max-w-5xl',
                        '6xl' => 'max-w-6xl',
                        'full' => 'max-w-full',
                        default => $maxContentWidth,
                    },
                ])
            >
                {{ \Filament\Facades\Filament::renderHook('content.start') }}

                {{ $slot }}

                {{ \Filament\Facades\Filament::renderHook('content.end') }}
            </div>

            <div class="filament-main-footer shrink-0 py-4">
                <x-filament::footer />
            </div>

        </div>
    </div>

    <!-- 🌗 DARK MODE SCRIPT -->
    <script>
    document.addEventListener("DOMContentLoaded", function () {

        const toggle = document.getElementById("themeToggle");

        // Load saved theme
        if (localStorage.getItem("theme") === "dark") {
            document.documentElement.classList.add("dark");
        }

        toggle?.addEventListener("click", () => {
            document.documentElement.classList.toggle("dark");

            if (document.documentElement.classList.contains("dark")) {
                localStorage.setItem("theme", "dark");
            } else {
                localStorage.setItem("theme", "light");
            }
        });

    });
    </script>

</x-filament::layouts.base>