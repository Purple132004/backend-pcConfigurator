<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComponentCategoryController;
use App\Http\Controllers\ComponentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BuildController;
use App\Http\Controllers\PreventivoController;
use App\Http\Controllers\AdminController;


Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);
    });
});

Route::middleware('auth:sanctum')->group(function () {
    // Categorie
    Route::get('/categories', [ComponentCategoryController::class, 'index']);

    // Componenti
    Route::get('/components', [ComponentController::class, 'index']);
    Route::post('/components/compatible/{slug}', [ComponentController::class, 'compatible']);
    Route::get('/components/category/{slug}', [ComponentController::class, 'byCategory']);

    // Builds
    Route::get('/builds', [BuildController::class, 'index']);
    Route::post('/builds', [BuildController::class, 'store']);
    Route::get('/builds/{build}', [BuildController::class, 'show']);
    Route::delete('/builds/{build}', [BuildController::class, 'destroy']);
    Route::post('/builds/{build}/components', [BuildController::class, 'addComponent']);
    Route::delete('/builds/{build}/components', [BuildController::class, 'removeComponent']);

    Route::get('/preventivi', [PreventivoController::class, 'index']);
    Route::post('/preventivi', [PreventivoController::class, 'store']);
    Route::get('/preventivi/{quote}', [PreventivoController::class, 'show']);
    Route::delete('/preventivi/{quote}', [PreventivoController::class, 'destroy']);

    // Admin 
    Route::middleware('admin')->group(function () {
        Route::post('/components', [ComponentController::class, 'store']);
        Route::put('/components/{component}', [ComponentController::class, 'update']);
        Route::delete('/components/{component}', [ComponentController::class, 'destroy']);
        Route::get('/admin/preventivi', [PreventivoController::class, 'adminIndex']);
        Route::put('/preventivi/{quote}/status', [PreventivoController::class, 'updateStatus']);
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
        Route::get('/admin/users', [AdminController::class, 'users']);
        Route::put('/admin/users/{user}/role', [AdminController::class, 'updateUserRole']);
        Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser']);
        Route::put('/admin/components/{component}/price', [AdminController::class, 'updateComponentPrice']);
    });

    // Confronto
    Route::post('/builds/compare', [BuildController::class, 'compare']);
    Route::get('/builds/{build}/power', [BuildController::class, 'powerConsumption']);
});
