<?php

use App\Models\User;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use App\Mail\SendEmailNotification;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::post('/register',[UserController::class,'register']);
Route::get('/verify-email', [UserController::class, 'verifyEmail']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);