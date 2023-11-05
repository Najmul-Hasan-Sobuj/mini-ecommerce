<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Product;
use App\Models\CartAndWishlist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CartAndWishlist>
 */
class CartAndWishlistFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CartAndWishlist::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $type = $this->faker->randomElement(['cart', 'wishlist']);
        $quantity = $type === 'cart' ? $this->faker->numberBetween(1, 10) : null;
        $price = $type === 'cart' ? $this->faker->randomFloat(2, 10, 1000) : null;

        return [
            'type' => $type,
            'user_id' => User::query()->inRandomOrder()->first()->id ?? User::factory()->create()->id,
            'product_id' =>  Product::query()->inRandomOrder()->first()->id ?? Product::factory()->create()->id,
            'quantity' => $quantity,
            'price' => $price,
        ];
    }
}
