<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BasketController;

Route::get('/', [BasketController::class, 'showForm']);
Route::post('/basket/total', [BasketController::class, 'calculateTotal']);
