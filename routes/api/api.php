<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\TaskController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'destroy']);
    Route::get('/courses', [CourseController::class, 'index']);
    Route::post('/course', [CourseController::class, 'store']);
    Route::get('/course/{id}', [CourseController::class, 'show']);
    Route::patch('/course/{course}', [CourseController::class, 'update']);
    Route::delete('/course/{course}', [CourseController::class, 'destroy']);

    Route::get('/notes', [NoteController::class, 'index']);
    Route::post('/note', [NoteController::class, 'store']);
    Route::get('/note/{note}', [NoteController::class, 'show']);
    Route::patch('/note/{note}', [NoteController::class, 'update']);
    Route::delete('/note/{note}', [NoteController::class, 'destroy']);

    Route::get('/tasks', [TaskController::class, 'index']);
    Route::post('/task', [TaskController::class, 'store']);
    Route::get('/task/{task}', [TaskController::class, 'show']);
    Route::patch('/task/{task}', [TaskController::class, 'update']);
    Route::delete('/task/{task}', [TaskController::class, 'destroy']);
});
Route::post('/register', [AuthController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);
