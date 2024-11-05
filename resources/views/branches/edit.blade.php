<x-app-layout>
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la Branche</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">Modifier la Branche</h1>
        <form action="{{ route('branches.update', $branche->Branche_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="Nom_Branche" class="block text-gray-700">Nom de la Branche :</label>
                <input type="text" name="Nom_Branche" id="Nom_Branche" class="mt-1 block w-full" value="{{ $branche->Nom_Branche }}" required>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Mettre à jour</button>
        </form>
    </div>
</body>
</html>

@endsection
</x-app-layout>
