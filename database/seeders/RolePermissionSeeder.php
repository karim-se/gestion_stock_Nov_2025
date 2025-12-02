<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Créer les permissions
        Permission::firstOrCreate(['name' => 'create_article']);
        Permission::firstOrCreate(['name' => 'view_staging_articles']);
        Permission::firstOrCreate(['name' => 'validate_article']);
        Permission::firstOrCreate(['name' => 'reject_article']);
        Permission::firstOrCreate(['name' => 'manage_roles']);

        // Créer le rôle d'employé
        $employeeRole = Role::firstOrCreate(['name' => 'employee']);
        $employeeRole->syncPermissions(['create_article', 'view_staging_articles']);

        // Créer le rôle de responsable/validateur
        $managerRole = Role::firstOrCreate(['name' => 'manager']);
        $managerRole->syncPermissions([
            'create_article',
            'view_staging_articles',
            'validate_article',
            'reject_article',
        ]);

        // Créer le rôle d'administrateur
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions([
            'create_article',
            'view_staging_articles',
            'validate_article',
            'reject_article',
            'manage_roles',
        ]);
    }
}