<?php

namespace App\Http\Controllers;

use App\Services\ComponentService;
use Illuminate\Http\JsonResponse;

class ComponentCategoryController extends Controller
{
    public function __construct(protected ComponentService $service) {}

    public function index(): JsonResponse
    {
        return response()->json($this->service->getAllCategories());
    }
}