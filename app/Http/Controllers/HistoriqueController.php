<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Historique;

class HistoriqueController extends Controller
{
    public function index()
    {
        $historiques = Historique::with(['equipement', 'ancienUtilisateur', 'nouveauUtilisateur', ])->get();
        return view('historiques.index', compact('historiques'));
    }

    public function create()
    {

    }
    public function store(Request $request)
    {

    }

}
