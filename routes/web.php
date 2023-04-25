<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AnnonceAdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth', 'can:admin')->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Afficher les categories
    Route::get('/admin/category', [CategoryController::class, 'index'])->name('admin.category.index');
    // créer une categorie
    Route::post('/admin/category', [CategoryController::class, 'store'])->name('admin.category.store');
    // editer une categorie
    Route::post('/admin/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    // Supprimer une categorie
    Route::post('/admin/category/delete/{id}', [CategoryController::class, 'delete'])->name('admin.category.delete');

    Route::get('/admin/annonce', [AnnonceAdminController::class, 'index'])->name('admin.annonce');
    Route::get('/admin/annonce/create', [AnnonceAdminController::class, 'create'])->name('admin.annonce.create');
    Route::get('/admin/annonce/edit', [AnnonceAdminController::class, 'edit'])->name('admin.annonce.edit');
});

require __DIR__ . '/auth.php';
