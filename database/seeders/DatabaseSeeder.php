<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Primero crear roles y permisos
        $this->call([
            RolesYPermisosSeeder::class,
        ]);

        // Luego crear usuarios con datos
        $this->call([
            TablaPosicionesSeeder::class,
            ConcursoSeeder::class,
            JuezSeeder::class,
        ]);

        // Usuario administrador de prueba
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@codebattle.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);
        $admin->assignRole('admin');

        // Usuario juez de prueba
        $juez = User::create([
            'name' => 'Juez Demo',
            'email' => 'juez@codebattle.com',
            'password' => Hash::make('juez123'),
            'role' => 'juez',
        ]);
        $juez->assignRole('juez');

        // Usuario participante de prueba
        $user = User::create([
            'name' => 'Usuario Demo',
            'email' => 'user@codebattle.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
        ]);
        $user->assignRole('user');
    }
}
