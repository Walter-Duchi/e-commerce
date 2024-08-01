<?php
session_start();
require_once('database/connection.php');

// Obtener los mensajes respondidos
$query = $conn->prepare('
    SELECT mpp.id, cr.nombre AS nombre_usuario, mpp.mensaje, mpp.respuesta, mpp.fecha_respuesta AS fecha 
    FROM mensajes_por_producto mpp
    JOIN ClienteRegistrado cr ON mpp.id_cliente = cr.id 
    WHERE mpp.estado = "respondido"
    ORDER BY mpp.fecha_respuesta DESC
');
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
                    <th>Respuesta</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nombre_usuario']); ?></td>
                        <td><?php echo htmlspecialchars($row['mensaje']); ?></td>
                        <td><?php echo htmlspecialchars($row['respuesta']); ?></td>
                        <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

