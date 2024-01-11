<?php

namespace Tests\Feature\Api;

use App\Models\Course;
use App\Models\Module;
use Tests\TestCase;

class ModuleTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_all_modules_by_course(): void
    {
        $course = Course::factory()->create();

        Module::factory()->count(10)->create([
            'course_id' => $course->id
        ]);

        $response = $this->getJson("/courses/{$course->uuid}/modules");

        $response->assertStatus(200)->assertJsonCount(10, 'data');
    }

    public function test_get_notfound_modules_by_course(): void
    {
        $response = $this->getJson("/courses/fake_course/modules");

        $response->assertStatus(404);
    }

    public function test_notfound_module_by_course(): void
    {
        $course = Course::factory()->create();

        $response = $this->getJson("/courses/{$course->id}/fake_module");

        $response->assertStatus(404);
    }

    public function test_get_module_by_course(): void
    {
        $course = Course::factory()->create();

        $module = Module::factory()->create([
            'course_id' => $course->id
        ]);

        $response = $this->getJson("/courses/$course->uuid/modules/$module->uuid");

        $response->assertStatus(200);
    }

    public function test_validations_create_module_by_course(): void
    {
        $course = Course::factory()->create();

        $response = $this->postJson("/courses/$course->id/modules", []);

        $response->assertStatus(422);
    }

    public function test_create_module_by_course(): void
    {
        $course = Course::factory()->create();

       $response = $this->postJson("/courses/$course->id/modules", [
        'course' => $course->uuid,
        'name' => 'Novo Módulo'
       ]);

        $response->assertStatus(201);
    }

    public function test_validation_update_module_by_course(): void
    {
        $course = Module::factory()->create();

        $module = Module::factory()->create([
            'course_id' => $course->id,
        ]);

        $response = $this->putJson("/courses/$course->uuid/modules/$module->uuid", []);

        $response->assertStatus(422);
    }

    public function test_update_module_by_course(): void
    {
        $course = Course::factory()->create();

        $module = Module::factory()->create([
            'course_id' => $course->id,
        ]);

        $response = $this->putJson("/courses/$course->uuid/modules/$module->uuid", [
            'course' => $course->uuid,
            'name' => 'teste validação'
        ]);

        $response->assertStatus(200);
    }

    public function test_404_update_module_by_course(): void
    {
        $course = Course::factory()->create();

        $response = $this->putJson("/courses/$course->uuid}/modules/fake_module", [
            'course' => $course->uuid,
            'name' => 'teste validação'
        ]);

        $response->assertStatus(404);
    }

    public function test_404_delete_module_by_course(): void
    {
        $course = Course::factory()->create();
    
        $response = $this->deleteJson("/courses/$course->uuid/modules/fake_module}");

        $response->assertStatus(404);
    }

    public function test_delete_module_by_course(): void
    {
        $course = Course::factory()->create();
        $module = Module::factory()->create([
            'course_id' => $course->id
        ]);

        $response = $this->deleteJson("/courses/$course->uuid/modules/$module->uuid");

        $response->assertStatus(204);
    }
}
