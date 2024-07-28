<?php
// database/verDetalleProducto.php

require 'connection.php';

function getProductDetails($product_id) {
    global $conn;
    $query = "SELECT * FROM productos WHERE id = $product_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return null;
    }
}
?>
