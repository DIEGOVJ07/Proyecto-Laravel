<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // 1. Roles y Permisos
        $this->call([
            RolesYPermisosSeeder::class,
        ]);

        // 2. Usuarios de prueba (DEBEN CREARSE PRIMERO)
        $this->crearUsuariosManuales();

        // 3. Datos principales (requieren usuarios existentes)
        $this->call([
            ConcursoSeeder::class,            // Este crea Concursos + Leaderboard correctamente
            JuezSeeder::class,
            PostSeeder::class,                // Artículos del blog (requiere administradores)
        ]);
    }

    private function crearUsuariosManuales()
    {
        // Super Admin - Control total del sistema
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@codebattle.com',
            'password' => Hash::make('superadmin123'),
            'role' => 'super_admin',
            'email_verified_at' => now(), // ✅ Email verificado automáticamente
        ]);
        $superAdmin->assignRole('super_admin');

        // Admin - Gestión operativa
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@codebattle.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'email_verified_at' => now(), // ✅ Email verificado automáticamente
        ]);
        $admin->assignRole('admin');

        // Juez - Evaluación
        $juez = User::create([
            'name' => 'Juez Demo',
            'email' => 'juez@codebattle.com',
            'password' => Hash::make('juez123'),
            'role' => 'juez',
            'email_verified_at' => now(), // ✅ Email verificado automáticamente
        ]);
        $juez->assignRole('juez');

        // Usuario - Participante
        $user = User::create([
            'name' => 'Usuario Demo',
            'email' => 'user@codebattle.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
            'email_verified_at' => now(), // ✅ Email verificado automáticamente
        ]);
        $user->assignRole('user');
    }
}