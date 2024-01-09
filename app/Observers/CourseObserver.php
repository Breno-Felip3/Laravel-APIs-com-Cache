<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Course;

class CourseObserver
{
    /**
     * Handle the Course "creating" event.
     */
    public function creating(Course $course)
    {
        $course->uuid = (string)Str::uuid();
    }

}
