<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;

use App\Http\Controllers\EquipementController; // Assurez-vous d'importer le bon contrôleur
use App\Http\Controllers\MaintenanceController;



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
    return redirect()->route('register'); //Rediriger vers la page d'inscription
});

Route::get('/register',['RegisteredUserController'::class, 'create'])->name('register');



Route::get('/equipements', [EquipementController::class, 'index'])->name('equipements.index');
Route::get('/equipements/create', [EquipementController::class, 'create'])->name('equipements.create'); // Formulaire de création
Route::post('/equipements', [EquipementController::class, 'store'])->name('equipements.store'); // Enregistrement de l'équipement
Route::get('/equipements/{equipement}/edit', [EquipementController::class, 'edit'])->name('equipements.edit'); // Formulaire d'édition
Route::put('/equipements/{equipement}', [EquipementController::class, 'update'])->name('equipements.update'); // Mise à jour de l'équipement
Route::delete('/equipements/{equipement}', [EquipementController::class, 'destroy'])->name('equipements.destroy'); // Suppression de l'équipement


Route::get('/maintenances', [MaintenanceController::class, 'index'])->name('maintenances.index');
Route::get('/statistiques', [StatistiqueController::class, 'index'])->name('statistiques.index');
Route::get('/rapports', [RapportController::class, 'index'])->name('rapports.index');
Route::get('/utilisateurs', [UserController::class, 'index'])->name('utilisateurs.index');



Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
