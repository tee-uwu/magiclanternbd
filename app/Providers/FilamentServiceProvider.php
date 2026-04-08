<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;
use App\Filament\Pages\Dashboard;
use App\Filament\Pages\Analytics;
use App\Filament\Resources\ContentResource;
use App\Filament\Resources\OrderResource;
use App\Filament\Resources\PostResource;
use App\Filament\Resources\ProductResource;
use App\Filament\Resources\ReviewResource;

class FilamentServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Register custom styles when Filament is serving
        Filament::serving(function () {
            Filament::registerStyles([
                asset('css/filament-admin.css'),
            ]);
        });

        // Register Filament v2 resources and pages
        Filament::registerPages([
            Dashboard::class,
            Analytics::class,
        ]);

        Filament::registerResources([
            ContentResource::class,
            OrderResource::class,
            PostResource::class,
            ProductResource::class,
            ReviewResource::class,
        ]);

        // Register render hook for custom admin nav (v2 compatible)
        // Moved to AdminPanelProvider
    }
}
