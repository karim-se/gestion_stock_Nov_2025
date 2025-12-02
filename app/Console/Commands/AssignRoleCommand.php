<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class AssignRoleCommand extends Command
{
    protected $signature = 'user:assign-role {email} {role}';
    
    protected $description = 'Assigner un rôle à un utilisateur';

    public function handle()
    {
        $email = $this->argument('email');
        $role = $this->argument('role');

        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("❌ Utilisateur avec l'email {$email} introuvable !");
            return 1;
        }

        // Vérifier si le rôle existe
        $validRoles = ['admin', 'manager', 'employee'];
        if (!in_array($role, $validRoles)) {
            $this->error("❌ Rôle invalide ! Rôles disponibles : " . implode(', ', $validRoles));
            return 1;
        }

        try {
            // Retirer tous les anciens rôles
            $user->syncRoles([]);
            
            // Assigner le nouveau rôle
            $user->assignRole($role);
            
            $this->info("✅ Rôle '{$role}' assigné avec succès à {$user->name} ({$user->email})");
            
            // Afficher les permissions du rôle
            $permissions = $user->getAllPermissions()->pluck('name');
            $this->info("📋 Permissions : " . $permissions->implode(', '));
            
            return 0;
        } catch (\Exception $e) {
            $this->error("❌ Erreur : " . $e->getMessage());
            return 1;
        }
    }
}