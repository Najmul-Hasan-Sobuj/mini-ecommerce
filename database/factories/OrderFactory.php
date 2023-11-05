<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\ShippingAndBillingAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $orderDate = Carbon::now()->subDays($this->faker->numberBetween(0, 60));
        $shippedDate = $this->faker->randomElement([null, $orderDate->copy()->addDays($this->faker->numberBetween(1, 15))]);

        return [
            'user_id' =>  User::query()->inRandomOrder()->first()->id ?? User::factory()->create()->id,
            'shipping_address_id' => ShippingAndBillingAddress::query()->inRandomOrder()->first()->id ?? ShippingAndBillingAddress::factory()->create()->id,
            'billing_address_id' => ShippingAndBillingAddress::query()->inRandomOrder()->first()->id ?? ShippingAndBillingAddress::factory()->create()->id,
            'order_date' => $orderDate,
            'shipped_date' => $shippedDate,
            'status' => $this->faker->randomElement(['pending', 'processing', 'shipped', 'delivered', 'cancelled', 'return']),
            'subtotal' => $subtotal = $this->faker->randomFloat(2, 10, 1000),
            'tax' => $tax = $subtotal * 0.1,
            'shipping_cost' => $shippingCost = $this->faker->randomFloat(2, 5, 50),
            'total_price' => $subtotal + $tax + $shippingCost,
            'return_date' => $shippedDate ? $shippedDate->copy()->addDays($this->faker->numberBetween(1, 15)) : null,
            'return_reason' => $this->faker->optional()->sentence,
            'return_amount' => $this->faker->optional()->randomFloat(2, 1, $subtotal),
            'notes' => $this->faker->optional()->sentence,
        ];
    }
}
