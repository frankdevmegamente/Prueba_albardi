# Bitácora de cambios

### Hallazgos y correcciones aplicadas:
1. **Configuración del entorno (`backend/config.example.php`):**
   - No existía plantilla base para credenciales. 
   - **Solución:** Se creó `backend/config.example.php` asegurando que `backend/config.php` quede ignorado en `.gitignore` para prevenir fuga de credenciales.

2.   El archivo `.htaccess` incluía `php_value default_charset "UTF-8"` generando una falla de sintaxis en el servidor dando error 500.
  - **Solución:** Se removió la línea `php_value` manteniendo únicamente `AddDefaultCharset UTF-8`. 

3. **Dependencia de base de datos (`backend/auth/login.php`):**
   - El archivo invocaba `getDB()` pero no requería `db.php`. 
   - **Solución:** Se agregó `require_once __DIR__ . '/../db.php';` para corregit error 500.

4. **Navegación frontend (`frontend/index.html`):**
   - El botón "Acceso" apuntaba a `login.html` inexistente dando "pagina no encontrada". 
   - **Solución:** Se corrigió la ruta hacia `/Prueba_albardi/backend/auth/login.php`.


