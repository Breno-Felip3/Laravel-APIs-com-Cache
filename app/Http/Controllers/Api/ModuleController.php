<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateModule;
use App\Http\Resources\ModuleResource;
use App\Services\ModuleService;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    protected $moduleService;

    public function __construct(ModuleService $moduleService)
    {
        $this->moduleService = $moduleService;   
    }
    /**
     * Display a listing of the resource.
     */
    public function index($course)
    {
        $modules = $this->moduleService->getModulesByCourse($course);

        return ModuleResource::collection($modules);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateModule $request, $course)
    {
        $module = $this->moduleService->createNewModule($request->validated());

        return new ModuleResource($module);
    }

    /**
     * Display the specified resource.
     */
    public function show($course, string $uuid_module)
    {
        $module = $this->moduleService->getModuleByCourse($course, $uuid_module);

        return new ModuleResource($module);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($course, StoreUpdateModule $request, string $module)
    {
        $this->moduleService->updateModule($request->validated(), $module);

        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($course, $uuid_module)
    {
        $this->moduleService->deleteModule($uuid_module);

        return response()->json([], 204);
    }
}
