<?php

namespace Tests\Feature\Api;

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CourseTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_all_courses(): void
    {
        $response = $this->getJson('/courses');

        $response->assertStatus(200);
    }

    public function test_get_count_courses(): void
    {
        Course::factory()->count(10)->create();

        $response = $this->getJson('/courses');

        // $response->dump();

        $response->assertJsonCount(10, 'data');

        $response->assertStatus(200);
    }

    public function test_get_notfound_courses(): void
    {
        $response = $this->getJson('/courses/fake_value');

        $response->assertStatus(404);
    }

    public function test_notfound_courses(): void
    {
        $response = $this->getJson('/courses/fake_value');

        $response->assertStatus(404);
    }

    public function test_get_course(): void
    {
        $course = Course::factory()->create();

        $response = $this->getJson("/courses/{$course->uuid}");

        $response->assertStatus(200);
    }

    public function test_validations_create_course(): void
    {
       $response = $this->postJson('/courses', []);

        $response->assertStatus(422);
    }

    public function test_create_course(): void
    {
       $response = $this->postJson('/courses', [
        'name' => 'Novo Curso'
       ]);

        $response->assertStatus(201);
    }

    public function test_validation_update_course(): void
    {
        $course = Course::factory()->create();

        $response = $this->putJson("/course/{$course->uuid}", []);

        $response->assertStatus(422);
    }

    public function test_update_course(): void
    {
        $course = Course::factory()->create();

        $response = $this->putJson("/course/{$course->uuid}", [
            'name' => 'teste']);

        $response->assertStatus(200);
    }

    public function test_404_update_course(): void
    {
        $response = $this->putJson("/course/fake_value}", [
            'name' => 'teste']);

        $response->assertStatus(404);
    }

    public function test_404_delete_course(): void
    {
        $response = $this->deleteJson("/course/fake_value}");

        $response->assertStatus(404);
    }

    public function test_delete_course(): void
    {
        $course = Course::factory()->create();

        $response = $this->deleteJson("/course/{$course->uuid}");

        $response->assertStatus(204);
    }
}
