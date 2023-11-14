<?php

namespace App\Providers;

use App\Repositories\FaqRepository;
use App\Repositories\SmtpRepository;
use App\Repositories\BrandRepository;
use App\Repositories\CouponRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryRepository;
use App\Repositories\RefundPolicyRepository;
use App\Repositories\BaseRepositoryInterface;
use App\Repositories\PaymentMethodRepository;
use App\Repositories\Interfaces\SmtpRepositoryInterface;
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
            BaseRepositoryInterface::class => FaqRepository::class,
            BaseRepositoryInterface::class => CouponRepository::class,
            PaymentMethodRepositoryInterface::class => PaymentMethodRepository::class,
            RefundPolicyRepositoryInterface::class => RefundPolicyRepository::class,
            SmtpRepositoryInterface::class => SmtpRepository::class,
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
