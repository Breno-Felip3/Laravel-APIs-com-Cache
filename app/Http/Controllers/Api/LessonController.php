<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateLesson;
use App\Http\Resources\LessonResource;
use App\Services\LessonService;


class LessonController extends Controller
{
    protected $lessonService;

    public function __construct(LessonService $lessonService)
    {
        $this->lessonService = $lessonService;   
    }
    /**
     * Display a listing of the resource.
     */
    public function index($module)
    {
        $lessons = $this->lessonService->getLessonsByModule($module);

        return LessonResource::collection($lessons);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateLesson $request, $module)
    {
        $lesson = $this->lessonService->createNewLesson($request->validated());

        return new LessonResource($lesson);
    }

    /**
     * Display the specified resource.
     */
    public function show($module, string $uuid_lesson)
    {
        $lesson = $this->lessonService->getLessonByModule($module, $uuid_lesson);

        return new LessonResource($lesson);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($module, StoreUpdateLesson $request, string $lesson)
    {
        $this->lessonService->updateLesson($request->validated(), $lesson);

        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($module, $uuid_lesson)
    {
        $this->lessonService->deleteLesson($uuid_lesson);

        return response()->json([], 204);
    }
}
