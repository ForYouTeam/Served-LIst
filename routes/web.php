<?php

use App\Http\Controllers\Cms\StaffController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('pages.Table');
});

Route::prefix('pages')->group(function () {
    Route::get('staff', [StaffController::class, 'index'])->name('staff.index');
});

Route::prefix('api')->group(function () {
    Route::prefix('staff')->controller(StaffController::class)->group(function () {
        Route::get('/', 'getAllStaff');
    });
});
