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

        // 2. Datos principales
        $this->call([
            // TablaPosicionesSeeder::class,  <--- COMENTADO O BORRADO (Causaba el error)
            ConcursoSeeder::class,            // Este crea Concursos + Leaderboard correctamente
            JuezSeeder::class,
        ]);

        // 3. Usuarios de prueba
        $this->crearUsuariosManuales();
    }

    private function crearUsuariosManuales()
    {
        // Admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@codebattle.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);
        $admin->assignRole('admin');

        // Juez
        $juez = User::create([
            'name' => 'Juez Demo',
            'email' => 'juez@codebattle.com',
            'password' => Hash::make('juez123'),
            'role' => 'juez',
        ]);
        $juez->assignRole('juez');

        // Usuario
        $user = User::create([
            'name' => 'Usuario Demo',
            'email' => 'user@codebattle.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
        ]);
        $user->assignRole('user');
    }
}