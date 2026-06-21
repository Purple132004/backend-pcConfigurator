<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Services\PreventivoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PreventivoController extends Controller
{
    public function __construct(protected PreventivoService $service) {}

    public function index(): JsonResponse
    {
        return response()->json($this->service->getUserQuotes());
    }

    public function show(Quote $quote): JsonResponse
    {
        return response()->json($this->service->getQuote($quote));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'build_id' => ['required', 'exists:builds,id'],
        ]);

        return response()->json($this->service->createQuote($data['build_id']), 201);
    }

    public function updateStatus(Request $request, Quote $quote): JsonResponse
    {
        $data = $request->validate([
            'status' => ['required', 'in:pending,confirmed,expired'],
        ]);

        return response()->json($this->service->updateStatus($quote, $data['status']));
    }

    public function destroy(Quote $quote): JsonResponse
    {
        $this->service->deleteQuote($quote);
        return response()->json(['message' => 'Preventivo eliminato con successo']);
    }

    public function adminIndex(): JsonResponse
    {
        return response()->json($this->service->getAllQuotes());
    }
}