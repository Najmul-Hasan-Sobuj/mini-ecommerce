<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class BreadcrumbServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        View::composer('admin.partials.page-header', function ($view) {
            $segments = request()->segments();
            $breadcrumbs = [];
            foreach ($segments as $key => $segment) {
                $breadcrumbs[] = [
                    'url' => '/' . implode('/', array_slice($segments, 0, $key + 1)),
                    'name' => ucfirst($segment),
                ];
            }
            $view->with('breadcrumbs', $breadcrumbs);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
