<?php

use App\Http\Controllers\DrawController;
use App\Http\Controllers\ParticipantController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ParticipantController::class, 'index']);
Route::post('/participants', [ParticipantController::class, 'store']);
Route::post('/draw', [DrawController::class, 'drawNames']);
