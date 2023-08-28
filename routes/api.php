<?php

use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\LeagueController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/institution', [InstitutionController::class, 'store']);
Route::get('/institution', [InstitutionController::class, 'index']);
Route::get('/institution/{id}', [InstitutionController::class, 'show']);
Route::delete('/institution/{id}', [InstitutionController::class, 'destroy']);
Route::put('/institution/{id}', [InstitutionController::class, 'update']);

Route::get('/league', [LeagueController::class, 'index']);
Route::get('/league/{id}', [LeagueController::class, 'show']);
Route::post('/league', [LeagueController::class, 'store']);
Route::put('/league/{id}', [LeagueController::class, 'update']);
Route::delete('/league/{id}', [LeagueController::class, 'destroy']);
