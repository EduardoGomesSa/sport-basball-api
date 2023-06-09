<?php

use App\Http\Controllers\InstitutionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/institution', [InstitutionController::class, 'store']);