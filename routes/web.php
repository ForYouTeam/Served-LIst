<?php

use App\Http\Controllers\Cms\PrioritasController;
use App\Http\Controllers\Cms\StaffController;
use App\Http\Controllers\Cms\TagController;
use App\Http\Controllers\Cms\TaskController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('pages.Table');
});

Route::prefix('pages')->group(function () {
    Route::get('staff', [StaffController::class, 'index'])->name('staff.index');
    Route::get('tag', [TagController::class, 'index'])->name('tag.index');
    Route::get('prioritas', [PrioritasController::class, 'index'])->name('prioritas.index');
    Route::get('task', [TaskController::class, 'index'])->name('task.index');
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
Route::prefix('api')->group(function () {
    Route::prefix('prioritas')->controller(PrioritasController::class)->group(function () {
        Route::get('/', 'getAllPrioritas');
        Route::get('/{id}', 'getPrioritasById');
        Route::post('/', 'createPrioritas');
        Route::patch('/{id}', 'updatePrioritas');
        Route::delete('/{id}', 'deletePrioritas');
    });
});

Route::prefix('api/task')->controller(TaskController::class)->group(function () {
    Route::patch('realtimeUpdate/{id}', 'updateRealtime');
    Route::get('/get/{id}', 'getById');
    Route::delete('/del/{id}/{idtask}', 'deleteTag');
    Route::post('/', 'createTask');
});
