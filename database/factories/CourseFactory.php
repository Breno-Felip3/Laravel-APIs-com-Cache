<?php

namespace Database\Factories;
use App\Models\Course;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Course::class;

    public function definition(): array
    {
        return [
            'name' => $this->fake()->unique()->name(),
            'description' => $this->faker->sentence(10),
        ];
    }
}
