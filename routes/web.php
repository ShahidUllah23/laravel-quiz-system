<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\McqsController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {

    // Auth routes
    Route::get('login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminController::class, 'login'])->name('admin.login.submit');
    Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');

    // Protected routes
    Route::middleware('admin.auth')->group(function () {

        Route::get('dashboard', fn() => view('admin.dashboard'))
            ->name('admin.dashboard');

        Route::get('categories', [CategoryController::class, 'index'])
            ->name('admin.categories');

        Route::post('categories', [CategoryController::class, 'store'])
            ->name('admin.categories.store');

        Route::put('categories/{id}', [CategoryController::class, 'update'])
            ->name('admin.categories.update');

        Route::delete('categories/{id}', [CategoryController::class, 'destroy'])
            ->name('admin.categories.delete');

        // Quizzes
        Route::get('quizzes', [QuizController::class, 'index'])->name('admin.quizzes');
        Route::get('quizzes/create', [QuizController::class, 'create'])->name('admin.quizzes.create');
        Route::post('quizzes', [QuizController::class, 'store'])->name('admin.quizzes.store');
        Route::put('quizzes/{id}', [QuizController::class, 'update'])->name('admin.quizzes.update');
        Route::delete('quizzes/{id}', [QuizController::class, 'destroy'])->name('admin.quizzes.delete');

        // MCQs per Quiz
        Route::get('quizzes/{quiz}/mcqs', [McqsController::class, 'index'])->name('admin.mcqs.index');
        Route::get('quizzes/{quiz}/mcqs/create', [McqsController::class, 'create'])->name('admin.mcqs.create');
        Route::post('quizzes/{quiz}/mcqs', [McqsController::class, 'store'])->name('admin.mcqs.store');
        Route::put('mcqs/{id}', [McqsController::class, 'update'])->name('admin.mcqs.update');
        Route::delete('mcqs/{id}', [McqsController::class, 'destroy'])->name('admin.mcqs.delete');
    });
});
