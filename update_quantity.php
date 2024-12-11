<?php
require_once 'CProducts.php';
require_once 'db_config.php';

if (isset($_POST['id']) && isset($_POST['quantity'])) {
    $products->updateQuantity($_POST['id'], $_POST['quantity']);
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>
