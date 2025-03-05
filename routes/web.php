<?php

use App\Http\Controllers\DrawController;
use App\Http\Controllers\ParticipantController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ParticipantController::class, 'index']);

Route::post('/participants', [ParticipantController::class, 'store']);
Route::put('/participants/{id}', [ParticipantController::class, 'update']);
Route::delete('/participants/{id}', [ParticipantController::class, 'destroy']);

Route::post('/draw', [DrawController::class, 'drawNames']);
