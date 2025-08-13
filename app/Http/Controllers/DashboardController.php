<?php

namespace App\Http\Controllers;

use App\Models\Equipement;
use App\Models\Employe;
use App\Models\Maintenance;
use App\Models\Rapport;
use App\Models\User;
use App\Models\Licence; use App\Models\Logiciel;
 use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
         $user = Auth::user();

        // Vérifie si l'utilisateur est désactivé
        if ($user->statut === 'desactif') {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Votre compte est désactivé. Veuillez contacter l’administrateur.');
        }

        // Total employés
        $totalEmployes = Employe::count();

        // Total équipements
        $totalEquipements = Equipement::count();

        // Total équipements actifs, en panne et hors service
        $equipementsActifs = Equipement::where('etat', 'actif')->count();
        $equipementsEnPanne = Equipement::where('etat', 'en panne')->count();
        $equipementsHorsService = Equipement::where('etat', 'hors service')->count();

        // Total maintenances
        $totalMaintenances = Maintenance::count();
        $maintenancesEnCours = Maintenance::where('etat', 'en cours')->count();
        $maintenancesTerminees = Maintenance::where('etat', 'terminé')->count();
        $maintenancesEnAttente = Maintenance::where('etat', 'en attente')->count();
        $maintenancesAnnulees = Maintenance::where('etat', 'annulé')->count();
        $maintenancesReporte = Maintenance::where('etat', 'reporté')->count();


        // Total rapports
        $totalRapports = Rapport::count();

         // Total licences
         $totalLicences = Licence::count();

          // Total losgiciel
        $totalLogiciels = Logiciel::count();



        // Passer les données à la vue
        return view('dashboard', [
            'totalEmployes' => $totalEmployes,
            'totalEquipements' => $totalEquipements,
            'equipementsActifs' => $equipementsActifs,
            'equipementsEnPanne' => $equipementsEnPanne,
            'equipementsHorsService' => $equipementsHorsService,
            'totalMaintenances' => $totalMaintenances,
            'maintenancesEnCours' => $maintenancesEnCours,
            'maintenancesTerminees' => $maintenancesTerminees,
            'maintenancesEnAttente' => $maintenancesEnAttente,
            'maintenancesAnnulees' => $maintenancesAnnulees,
            'maintenancesReporte' => $maintenancesReporte,
            'totalRapports' => $totalRapports,
            'totalLicences' => $totalLicences,
            'totalLogiciels' => $totalLogiciels,

        ]);
    }

        public function showDashboard()
    {
        $user = auth()->user(); // Récupère l'utilisateur authentifié
        $notifications = $user->notifications; // Récupère toutes les notifications de l'utilisateur
        $unreadNotifications = $user->unreadNotifications; // Notifications non lues
        $readNotifications = $user->readNotifications; // Notifications lues

        // Passe les notifications à la vue
        return view('dashboard', compact('notifications', 'unreadNotifications', 'readNotifications'));
    }
}
