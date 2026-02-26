<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié | CSJ</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex items-center justify-center" style="background-color: #F3F4F6;">

    <div class="w-full max-w-md px-6 py-8">

        {{-- Logo --}}
        <div class="text-center mb-8">
            <img src="{{ asset('images/logo.png') }}" alt="CSJ" class="h-20 w-auto mx-auto mb-4">
            <h1 class="text-2xl font-heading font-bold" style="color: #1F2937;">Mot de passe oublié</h1>
            <p class="text-sm mt-1" style="color: #4B5563;">Entrez votre email pour recevoir un lien de réinitialisation</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-8" style="border: 1px solid #D1D5DB;">

            @if(session('status'))
                <div class="mb-4 p-3 rounded-lg bg-green-50 border border-green-200 text-green-700 text-sm">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium mb-2" style="color: #1F2937;">
                        Adresse email
                    </label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                           required autofocus
                           class="w-full px-4 py-3 rounded-xl text-sm transition-all duration-200"
                           style="border: 1px solid #D1D5DB; color: #1F2937; outline: none;"
                           onfocus="this.style.borderColor='#2DB9B5'; this.style.boxShadow='0 0 0 3px rgba(45,185,181,0.15)'"
                           onblur="this.style.borderColor='#D1D5DB'; this.style.boxShadow='none'"
                           placeholder="admin@csj.ht">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                        class="w-full py-3 rounded-xl font-medium text-white text-sm transition-all duration-200"
                        style="background-color: #2DB9B5;"
                        onmouseover="this.style.backgroundColor='#239E9B'"
                        onmouseout="this.style.backgroundColor='#2DB9B5'">
                    Envoyer le lien
                </button>
            </form>

            <div class="text-center mt-4">
                <a href="{{ route('login') }}" class="text-sm hover:underline" style="color: #2DB9B5;">
                    Retour à la connexion
                </a>
            </div>
        </div>
    </div>

</body>
</html>