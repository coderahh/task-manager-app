<?php

namespace Database\Factories;
use App\Models\Task;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'completed', 'delayed']),
            'priority' => $this->faker->randomElement(['high', 'medium', 'low']),
            'due_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'user_id' => User::factory(),
        ];
    }
}