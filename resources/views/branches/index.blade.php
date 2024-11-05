<x-app-layout>

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Branches</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">Liste des Branches</h1>
        <a href="{{ route('branches.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Ajouter une Branche</a>
        <table class="min-w-full bg-white border border-gray-200 mt-4">
            <thead>
                
                <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">Nom de la Branche</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($branches as $branche)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $branche->Branche_id }}</td>
                    <td class="py-2 px-4 border-b">{{ $branche->Nom_Branche }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('branches.edit', $branche->Branche_id) }}" class="text-blue-500">Modifier</a>
                        
                        <form action="{{ route('branches.destroy', $branche->Branche_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"  onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette branche ?')" class="text-red-500">Supprimer</button>
                        </form>
                        <a href="{{ route('branches.specialites.index', $branche->Branche_id) }}" class="text-green-500">Spécialités</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>

@endsection

</x-app-layout>