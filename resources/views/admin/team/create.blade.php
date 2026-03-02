@extends('layouts.admin')

@section('title', 'Ajouter un membre')
@section('page_title', 'Ajouter un membre')

@section('content')

<div class="max-w-2xl">
    <form action="{{ route('admin.team.store') }}" method="POST">
        @csrf
        <div class="card p-8 space-y-6">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-csj-gray-700 mb-2">Nom <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" class="input-field @error('name') border-red-400 @enderror">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-csj-gray-700 mb-2">Rôle <span class="text-red-500">*</span></label>
                    <input type="text" name="role" value="{{ old('role') }}" class="input-field @error('role') border-red-400 @enderror" placeholder="ex: Directeur pédagogique">
                    @error('role') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-csj-gray-700 mb-2">Description</label>
                <textarea name="description" rows="3" class="input-field resize-none" placeholder="Brève description...">{{ old('description') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-csj-gray-700 mb-2">Ordre d'affichage</label>
                    <input type="number" name="order" value="{{ old('order', 0) }}" class="input-field" min="0">
                </div>
                <div class="flex items-center gap-3 pt-6">
                    <input type="checkbox" name="is_active" id="is_active" value="1" checked class="w-4 h-4 rounded" style="accent-color: #0DCAF0;">
                    <label for="is_active" class="text-sm font-medium text-csj-gray-700">Membre actif</label>
                </div>
            </div>

            {{-- Photo avec recadrage --}}
            <div>
                <label class="block text-sm font-medium text-csj-gray-700 mb-2">Photo</label>

                <input type="file" id="photoInput" accept="image/jpeg,image/png,image/webp"
                       class="block w-full text-sm text-csj-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:text-white">

                <div id="cropperContainer" class="hidden mt-4">
                    <div class="relative w-full max-w-sm mx-auto">
                        <img id="cropperImage" class="max-w-full">
                    </div>
                    <div class="flex gap-3 mt-4 justify-center">
                        <button type="button" id="cropBtn"
                                class="px-4 py-2 rounded-xl text-white text-sm font-medium"
                                style="background-color: #0DCAF0;">
                            ✓ Valider le recadrage
                        </button>
                        <button type="button" id="cancelCropBtn"
                                class="px-4 py-2 rounded-xl text-sm font-medium border border-csj-gray-200 text-csj-gray-600">
                            ✕ Annuler
                        </button>
                    </div>
                </div>

                <div id="previewContainer" class="hidden mt-4 text-center">
                    <img id="previewImage" class="w-24 h-24 rounded-full object-cover mx-auto border-4" style="border-color: #0DCAF0;">
                    <p class="text-xs text-csj-gray-400 mt-2">Aperçu de la photo</p>
                    <button type="button" id="changePhotoBtn" class="text-xs mt-1 hover:underline" style="color: #0DCAF0;">
                        Changer la photo
                    </button>
                </div>

                <input type="hidden" name="photo" id="croppedPhoto">
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary">Ajouter le membre</button>
                <a href="{{ route('admin.team.index') }}" class="btn-secondary">Annuler</a>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<script>
let cropper = null;

document.getElementById('photoInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(e) {
        const img = document.getElementById('cropperImage');
        img.src = e.target.result;
        document.getElementById('cropperContainer').classList.remove('hidden');
        document.getElementById('previewContainer').classList.add('hidden');
        if (cropper) cropper.destroy();
        cropper = new Cropper(img, {
            aspectRatio: 1,
            viewMode: 1,
            autoCropArea: 0.8,
            responsive: true,
        });
    };
    reader.readAsDataURL(file);
});

document.getElementById('cropBtn').addEventListener('click', function() {
    if (!cropper) return;
    const canvas = cropper.getCroppedCanvas({ width: 300, height: 300 });
    const croppedDataUrl = canvas.toDataURL('image/jpeg', 0.9);
    document.getElementById('croppedPhoto').value = croppedDataUrl;
    document.getElementById('previewImage').src = croppedDataUrl;
    document.getElementById('cropperContainer').classList.add('hidden');
    document.getElementById('previewContainer').classList.remove('hidden');
    cropper.destroy();
    cropper = null;
});

document.getElementById('cancelCropBtn').addEventListener('click', function() {
    document.getElementById('cropperContainer').classList.add('hidden');
    document.getElementById('photoInput').value = '';
    if (cropper) { cropper.destroy(); cropper = null; }
});

document.getElementById('changePhotoBtn').addEventListener('click', function() {
    document.getElementById('photoInput').value = '';
    document.getElementById('previewContainer').classList.add('hidden');
    document.getElementById('croppedPhoto').value = '';
    document.getElementById('photoInput').click();
});
</script>
@endpush

@endsection