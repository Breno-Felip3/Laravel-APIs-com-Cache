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

        $response->dump();

        $response->assertStatus(200);
    }
}
