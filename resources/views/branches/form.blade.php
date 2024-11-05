<!-- resources/views/branches/form.blade.php -->

@extends('layouts.app')

@section('content')
    <div>
        <h2>{{ isset($branche) ? 'Modifier une Branche' : 'Ajouter une Branche' }}</h2>
        <form action="{{ isset($branche) ? route('branches.update', $branche->Branche_id) : route('branches.store') }}" method="POST">
            @csrf
            @if (isset($branche))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="Nom_Branche">Nom de la Branche</label>
                <input type="text" class="form-control" id="Nom_Branche" name="Nom_Branche" value="{{ isset($branche) ? $branche->Nom_Branche : '' }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="{{ route('branches.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@endsection
