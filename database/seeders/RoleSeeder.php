<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Reset du cache des permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Création des permissions
        $permissions = [
            // Articles
            'create articles',
            'edit articles',
            'delete articles',
            'publish articles',

            // Commentaires
            'moderate comments',
            'delete comments',

            // Galerie
            'manage gallery',

            // Équipe
            'manage team',

            // Utilisateurs
            'manage users',

            // Messages contact
            'view messages',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Création des rôles avec leurs permissions
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        $directeur = Role::firstOrCreate(['name' => 'directeur']);
        $directeur->givePermissionTo([
            'create articles',
            'edit articles',
            'delete articles',
            'publish articles',
            'moderate comments',
            'delete comments',
            'manage gallery',
            'manage team',
            'view messages',
        ]);

        $secretaire = Role::firstOrCreate(['name' => 'secretaire']);
        $secretaire->givePermissionTo([
            'create articles',
            'edit articles',
            'moderate comments',
            'manage gallery',
            'view messages',
        ]);
    }
}