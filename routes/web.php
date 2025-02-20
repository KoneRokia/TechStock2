<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;

use App\Http\Controllers\EquipementController; // Assurez-vous d'importer le bon contrôleur
use App\Http\Controllers\MaintenanceController;

use App\Http\Controllers\EmployeController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\HistoriqueController;


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
Route::get('/maintenances/create', [MaintenanceController::class, 'create'])->name('maintenances.create'); // Formulaire de création
Route::post('/maintenances', [MaintenanceController::class, 'store'])->name('maintenances.store'); // Enregistrement de l'équipement
Route::get('/maintenances/{/maintenance}/edit', [MaintenanceController::class, 'edit'])->name('maintenances.edit'); // Formulaire d'édition
Route::put('/maintenances/{/maintenance}', [MaintenanceController::class, 'update'])->name('maintenances.update'); // Mise à jour de l'équipement
Route::delete('/maintenances/{/maintenance}', [MaintenanceController::class, 'destroy'])->name('maintenances.destroy'); // Suppression de l'équipement


Route::get('/employes', [EmployeController::class, 'index'])->name('employes.index');
Route::get('/employes/create', [EmployeController::class, 'create'])->name('employes.create');
Route::post('/employes', [EmployeController::class, 'store'])->name('employes.store');
Route::get('/employes/{employe}', [EmployeController::class, 'show'])->name('employes.show');
Route::get('/employes/{employe}/edit', [EmployeController::class, 'edit'])->name('employes.edit');
Route::put('/employes/{employe}', [EmployeController::class, 'update'])->name('employes.update');
Route::delete('/employes/{employe}', [EmployeController::class, 'destroy'])->name('employes.destroy');

Route::get('/employes/{employe}/affectation', [EmployeController::class, 'showAffectationForm'])
    ->name('employes.affectation');
Route::post('/employes/{employe}/affecter-equipements', [EmployeController::class, 'affecterEquipements'])
    ->name('employes.affecter-equipements');

Route::middleware(['auth'])->group(function () {
    Route::resource('rapports', RapportController::class);
});
Route::get('/rapports/export/pdf', [RapportController::class, 'exportPDF'])->name('rapports.export.pdf');



Route::get('/historiques', [HistoriqueController::class, 'index'])->name('historiques.index');



Route::get('/statistiques', [StatistiqueController::class, 'index'])->name('statistiques.index');
Route::get('/utilisateurs', [UserController::class, 'index'])->name('utilisateurs.index');



Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
