<?php

namespace App\Repositories;

use App\Models\Course;
use Illuminate\Support\Facades\Cache;

class CourseRepository
{
    protected $entity;

    public function __construct(Course $course)
    {
        $this->entity = $course;
    }

    public function getAllCourses()
    {
        // return Cache::remember('courses', 60, function(){
        //     return $this->entity->with('modules.lessons')->get();
        // });

        return Cache::rememberForever('courses', function(){

            return $this->entity->with('modules.lessons')->get();
        });

    }

    public function createNewCourse(array $data)
    {
        return $this->entity->create($data);
    }

    public function getCourseByUuid(string $uuid, bool $loadRelationships = true)
    {
        $query = $this->entity->where('uuid', $uuid);

        if($loadRelationships == true){
            $query->with(['modules.lessons']);
        }

        return $query->firstOrFail();
    }

    public function deleteCourseByUuid(string $uuid)
    {
        $course = $this->getCourseByUuid($uuid, false);

        Cache::forget('courses');

        return $course->delete();
    }

    public function updateCourseByUuid($data, $uuid)
    {
        $course = $this->getCourseByUuid($uuid, false);

        //Deleta o cache
        Cache::forget('courses');

        return $course->update($data);
    }
}