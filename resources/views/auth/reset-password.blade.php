<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau mot de passe | CSJ</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex items-center justify-center" style="background-color: #F3F4F6;">

    <div class="w-full max-w-md px-6 py-8">

        {{-- Logo --}}
        <div class="text-center mb-8">
            <img src="{{ asset('images/logo.png') }}" alt="CSJ" class="h-20 w-auto mx-auto mb-4">
            <h1 class="text-2xl font-heading font-bold" style="color: #1F2937;">Nouveau mot de passe</h1>
            <p class="text-sm mt-1" style="color: #4B5563;">Choisissez un nouveau mot de passe sécurisé</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-8" style="border: 1px solid #D1D5DB;">

            <form method="POST" action="{{ route('password.store') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                {{-- Email --}}
                <div class="mb-5">
                    <label for="email" class="block text-sm font-medium mb-2" style="color: #1F2937;">
                        Adresse email
                    </label>
                    <input id="email" type="email" name="email"
                           value="{{ old('email', $request->email) }}"
                           required autofocus autocomplete="username"
                           class="w-full px-4 py-3 rounded-xl text-sm transition-all duration-200"
                           style="border: 1px solid #D1D5DB; color: #1F2937; outline: none;"
                           onfocus="this.style.borderColor='#0DCAF0'; this.style.boxShadow='0 0 0 3px rgba(13,202,240,0.15)'"
                           onblur="this.style.borderColor='#D1D5DB'; this.style.boxShadow='none'">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nouveau mot de passe --}}
                <div class="mb-5">
                    <label for="password" class="block text-sm font-medium mb-2" style="color: #1F2937;">
                        Nouveau mot de passe
                    </label>
                    <input id="password" type="password" name="password"
                           required autocomplete="new-password"
                           class="w-full px-4 py-3 rounded-xl text-sm transition-all duration-200"
                           style="border: 1px solid #D1D5DB; color: #1F2937; outline: none;"
                           onfocus="this.style.borderColor='#0DCAF0'; this.style.boxShadow='0 0 0 3px rgba(13,202,240,0.15)'"
                           onblur="this.style.borderColor='#D1D5DB'; this.style.boxShadow='none'"
                           placeholder="••••••••">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs mt-1" style="color: #6C757D;">Min. 8 caractères, majuscule, minuscule et chiffre.</p>
                </div>

                {{-- Confirmer mot de passe --}}
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium mb-2" style="color: #1F2937;">
                        Confirmer le mot de passe
                    </label>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                           required autocomplete="new-password"
                           class="w-full px-4 py-3 rounded-xl text-sm transition-all duration-200"
                           style="border: 1px solid #D1D5DB; color: #1F2937; outline: none;"
                           onfocus="this.style.borderColor='#0DCAF0'; this.style.boxShadow='0 0 0 3px rgba(13,202,240,0.15)'"
                           onblur="this.style.borderColor='#D1D5DB'; this.style.boxShadow='none'"
                           placeholder="••••••••">
                    @error('password_confirmation')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                        class="w-full py-3 rounded-xl font-medium text-white text-sm transition-all duration-200"
                        style="background-color: #0DCAF0;"
                        onmouseover="this.style.backgroundColor='#0AABE0'"
                        onmouseout="this.style.backgroundColor='#0DCAF0'">
                    Réinitialiser le mot de passe
                </button>
            </form>

            <div class="text-center mt-4">
                <a href="{{ route('login') }}" class="text-sm hover:underline" style="color: #0DCAF0;">
                    Retour à la connexion
                </a>
            </div>
        </div>

        <p class="text-center text-xs mt-6" style="color: #4B5563;">
            © {{ date('Y') }} Collège Saint Jean des Cayes
        </p>
    </div>

</body>
</html>