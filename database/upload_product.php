<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    // Directorio donde se guardarán las imágenes
    $target_dir = "../assets/uploads/";
    
    // Obtener el próximo ID de la tabla Productos
    $result = $conn->query("SHOW TABLE STATUS LIKE 'Productos'");
    $row = $result->fetch_assoc();
    $next_id = $row['Auto_increment'];
    
    // Generar un nombre único para la imagen
    $imageFileType = strtolower(pathinfo($_FILES['imagen_url']['name'], PATHINFO_EXTENSION));
    $target_file = $target_dir . "imagen_" . $next_id . '.' . $imageFileType;

    // Mover el archivo subido a la carpeta de destino
    if (move_uploaded_file($_FILES['imagen_url']['tmp_name'], $target_file)) {
        // Guardar la ruta relativa en la base de datos
        $imagen_url = "imagen_" . $next_id . '.' . $imageFileType;

        $sql = "INSERT INTO Productos (nombre, descripcion, precio, stock, imagen_url) VALUES (?, ?, ?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssdis", $nombre, $descripcion, $precio, $stock, $imagen_url);
            if ($stmt->execute()) {
                echo "Producto guardado exitosamente.";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Hubo un error subiendo el archivo.";
    }
}
$conn->close();
?>
