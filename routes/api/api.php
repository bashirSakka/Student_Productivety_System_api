<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\NoteController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'destroy']);
    Route::get('/courses', [CourseController::class, 'index']);
    Route::post('/course', [CourseController::class, 'store']);
    Route::get('/course/{id}', [CourseController::class, 'show']);
    Route::patch('/course/{id}', [CourseController::class, 'update']);
    Route::delete('/course/{id}', [CourseController::class, 'destroy']);

    Route::get('/notes', [NoteController::class, 'index']);
    Route::post('/note', [NoteController::class, 'store']);
    Route::get('/note/{note}', [NoteController::class, 'show']);
    Route::patch('/note/{note}', [NoteController::class, 'update']);
    Route::delete('/note/{note}', [NoteController::class, 'destroy']);
});
Route::post('/register', [AuthController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);