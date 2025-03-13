<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/verify-email', [UserController::class, 'verifyEmail']);