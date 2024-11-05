<?php
namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEtudiants = Etudiant::count();
        $etudiantsAvecBourse = Etudiant::where('Bourse', true)->count();
        $etudiantsSansBourse = Etudiant::where('Bourse', false)->count();

        return view('dashboard', compact('totalEtudiants', 'etudiantsAvecBourse', 'etudiantsSansBourse'));
    }
}
