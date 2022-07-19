<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Cms\PrioritasController;
use App\Http\Controllers\Cms\StaffController;
use App\Http\Controllers\Cms\TagController;
use App\Http\Controllers\Cms\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TaskController::class, 'index'])->middleware('auth')->name('task.index');

Route::prefix('auth')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'loginProcess'])->name('login.process');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});
Route::prefix('pages')->middleware('auth')->group(function () {
    Route::get('staff', [StaffController::class, 'index'])->name('staff.index')->middleware('role:super-admin');
    Route::get('tag', [TagController::class, 'index'])->name('tag.index')->middleware('role:super-admin');
    Route::get('prioritas', [PrioritasController::class, 'index'])->name('prioritas.index')->middleware('role:super-admin');
});

Route::prefix('api')->middleware('auth')->group(function () {
    Route::prefix('staff')->controller(StaffController::class)->group(function () {
        Route::get('/', 'getAllStaff')->middleware('permission:get content');
        Route::get('/{id}', 'getStaffById')->middleware('permission:getbyid content');
        Route::post('/', 'createStaff')->middleware('permission:post content');
        Route::patch('/{id}', 'updateStaff')->middleware('permission:update content');
        Route::delete('/{id}', 'deleteStaff')->middleware('permission:delete content');
    });
    Route::prefix('tag')->controller(TagController::class)->group(function () {
        Route::get('/', 'getAllTag')->middleware('permission:get content');
        Route::get('/{id}', 'getTagById')->middleware('permission:getbyid content');
        Route::post('/', 'createTag')->middleware('permission:post content');
        Route::patch('/{id}', 'updateTag')->middleware('permission:update content');
        Route::delete('/{id}', 'deleteTag')->middleware('permission:delete content');
    });
    Route::prefix('prioritas')->controller(PrioritasController::class)->group(function () {
        Route::get('/', 'getAllPrioritas')->middleware('permission:get content');
        Route::get('/{id}', 'getPrioritasById')->middleware('permission:getbyid content');
        Route::post('/', 'createPrioritas')->middleware('permission:post content');
        Route::patch('/{id}', 'updatePrioritas')->middleware('permission:update content');
        Route::delete('/{id}', 'deletePrioritas')->middleware('permission:delete content');
    });
    Route::prefix('task')->controller(TaskController::class)->group(function () {
        Route::patch('realtimeUpdate/{id}', 'updateRealtime')->middleware('permission:update content');
        Route::get('/get/{id}', 'getById')->middleware('permission:getbyid content');
        Route::delete('/delete_task/{id}', 'deleteTask')->middleware('permission:delete content');
        Route::delete('/del/{id}/{idtask}', 'deleteTag');
    });
    Route::post('new_task', 'createTask')->middleware('permission:post content');
});
