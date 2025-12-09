<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesYPermisosSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Resetear caché de roles y permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. Lista de Permisos
        $permissions = [
            // Concursos
            'ver-concursos',
            'crear-concursos',
            'editar-concursos',
            'eliminar-concursos',
            'registrar-concurso', // Inscribirse como participante
            'cerrar-concurso',    // Finalizar el evento
            
            // Jueces y Calificación
            'ver-jueces',
            'crear-jueces',
            'editar-jueces',
            'eliminar-jueces',
            'asignar-jueces',
            'calificar-equipos', // <--- NUEVO: Para guardar puntuaciones (gradeTeam)
            
            // Equipos (NUEVOS - Para la lógica de TeamController)
            'ver-equipos',
            'crear-equipos',
            'buscar-equipos',
            'unirse-equipos',
            'salir-equipos',

            // Clasificación
            'ver-clasificacion',
            'editar-clasificacion', // Solo Admin/Juez
            
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
            
            // Usuarios
            'ver-usuarios',
            'crear-usuarios',
            'editar-usuarios',
            'eliminar-usuarios',
            'gestionar-roles',
            
            // Permisos de Sistema (Solo Super Admin)
            'configurar-sistema',
            'ver-logs-auditoria',
            'gestionar-admins',
            
            // Perfil
            'ver-perfil',
            'editar-perfil',
        ];

        // 3. Crear permisos (usando firstOrCreate para evitar duplicados)
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 4. Crear Roles y Asignar Permisos

        // --- ROL: SUPER ADMIN ---
        // Control total del sistema
        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin']);
        $superAdminRole->syncPermissions(Permission::all()); // TODOS los permisos

        // --- ROL: ADMIN ---
        // Gestión operativa completa
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions([
            // Concursos
            'ver-concursos',
            'crear-concursos',
            'editar-concursos',
            'eliminar-concursos',
            'cerrar-concurso',
            'calificar-equipos',
            
            // Jueces
            'ver-jueces',
            'crear-jueces',
            'editar-jueces',
            'eliminar-jueces',
            'asignar-jueces',
            
            // Equipos
            'ver-equipos',
            'crear-equipos',
            'buscar-equipos',
            'unirse-equipos',
            'salir-equipos',
            
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
            
            // Usuarios (solo ver, sin modificar - eso es de super_admin)
            'ver-usuarios',
            
            // Perfil
            'ver-perfil',
            'editar-perfil',
        ]);

        // --- ROL: JUEZ ---
        // Puede ver todo, calificar equipos y editar clasificación
        $juezRole = Role::firstOrCreate(['name' => 'juez']);
        $juezRole->syncPermissions([
            'ver-concursos',
            'calificar-equipos', // Vital para tu sistema de notas
            'ver-jueces',
            'ver-clasificacion',
            'editar-clasificacion',
            'ver-blog',
            'crear-blog', // A veces los jueces escriben artículos
            'ver-sedes',
            'ver-perfil',
            'editar-perfil',
            'ver-equipos', // Para ver la lista de equipos a calificar
        ]);

        // --- ROL: USUARIO ---
        // Participante estándar
        $userRole = Role::firstOrCreate(['name' => 'user']);
        $userRole->syncPermissions([
            'ver-concursos',
            'registrar-concurso', // Inscribirse
            'ver-clasificacion',  // Ver ranking (pero NO editar)
            'ver-blog',
            'ver-sedes',
            'ver-perfil',
            'editar-perfil',
            // Gestión de su propio equipo
            'ver-equipos',
            'crear-equipos',
            'buscar-equipos',
            'unirse-equipos',
            'salir-equipos',
        ]);
    }
}