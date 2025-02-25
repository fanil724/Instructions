<?php

use App\Http\Controllers\InstruktController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\Admin\IndexController as AdminIndexController;
use App\Http\Controllers\Admin\IstructionsController as AdminIstructionsController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ComplaintController as AdminComplaintController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CaptchaController;


Auth::routes();


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/{soc}/redirect', [SocialiteController::class, 'redirect'])->name('auth.redirect');
Route::get('/{soc}/callback', [SocialiteController::class, 'callback'])->name('auth.callback');

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/show', [App\Http\Controllers\HomeController::class, 'show'])->name('show');

Route::name('admin.')
    ->middleware(['is_admin'])
    ->prefix('admin')->group(function () {
        Route::get('/index', [AdminIndexController::class, 'index'])->name('index');
        Route::name('instructions.')->prefix('instructions')->group(function () {
            Route::get('/', [AdminIstructionsController::class, 'index'])->name('index');
            Route::get('/{instruction}', [AdminIstructionsController::class, 'show'])->name('show');
            Route::get('/addInstruktion/{id}', [AdminIstructionsController::class, 'addInstruktion'])->name('addInstruktion');
            Route::delete('/destroy/{instruction}', [AdminIstructionsController::class, 'destroy'])->name('destroy');
        });
        Route::name('users.')->prefix('users')->group(function () {
            Route::get('/', [AdminUserController::class, 'index'])->name('index');
            Route::get('/blockedUsers', [AdminUserController::class, 'blockedUsers'])->name('blockedUsers');
            Route::post('/store', [AdminUserController::class, 'store'])->name('store');
            Route::get('/{user}/edit', [AdminUserController::class, 'edit'])->name('edit');
            Route::put('/update/{user}', [AdminUserController::class, 'update'])->name('update');
            Route::delete('/destroy/{user}', [AdminUserController::class, 'destroy'])->name('destroy');
            Route::post('/{id}/blocked', [AdminUserController::class, 'blocked'])->name('blocked');
            Route::get('/create', [AdminUserController::class, 'create'])->name('create');
            Route::post('/store', [AdminUserController::class, 'store'])->name('store');
            Route::get('/{user}/show', [AdminUserController::class, 'show'])->name('show');
        });
        Route::name('complaint.')->prefix('complaint')->group(function () {
            Route::get('/', [AdminComplaintController::class, 'index'])->name('index');
            Route::get('/all', [AdminComplaintController::class, 'all'])->name('all');
            Route::post('/{id}/status', [AdminComplaintController::class, 'status'])->name('status');
            Route::get('/{id}/show', [AdminComplaintController::class, 'show'])->name('show');
        });
    });



Route::name('instructions.')->prefix('instructions')->group(function () {
    Route::get('/', [InstruktController::class, 'index'])->name('index');
    Route::get('/create', [InstruktController::class, 'create'])->name('create');
    Route::post('/store', [InstruktController::class, 'store'])->name('store');
    Route::post('/search', [InstruktController::class, 'search'])->name('search');
    Route::get('/{instruction}', [InstruktController::class, 'show'])->name('show');
    Route::get('/complaint/{instruction}', [InstruktController::class, 'complaint'])->name('complaint');
    Route::post('/complaint/store', [InstruktController::class, 'comStore'])->name('complaint.store');
});

Route::name('user.')->prefix('user')->group(function () {
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('/update/{user}', [UserController::class, 'update'])->name('update');
});

Route::get('download/{instruction}', [InstruktController::class, 'download'])->name('download');
Route::get('/captchaIMG', [CaptchaController::class, 'refreshCaptcha'])->name('refreshCaptcha');
