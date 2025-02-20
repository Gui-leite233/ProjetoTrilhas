<?php

use Illuminate\Support\Facades\Route;
use MoonShine\Http\Controllers\AuthController;
use MoonShine\Http\Controllers\RoleController;
use MoonShine\Http\Controllers\UserController;
use MoonShine\Http\Middleware\Authenticate;

Route::middleware(['web', 'moonshine'])->group(function () {
    Route::get('moonshine/login', [AuthController::class, 'login'])
        ->middleware('guest')
        ->name('moonshine.login');
        
    Route::post('moonshine/login', [AuthController::class, 'authenticate'])
        ->middleware('guest')
        ->name('moonshine.authenticate');
});

Route::prefix('moonshine')->group(function () {
    Route::resource('roles', RoleController::class)->names('moonshine.roles');
    Route::resource('users', UserController::class)->names('moonshine.users');
});
