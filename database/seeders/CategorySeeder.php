<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Actualités',       'description' => 'Les dernières nouvelles du collège'],
            ['name' => 'Événements',        'description' => 'Événements et activités scolaires'],
            ['name' => 'Résultats',         'description' => 'Résultats académiques et performances'],
            ['name' => 'Annonces',          'description' => 'Annonces officielles de la direction'],
            ['name' => 'Vie Scolaire',      'description' => 'La vie quotidienne au collège'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category['name']], $category);
        }
    }
}