<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Lesson::class;

    public function definition(): array
    {
        $name = $this->fake()->unique()->name();

        return [
            'module_id' => Module::factory(),
            'name' => $name,
            'video' => $name,
            'description' => $this->faker->sentence(10),
        ];
    }
}
