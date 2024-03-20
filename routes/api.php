<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])->withoutMiddleware(\App\Http\Middleware\ValidTokenMiddleware::class);

Route::middleware('auth:sanctum')->group( function(){
   Route::group(['prefix' => 'v1'], function (){
       Route::get('orders', [ApiController::class, 'orders']);
       Route::get('order/{id}', [ApiController::class, 'order']);
   });
});
