<?php

namespace App\Services;

use App\Models\Build;
use App\Models\Component;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class AdminService
{
    public function getDashboardStats(): array
    {
        return [
            'total_users' => User::count(),
            'total_builds' => Build::count(),
            'total_quotes' => Quote::count(),
            'total_components' => Component::count(),
            'recent_builds' => Build::with('user')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get(),
            'recent_quotes' => Quote::with(['user', 'build'])
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get(),
        ];
    }

    public function getAllUsers(): Collection
    {
        return User::withCount(['builds', 'quotes'])->get();
    }

    public function updateUserRole(User $user, string $role): User
    {
        $user->update(['role' => $role]);
        return $user->fresh();
    }

    public function updateComponentPrice(Component $component, float $price): Component
    {
        $component->update(['price' => $price]);
        return $component->fresh();
    }

    public function deleteUser(User $user): void
    {
        $user->delete();
    }
}