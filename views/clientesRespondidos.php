<?php
require_once('database/connection.php');

$query = $conn->prepare('
    SELECT mf.id, mf.nombre_usuario, mf.mensaje, mf.fecha, r.respuesta, r.fecha_respuesta 
    FROM MensajesForo mf 
    JOIN (
        SELECT id_respuesta_a AS id, mensaje AS respuesta, fecha AS fecha_respuesta 
        FROM MensajesForo 
        WHERE id_encargado IS NOT NULL
    ) r ON mf.id = r.id
    WHERE mf.estado = TRUE
    ORDER BY r.fecha_respuesta DESC
');
$query->execute();
$result = $query->get_result();
?>
<div class="container">
    <h2>Clientes Respondidos</h2>
    <table>
        <thead>
            <tr>
                <th>Nombre Usuario</th>
                <th>Fecha</th>
                <th>Mensaje</th>
                <th>Respuesta</th>
                <th>Fecha Respuesta</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['nombre_usuario']; ?></td>
                    <td><?php echo $row['fecha']; ?></td>
                    <td><?php echo $row['mensaje']; ?></td>
                    <td><?php echo $row['respuesta']; ?></td>
                    <td><?php echo $row['fecha_respuesta']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
