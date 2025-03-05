<?php

namespace App\Http\Controllers;

use App\Models\Equipement;
use App\Models\Employe;
use App\Models\Maintenance;
use App\Models\Rapport;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
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

        // Total rapports
        $totalRapports = Rapport::count();

         // Total licences
         $totalLicences = Rapport::count();

          // Total losgiciel
        $totalLogiciels = Rapport::count();



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
