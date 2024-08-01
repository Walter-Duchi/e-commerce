<?php
session_start();
require_once('database/connection.php');

// Verificar si el formulario de respuesta ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_mensaje']) && isset($_POST['respuesta'])) {
    $id_mensaje = $_POST['id_mensaje'];
    $respuesta = $_POST['respuesta'];
    $id_encargado = $_SESSION['id_encargado']; // Asegúrate de que el id del encargado esté en la sesión

    // Actualizar el mensaje con la respuesta
    $stmt = $conn->prepare('
        UPDATE mensajes_por_producto
        SET respuesta = ?, estado = "respondido", id_encargado = ?, fecha_respuesta = NOW()
        WHERE id = ?
    ');
    $stmt->bind_param('sii', $respuesta, $id_encargado, $id_mensaje);
    $stmt->execute();
    
    // Recargar la página para ver los cambios
    header('Location: ' . 'index.php?page=clientes_por_responder');
    exit();
}

// Obtener los mensajes no respondidos
$query = $conn->prepare('
    SELECT mpp.id, cr.nombre AS nombre_usuario, mpp.mensaje, mpp.fecha_mensaje AS fecha 
    FROM mensajes_por_producto mpp
    JOIN ClienteRegistrado cr ON mpp.id_cliente = cr.id 
    WHERE mpp.estado = "no_respondido"
    ORDER BY mpp.fecha_mensaje DESC
');
$query->execute();
$result = $query->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes por Responder</title>
    <link rel="stylesheet" href="path_to_your_css_file.css">
</head>
<body>
<div class="container">
    <main>
        <h2>Clientes por Responder</h2>
        <table>
            <thead>
                <tr>
                    <th>Nombre Usuario</th>
                    <th>Fecha</th>
                    <th>Mensaje</th>
                    <th>Responder</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nombre_usuario']); ?></td>
                        <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                        <td><?php echo htmlspecialchars($row['mensaje']); ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="id_mensaje" value="<?php echo htmlspecialchars($row['id']); ?>">
                                <textarea name="respuesta" required></textarea>
                                <button type="submit">Responder</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>
</div>
</body>
</html>
