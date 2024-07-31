<?php
session_start();
require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = trim($_POST['correo']);
    $contrasena = trim($_POST['contrasena']);

    // Validación básica
    if (empty($correo) || empty($contrasena)) {
        $error = "Todos los campos son obligatorios.";
        echo "<script>alert('$error'); window.history.back();</script>";
    } else {
        // Verificar si el correo existe en ClienteRegistrado
        $sql = "SELECT id, nombre, apellido, contrasena FROM ClienteRegistrado WHERE correo_electronico = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $nombre, $apellido, $hash_contrasena);

        if ($stmt->num_rows > 0) {
            $stmt->fetch();
            if ($contrasena === $hash_contrasena) {
                $_SESSION['id_usuario'] = $id;
                $_SESSION['correo_electronico'] = $correo;
                $_SESSION['nombre_usuario'] = $nombre;
                $_SESSION['apellido'] = $apellido;
                $_SESSION['tipo_usuario'] = 'cliente';
                echo "<script>window.location.href = '../index.php';</script>";
            } else {
                $error = "Contraseña incorrecta.";
                echo "<script>alert('$error'); window.history.back();</script>";
            }
        } else {
            // Verificar si el correo existe en EncargadoInventarios
            $sql = "SELECT id, nombre, apellido, contrasena FROM EncargadoInventarios WHERE correo_personal = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $correo);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $nombre, $apellido, $hash_contrasena);

            if ($stmt->num_rows > 0) {
                $stmt->fetch();
                if ($contrasena === $hash_contrasena) {
                    $_SESSION['id_usuario'] = $id;
                    $_SESSION['correo_personal'] = $correo;
                    $_SESSION['nombre_usuario'] = $nombre;
                    $_SESSION['apellido'] = $apellido;
                    $_SESSION['tipo_usuario'] = 'encargado';
                    echo "<script>window.location.href = '../index.php';</script>";
                } else {
                    $error = "Contraseña incorrecta.";
                    echo "<script>alert('$error'); window.history.back();</script>";
                }
            } else {
                $error = "El correo no está registrado.";
                echo "<script>alert('$error'); window.history.back();</script>";
            }
        }
        $stmt->close();
    }
}
?>
