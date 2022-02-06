<?php

use Src\Route;

Route::add('GET', '/', [Controller\Site::class, 'index']);
Route::add('GET', '/feed', [Controller\Site::class, 'feed']);
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);
Route::add('GET', '/seats-filter', [Controller\Site::class, 'seatsFilter'])->middleware('auth');
Route::add('GET', '/square-filter', [Controller\Site::class, 'squareFilter'])->middleware('auth');
Route::add('GET', '/rooms-filter', [Controller\Site::class, 'roomsFilter'])->middleware('auth');
