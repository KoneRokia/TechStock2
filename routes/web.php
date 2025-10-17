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
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckAccountStatus;


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
// Route::delete('/equipements/{equipement}', [EquipementController::class, 'destroy'])->name('equipements.destroy'); // Suppression de l'équipement
Route::get('/equipements/{equipement}', [EquipementController::class, 'show'])->name('equipements.show');
Route::put('/equipements/{id}/supprimer', [EquipementController::class, 'supprimer'])->name('equipements.supprimer');
Route::put('/equipements/{id}/desactiver', [EmployeController::class, 'desactiver'])->name('equipements.desactiver');
Route::POST('/equipements/filter', [EquipementController::class, 'filterEquipements']);


Route::resource('maintenances', MaintenanceController::class);


Route::get('/employes', [EmployeController::class, 'index'])->name('employes.index');
Route::get('/employes/create', [EmployeController::class, 'create'])->name('employes.create');
Route::post('/employes', [EmployeController::class, 'store'])->name('employes.store');
Route::get('/employes/{employe}', [EmployeController::class, 'show'])->name('employes.show');
Route::get('/employes/{employe}/edit', [EmployeController::class, 'edit'])->name('employes.edit');
Route::put('/employes/{employe}', [EmployeController::class, 'update'])->name('employes.update');
// Route::delete('/employes/{employe}', [EmployeController::class, 'destroy'])->name('employes.destroy');


Route::get('/employes/{employe}/affectation', [EmployeController::class, 'showAffectationForm'])
    ->name('employes.affectation');
Route::post('/employes/{employe}/affecter-equipements', [EmployeController::class, 'affecterEquipements'])
    ->name('employes.affecter-equipements');
    Route::put('/employes/{id}/supprimer', [EmployeController::class, 'supprimer'])->name('employes.supprimer');
    Route::put('/employes/{id}/toggle', [EmployeController::class, 'toggleStatut'])->name('employes.toggle');


Route::middleware(['auth'])->group(function () {
    Route::resource('rapports', RapportController::class);
});
Route::get('/rapports/export/pdf', [RapportController::class, 'exportPDF'])->name('rapports.export.pdf');
Route::get('/rapports/{rapport}', [RapportController::class, 'show'])->name('rapports.show');


Route::get('/historiques', [HistoriqueController::class, 'index'])->name('historiques.index');

Route::resource('logiciels', LogicielController::class);
Route::get('/logiciels/{id}/data', [LogicielController::class, 'getLogicielData']);


// Routes réservées aux admins
Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });
});

// Routes réservées aux éditeurs
Route::middleware(['role:editeur'])->group(function () {
    Route::get('/editeur/dashboard', function () {
        return view('editeur.dashboard');
    });
});

// Routes accessibles à tous les utilisateurs
Route::get('/home', function () {
    return view('home');
});


Route::resource('licences', LicenceController::class);
Route::get('/licences/check-expiration', [LicenceController::class, 'checkLicencesExpiringSoon']);


Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::get('/notifications', [NotificationController::class, 'showNotifications'])->name('notifications.index');
// Route::get('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
Route::put('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

Route::middleware(['auth', 'check.account.status'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/delete', [ProfileController::class, 'softDelete'])->name('profile.softDelete');
 Route::put('/profile/deactivate', [UserController::class, 'deactivateSelf'])->name('profile.deactivate');

    // Route::middleware(['auth'])->group(function () {
    //     Route::put('/profile/deactivate', [ProfileController::class, 'deactivate'])->name('profile.deactivate');
    // });

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::put('/profile/{id}/activate', [ProfileController::class, 'activate'])->name('profile.activate');
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::put('/users/{id}/activate', [UserController::class, 'activate'])->name('users.activate');
        Route::put('/users/{id}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');



    });


    Route::patch('/admin/users/{user}/statut', [UserController::class, 'updateStatut'])
    ->name('admin.users.statut')
    ->middleware(['auth', 'admin']);

});

require __DIR__.'/auth.php';
