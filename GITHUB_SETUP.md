# 📦 Guía para Subir el Proyecto a GitHub

## 1️⃣ Crear Repositorio en GitHub

1. Ve a [GitHub](https://github.com) e inicia sesión
2. Haz clic en el botón **"New"** (Nuevo repositorio)
3. Nombra tu repositorio (ejemplo: `codebattle` o `pw`)
4. **NO** marques "Initialize with README" (ya tienes uno)
5. Haz clic en **"Create repository"**

## 2️⃣ Configurar Git Local

Abre una terminal en la carpeta del proyecto (`c:\laragon\www\pw`) y ejecuta:

```bash
# Inicializar Git (si no está inicializado)
git init

# Configurar tu nombre y email (si es primera vez)
git config --global user.name "Tu Nombre"
git config --global user.email "tu-email@example.com"

# Agregar todos los archivos
git add .

# Hacer el primer commit
git commit -m "Initial commit - CodeBattle platform"
```

## 3️⃣ Conectar con GitHub

Copia la URL de tu repositorio de GitHub (aparece después de crearlo) y ejecuta:

```bash
# Conectar con tu repositorio remoto
git remote add origin https://github.com/tu-usuario/nombre-repositorio.git

# Verificar que se agregó correctamente
git remote -v

# Subir el código
git branch -M main
git push -u origin main
```

## 4️⃣ Para Tus Compañeros

Cuando tus compañeros clonen el repositorio, deben seguir estos pasos:

### Clonar el proyecto
```bash
git clone https://github.com/tu-usuario/nombre-repositorio.git
cd nombre-repositorio
```

### Instalar dependencias
```bash
composer install
npm install
```

### Configurar entorno
```bash
cp .env.example .env
php artisan key:generate
```

### Configurar base de datos
Editar el archivo `.env` con sus datos:
```env
DB_DATABASE=codebattle
DB_USERNAME=root
DB_PASSWORD=su_contraseña
```

### Crear base de datos y poblar con datos
```bash
# En MySQL Workbench o línea de comandos:
CREATE DATABASE codebattle;

# Luego ejecutar:
php artisan migrate --seed
```

### Compilar assets y ejecutar
```bash
npm run dev

# En otra terminal:
php artisan serve
```

## 5️⃣ Comandos Útiles para Colaboración

```bash
# Obtener cambios del repositorio
git pull origin main

# Ver estado de archivos modificados
git status

# Crear una nueva rama para trabajar
git checkout -b nombre-de-tu-feature

# Agregar cambios
git add .

# Hacer commit de tus cambios
git commit -m "Descripción de cambios"

# Subir tu rama
git push origin nombre-de-tu-feature
```

## 🔐 Seguridad

✅ El archivo `.env` está en `.gitignore` (NO se sube a GitHub)
✅ Las carpetas `vendor/` y `node_modules/` NO se suben
✅ Los archivos de log NO se suben

## 📊 Datos Compartidos

Todos tus compañeros tendrán los mismos datos porque:

- ✅ Las **migraciones** crean la estructura de tablas
- ✅ Los **seeders** insertan los mismos datos de ejemplo
- ✅ El comando `php artisan migrate --seed` hace todo automáticamente

### Datos incluidos:
- 6 concursos de ejemplo (Weekly Challenge, Data Structures, etc.)
- 6 competidores en el ranking
- Usuario de prueba: test@example.com / password

## 🆘 Problemas Comunes

### Error: "Please tell me who you are"
```bash
git config --global user.name "Tu Nombre"
git config --global user.email "tu@email.com"
```

### Error: "remote origin already exists"
```bash
git remote remove origin
git remote add origin https://github.com/tu-usuario/repositorio.git
```

### Error en migraciones
```bash
php artisan migrate:fresh --seed
```

### Los cambios no se reflejan
```bash
npm run build
php artisan view:clear
php artisan cache:clear
```
