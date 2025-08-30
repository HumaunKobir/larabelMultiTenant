<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Load central domain routes (super admin, auth, dashboard, tenants management)
        foreach ($this->centralDomains() as $domain) {
            Route::middleware('web')
                ->domain($domain)
                ->group(base_path('routes/web.php'));

            Route::middleware('web')
                ->domain($domain)
                ->group(base_path('routes/auth.php'));
        }

        // Tenant routes are handled separately by Stancl's TenantRouteServiceProvider
        // You do NOT register tenant.php here.
    }

    protected function centralDomains(): array
    {
        return config('tenancy.central_domains', []);
    }
}
