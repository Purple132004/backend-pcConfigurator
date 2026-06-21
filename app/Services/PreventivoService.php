<?php

namespace App\Services;

use App\Models\Build;
use App\Models\Quote;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class PreventivoService
{
    public function getUserQuotes(): Collection
    {
        return Quote::where('user_id', Auth::id())
            ->with(['build' => function ($query) {
                $query->with(['components' => function ($q) {
                    $q->with('category');
                }]);
            }])
            ->get();
    }

    public function getQuote(Quote $quote): Quote
    {
        return $quote->load(['build' => function ($query) {
            $query->with(['components' => function ($q) {
                $q->with('category');
            }]);
        }]);
    }

    public function createQuote(int $buildId): Quote
    {
        $build = Build::with('components')->findOrFail($buildId);

        return Quote::create([
            'build_id' => $build->id,
            'user_id' => Auth::id(),
            'status' => 'pending',
            'total_price' => $build->total_price,
        ]);
    }

    public function updateStatus(Quote $quote, string $status): Quote
    {
        $quote->update(['status' => $status]);
        return $quote->fresh();
    }

    public function deleteQuote(Quote $quote): void
    {
        $quote->delete();
    }

    public function getAllQuotes(): Collection
    {
        return Quote::with(['user', 'build'])->get();
    }
}