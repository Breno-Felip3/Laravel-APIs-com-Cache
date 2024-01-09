<?php

namespace App\Services;

use App\Repositories\ModuleRepository;
use App\Repositories\LessonRepository;

class LessonService
{
    protected $lessonRepository, $moduleRepository;

    public function __construct(LessonRepository $lessonRepository, ModuleRepository $moduleRepository)
    {
        $this->lessonRepository = $lessonRepository;
        $this->moduleRepository = $moduleRepository;
    }

    public function getLessonsByModule(string $module)
    {
        $module = $this->moduleRepository->getModuleByUuid($module);

        $lessons = $this->lessonRepository->getLessonsByModule($module->id);

        return $lessons;
    }

    public function createNewLesson(array $data)
    {
        $module = $this->moduleRepository->getModuleByUuid($data['module']);

        $lesson = $this->lessonRepository->createNewLesson($module->id, $data);

        return $lesson;
    }

    public function getLessonByModule(string $module, string $uuid_lesson)
    {
        $module = $this->moduleRepository->getModuleByUuid($module);
        $lesson = $this->lessonRepository->getLessonByModule($module->id, $uuid_lesson);

        return $lesson;
    }

    public function updateLesson(array $data, string $uuid_lesson)
    {
        $module = $this->moduleRepository->getModuleByUuid($data['module']);

        $lesson = $this->lessonRepository->updateLessonByUuid($module->id, $uuid_lesson, $data);

        return $lesson;
    }

    public function deleteLesson($uuid_lesson)
    {
        $lesson = $this->lessonRepository->deleteLessonByUuid($uuid_lesson);

        return $lesson;
    }
}