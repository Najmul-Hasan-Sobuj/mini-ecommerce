<?php

namespace Database\Factories;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Faq>
 */
class FaqFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Faq::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'category' => $this->faker->word,
            'question' => $this->faker->sentence,
            'order'    => $this->faker->optional()->randomNumber(),
            'status'   => $this->faker->randomElement(['active', 'inactive']),
            'answer'   => $this->faker->paragraph,
        ];
    }
}
