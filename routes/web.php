<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\AcheteurController;
use App\Http\Controllers\BoutiqueController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [AuthController::class, 'dologin'])->name('auth.login');
Route::get('/register', function () {
    return view('Auth.register');
})->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/administrateur', [AuthController::class, 'index'])->name('dossiers.administrateur');
Route::get('/entreprise', [AuthController::class, 'index'])->name('dossiers.entreprise');
Route::get('/acheteur', [AuthController::class, 'index'])->name('dossiers.acheteur');
    
// Routes pour les Entreprises
Route::prefix('entreprise')->name('entreprise.')->group(function () {
    Route::get('/', [EntrepriseController::class, 'index'])->name('index');
    Route::get('/create', [EntrepriseController::class, 'create'])->name('create');
    Route::post('/store', [EntrepriseController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [EntrepriseController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [EntrepriseController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [EntrepriseController::class, 'destroy'])->name('destroy');
    Route::get('/annonces', [EntrepriseController::class, 'index'])->name('annonces');
    Route::get('/demandes', [EntrepriseController::class, 'demandes'])->name('demandes');
    Route::get('/demandes/{id}', [EntrepriseController::class, 'showDemande'])->name('demandes.show');
    Route::post('/demandes/{id}/statut', [EntrepriseController::class, 'updateStatutDemande'])->name('demandes.statut');
    Route::get('/entreprise/demandes', [EntrepriseController::class, 'demandes'])->name('entreprise.demandes');
    Route::put('/entreprise/demandes/{id}/statut', [EntrepriseController::class, 'updateStatutDemande'])->name('entreprise.demandes.statut');
  
});

// Routes pour les Acheteurs
Route::prefix('acheteur')->name('acheteur.')->group(function () {
    Route::get('/', [AcheteurController::class, 'index'])->name('index');
    Route::post('/demande/{id}', [AcheteurController::class, 'envoyerDemande'])->name('demande');
    Route::get('/annonces', [AcheteurController::class, 'index'])->name('annonces');
    Route::get('/mes-demandes', [AcheteurController::class, 'mesDemandes'])->name('mes-demandes');
    Route::get('/mes-demandes/{id}', [AcheteurController::class, 'showDemande'])->name('mes-demandes.show');
    Route::post('/mes-demandes/{id}/statut', [AcheteurController::class, 'updateStatutDemande'])->name('mes-demandes.statut');
    Route::get('/acheteur/mes-demandes', [AcheteurController::class, 'mesDemandes'])->name('acheteur.mes-demandes');

});

Route::prefix('administrateur')->name('administrateur.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/annonces', [AdminController::class, 'annonces'])->name('annonces');
    Route::get('/utilisateurs', [AdminController::class, 'utilisateurs'])->name('utilisateurs');
    Route::delete('/annonce/{id}', [AdminController::class, 'deleteAnnonce'])->name('deleteAnnonce');
    Route::delete('/utilisateur/{id}', [AdminController::class, 'deleteUser'])->name('deleteUser');
});

Route::prefix('boutique')->name('boutique.')->group(function () {
    Route::get('/', [BoutiqueController::class, 'index'])->name('index');
    Route::get('/index', [BoutiqueController::class, 'index'])->name('index');
    Route::get('/produit/{id}', [BoutiqueController::class, 'show'])->name('produit.show');
    Route::post('/demande/{id}', [BoutiqueController::class, 'envoyerDemande'])->name('demande');
    Route::get('/mes-demandes', [BoutiqueController::class, 'mesDemandes'])->name('mes-demandes');
    Route::get('/recherche-demande', [BoutiqueController::class, 'mesDemandes'])->name('recherche-demande');
});
