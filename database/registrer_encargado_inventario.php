<?php
session_start();
require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $telefono = trim($_POST['telefono']);
    $correo_personal = trim($_POST['correo_personal']);
    $contrasena = trim($_POST['contrasena']); // Contraseña en texto plano

    // Validación básica
    if (empty($nombre) || empty($apellido) || empty($telefono) || empty($correo_personal) || empty($contrasena)) {
        $error = "Todos los campos son obligatorios.";
        echo "<script>alert('$error'); window.history.back();</script>";
    } else {
        // Verificar si el correo personal ya existe en la tabla de encargados de inventario
        $sql = "SELECT id FROM EncargadoInventarios WHERE correo_personal = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $correo_personal);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "El correo personal ya está en uso.";
            echo "<script>alert('$error'); window.history.back();</script>";
        } else {
            // Verificar si el correo personal ya existe en la tabla de clientes
            $sql = "SELECT id FROM ClienteRegistrado WHERE correo_electronico = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $correo_personal);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $error = "El correo personal ya está en uso.";
                echo "<script>alert('$error'); window.history.back();</script>";
            } else {
                // Insertar el nuevo usuario en la base de datos
                $sql = "INSERT INTO EncargadoInventarios (nombre, apellido, telefono, correo_personal, contrasena) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssss", $nombre, $apellido, $telefono, $correo_personal, $contrasena);

                try {
                    $stmt->execute();
                    $_SESSION['id'] = $stmt->insert_id;
                    $_SESSION['correo_personal'] = $correo_personal;
                    echo "<script>alert('Registro exitoso'); window.location.href = '../index.php';</script>";
                } catch (mysqli_sql_exception $e) {
                    $error = "Ocurrió un error al registrar el usuario. Por favor, intenta nuevamente.";
                    echo "<script>alert('$error'); window.history.back();</script>";
                }
            }
        }
        $stmt->close();
    }
}
?>
