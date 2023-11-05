<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductAttachment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductAttachment>
 */
class ProductAttachmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductAttachment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_id' => Product::query()->inRandomOrder()->first()->id ?? Product::factory()->create()->id,
            'images' => $this->faker->imageUrl(),
        ];
    }
}
