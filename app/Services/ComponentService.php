<?php

namespace App\Services;

use App\Models\Component;
use App\Models\ComponentCategory;
use Illuminate\Database\Eloquent\Collection;

class ComponentService
{
    public function getAllCategories(): Collection
    {
        return ComponentCategory::with('components')->get();
    }

    public function getComponentsByCategory(string $slug): Collection
    {
        return Component::whereHas('category', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->with('category')->where('is_active', true)->get();
    }

    public function getCompatibleComponents(string $slug, array $selectedIds): Collection
    {
        $selected = Component::whereIn('id', $selectedIds)->get();
        $components = $this->getComponentsByCategory($slug);

        return $components->filter(function ($component) use ($selected, $slug) {
            return $this->isCompatible($component, $selected, $slug);
        })->values();
    }

    private function isCompatible(Component $component, Collection $selected, string $slug): bool
{
    foreach ($selected as $sel) {
        $selSlug = $sel->category->slug;
        $compSpecs = $component->specs;
        $selSpecs = $sel->specs;

        // CPU ↔ RAM
        if ($slug === 'ram' && $selSlug === 'cpu') {
            if (isset($compSpecs['type']) && isset($selSpecs['ram_type'])) {
                if ($compSpecs['type'] !== $selSpecs['ram_type']) return false;
            }
        }
        if ($slug === 'cpu' && $selSlug === 'ram') {
            if (isset($compSpecs['ram_type']) && isset($selSpecs['type'])) {
                if ($compSpecs['ram_type'] !== $selSpecs['type']) return false;
            }
        }

        // GPU ↔ Case
        if ($slug === 'gpu' && $selSlug === 'case') {
            if (isset($compSpecs['length']) && isset($selSpecs['max_gpu_length'])) {
                if ($compSpecs['length'] > $selSpecs['max_gpu_length']) return false;
            }
        }
        if ($slug === 'case' && $selSlug === 'gpu') {
            if (isset($selSpecs['length']) && isset($compSpecs['max_gpu_length'])) {
                if ($selSpecs['length'] > $compSpecs['max_gpu_length']) return false;
            }
        }
    }

    return true;
}

    public function getAllComponents(): Collection
    {
        return Component::with('category')->get();
    }

    public function createComponent(array $data): Component
    {
        return Component::create($data);
    }

    public function updateComponent(Component $component, array $data): Component
    {
        $component->update($data);
        return $component->fresh();
    }

    public function deleteComponent(Component $component): void
    {
        $component->delete();
    }
}