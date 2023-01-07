<?php

use App\Http\Controllers\Admin\Content\CreateController;
use App\Http\Controllers\Admin\Content\ViewController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'dashboard'])
                ->name('dashboard');

Route::controller(ProfileController::class)->group(function () {
    Route::get('/profile', 'edit')->name('profile.edit');
    Route::patch('/profile', 'update')->name('profile.update');
    Route::delete('/profile', 'destroy')->name('profile.destroy');
});

Route::controller(CreateController::class)->group(function () {
    Route::get('content/init', 'init')->name('content.create.init');
    Route::get('content/form', 'form')->name('content.create.form');
    Route::post('content/validation', 'validation')
                    ->name('content.create.validation');
    Route::get('content/confirm', 'confirm')->name('content.create.confirm');
    Route::post('content/create', 'store')->name('content.create.store');
});

Route::controller(ViewController::class)->group(function () {
    Route::get('/content', 'index')->name('content.index');
    Route::get('/content/{content_id}', 'show')->name('content.show');
});
