<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LeaderboardFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'total_points' => $this->faker->numberBetween(1000, 15000),
            'contests_won' => $this->faker->numberBetween(0, 25),
            'problems_solved' => $this->faker->numberBetween(50, 400),
            'country_code' => $this->faker->randomElement(['MX', 'ES', 'AR', 'CO', 'CL', 'PE', 'BR', 'EC', 'VE', 'UY']),
            'trend' => $this->faker->randomElement(['up', 'down', 'stable']),
        ];
    }
}