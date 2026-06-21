<?php

namespace App\Http\Controllers;

use App\Models\Build;
use App\Services\BuildService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuildController extends Controller
{
    public function __construct(protected BuildService $service) {}

    public function index(): JsonResponse
    {
        return response()->json($this->service->getUserBuilds());
    }

    public function show(Build $build): JsonResponse
    {
        return response()->json($this->service->getBuild($build));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        return response()->json($this->service->createBuild($data), 201);
    }

    public function addComponent(Request $request, Build $build): JsonResponse
    {
        $data = $request->validate([
            'component_id' => ['required', 'exists:components,id'],
            'quantity' => ['integer', 'min:1'],
        ]);

        return response()->json($this->service->addComponent(
            $build,
            $data['component_id'],
            $data['quantity'] ?? 1
        ));
    }

    public function removeComponent(Request $request, Build $build): JsonResponse
    {
        $data = $request->validate([
            'component_id' => ['required', 'exists:components,id'],
        ]);

        return response()->json($this->service->removeComponent($build, $data['component_id']));
    }

    public function destroy(Build $build): JsonResponse
    {
        $this->service->deleteBuild($build);
        return response()->json(['message' => 'Build eliminata con successo']);
    }

    public function powerConsumption(Build $build): JsonResponse
{
    return response()->json($this->service->calculatePowerConsumption($build));
}

public function compare(Request $request): JsonResponse
{
    $data = $request->validate([
        'build_a_id' => ['required', 'exists:builds,id'],
        'build_b_id' => ['required', 'exists:builds,id'],
    ]);

    $buildA = Build::findOrFail($data['build_a_id']);
    $buildB = Build::findOrFail($data['build_b_id']);

    return response()->json($this->service->compareBuild($buildA, $buildB));
}
}