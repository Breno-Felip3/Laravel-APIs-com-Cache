<?php

use App\Http\Controllers\Api\{
    CourseController,
    LessonController,
    ModuleController
};

use Illuminate\Support\Facades\Route;

Route::apiResource('/modules/{module}/lessons', LessonController::class);

Route::apiResource('/courses/{course}/modules', ModuleController::class);

Route::get('/courses', [CourseController::class, 'index']);
Route::post('/courses', [CourseController::class, 'store']);
Route::get('/courses/{uuid}', [CourseController::class, 'show']);
Route::delete('/course/{uuid}', [CourseController::class, 'destroy']);
Route::put('/course/{uuid}', [CourseController::class, 'update']);

Route::get('/', function(){
    return response()->json(['message' => 'ok']);
});
