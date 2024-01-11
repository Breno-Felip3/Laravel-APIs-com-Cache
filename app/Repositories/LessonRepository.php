<?php

namespace App\Repositories;

use App\Models\Lesson;
use Illuminate\Support\Facades\Cache;

class LessonRepository
{
    protected $entity;

    public function __construct(Lesson $lesson)
    {
        $this->entity = $lesson;
    }

    public function getLessonsByModule($moduleId)
    {
        return $this->entity->where('module_id', $moduleId)->get();
    }

    public function createNewLesson(int $moduleId, array $data)
    {
        $data['module_id'] = $moduleId;

        // $module->lessons()->create($data);

        return $this->entity->create($data);
    }

    public function getLessonByModule($moduleId, $uuid_lesson)
    {
        $lesson = $this->entity->where('module_id', $moduleId)
                            ->where('uuid', $uuid_lesson)
                            ->firstOrFail();

        return $lesson;
    }

    public function getLessonByUuid($uuid_lesson)
    {
        $lesson = $this->entity->where('uuid', $uuid_lesson)
                               ->firstOrFail();
        return $lesson;
    }

    public function updateLessonByUuid(int $moduleId, string $uuid_lesson, array $data)
    {
        $lesson = $this->getLessonByUuid($uuid_lesson);

        $data['module_id'] = $moduleId;  
        
        Cache::forget('courses');

        return $lesson->update($data);
    }

    public function deleteLessonByUuid($uuid_lesson)
    {
        $lesson = $this->getLessonByUuid($uuid_lesson);

        Cache::forget('courses');

        return $lesson->delete();
    }
}
