<?php

namespace App\Repositories;

use App\Models\Module;
use Illuminate\Support\Facades\Cache;

class ModuleRepository
{
    protected $entity;

    public function __construct(Module $module)
    {
        $this->entity = $module;
    }

    public function getModulesByCourse($courseId)
    {
        return $this->entity->where('course_id', $courseId)->get();
    }

    public function createNewModule(int $courseId, array $data)
    {
        $data['course_id'] = $courseId;

        // $course->modules()->create($data);

        return $this->entity->create($data);
    }

    public function getModuleByCourse($courseId, $uuid_module)
    {
        $module = $this->entity->where('course_id', $courseId)
                            ->where('uuid', $uuid_module)
                            ->firstOrFail();

        return $module;
    }

    public function getModuleByUuid($uuid_module)
    {
        $module = $this->entity->where('uuid', $uuid_module)
                               ->firstOrFail();
        return $module;
    }

    public function updateModuleByUuid(int $courseId, string $uuid_module, array $data)
    {
        $module = $this->getModuleByUuid($uuid_module);

        $data['course_id'] = $courseId;  
        
        Cache::forget('courses');

        return $module->update($data);
    }

    public function deleteModuleByUuid($uuid_module)
    {
        $module = $this->getModuleByUuid($uuid_module);

        Cache::forget('courses');

        return $module->delete();
    }
}
