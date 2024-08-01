<?php
session_start();
require_once('database/connection.php');



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
                            <form action="../database/EnviarMensajeEncargadoInventario.php" method="post">
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
?>
