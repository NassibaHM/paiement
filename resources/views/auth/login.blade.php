<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
  <div class="min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full p-6 bg-white rounded-lg shadow-lg">
         
      <h1 class="text-2xl font-semibold text-center text-gray-500 mt-8 mb-6">Login</h1>
      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-6">
          <label for="email" class="block mb-2 text-sm text-gray-600">Email</label>
          <input type="email" id="email" name="email" :value="old('email')" required autofocus autocomplete="username" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" required>
          <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="mb-6">
          <label for="password" class="block mb-2 text-sm text-gray-600">Password</label>
          <input type="password"
          name="password"
          required autocomplete="current-password" id="password"  class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" required>
          <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Mot de passe oublié ?') }}
                </a>
            @endif
        <button type="submit" class="w-32 bg-gradient-to-r  bg-blue-500  to-cyan-600 text-white py-2 rounded-lg mx-auto block focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 mt-4 mb-6">Connexion</button>
      </form>
      
    </div>
  </div>
</body>
</html>