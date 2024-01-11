<?php

namespace Tests\Feature\Api;

use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LessonTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_all_lessons_by_module(): void
    {
        $module = Module::factory()->create();

        Lesson::factory()->count(10)->create([
            'module_id' => $module->id
        ]);

        $response = $this->getJson("/modules/{$module->uuid}/lessons");

        $response->assertStatus(200)->assertJsonCount(10, 'data');
    }

    public function test_get_notfound_lessons_by_module(): void
    {
        $response = $this->getJson("/modules/fake_module/lessons");

        $response->assertStatus(404);
    }

    public function test_notfound_lesson_by_module(): void
    {
        $module = Module::factory()->create();

        $response = $this->getJson("/modules/{$module->id}/fake_module");

        $response->assertStatus(404);
    }

    public function test_get_lesson_by_module(): void
    {
        $module = Module::factory()->create();

        $lesson = Lesson::factory()->create([
            'module_id' => $module->id
        ]);

        $response = $this->getJson("/modules/$module->uuid/lessons/$lesson->uuid");

        $response->assertStatus(200);
    }

    public function test_validations_create_lesson_by_module(): void
    {
        $module = Module::factory()->create();

        $response = $this->postJson("/modules/$module->id/lessons", []);

        $response->assertStatus(422);
    }

    public function test_create_lesson_by_module(): void
    {
        $module = Module::factory()->create();

        Lesson::factory()->create([
            'module_id' => $module->id,
        ]);

       $response = $this->postJson("/modules/$module->id/lessons", [
            'module' => $module->uuid,
            'name' => 'Nova Aula',
            'video' => 'novo video'
       ]);

        $response->assertStatus(201);
    }

    public function test_validation_update_lesson_by_module(): void
    {

        $module = Module::factory()->create();

        $lesson = Lesson::factory()->create([
            'module_id' => $module->id,
        ]);

        $response = $this->putJson("/modules/$module->uuid/lessons/$lesson->uuid", []);

        $response->assertStatus(422);
    }

    public function test_update_lesson_by_module(): void
    {
        $module = Module::factory()->create();

        $lesson = Lesson::factory()->create([
            'module_id' => $module->id,
        ]);

        $response = $this->putJson("/modules/$module->uuid/lessons/$lesson->uuid", [
            'module' => $module->uuid,
            'name' => 'Nova Aula',
            'video' => 'novo video'
        ]);

        $response->assertStatus(200);
    }

    public function test_404_update_lesson_by_module(): void
    {
        $module = Module::factory()->create();

        $response = $this->putJson("/modules/$module->uuid}/lessons/fake_module", [
            'module' => $module->uuid,
            'name' => 'teste validação',
            'video' => 'novo video'
        ]);

        $response->assertStatus(404);
    }

    public function test_404_delete_lesson_by_module(): void
    {    
        $module = Module::factory()->create();
        $response = $this->deleteJson("/modules/$module->uuid/lessons/fake_module}");

        $response->assertStatus(404);
    }

    public function test_delete_lesson_by_module(): void
    {
        $module = Module::factory()->create();

        $lesson = Lesson::factory()->create([
            'module_id' => $module->id
        ]);

        $response = $this->deleteJson("/modules/$module->uuid/lessons/$lesson->uuid");

        $response->assertStatus(204);
    }
}
