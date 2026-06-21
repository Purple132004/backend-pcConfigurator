<?php

namespace App\Http\Controllers;

use App\Models\Component;
use App\Models\User;
use App\Services\AdminService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(protected AdminService $service) {}

    public function dashboard(): JsonResponse
    {
        return response()->json($this->service->getDashboardStats());
    }

    public function users(): JsonResponse
    {
        return response()->json($this->service->getAllUsers());
    }

    public function updateUserRole(Request $request, User $user): JsonResponse
    {
        $data = $request->validate([
            'role' => ['required', 'in:user,admin'],
        ]);

        return response()->json($this->service->updateUserRole($user, $data['role']));
    }

    public function updateComponentPrice(Request $request, Component $component): JsonResponse
    {
        $data = $request->validate([
            'price' => ['required', 'numeric', 'min:0'],
        ]);

        return response()->json($this->service->updateComponentPrice($component, $data['price']));
    }

    public function deleteUser(User $user): JsonResponse
    {
        $this->service->deleteUser($user);
        return response()->json(['message' => 'Utente eliminato con successo']);
    }
}