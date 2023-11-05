<?php

namespace Database\Seeders;

use App\Models\CartAndWishlist;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CartAndWishlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CartAndWishlist::factory(100)->create();
    }
}
