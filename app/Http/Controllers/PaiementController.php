<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Etudiant;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class PaiementController extends Controller
{
    public function index(Request $request)
    {
        $etudiant_id = $request->query('etudiant_id');
        
        if ($etudiant_id) {
            $paiements = Paiement::where('etudiant_id', $etudiant_id)->get();
        } else {
            $paiements = Paiement::all();
        }

        return view('paiements.index', compact('paiements'));
    }

    public function create()
    {
        $etudiants = Etudiant::all();
        return view('paiements.create', compact('etudiants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'etudiant_id' => 'required|exists:etudiants,etudiants_id',
            'date_paiement' => 'required|date',
            'mode_paiement' => 'required|string',
            'description' => 'nullable|string',
        ]);

      
       
        $paiement = new Paiement($request->all());
       
        $paiement->save();

        return redirect()->route('paiements.index')
                         ->with('success', 'Paiement ajouté avec succès.');
    }

    public function telechargerRecu($id)
    {
            $paiement = Paiement::findOrFail($id);
            $etudiant = $paiement->etudiant;
    
            // Construction du contenu HTML du PDF
            $html = View::make('paiements.recu', compact('paiement', 'etudiant'))->render();
    
            // Options de DOMPDF
            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isPhpEnabled', true);
    
            // Instanciation de DOMPDF
            $dompdf = new Dompdf($options);
    
            // Chargement du HTML dans DOMPDF
            $dompdf->loadHtml($html);
    
            // Réglage des options du document (par exemple, la taille du papier et l'orientation)
            $dompdf->setPaper('A4', 'portrait');
    
            // Rendu du document PDF
            $dompdf->render();
    
            // Téléchargement du PDF
            return $dompdf->stream('recu_paiement_' . $paiement->paiement_id . '.pdf');
        
    }

    public function imprimerRecu($id)
    {
        $paiement = Paiement::findOrFail($id);
        // Logique pour imprimer le reçu
    }

    public function show($id)
    {
        $paiement = Paiement::findOrFail($id);
        return view('paiements.show', compact('paiement'));
    }

    public function edit($id)
    {
        $paiement = Paiement::findOrFail($id);
        $etudiants = Etudiant::all();
        return view('paiements.edit', compact('paiement', 'etudiants'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'etudiant_id' => 'required|exists:etudiants,etudiants_id',
            'date_paiement' => 'required|date',
            'mode_paiement' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $etudiant = Etudiant::findOrFail($request->etudiant_id);
      

        $paiement = Paiement::findOrFail($id);
        $paiement->update($request->all());
       
        $paiement->save();

        return redirect()->route('paiements.index')
                         ->with('success', 'Paiement mis à jour avec succès.');
    }
    public function destroy($id)
    {
        $paiement = Paiement::findOrFail($id);
        $paiement->delete();

        return redirect()->route('paiements.index')
                         ->with('success', 'Paiement supprimé avec succès.');
    }
}
