<?php
namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Specialite;

use App\Models\Branche;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    public function index()
{
    $etudiants = Etudiant::paginate(5); // Paginer les résultats par page avec 5 étudiants par page
    return view('etudiants.index', compact('etudiants'));
}

public function show($etudiants_id)
{
    $etudiant = Etudiant::with(['branche', 'specialite'])->findOrFail($etudiants_id);
    return view('etudiants.show', compact('etudiant'));
}


    public function create()
    {
        $branches = Branche::all();
        return view('etudiants.create', compact('branches'));
    }

    public function store(Request $request)
{
    $request->validate([
        'nom' => 'required',
        'prenom' => 'required',
        'telephone' => 'required',
        'CNE' => 'required',
        'Date_Naissance' => 'required',
        'Annee_Scolaire' => 'required',
        'Branche_id' => 'required',
        'specialite_id' => 'required',
        'mode_paiement' => 'required',
    ]);

    $etudiant = new Etudiant();
    $etudiant->nom = $request->nom;
    $etudiant->prenom = $request->prenom;
    $etudiant->telephone = $request->telephone;
    $etudiant->CNE = $request->CNE;
    $etudiant->Date_Naissance = $request->Date_Naissance;
    $etudiant->Annee_Scolaire = $request->Annee_Scolaire;
    $etudiant->Branche_id = $request->Branche_id;
    $etudiant->specialite_id = $request->specialite_id;
    $etudiant->mode_paiement = $request->mode_paiement;

    // Assurez-vous de récupérer les valeurs de Bourse, valeur_bourse, parents_profs et paiement_annuel du formulaire
    $etudiant->Bourse = $request->input('Bourse', 0); // 0 si non défini
    $etudiant->valeur_bourse = $request->input('valeur_bourse', 0);
    $etudiant->parents_profs = $request->input('parents_profs', 0);
    $etudiant->paiement_annuel = $request->input('paiement_annuel', 0);

    // Calculer MontantRestant et l'attribuer à montant_restant
    $montantRestant = $etudiant->MontantRestant;
    $etudiant->MontantRestant = $montantRestant;

    $etudiant->save();

    return redirect()->route('etudiants.index')->with('success', 'Étudiant ajouté avec succès.');
}

public function edit($etudiants_id)
{
    $etudiant = Etudiant::findOrFail($etudiants_id);
    $branches = Branche::all();
    $specialites = Specialite::where('Branche_id', $etudiant->Branche_id)->get();
    return view('etudiants.edit', compact('etudiant', 'branches', 'specialites'));
}



public function update(Request $request, $etudiants_id)
{
    // Valider les données du formulaire
    $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'telephone' => 'required|string|max:255',
        'CNE' => 'required|string|max:255',
        'Date_Naissance' => 'required|date',
        'Annee_Scolaire' => 'required|string|max:255',
        'Branche_id' => 'required|exists:branches,Branche_id',
        'specialite_id' => 'required|exists:specialites,Specialite_id', // Make sure specialite_id is required
        'Bourse' => 'required|in:0,1',
        'valeur_bourse' => 'nullable|numeric',
        'parents_profs' => 'nullable|boolean',
        'paiement_annuel' => 'nullable|boolean',
        'mode_paiement' => 'required|in:mensuel,trimestriel,annuel',
    ]);
    // Récupérer l'étudiant existant à mettre à jour
    $etudiant = Etudiant::findOrFail($etudiants_id);
   
    // Mettre à jour les attributs de l'étudiant
    $etudiant->nom = $request->nom;
    $etudiant->prenom = $request->prenom;
    $etudiant->telephone = $request->telephone;
    $etudiant->CNE = $request->CNE;
    $etudiant->Bourse = $request->Bourse;
    $etudiant->valeur_bourse = $request->valeur_bourse;
    $etudiant->parents_profs = $request->parents_profs;
    $etudiant->non = $request->non;
    $etudiant->paiement_annuel = $request->paiement_annuel;
    $etudiant->mode_paiement = $request->mode_paiement;
    $etudiant->Date_Naissance = $request->Date_Naissance;
    $etudiant->Annee_Scolaire = $request->Annee_Scolaire;
    $etudiant->Branche_id = $request->Branche_id;
    $etudiant->specialite_id = $request->specialite_id;

    // Sauvegarder les modifications de l'étudiant
    $etudiant->save();

    // Redirection avec un message de succès
    return redirect()->route('etudiants.show', $etudiants_id)->with('success', 'Les informations de l\'étudiant ont été mises à jour avec succès.');
}
    public function destroy($etudiants_id)
    {
        $etudiant = Etudiant::findOrFail($etudiants_id);
        $etudiant->delete();

        return redirect()->route('etudiants.index')
                         ->with('success', 'Étudiant supprimé avec succès.');
    }
    public function search(Request $request)
{
    $search = $request->input('search');

    // Requête pour rechercher les étudiants par nom
    $etudiants = Etudiant::where('nom', 'LIKE', "%$search%")->paginate(5);

    // Retourner la vue avec les résultats de la recherche paginés
    return view('etudiants.index', compact('etudiants'));
}


public function getSpecialites(Request $request, $brancheId)
{
    // Récupérer les spécialités pour la branche spécifiée
    $specialites = Specialite::where('Branche_id', $brancheId)->get();

    // Retourner les spécialités au format JSON
    return response()->json($specialites);
}

}
