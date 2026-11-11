<?php
declare(strict_types=1);

// Credenciales de base de datos (Plantilla)
define('DB_HOST', 'localhost');
define('DB_NAME', 'albardi_portal');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// Configuración general
define('APP_URL', 'http://localhost/prueba_becario');
define('APP_NAME', 'Albardi Portal');

// Entorno local
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Sesión segura
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', '1');
    ini_set('session.use_only_cookies', '1');
    session_start();
}