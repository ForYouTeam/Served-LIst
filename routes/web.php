<?php

use App\Http\Controllers\Cms\StaffController;
use App\Http\Controllers\Cms\TagController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('pages.Table');
});

Route::prefix('pages')->group(function () {
    Route::get('staff', [StaffController::class, 'index'])->name('staff.index');
    Route::get('tag', [TagController::class, 'index'])->name('tag.index');
});

Route::prefix('api')->group(function () {
    Route::prefix('staff')->controller(StaffController::class)->group(function () {
        Route::get('/', 'getAllStaff');
        Route::get('/{id}', 'getStaffById');
        Route::post('/', 'createStaff');
        Route::patch('/{id}', 'updateStaff');
        Route::delete('/{id}', 'deleteStaff');
    });
});
Route::prefix('api')->group(function () {
    Route::prefix('tag')->controller(TagController::class)->group(function () {
        Route::get('/', 'getAllTag');
        Route::get('/{id}', 'getTagById');
        Route::post('/', 'createTag');
        Route::patch('/{id}', 'updateTag');
        Route::delete('/{id}', 'deleteTag');
    });
});
