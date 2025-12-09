# Railway.app Deployment Guide

## Variables de Entorno Necesarias en Railway

En tu panel de Railway, debes configurar las siguientes variables de entorno:

```env
# Aplicación
APP_NAME=CodeBattle
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:S1jctGYdPoBntxLodpPFXNxRx7cFhCA/8irsQfYvh6A=
APP_URL=https://tu-app.up.railway.app

# Base de datos (Railway proveerá estos valores si usas su servicio MySQL)
DB_CONNECTION=mysql
DB_HOST=${MYSQLHOST}
DB_PORT=${MYSQLPORT}
DB_DATABASE=${MYSQLDATABASE}
DB_USERNAME=${MYSQLUSER}
DB_PASSWORD=${MYSQLPASSWORD}

# Session
SESSION_DRIVER=database
SESSION_LIFETIME=720

# Cache
CACHE_STORE=database
QUEUE_CONNECTION=database

# Logs
LOG_CHANNEL=stack
LOG_LEVEL=error
```

## Pasos para Desplegar en Railway

1. **Crear cuenta en Railway.app**
   - Ve a https://railway.app
   - Conecta tu cuenta de GitHub

2. **Crear nuevo proyecto**
   - Click en "New Project"
   - Selecciona "Deploy from GitHub repo"
   - Elige tu repositorio

3. **Agregar servicio MySQL**
   - Click en "+ New"
   - Selecciona "Database" -> "Add MySQL"
   - Railway automáticamente creará las variables de entorno

4. **Configurar variables de entorno**
   - Ve a tu servicio web
   - Click en "Variables"
   - Agrega todas las variables listadas arriba
   - **IMPORTANTE**: Usa las variables de Railway para DB (${MYSQLHOST}, etc.)

5. **Verificar archivos creados**
   Los siguientes archivos ya están en tu proyecto:
   - ✅ `Procfile` - Define cómo ejecutar la app
   - ✅ `nixpacks.toml` - Configuración de build para Railway

6. **Hacer commit y push**
   ```bash
   git add .
   git commit -m "Configure Railway deployment"
   git push
   ```

7. **Railway desplegará automáticamente**
   - Espera a que termine el build
   - Verifica los logs en Railway
   - Railway te dará una URL pública

## Solución de Problemas Comunes

### Error 500 o página en blanco
- Verifica que `APP_KEY` esté configurado
- Asegúrate que `APP_DEBUG=false` en producción
- Revisa los logs en Railway

### Error de base de datos
- Verifica que las variables de MySQL estén correctas
- Ejecuta las migraciones desde Railway CLI o agrega en nixpacks.toml

### CSS/JS no carga
- Verifica que `APP_URL` coincida con tu dominio de Railway
- Railway debe servir desde la carpeta `/public`

### Permisos
Railway debería manejar permisos automáticamente, pero si hay problemas:
```bash
chmod -R 775 storage bootstrap/cache
```

## Comandos útiles en Railway

Para ejecutar comandos en Railway:
1. Instala Railway CLI: `npm i -g @railway/cli`
2. Login: `railway login`
3. Link proyecto: `railway link`
4. Ejecutar comandos: 
   ```bash
   railway run php artisan migrate --force
   railway run php artisan config:clear
   railway run php artisan cache:clear
   ```

## Checklist Final

- [ ] Variables de entorno configuradas en Railway
- [ ] Servicio MySQL agregado y conectado
- [ ] `APP_KEY` generado y configurado
- [ ] `APP_DEBUG=false`
- [ ] `APP_URL` con la URL de Railway
- [ ] Archivos `Procfile` y `nixpacks.toml` en el repositorio
- [ ] Código subido a GitHub
- [ ] Deployment exitoso en Railway
