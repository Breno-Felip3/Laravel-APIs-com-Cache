<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Lesson;

class LessonObserver
{
    public function creating(Lesson $lesson)
    {
        $lesson->uuid = (string)Str::uuid();
    }
}
