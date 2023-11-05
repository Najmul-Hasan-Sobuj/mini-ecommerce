<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShippingAndBillingAddress;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ShippingAndBillingAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ShippingAndBillingAddress::factory(25)->create();
    }
}
