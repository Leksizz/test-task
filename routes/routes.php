<?php

use App\Core\Router\Route;
use App\Src\Controllers\AuthController;
use App\Src\Controllers\MainController;
use App\Src\Controllers\PhoneController;
use App\Src\Middlewares\Auth;
use App\Src\Middlewares\Guest;
use App\Src\Middlewares\Admin;
use App\Src\Controllers\AdminController;
use App\Src\Controllers\UserController;

// Маршруты в приложении

return [
    Route::get('/', [MainController::class, 'index']),
    Route::get('/login', [AuthController::class, 'index'], [Guest::class]),
    Route::post('/login', [AuthController::class, 'login'], [Guest::class]),
    Route::get('/logout', [AuthController::class, 'logout'], [Auth::class]),
    Route::get('/admin/index/\d+', [AdminController::class, 'index'], [Admin::class]),
    Route::get('/user/users/\d+', [UserController::class, 'users'], [Admin::class]),
    Route::get('/admin/create', [AdminController::class, 'create'], [Admin::class]),
    Route::post('/admin/store', [AdminController::class, 'store'], [Admin::class]),
    Route::get('/admin/edit/\d+', [AdminController::class, 'edit'], [Admin::class]),
    Route::post('/admin/update/\d+', [AdminController::class, 'update'], [Admin::class]),
    Route::get('/user/\d+', [UserController::class, 'user'], [Admin::class]),
    Route::get('/phones/\d+', [PhoneController::class, 'phones'], [Admin::class]),
    Route::post('/admin/delete/\d+', [AdminController::class, 'delete'], [Admin::class]),
];