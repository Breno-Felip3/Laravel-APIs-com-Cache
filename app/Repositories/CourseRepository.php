<?php

namespace App\Repositories;

use App\Models\Course;

class CourseRepository
{
    protected $entity;

    public function __construct(Course $course)
    {
        $this->entity = $course;
    }

    public function getAllCourses()
    {
        return $this->entity->with('modules.lessons')->get();
    }

    public function createNewCourse(array $data)
    {
        return $this->entity->create($data);
    }

    public function getCourseByUuid(string $uuid, bool $loadRelationships = true)
    {
        return $this->entity->where('uuid', $uuid)
                            ->with([$loadRelationships ? 'modules.lessons' : ''])
                            ->firstOrFail();
    }

    public function deleteCourseByUuid(string $uuid)
    {
        $course = $this->getCourseByUuid($uuid, false);

        return $course->delete();
    }

    public function updateCourseByUuid($data, $uuid)
    {
        $course = $this->getCourseByUuid($uuid, false);

        return $course->update($data);
    }
}