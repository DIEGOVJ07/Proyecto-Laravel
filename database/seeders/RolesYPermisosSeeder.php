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
            'crear-usuarios',
            'editar-usuarios',
            'eliminar-usuarios',
            'gestionar-roles',
            
            // Permisos de Sistema (Solo Super Admin)
            'configurar-sistema',
            'ver-logs-auditoria',
            'gestionar-admins',
            
            // Permisos de Perfil
            'ver-perfil',
            'editar-perfil',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Crear roles y asignar permisos

        // ROL: Super Admin - Control total del sistema
        $superAdminRole = Role::create(['name' => 'super_admin']);
        $superAdminRole->givePermissionTo(Permission::all()); // TODOS los permisos

        // ROL: Admin - Gestión operativa sin permisos críticos
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo([
            // Concursos
            'ver-concursos',
            'crear-concursos',
            'editar-concursos',
            'eliminar-concursos',
            
            // Jueces
            'ver-jueces',
            'crear-jueces',
            'editar-jueces',
            'eliminar-jueces',
            'asignar-jueces',
            
            // Clasificación
            'ver-clasificacion',
            'editar-clasificacion',
            
            // Blog
            'ver-blog',
            'crear-blog',
            'editar-blog',
            'eliminar-blog',
            
            // Sedes
            'ver-sedes',
            'crear-sedes',
            'editar-sedes',
            'eliminar-sedes',
            
            // Usuarios (solo ver, sin modificar)
            'ver-usuarios',
            
            // Perfil
            'ver-perfil',
            'editar-perfil',
        ]);

        // ROL: Juez - Permisos de evaluación
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
