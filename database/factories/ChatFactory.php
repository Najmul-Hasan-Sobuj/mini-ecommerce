<?php

namespace Database\Factories;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chat>
 */
class ChatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Chat::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' =>  User::query()->inRandomOrder()->first()->id ?? User::factory()->create()->id,
            'support_agent_id' =>  User::query()->inRandomOrder()->first()->id ?? User::factory()->create()->id,
            'chat_message' => $this->faker->sentence,
        ];
    }
}
