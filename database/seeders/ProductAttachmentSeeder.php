<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductAttachment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductAttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductAttachment::factory(200)->create();
    }
}
