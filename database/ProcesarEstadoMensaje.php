<?php
require_once 'connection.php';

// Seleccionar mensajes que necesitan actualización
$sql = "SELECT * FROM mensajes_por_producto WHERE estado = 'no_respondido'";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $id_mensaje = $row['id'];

    // Actualizar el estado del mensaje si ha sido respondido
    if ($row['respuesta'] !== NULL) {
        $updateSql = "UPDATE mensajes_por_producto SET estado = 'respondido' WHERE id = $id_mensaje";
        mysqli_query($conn, $updateSql);
    }
}
?>
