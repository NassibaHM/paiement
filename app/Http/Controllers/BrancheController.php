<?php

// app/Http/Controllers/BrancheController.php

namespace App\Http\Controllers;

use App\Models\Branche;
use Illuminate\Http\Request;
use App\Models\Specialite;

class BrancheController extends Controller
{
    public function index()
    {
        $branches = Branche::all();
        return view('branches.index', compact('branches'));
    }

    public function create()
    {
        return view('branches.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nom_Branche' => 'required|string|max:255',
        ]);

        Branche::create($request->all());

        return redirect()->route('branches.index')
            ->with('success', 'Branche ajoutée avec succès.');
    }

    public function edit(Branche $branche)
{
    $specialites = Specialite::all();
    return view('branches.edit', compact('branche', 'specialites'));
}

/**
 * Add a specialite to the specified branche.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */



    public function update(Request $request, Branche $branche)
    {
        $request->validate([
            'Nom_Branche' => 'required|string|max:255',
        ]);

        $branche->update($request->all());

        return redirect()->route('branches.index')
            ->with('success', 'Branche mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $branche = Branche::findOrFail($id);
        $branche->delete();
        return redirect()->route('branches.index')->with('success', 'Branche supprimée avec succès.');
    }
    
}
