<?php

namespace Database\Factories;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Coupon::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code'        => $this->faker->unique()->regexify('[A-Za-z0-9]{50}'),
            'type'        => $this->faker->randomElement(['fixed', 'percentage']),
            'max_uses'    => $this->faker->numberBetween(1, 100),
            'valid_from'  => $this->faker->date(),
            'valid_until' => $this->faker->date(),
            'status'      => $this->faker->randomElement(['active', 'expired', 'used']),
            'description' => $this->faker->sentence(),
        ];
    }
}
