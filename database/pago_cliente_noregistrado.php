<?php
require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $cedula = trim($_POST['cedula']);
    $ubicacion = trim($_POST['ubicacion']);
    $numero_tarjeta = $_POST['numero_tarjeta'];
    $fecha_expiracion = $_POST['fecha_expiracion'];
    $cvv = $_POST['cvv'];

    // Insertar datos del cliente no registrado
    $sql_cliente = "INSERT INTO ClienteNoRegistrado (nombre, cedula, ubicacion) VALUES (?, ?, ?)";
    $stmt_cliente = $conn->prepare($sql_cliente);
    $stmt_cliente->bind_param("sss", $nombre, $cedula, $ubicacion);

    if ($stmt_cliente->execute()) {
        $id_cliente_no_registrado = $stmt_cliente->insert_id;

        // Insertar datos bancarios
        $sql_bancario = "INSERT INTO DatosBancariosNoRegistrado (id_cliente_no_registrado, numero_tarjeta, fecha_expiracion, cvv) VALUES (?, ?, ?, ?)";
        $stmt_bancario = $conn->prepare($sql_bancario);
        $stmt_bancario->bind_param("isss", $id_cliente_no_registrado, $numero_tarjeta, $fecha_expiracion, $cvv);

        if ($stmt_bancario->execute()) {
            echo "Datos guardados correctamente.";
        } else {
            echo "Error al guardar los datos bancarios: " . $stmt_bancario->error;
        }

        $stmt_bancario->close();
    } else {
        echo "Error al guardar los datos del cliente: " . $stmt_cliente->error;
    }

    $stmt_cliente->close();
    $conn->close();
}
?>


