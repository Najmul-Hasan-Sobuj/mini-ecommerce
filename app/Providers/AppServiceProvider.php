<?php

namespace App\Providers;

use App\Repositories\FaqRepository;
use App\Repositories\BrandRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryRepository;
use App\Repositories\RefundPolicyRepository;
use App\Repositories\PaymentMethodRepository;
use App\Repositories\PaymentTransactionRepository;
use App\Repositories\Interfaces\FaqRepositoryInterface;
use App\Repositories\Interfaces\BrandRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\RefundPolicyRepositoryInterface;
use App\Repositories\Interfaces\PaymentMethodRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $bindings = [
            CategoryRepositoryInterface::class => CategoryRepository::class,
            BrandRepositoryInterface::class => BrandRepository::class,
            FaqRepositoryInterface::class => FaqRepository::class,
            PaymentMethodRepositoryInterface::class => PaymentMethodRepository::class,
            RefundPolicyRepositoryInterface::class => RefundPolicyRepository::class,
        ];

        foreach ($bindings as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
