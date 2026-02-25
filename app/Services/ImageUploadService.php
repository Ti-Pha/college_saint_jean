<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class ImageUploadService
{
    // Types MIME autorisés
    private array $allowedMimes = [
        'image/jpeg',
        'image/png',
        'image/webp',
    ];

    // Taille maximale en bytes (3 Mo)
    private int $maxSize = 3145728;

    public function upload(UploadedFile $file, string $folder, int $maxWidth = 1200): string
    {
        // Vérification MIME réelle (pas juste l'extension)
        $this->validateFile($file);

        // Génération d'un nom sécurisé
        $filename = $this->generateSecureFilename($file);

        // Optimisation et redimensionnement
        $image = Image::read($file->getRealPath());

        // Redimensionner si trop large
        if ($image->width() > $maxWidth) {
            $image->scaleDown(width: $maxWidth);
        }

        // Sauvegarde dans storage/app/public
        $path = $folder . '/' . $filename;
        Storage::disk('public')->put($path, $image->toJpeg(85));

        return $path;
    }

    public function uploadMultiple(array $files, string $folder): array
    {
        $paths = [];
        foreach ($files as $file) {
            $paths[] = $this->upload($file, $folder);
        }
        return $paths;
    }

    public function delete(string $path): void
    {
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    private function validateFile(UploadedFile $file): void
    {
        // Vérification taille
        if ($file->getSize() > $this->maxSize) {
            abort(422, 'L\'image dépasse la taille maximale autorisée.');
        }

        // Vérification MIME réelle
        $realMime = mime_content_type($file->getRealPath());
        if (!in_array($realMime, $this->allowedMimes)) {
            abort(422, 'Type de fichier non autorisé.');
        }

        // Vérification que c'est vraiment une image
        $imageInfo = @getimagesize($file->getRealPath());
        if ($imageInfo === false) {
            abort(422, 'Le fichier n\'est pas une image valide.');
        }
    }

    private function generateSecureFilename(UploadedFile $file): string
    {
        // Nom aléatoire + timestamp pour éviter les collisions
        return Str::random(32) . '_' . time() . '.jpg';
    }
}