<?php
require_once('database/connection.php');

$query = $conn->prepare('
    SELECT mf.id, mf.nombre_usuario, mf.mensaje, mf.fecha 
    FROM MensajesForo mf 
    WHERE mf.estado = FALSE
    ORDER BY mf.fecha DESC
');
$query->execute();
$result = $query->get_result();
?>
<div class="container">
    <<main>
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
                    <td><?php echo $row['nombre_usuario']; ?></td>
                    <td><?php echo $row['fecha']; ?></td>
                    <td><?php echo $row['mensaje']; ?></td>
                    <td>
                        <form action="database/enviarMensaje.php" method="post">
                            <input type="hidden" name="id_mensaje" value="<?php echo $row['id']; ?>">
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
