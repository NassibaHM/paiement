<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branche;
use App\Models\Specialite;

class SpecialiteController extends Controller
{
    public function index($brancheId)
    {
        $branche = Branche::findOrFail($brancheId);
        $specialites = $branche->specialites;
        return view('specialites.index', compact('branche', 'specialites'));
    }

    public function create($brancheId)
    {
        $branche = Branche::findOrFail($brancheId);
        return view('specialites.create', compact('branche'));
    }

    public function store(Request $request, $brancheId)
{
    $branche = Branche::findOrFail($brancheId);
    $specialite = new Specialite($request->all());
    $specialite->Branche_id = $branche->Branche_id;
    $specialite->save();
    return redirect()->route('branches.specialites.index', $branche->Branche_id);
}

    public function edit($brancheId, $specialiteId)
    {
        $branche = Branche::findOrFail($brancheId);
        $specialite = Specialite::findOrFail($specialiteId);
        return view('specialites.edit', compact('branche', 'specialite'));
    }

    public function update(Request $request, $brancheId, $specialiteId)
    {
        $specialite = Specialite::findOrFail($specialiteId);
        $specialite->update($request->all());
        return redirect()->route('branches.specialites.index', $brancheId);
    }

    public function destroy($brancheId, $specialiteId)
    {
        $specialite = Specialite::findOrFail($specialiteId);
        $specialite->delete();
        return redirect()->route('branches.specialites.index', $brancheId);
    }
}
