<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Api\AuthController;

Route::post('/login', [AuthController::class, 'login']);
