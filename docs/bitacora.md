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

5. **Estilos y maquetación del panel administrativo (`backend/servicios/index.php` y `frontend/css/styles.css`):**
   - La vista del catálogo de servicios se renderizaba sin formato visual en la tabla faltaba el cierre de la etiqueta `</tbody>`.
   - **Solución:** Se añadieron al archivo `styles.css` las reglas de diseño para la clase `.table`, encabezados (`th`), filas alternas, acciones de edición y botón de eliminación. Asimismo, se corrigió la inclusión de `db.php` y la estructura del documento en `servicios/index.php`. Asi como se corrigio la identacion del archivo. 

6. **Consistencia de interfaz y UX en creación de servicios (`backend/servicios/create.php`):**
   - El formulario de creación carecía de un contenedor estilizado y los botones de acción no coincidían con la identidad visual del index de servicios.
   - **Solución:** Se implementó el contenedor tipo tarjeta (`card-form`) y se estilizó el enlace de cancelación como botón secundario manteniendo la consistencia de diseño asi como la identacion del archivo.

7. **Homogenización visual e inclusión de dependencias en update (`backend/servicios/update.php`):**
   - El formulario carecía de identidad respecto a index y create y adems no requería `db.php`.
   - **Solución:** Se incluyó `db.php`, se formateó la identación del documento y se aplicaron las clases `.card-form` y `.btn--secondary`.

8. **Inclusión de dependencias y estilizado en módulo de pagos (`backend/pagos/checkout.php`):**
   - Faltaba la importación de `db.php`, la tabla de historial carecía de la clase `.table` y el botón de simulación carecía de estilos del sistema de diseño.
   - **Solución:** Se agregó `require_once __DIR__ . '/../db.php';`, se corrigió la indentación del archivo y se integraron las clases `.table`, `.card-form` y `.btn--primary` para mantener la coherencia con el resto de la plataforma.

9. **Accesibilidad y navegación al módulo de pagos (`backend/servicios/index.php`):**
   - No existía ningún enlace o botón dentro de la interfaz que permitiera navegar hacia el módulo de pagos (`checkout.php`).
   - **Solución:** Se integró el botón de acción "Pagar Servicio" en el navbar de servicios para conectar el flujo de compra y simulación directamente desde el panel principal.