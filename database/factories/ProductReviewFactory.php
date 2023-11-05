<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductReview>
 */
class ProductReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductReview::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_id' =>  Product::query()->inRandomOrder()->first()->id ?? Product::factory()->create()->id,
            'user_id' =>  User::query()->inRandomOrder()->first()->id ?? User::factory()->create()->id,
            'review_text' => $this->faker->optional()->paragraph,
            'rating_value' => $this->faker->optional()->numberBetween(1, 5),
            'is_verified' => $this->faker->randomElement(['yes', 'no']),
        ];
    }
}
