# 🔐 Sistema de Roles - CodeBattle

## 📋 Jerarquía de Roles Implementada

### 🔴 Super Admin (super_admin)
**Control Total del Sistema**

**Credenciales:**
- Email: `superadmin@codebattle.com`
- Password: `superadmin123`

**Permisos Exclusivos:**
- ✅ Gestionar todos los usuarios (crear, editar, eliminar)
- ✅ Asignar y remover roles (incluidos otros admins)
- ✅ Ver y modificar super admins
- ✅ Configuración crítica del sistema
- ✅ Logs de auditoría completos
- ✅ Acceso a panel de gestión de usuarios

**Panel de Navegación:**
- 🟣 Usuarios (exclusivo)
- Panel Admin
- Jueces
- Clasificación
- Mi Perfil, Blog, Sedes

**Icono:** 🛡️ Escudo morado (fas fa-shield-halved)

---

### 🟠 Admin (admin)
**Gestión Operativa**

**Credenciales:**
- Email: `admin@codebattle.com`
- Password: `admin123`

**Permisos:**
- ✅ Gestionar concursos (crear, editar, cerrar, eliminar)
- ✅ Gestionar equipos y participantes
- ✅ Gestionar jueces (crear, editar, eliminar)
- ✅ Calificar equipos
- ✅ Ver estadísticas y reportes
- ✅ Ver clasificación
- ✅ Ver usuarios (solo lectura)

**Restricciones:**
- ❌ NO puede crear/editar otros admins
- ❌ NO puede gestionar super admins
- ❌ NO puede cambiar configuración del sistema
- ❌ NO puede ver logs de auditoría completos

**Panel de Navegación:**
- Panel Admin
- Jueces
- Clasificación
- Mi Perfil, Blog, Sedes

**Icono:** 👑 Corona amarilla (fas fa-crown)

---

### 🟡 Juez (juez)
**Evaluación y Calificación**

**Credenciales:**
- Email: `juez@codebattle.com`
- Password: `juez123`

**Permisos:**
- ✅ Ver concursos asignados
- ✅ Calificar equipos
- ✅ Comentar evaluaciones
- ✅ Ver clasificación

**Restricciones:**
- ❌ NO gestiona concursos
- ❌ NO gestiona usuarios

**Panel de Navegación:**
- Clasificación
- Mi Perfil, Blog, Sedes

**Icono:** ⚖️ Martillo azul (fas fa-gavel)

---

### 🟢 Usuario (user)
**Participante Estándar**

**Credenciales:**
- Email: `user@codebattle.com`
- Password: `user123`

**Permisos:**
- ✅ Ver concursos públicos
- ✅ Inscribirse en concursos
- ✅ Ver su perfil y estadísticas
- ✅ Editar su propia información
- ✅ Ver clasificación

**Panel de Navegación:**
- Inicio
- Concursos
- Mi Perfil, Blog, Sedes

**Icono:** Sin icono especial

---

## 🛠️ Implementación Técnica

### Archivos Modificados:

1. **database/seeders/RolesYPermisosSeeder.php**
   - Agregado rol `super_admin` con todos los permisos
   - Nuevos permisos: `crear-usuarios`, `gestionar-roles`, `configurar-sistema`, `ver-logs-auditoria`, `gestionar-admins`
   - Admin ahora tiene permisos limitados (sin gestión de usuarios/roles/sistema)

2. **database/seeders/DatabaseSeeder.php**
   - Usuario Super Admin creado: `superadmin@codebattle.com`

3. **app/Http/Middleware/SuperAdminMiddleware.php** (NUEVO)
   - Middleware exclusivo para super_admin
   - Bloquea acceso si no es super_admin

4. **app/Http/Middleware/AdminMiddleware.php** (ACTUALIZADO)
   - Ahora permite acceso a `admin` Y `super_admin`

5. **bootstrap/app.php**
   - Registrado alias `super_admin` para el middleware

6. **resources/views/layouts/navigation.blade.php**
   - Enlace "Usuarios" visible solo para super_admin
   - Iconos diferenciados por rol:
     - Super Admin: 🛡️ Escudo morado
     - Admin: 👑 Corona amarilla
     - Juez: ⚖️ Martillo azul

---

## 🚀 Sistema Listo para Usar

### ✅ Todo Implementado:

1. **Login como Super Admin:**
   ```
   Email: superadmin@codebattle.com
   Password: superadmin123
   ```

2. **Panel de Gestión de Usuarios:**
   - Accede desde el menú "Usuarios" (solo visible para super_admin)
   - Ruta: `/admin/users`

3. **Funcionalidades Disponibles:**
   - ✅ Ver lista completa de usuarios con filtros
   - ✅ Buscar por nombre o email
   - ✅ Filtrar por rol
   - ✅ Crear nuevos usuarios
   - ✅ Editar usuarios existentes
   - ✅ Cambiar roles de usuarios
   - ✅ Eliminar usuarios (excepto super_admins)
   - ✅ Ver detalles y estadísticas de usuarios
   - ✅ Protección automática de super_admins

4. **Archivos Creados:**
   - `app/Http/Controllers/Admin/UserController.php` - CRUD completo
   - `app/Http/Middleware/SuperAdminMiddleware.php` - Middleware exclusivo
   - `resources/views/admin/users/index.blade.php` - Lista de usuarios
   - `resources/views/admin/users/create.blade.php` - Crear usuario
   - `resources/views/admin/users/edit.blade.php` - Editar usuario
   - `resources/views/admin/users/show.blade.php` - Detalles de usuario

---

## 📊 Comparación de Permisos

| Funcionalidad | Super Admin | Admin | Juez | User |
|---|:---:|:---:|:---:|:---:|
| Gestionar usuarios | ✅ | ❌ | ❌ | ❌ |
| Asignar roles | ✅ | ❌ | ❌ | ❌ |
| Gestionar admins | ✅ | ❌ | ❌ | ❌ |
| Gestionar concursos | ✅ | ✅ | ❌ | ❌ |
| Gestionar jueces | ✅ | ✅ | ❌ | ❌ |
| Calificar equipos | ✅ | ✅ | ✅ | ❌ |
| Config. sistema | ✅ | ❌ | ❌ | ❌ |
| Logs auditoría | ✅ | Parcial | ❌ | ❌ |
| Participar concursos | ✅ | ✅ | ✅ | ✅ |

---

## 🔒 Seguridad

### Protección implementada:
- ✅ Super Admin no puede ser degradado por admins
- ✅ Admin no puede ver/modificar super admins
- ✅ Middlewares específicos por nivel de acceso
- ✅ Permisos granulares con Spatie Permission
- ✅ Validación en rutas y vistas

### Recomendaciones:
- 🔐 Cambiar contraseñas en producción
- 👥 Limitar super admins a 1-2 usuarios de confianza
- 📝 Implementar logs de auditoría
- 🔄 Revisar permisos periódicamente
