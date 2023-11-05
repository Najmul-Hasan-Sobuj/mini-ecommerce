<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\RefundPolicy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RefundPolicy>
 */
class RefundPolicyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RefundPolicy::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $lastUpdated = Carbon::now()->subDays($this->faker->numberBetween(0, 365));

        return [
            'policy_text' => $this->faker->paragraphs($nb = 3, $asText = true),
            'last_updated' => $lastUpdated,
        ];
    }
}
