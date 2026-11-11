<?php
// backend/servicios/index.php
require_once __DIR__ . '/../helpers.php';
require_once __DIR__ . '/../db.php';

requireLogin();
$pdo = getDB(); 
$rows = $pdo->query('SELECT * FROM servicios ORDER BY id DESC')->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Servicios — Grupo Albardi</title>
  <link rel="stylesheet" href="../../frontend/css/styles.css">
</head>
<body>
<section class="section">
  <div class="container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
      <h2>Panel de Servicios</h2>
      <div>
        <a class="btn btn--primary" href="create.php">Nuevo Servicio</a>
        <a class="btn btn--primary" href="../pagos/checkout.php">Pagar Servicio</a>
        <a class="btn" style="background:#e3e6ea; color:var(--text); margin-left: 8px;" href="../auth/logout.php">Cerrar Sesión</a>
      </div>
    </div>

    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Precio</th>
          <th>Activo</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($rows as $r): ?>
        <tr>
          <td><?php echo (int)$r['id']; ?></td>
          <td><strong><?php echo e($r['nombre']); ?></strong></td>
          <td>$<?php echo number_format((float)$r['precio'], 2); ?></td>
          <td><?php echo $r['activo'] ? 'Sí' : 'No'; ?></td>
          <td>
            <a href="update.php?id=<?php echo (int)$r['id']; ?>">Editar</a>
            <form method="post" action="delete.php" style="display:inline" onsubmit="return confirm('¿eliminar?')">
              <input type="hidden" name="csrf" value="<?php echo e(csrfToken()); ?>">
              <input type="hidden" name="id" value="<?php echo (int)$r['id']; ?>">
              <button type="submit">Eliminar</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</section>
</body>
</html>