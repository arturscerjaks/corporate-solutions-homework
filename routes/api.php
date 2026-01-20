<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ProductAuditController;
use App\Http\Middleware\AdminOnly;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/login', [AuthController::class, 'createToken']);
Route::post('/logout', [AuthController::class, 'deleteToken'])
    ->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', AdminOnly::class])->group(function () {
    Route::get('/product_audit', [ProductAuditController::class, 'index']);
});
