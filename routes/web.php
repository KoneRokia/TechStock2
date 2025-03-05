<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;

use App\Http\Controllers\EquipementController; // Assurez-vous d'importer le bon contrôleur
use App\Http\Controllers\MaintenanceController;

use App\Http\Controllers\EmployeController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\HistoriqueController;
use App\Http\Controllers\LogicielController;
use App\Http\Controllers\LicenceController;
use App\Http\Controllers\NotificationController;


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
Route::get('/equipements/{equipement}', [EquipementController::class, 'show'])->name('equipements.show');



Route::resource('maintenances', MaintenanceController::class);


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
Route::get('/rapports/{rapport}', [RapportController::class, 'show'])->name('rapports.show');


Route::get('/historiques', [HistoriqueController::class, 'index'])->name('historiques.index');

Route::resource('logiciels', LogicielController::class);

// Route::get('/logicielss', [EmployeController::class, 'index'])->name('logiciels.index');
// Route::get('/logiciels/create', [EmployeController::class, 'create'])->name('logiciels.create');
// Route::post('/logiciels', [EmployeController::class, 'store'])->name('logiciels.store');
// Route::get('/logiciels/{logiciel}', [EmployeController::class, 'show'])->name('logiciels.show');
// Route::get('/logiciels/{logiciel}/edit', [EmployeController::class, 'edit'])->name('logiciels.edit');
// Route::put('/logiciels/{logiciel}', [EmployeController::class, 'update'])->name('logiciels.update');
// Route::delete('/logiciels/{logiciel}', [EmployeController::class, 'destroy'])->name('logiciels.destroy');



Route::resource('licences', LicenceController::class);
Route::get('/licences/check-expiration', [LicenceController::class, 'checkLicencesExpiringSoon']);


Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::get('/notifications', [NotificationController::class, 'showNotifications'])->name('notifications.index');
Route::get('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');





Route::get('/statistiques', [StatistiqueController::class, 'index'])->name('statistiques.index');
Route::get('/utilisateurs', [UserController::class, 'index'])->name('utilisateurs.index');



Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
