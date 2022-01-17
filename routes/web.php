<?php

use App\Http\Controllers\ProductController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::prefix('admin')->middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/collection', [ProductController::class, 'index'])->name('collection');
    Route::post('/collection', [ProductController::class, 'store'])->name('collection.store');
    Route::get('/collection/create', [ProductController::class, 'create'])->name('collection.create');
    Route::put('/collection/{collection}', [ProductController::class, 'update'])->name('collection.update');
    Route::get('/collection/{collection}/edit', [ProductController::class, 'edit'])->name('collection.edit');
    Route::get('/collection/{collection}/disable', [ProductController::class, 'disable'])->name('collection.disable');
    Route::get('/collection/{collection}/restore', [ProductController::class, 'restore'])->name('collection.restore');
    Route::delete('/collection/{collection}', [ProductController::class, 'destroy'])->name('collection.delete');
});