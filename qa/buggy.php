<?php
// qa/buggy.php
require_once __DIR__ . '/../backend/helpers.php';
require_once __DIR__ . '/../backend/db.php';

startSession();

$pdo = getDB();
$busqueda = trim($_GET['q'] ?? '');

// Consulta segura con prepared statement
$stmt = $pdo->prepare("SELECT id, nombre, email FROM usuarios WHERE nombre LIKE :q");
$stmt->execute([':q' => '%' . $busqueda . '%']);
$usuarios = $stmt->fetchAll();

// Sanitización de salida contra XSS
foreach ($usuarios as $u) {
    echo "<p>Usuario: " . e($u['nombre']) . " - " . e($u['email']) . "</p>";
}

// Validación y registro de tickets
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Email inválido";
    } else {
        $ins = $pdo->prepare('INSERT INTO tickets (usuario_id, asunto, mensaje) VALUES (1, :a, :m)');
        $ins->execute([
            ':a' => trim($_POST['asunto'] ?? ''),
            ':m' => trim($_POST['mensaje'] ?? '')
        ]);
        echo "Ticket creado";
    }
}

// Control de acceso por mayoría de edad
$edad = (int)($_GET['edad'] ?? 0);
if ($edad >= 18) {
    echo "Acceso permitido";
} else {
    echo "Acceso denegado";
}

// Saludo a usuario
$username = trim($_GET['user'] ?? 'invitado');
echo "Hola, " . e($username);