<?php

use Src\Route;

// user controllers
Route::add(['GET', 'POST'], '/signup', [Controller\UserController::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\UserController::class, 'login']);
Route::add('GET', '/logout', [Controller\UserController::class, 'logout']);

// main functionality
Route::add('GET', '/', [Controller\RoomsController::class, 'index']);
Route::add('GET', '/feed', [Controller\RoomsController::class, 'feed']);

// authorized only
Route::add('GET', '/seats-filter', [Controller\RoomsController::class, 'seats_filter'])->middleware('auth');
Route::add('GET', '/square-filter', [Controller\RoomsController::class, 'square_filter'])->middleware('auth');
Route::add('GET', '/rooms-filter', [Controller\RoomsController::class, 'rooms_filter'])->middleware('auth');

// admin only functions
Route::add(['GET', 'POST'], '/add-room', [Controller\AdminController::class, 'add_room'])->middleware('admin');
Route::add(['GET', 'POST'], '/add-division', [Controller\AdminController::class, 'add_division'])->middleware('admin');
Route::add(['GET', 'POST'], '/add-type-of-room', [Controller\AdminController::class, 'add_type_of_room'])->middleware('admin');
Route::add(['GET', 'POST'], '/add-type-of-division', [Controller\AdminController::class, 'add_type_of_division'])->middleware('admin');
