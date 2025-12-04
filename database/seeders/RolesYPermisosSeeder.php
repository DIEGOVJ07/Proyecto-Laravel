<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesYPermisosSeeder extends Seeder
{
    public function run(): void
    {
        // Resetear caché de roles y permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear permisos
        $permissions = [
            // Permisos de Concursos
            'ver-concursos',
            'crear-concursos',
            'editar-concursos',
            'eliminar-concursos',
            'registrar-concurso',
            
            // Permisos de Jueces
            'ver-jueces',
            'crear-jueces',
            'editar-jueces',
            'eliminar-jueces',
            'asignar-jueces',
            
            // Permisos de Clasificación
            'ver-clasificacion',
            'editar-clasificacion',
            
            // Permisos de Blog
            'ver-blog',
            'crear-blog',
            'editar-blog',
            'eliminar-blog',
            
            // Permisos de Sedes
            'ver-sedes',
            'crear-sedes',
            'editar-sedes',
            'eliminar-sedes',
            
            // Permisos de Usuarios
            'ver-usuarios',
            'editar-usuarios',
            'eliminar-usuarios',
            
            // Permisos de Perfil
            'ver-perfil',
            'editar-perfil',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Crear roles y asignar permisos

        // ROL: Admin - Tiene todos los permisos
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        // ROL: Juez - Permisos limitados
        $juezRole = Role::create(['name' => 'juez']);
        $juezRole->givePermissionTo([
            'ver-concursos',
            'ver-jueces',
            'ver-clasificacion',
            'editar-clasificacion',
            'ver-blog',
            'ver-sedes',
            'ver-perfil',
            'editar-perfil',
        ]);

        // ROL: Usuario - Permisos básicos
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo([
            'ver-concursos',
            'registrar-concurso',
            'ver-clasificacion',
            'ver-blog',
            'ver-sedes',
            'ver-perfil',
            'editar-perfil',
        ]);
    }
}
