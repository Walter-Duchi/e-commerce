<?php
session_start();
require_once('database/connection.php');

// Asegúrate de que el usuario está logueado y es un encargado
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 'encargado') {
    header('Location: ../index.php');
    exit();
}

// Obtener los mensajes respondidos
$query = $conn->prepare('SELECT * FROM MensajesForo WHERE estado = TRUE');
$query->execute();
$result = $query->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clientes Respondidos</title>
    <link rel="stylesheet" href="../css/styles.css"> <!-- Asegúrate de tener un archivo CSS -->
</head>
<body>
    <div class="container">
        <h2>Clientes Respondidos</h2>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Mensaje</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nombre_usuario']); ?></td>
                        <td><?php echo htmlspecialchars($row['mensaje']); ?></td>
                        <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
