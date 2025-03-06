<?php

use App\Http\Controllers\DrawController;
use App\Http\Controllers\ParticipantController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ParticipantController::class, 'index']);
Route::get('/participants', [ParticipantController::class, 'index']);
Route::post('/participants', [ParticipantController::class, 'store']);
Route::put('/participants/{participant}', [ParticipantController::class, 'update']);
Route::delete('/participants/{participant}', [ParticipantController::class, 'destroy']);

Route::post('/draw', [DrawController::class, 'drawNames']);

Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
Route::post('/rooms', [RoomController::class, 'store']);
Route::post('/rooms/{room}/join', [RoomController::class, 'join']);
