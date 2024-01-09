<?php

namespace App\Services;

use App\Repositories\CourseRepository;

class CourseService
{
    protected $repository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->repository = $courseRepository;
    }

    public function getCources()
    {
        return $this->repository->getAllCourses();
    }

    public function createNewCourse(array $data)
    {
        return $this->repository->createNewCourse($data);
    }

    public function getCourse(string $uuid)
    {
        return $this->repository->getCourseByUuid($uuid);
    }

    public function deleteCourse($uuid)
    {
        return $this->repository->deleteCourseByUuid($uuid);
    }

    public function updateCourse(array $data, string $uuid)
    {
        return $this->repository->updateCourseByUuid($data, $uuid);
    }
}


