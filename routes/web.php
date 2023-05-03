<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\FavorisController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserAnnonceController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersAdminController;
use App\Http\Controllers\Admin\AnnonceAdminController;

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
/**
 * User
 */
Route::middleware('auth')->group(function () {
    Route::get('/profile/account', [UserAnnonceController::class, 'index'])->name('account.index');

    // Afficher les annonces d'un utilisateur
    Route::get('/profile/annonce/list', [UserAnnonceController::class, 'list'])->name('account.annonce.list');

    // Ajouter des annonces
    Route::get('/profile/annonce/add', [UserAnnonceController::class, 'create'])->name('account.annonce.ajouter'); //Je créer
    Route::post('/profile/annonce/add', [UserAnnonceController::class, 'store'])->name('account.annonce.ajouter'); // j'enregistre

    // Modifier des annonces
    Route::get('/profile/annonce/edit/{id}', [UserAnnonceController::class, 'edit'])->name('account.annonce.edit'); //Je récupère
    Route::post('/profile/annonce/edit/{id}', [UserAnnonceController::class, 'update'])->name('account.annonce.edit'); //Je met à jour

    // Supprimer une annonce
    Route::delete('/profile/annonce/delete/{id}', [UserAnnonceController::class, 'delete'])->name('account.annonce.delete');

    // Voir une annonce
    Route::get('/profile/annonce/show/{id}', [UserAnnonceController::class, 'show'])->name('account.annonce.show');



    // Ajouter des favoris
    Route::get('/profile/favoris/add/{id}/{user_id}', [FavorisController::class, 'create'])->name('account.favoris.ajouter'); //Je créer
    Route::post('/profile/favoris/add/{id}/{user_id}', [FavorisController::class, 'store'])->name('account.favoris.ajouter'); // j'enregistre

    // Supprimer des favoris
    Route::get('/profile/favoris/delete/{id}', [FavorisController::class, 'delete'])->name('account.favoris.delete');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/profile/update-avatar', [ProfileController::class, 'storeAvatar'])->name('profile.update-avatar');

    // COEUR AJOUT SUPRESSION 
    Route::get('/profile/favoris/add/{id}', [FavorisController::class, 'add'])->name('profile.favoris.add');

    // Supprimer un favoris
    Route::get('/profile/favoris/delete/{id}', [FavorisController::class, 'delete'])->name('account.favoris.delete');

    // Voir un favoris
    Route::get('/profile/annonce/user/favoris', [FavorisController::class, 'index'])->name('account.favoris.list');
});

/**
 * Admin
 */
Route::middleware('auth', 'can:admin')->group(function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.home');

    // Afficher les categories
    Route::get('/admin/category', [CategoryController::class, 'index'])->name('admin.category.index');
    // créer une categorie
    Route::post('/admin/category', [CategoryController::class, 'store'])->name('admin.category.store');
    // editer une categorie
    Route::post('/admin/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    // Supprimer une categorie
    Route::post('/admin/category/del/{id}', [CategoryController::class, 'delete'])->name('admin.category.delete');

    Route::get('/admin/annonce', [AnnonceAdminController::class, 'index'])->name('admin.annonce.index');

    // Ajouter des annonces
    Route::get('/admin/annonce/add', [AnnonceAdminController::class, 'create'])->name('admin.annonce.ajouter'); //Je créer
    Route::post('/admin/annonce/add', [AnnonceAdminController::class, 'store'])->name('admin.annonce.ajouter'); // j'enregistre

    // Modifier des annonces
    Route::get('/admin/annonce/edit/{id}', [AnnonceAdminController::class, 'edit'])->name('admin.annonce.edit'); //Je récupère
    Route::post('/admin/annonce/edit/{id}', [AnnonceAdminController::class, 'update'])->name('admin.annonce.edit'); //Je met à jour

    // Supprimer des annonces
    Route::get('/admin/annonce/del/{id}', [AnnonceAdminController::class, 'delete'])->name('admin.annonce.delete');

    // Voir une annonce
    Route::get('/admin/annonce/show/{id}', [AnnonceAdminController::class, 'show'])->name('admin.annonce.show');

    // Afficher les utilisateurs
    Route::get('/admin/users', [UsersAdminController::class, 'index'])->name('admin.users.index');

    Route::post('/admin/users/updateSatut/{id}', [UsersAdminController::class, 'updateStatut'])->name('profile.update-statut');

    // Afficher les utilisateurs
    Route::get('/admin/favoris', [FavorisController::class, 'index'])->name('admin.usersFavoris.index');
});

require __DIR__ . '/auth.php';
