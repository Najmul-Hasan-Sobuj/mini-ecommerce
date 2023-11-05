<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\ShippingAndBillingAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShippingAndBillingAddress>
 */
class ShippingAndBillingAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ShippingAndBillingAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::query()->inRandomOrder()->first()->id ?? User::factory()->create()->id,
            'address_type' => $this->faker->randomElement(['shipping', 'billing']),
            'street_address' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'country' => $this->faker->country,
            'postal_code' => $this->faker->postcode,
        ];
    }
}
