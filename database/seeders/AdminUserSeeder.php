<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@csj.ht'],
            [
                'name'     => 'Administrateur CSJ',
                'password' => Hash::make('Admin@CSJ2026!'),
            ]
        );
        $admin->assignRole('admin');

        $directeur = User::firstOrCreate(
            ['email' => 'directeur@csj.ht'],
            [
                'name'     => 'Directeur CSJ',
                'password' => Hash::make('Directeur@CSJ2026!'),
            ]
        );
        $directeur->assignRole('directeur');

        $secretaire = User::firstOrCreate(
            ['email' => 'secretaire@csj.ht'],
            [
                'name'     => 'Secrétaire CSJ',
                'password' => Hash::make('Secretaire@CSJ2026!'),
            ]
        );
        $secretaire->assignRole('secretaire');
    }
}