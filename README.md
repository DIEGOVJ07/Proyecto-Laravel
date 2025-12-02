# 🏆 CodeBattle - Plataforma de Competencias de Programación

Plataforma web para gestión de concursos de programación competitiva, clasificaciones en tiempo real y perfiles de usuarios.

## 🚀 Características

- 🎯 Sistema de concursos con filtros por estado y dificultad
- 📊 Clasificación global de competidores
- 👤 Perfiles de usuario con estadísticas
- 🎨 Diseño moderno con Tailwind CSS
- 🔐 Autenticación con Laravel Breeze

## 📋 Requisitos Previos

- PHP >= 8.2
- Composer
- MySQL
- Node.js & NPM

## 🛠️ Instalación

### 1. Clonar el repositorio

```bash
git clone <url-del-repositorio>
cd pw
```

### 2. Instalar dependencias de PHP

```bash
composer install
```

### 3. Instalar dependencias de JavaScript

```bash
npm install
```

### 4. Configurar el archivo de entorno

```bash
cp .env.example .env
```

Edita el archivo `.env` y configura tu base de datos:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=codebattle
DB_USERNAME=root
DB_PASSWORD=tu_contraseña
```

### 5. Generar la clave de aplicación

```bash
php artisan key:generate
```

### 6. Crear la base de datos

Crea una base de datos MySQL llamada `codebattle`:

```sql
CREATE DATABASE codebattle;
```

### 7. Ejecutar migraciones y seeders

```bash
php artisan migrate --seed
```

Esto creará todas las tablas necesarias y poblará la base de datos con:
- 6 concursos de ejemplo
- 6 competidores en el ranking
- Usuario de prueba (test@example.com / password)

### 8. Compilar assets

```bash
npm run dev
```

Para producción:

```bash
npm run build
```

### 9. Iniciar el servidor de desarrollo

```bash
php artisan serve
```

La aplicación estará disponible en `http://localhost:8000`

## 👥 Usuarios de Prueba

- **Email:** test@example.com
- **Contraseña:** password

## 📁 Estructura del Proyecto

```
resources/views/
├── inicio/          # Página principal
├── concursos/       # Lista de concursos
├── clasificacion/   # Ranking global
├── blog/            # Blog de noticias
├── sedes/           # Información de sedes
├── profile/         # Perfil de usuario
├── components/      # Componentes reutilizables
├── layouts/         # Layouts principales
└── partials/        # Navbar y footer
```

## 🗄️ Seeders Disponibles

- `ContestSeeder`: Crea 6 concursos de ejemplo
- `LeaderSeeder`: Crea 6 competidores en el ranking

Para ejecutar seeders individuales:

```bash
php artisan db:seed --class=ContestSeeder
php artisan db:seed --class=LeaderSeeder
```

## 🔄 Comandos Útiles

```bash
# Limpiar cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Recargar base de datos
php artisan migrate:fresh --seed

# Ejecutar tests
php artisan test
```

## 🎨 Tecnologías

- **Backend:** Laravel 11
- **Frontend:** Blade, Tailwind CSS, Alpine.js
- **Base de datos:** MySQL
- **Autenticación:** Laravel Breeze
- **Iconos:** Font Awesome 6.5.2

## 📝 Licencia

Este proyecto es de código abierto bajo la licencia MIT.
