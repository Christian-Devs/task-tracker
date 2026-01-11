<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

Route::post('/projects', [ProjectController::class, 'store']);
Route::get('/projects/{project}', [ProjectController::class, 'show']);

Route::post('/projects/{project}/tasks', [TaskController::class, 'store']);
Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus']);
