<?php

namespace App\Services;

use App\Models\Build;
use App\Models\Component;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class BuildService
{
    public function getUserBuilds(): Collection
    {
        return Build::where('user_id', Auth::id())
            ->with(['components' => function ($query) {
                $query->with('category');
            }])
            ->get();
    }

    public function getBuild(Build $build): Build
    {
        return $build->load(['components' => function ($query) {
            $query->with('category');
        }]);
    }

    public function createBuild(array $data): Build
    {
        return Build::create([
            'user_id' => Auth::id(),
            'name' => $data['name'],
            'status' => 'draft',
            'total_price' => 0,
        ]);
    }

    public function addComponent(Build $build, int $componentId, int $quantity = 1): Build
    {
        $component = Component::findOrFail($componentId);

        $existing = $build->buildComponents()
            ->where('component_id', $componentId)
            ->first();

        if ($existing) {
            $existing->update(['quantity' => $existing->quantity + $quantity]);
        } else {
            $build->buildComponents()->create([
                'component_id' => $componentId,
                'quantity' => $quantity,
            ]);
        }

        $this->recalculateTotalPrice($build);

        return $this->getBuild($build);
    }

    public function removeComponent(Build $build, int $componentId): Build
    {
        $build->buildComponents()
            ->where('component_id', $componentId)
            ->delete();

        $this->recalculateTotalPrice($build);

        return $this->getBuild($build);
    }

    public function updateBuildStatus(Build $build, string $status): Build
    {
        $build->update(['status' => $status]);
        return $build->fresh();
    }

    public function deleteBuild(Build $build): void
    {
        $build->delete();
    }

    private function recalculateTotalPrice(Build $build): void
{
    $total = $build->buildComponents()
        ->with('component')
        ->get()
        ->sum(function ($bc) {
            return $bc->component->price * $bc->quantity;
        });

    $build->update(['total_price' => $total]);
}

public function calculatePowerConsumption(Build $build): array
{
    $components = $build->buildComponents()->with('component')->get();

    $totalTdp = $components->sum(function ($bc) {
        return ($bc->component->specs['tdp'] ?? 0) * $bc->quantity;
    });

    return [
        'total_tdp' => $totalTdp,
        'recommended_psu' => (int) ceil($totalTdp * 1.2),
    ];
}

public function compareBuild(Build $buildA, Build $buildB): array
{
    $buildA->load(['components' => function ($q) { $q->with('category'); }]);
    $buildB->load(['components' => function ($q) { $q->with('category'); }]);

    return [
        'build_a' => [
            'build' => $buildA,
            'total_price' => $buildA->total_price,
            'power_consumption' => $this->calculatePowerConsumption($buildA),
        ],
        'build_b' => [
            'build' => $buildB,
            'total_price' => $buildB->total_price,
            'power_consumption' => $this->calculatePowerConsumption($buildB),
        ],
    ];
}
}