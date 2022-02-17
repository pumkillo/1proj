<?php

use Src\Route;

Route::add('GET', '/', [Controller\Api::class, 'index']);
Route::add('POST', '/echo', [Controller\Api::class, 'echo']);
Route::add('POST', '/login', [Controller\Api::class, 'login']);
Route::add('GET', '/seats-filter', [Controller\Api::class, 'seats_filter']);
