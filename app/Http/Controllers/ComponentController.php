<?php

namespace App\Http\Controllers;

use App\Models\Component;
use App\Services\ComponentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    public function __construct(protected ComponentService $service) {}

    public function index(): JsonResponse
    {
        return response()->json(
            Component::with('category')->get()
        );
    }

    public function byCategory(string $slug): JsonResponse
    {
        return response()->json($this->service->getComponentsByCategory($slug));
    }

    public function compatible(Request $request, string $slug): JsonResponse
    {
        $selectedIds = $request->input('selected', []);
        return response()->json(
            $this->service->getCompatibleComponents($slug, $selectedIds)
        );
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'category_id' => ['required', 'exists:component_categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'brand' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'specs' => ['required', 'array'],
            'specs.tdp' => ['required', 'integer', 'min:0'],
            'is_active' => ['boolean'],
        ]);

        $category = \App\Models\ComponentCategory::find($data['category_id']);

        $specsRules = match ($category->slug) {
            'cpu' => [
                'specs.ram_type' => ['required', 'in:DDR4,DDR5'],
                'specs.ram_slots' => ['required', 'integer', 'min:1'],
            ],
            'ram' => [
                'specs.type' => ['required', 'in:DDR4,DDR5'],
                'specs.capacity' => ['required', 'integer', 'min:1'],
            ],
            'gpu' => [
                'specs.length' => ['required', 'integer', 'min:1'],
            ],
            'case' => [
                'specs.max_gpu_length' => ['required', 'integer', 'min:1'],
                'specs.storage_bays' => ['required', 'integer', 'min:1'],
            ],
            'storage' => [
                'specs.type' => ['required', 'in:SSD,HDD'],
                'specs.capacity' => ['required', 'integer', 'min:1'],
            ],
            default => [],
        };

        $request->validate($specsRules);

        return response()->json($this->service->createComponent($data), 201);
    }

    public function update(Request $request, Component $component): JsonResponse
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'brand' => ['sometimes', 'string', 'max:255'],
            'price' => ['sometimes', 'numeric', 'min:0'],
            'specs' => ['sometimes', 'array'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        if (isset($data['specs'])) {
            $category = $component->category;

            $specsRules = match ($category->slug) {
                'cpu' => [
                    'specs.ram_type' => ['required', 'in:DDR4,DDR5'],
                    'specs.ram_slots' => ['required', 'integer', 'min:1'],
                ],
                'ram' => [
                    'specs.type' => ['required', 'in:DDR4,DDR5'],
                    'specs.capacity' => ['required', 'integer', 'min:1'],
                ],
                'gpu' => [
                    'specs.length' => ['required', 'integer', 'min:1'],
                ],
                'case' => [
                    'specs.max_gpu_length' => ['required', 'integer', 'min:1'],
                    'specs.storage_bays' => ['required', 'integer', 'min:1'],
                ],
                'storage' => [
                    'specs.type' => ['required', 'in:SSD,HDD'],
                    'specs.capacity' => ['required', 'integer', 'min:1'],
                ],
                default => [],
            };

            $request->validate($specsRules);
        }

        return response()->json($this->service->updateComponent($component, $data));
    }

    public function destroy(Component $component): JsonResponse
    {
        $this->service->deleteComponent($component);
        return response()->json(['message' => 'Componente eliminato con successo']);
    }
}
