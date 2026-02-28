@extends('layouts.admin')

@section('title', 'Mon profil')
@section('page_title', 'Mon profil')

@section('content')

<div class="max-w-2xl space-y-6">

    {{-- Informations personnelles --}}
    <div class="card p-8">
        <h3 class="font-heading font-semibold text-csj-gray-900 mb-6">Informations personnelles</h3>

        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PATCH')

            <div class="space-y-5">

                {{-- Photo de profil --}}
                <div>
                    <label class="block text-sm font-medium text-csj-gray-700 mb-2">Photo de profil</label>
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-full overflow-hidden flex-shrink-0">
                            @if($user->avatar)
                                <img src="{{ Storage::url($user->avatar) }}" class="w-full h-full object-cover" id="avatar-preview">
                            @else
                                <div class="w-16 h-16 rounded-full flex items-center justify-center text-white font-bold text-xl" style="background-color: #0DCAF0;" id="avatar-placeholder">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <input type="file" name="avatar" id="avatar" accept="image/jpeg,image/png,image/webp"
                                   class="block w-full text-sm text-csj-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:text-white"
                                   style="accent-color: #0DCAF0;"
                                   onchange="previewAvatar(this)">
                            <p class="text-csj-gray-400 text-xs mt-1">JPG, PNG ou WebP. Max 2 Mo.</p>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-csj-gray-700 mb-2">Nom complet <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                           class="input-field @error('name') border-red-400 @enderror">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-csj-gray-700 mb-2">Adresse email <span class="text-red-500">*</span></label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                           class="input-field @error('email') border-red-400 @enderror">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-csj-gray-700 mb-2">Téléphone</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                           class="input-field" placeholder="+509 XXXX XXXX">
                </div>

                <div>
                    <label class="block text-sm font-medium text-csj-gray-700 mb-2">Rôle</label>
                    <input type="text" value="{{ $user->getRoleNames()->first() }}"
                           class="input-field" style="background-color: #F3F4F6;" disabled>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="btn-primary">Mettre à jour</button>
            </div>
        </form>
    </div>

    {{-- Changer le mot de passe --}}
    <div class="card p-8">
        <h3 class="font-heading font-semibold text-csj-gray-900 mb-6">Changer le mot de passe</h3>

        <form action="{{ route('admin.profile.password') }}" method="POST">
            @csrf @method('PATCH')

            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-csj-gray-700 mb-2">Mot de passe actuel <span class="text-red-500">*</span></label>
                    <input type="password" name="current_password"
                           class="input-field @error('current_password') border-red-400 @enderror"
                           placeholder="••••••••">
                    @error('current_password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-csj-gray-700 mb-2">Nouveau mot de passe <span class="text-red-500">*</span></label>
                    <input type="password" name="password"
                           class="input-field @error('password') border-red-400 @enderror"
                           placeholder="••••••••">
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    <p class="text-csj-gray-400 text-xs mt-1">Min. 8 caractères, majuscule, minuscule et chiffre.</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-csj-gray-700 mb-2">Confirmer le mot de passe <span class="text-red-500">*</span></label>
                    <input type="password" name="password_confirmation"
                           class="input-field" placeholder="••••••••">
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="btn-primary">Changer le mot de passe</button>
            </div>
        </form>
    </div>

</div>

@push('scripts')
<script>
function previewAvatar(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('avatar-preview');
            const placeholder = document.getElementById('avatar-placeholder');
            if (preview) {
                preview.src = e.target.result;
            } else if (placeholder) {
                placeholder.outerHTML = `<img src="${e.target.result}" class="w-16 h-16 rounded-full object-cover" id="avatar-preview">`;
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush

@endsection