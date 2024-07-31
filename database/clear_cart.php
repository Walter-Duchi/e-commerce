<?php
// database/clear_cart.php
session_start();

if(isset($_SESSION['cart'])) {
    unset($_SESSION['cart']);
    echo json_encode(array('status' => 'success'));
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Cart is already empty'));
}
?>
