<?php

namespace App\Services;

use App\Repositories\CourseRepository;
use App\Repositories\ModuleRepository;

class ModuleService
{
    protected $moduleRepository, $courseRepository;

    public function __construct(ModuleRepository $moduleRepository, CourseRepository $courseRepository)
    {
        $this->moduleRepository = $moduleRepository;
        $this->courseRepository = $courseRepository;
    }

    public function getModulesByCourse(string $course)
    {
        $course = $this->courseRepository->getCourseByUuid($course);

        $modules = $this->moduleRepository->getModulesByCourse($course->id);

        return $modules;
    }

    public function createNewModule(array $data)
    {
        $course = $this->courseRepository->getCourseByUuid($data['course']);

        $module = $this->moduleRepository->createNewModule($course->id, $data);

        return $module;
    }

    public function getModuleByCourse(string $course, string $uuid_module)
    {
        $course = $this->courseRepository->getCourseByUuid($course);
        $module = $this->moduleRepository->getModuleByCourse($course->id, $uuid_module);

        return $module;
    }

    public function updateModule(array $data, string $uuid_module)
    {
        $course = $this->courseRepository->getCourseByUuid($data['course']);

        $module = $this->moduleRepository->updateModuleByUuid($course->id, $uuid_module, $data);

        return $module;
    }

    public function deleteModule($uuid_module)
    {
        $module = $this->moduleRepository->deleteModuleByUuid($uuid_module);

        return $module;
    }
}