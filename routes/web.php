<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersAdminController;
use App\Http\Controllers\Admin\AnnonceAdminController;
use App\Http\Controllers\UserAnnonceController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

// Affiche tous les annonces du site
Route::get('/annonces', [AnnonceController::class, 'index'])->name('annonce.index');

// Affiche les détails d'une annonce
Route::get('/annonce/details/{id}', [AnnonceController::class, 'show'])->name('annonce.show');

// Filtre les annonces par catégories
Route::get('/home/category/tri/{id}', [HomeController::class, 'show'])->name('home.tri');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile/annonce', [UserAnnonceController::class, 'index'])->name('account.index');

    // Ajouter des annonces
    Route::get('/profile/annonce/ajouter', [UserAnnonceController::class, 'create'])->name('account.annonce.ajouter'); //Je créer
    Route::post('/profile/annonce/ajouter', [UserAnnonceController::class, 'store'])->name('account.annonce.ajouter'); // j'enregistre

    // Modifier des annonces
    Route::get('/profile/annonce/edit/{id}', [UserAnnonceController::class, 'edit'])->name('account.annonce.edit'); //Je récupère
    Route::post('/profile/annonce/edit/{id}', [UserAnnonceController::class, 'update'])->name('account.annonce.edit'); //Je met à jour

    // Supprimer des annonces
    Route::get('/profile/annonce/delete/{id}', [UserAnnonceController::class, 'delete'])->name('account.annonce.delete');

    // Voir une annonce
    Route::get('/profile/annonce/show/{id}', [UserAnnonceController::class, 'show'])->name('account.annonce.show');

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

    // Afficher les utilisateurs
    Route::get('/admin/users', [UsersAdminController::class, 'index'])->name('admin.users.index');

    Route::get('/admin/annonce', [AnnonceAdminController::class, 'index'])->name('admin.annonce.index');

    // Ajouter des annonces
    Route::get('/admin/annonce/ajouter', [AnnonceAdminController::class, 'create'])->name('admin.annonce.ajouter'); //Je créer
    Route::post('/admin/annonce/ajouter', [AnnonceAdminController::class, 'store'])->name('admin.annonce.ajouter'); // j'enregistre

    // Modifier des annonces
    Route::get('/admin/annonce/edit/{id}', [AnnonceAdminController::class, 'edit'])->name('admin.annonce.edit'); //Je récupère
    Route::post('/admin/annonce/edit/{id}', [AnnonceAdminController::class, 'update'])->name('admin.annonce.edit'); //Je met à jour

    // Supprimer des annonces
    Route::get('/admin/annonce/delete/{id}', [AnnonceAdminController::class, 'delete'])->name('admin.annonce.delete');

    // Voir une annonce
    Route::get('/admin/annonce/show/{id}', [AnnonceAdminController::class, 'show'])->name('admin.annonce.show');
});

require __DIR__ . '/auth.php';
