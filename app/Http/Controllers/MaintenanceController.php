<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Equipement;
use App\Models\User;
use Illuminate\Http\Request;



class MaintenanceController extends Controller
{
    public function index()
    {
        $maintenances = Maintenance::with('user', 'equipement')->get();
        return view('maintenances.index', compact('maintenances'));
    }

    public function create()
    {
        $equipements = Equipement::all();
        $users = User::where('role', 'technicien')->get();
        return view('maintenances.create', compact('equipements', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'type' => 'required|string|in:Préventive,Curative,Corrective,Évolutive',
            'cout' => 'required|string|max:255',
            'etat' => 'required|string|in:en cours,terminé,en attente,annulé,reporté',
            'user_id' => 'required|exists:users,id',
            'equipement_id' => 'required|exists:equipements,id',
        ]);

        Maintenance::create($request->all());
        return redirect()->route('maintenances.index')->with('success', 'Maintenance ajoutée avec succès.');
    }

    public function edit($id)
    {
        $maintenance = Maintenance::findOrFail($id);
        $users = User::where('role', 'technicien')->get(); // Récupérer tous les techniciens
        $equipements = Equipement::all(); // Récupérer tous les équipements

        return view('maintenances.edit', compact('maintenance', 'users', 'equipements'));
    }


    // public function edit(Maintenance $maintenance)
    // {
    //     $equipements = Equipement::all();
    //     $users = User::where('role', 'technicien')->get();
    //     return view('maintenances.edit', compact('maintenance', 'equipements', 'users'));
    // }

    public function update(Request $request, Maintenance $maintenance)
    {
        $request->validate([
            'date' => 'required|date',
            'type' => 'required|string|in:Préventive,Curative,Corrective,Évolutive',
            'cout' => 'required|string|max:255',
            'etat' => 'required|string|in:en cours,terminé,en attente,annulé,reporté',
            'user_id' => 'required|exists:users,id',
            'equipement_id' => 'required|exists:equipements,id',
        ]);

        $maintenance->update($request->all());
        return redirect()->route('maintenances.index')->with('success', 'Maintenance mise à jour.');
    }

    public function destroy($id)
{
    $maintenance = Maintenance::findOrFail($id);
    $maintenance->delete();

    return redirect()->route('maintenances.index')->with('success', 'Maintenance supprimée avec succès.');
}




         // Afficher un maintenance spécifique
    public function show(Maintenance $maintenance)
    {
        return view('maintenances.show', compact('maintenance'));
    }




    // public function destroy(Maintenance $maintenance)
    // {
    //     $maintenance->delete();
    //     return redirect()->route('maintenances.index')->with('success', 'Maintenance supprimée.');
    // }



}

