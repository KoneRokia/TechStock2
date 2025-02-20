<?php

namespace App\Http\Controllers;

use App\Models\Equipement;
use App\Models\Employe;
use App\Models\Maintenance;
use App\Models\Rapport;

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
        ]);
    }
}
