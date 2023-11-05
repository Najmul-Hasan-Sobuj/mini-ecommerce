<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\PaymentTransaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentTransaction>
 */
class PaymentTransactionFactory extends Factory
{
     /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PaymentTransaction::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'order_id' => Order::query()->inRandomOrder()->first()->id ?? Order::factory()->create()->id,
            'payment_method_id' => PaymentMethod::query()->inRandomOrder()->first()->id ?? PaymentMethod::factory()->create()->id,
            'amount' => $this->faker->randomFloat(2, 10, 1000),
            'transaction_id' => $this->faker->unique()->bankAccountNumber,
            'status' => $this->faker->randomElement(['pending', 'completed', 'failed', 'refunded']),
        ];
    }
}
