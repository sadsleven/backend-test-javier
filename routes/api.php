<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Rutas para listar, obtener, crear, editar y eliminar tareas

Route::get('/task', [TaskController::class, 'index']);

Route::post('/task', [TaskController::class, 'store']);

Route::get('/task/{id}', [TaskController::class, 'show']);

Route::put('/task/{id}', [TaskController::class, 'update']);

Route::patch('/task-complete/{id}', [TaskController::class, 'updateCompleted']);

Route::delete('/task/{id}', [TaskController::class, 'destroy']);