<?php

namespace Database\Seeders;

use Database\Seeders\FaqSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\ChatSeeder;
use Database\Seeders\BrandSeeder;
use Database\Seeders\OrderSeeder;
use Database\Seeders\CouponSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\OrderItemSeeder;
use Database\Seeders\RefundPolicySeeder;
use Database\Seeders\PaymentMethodSeeder;
use Database\Seeders\ProductReviewSeeder;
use Database\Seeders\ProductAttachmentSeeder;
use Database\Seeders\PaymentTransactionSeeder;
use Database\Seeders\ShippingAndBillingAddressSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Admin::factory(5)->create();
        \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            CategorySeeder::class,
            BrandSeeder::class,
            ProductSeeder::class,
            ProductAttachmentSeeder::class,
            ShippingAndBillingAddressSeeder::class,
            OrderSeeder::class,
            OrderItemSeeder::class,
            PaymentMethodSeeder::class,
            PaymentTransactionSeeder::class,
            ProductReviewSeeder::class,
            FaqSeeder::class,
            ChatSeeder::class,
            RefundPolicySeeder::class,
            CouponSeeder::class,
        ]);
    }
}
