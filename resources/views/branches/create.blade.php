<x-app-layout>

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Branche</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">Ajouter une Branche</h1>
        <form action="{{ route('branches.store') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label for="Nom_Branche" class="block text-gray-700 font-bold mb-2">Nom de la Branche</label>
                <input type="text" name="Nom_Branche" id="Nom_Branche" class="border rounded px-4 py-2 w-full @error('Nom_Branche') border-red-500 @enderror">
                @error('Nom_Branche')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Ajouter</button>
        </form>
    </div>
</body>
</html>
@endsection

</x-app-layout>