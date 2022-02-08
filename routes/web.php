<?php

use Src\Route;

// user controllers
Route::add(['GET', 'POST'], '/signup', [Controller\UserController::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\UserController::class, 'login']);
Route::add('GET', '/logout', [Controller\UserController::class, 'logout']);

// main functionality
Route::add('GET', '/', [Controller\RoomsController::class, 'index']);
Route::add('GET', '/feed', [Controller\RoomsController::class, 'feed']);
Route::add('GET', '/seats-filter', [Controller\RoomsController::class, 'seats_filter'])->middleware('auth');
Route::add('GET', '/square-filter', [Controller\RoomsController::class, 'square_filter'])->middleware('auth');
Route::add('GET', '/rooms-filter', [Controller\RoomsController::class, 'rooms_filter'])->middleware('auth');

// admin only functions
Route::add(['GET', 'POST'], '/add-room', [Controller\RoomsController::class, 'add_room']);
Route::add(['GET', 'POST'], '/add-division', [Controller\RoomsController::class, 'add_division']);
Route::add(['GET', 'POST'], '/add-type-of-room', [Controller\RoomsController::class, 'add_type_of_room']);
Route::add(['GET', 'POST'], '/add-type-of-division', [Controller\RoomsController::class, 'add_type_of_division']);