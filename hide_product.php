<?php
require_once 'CProducts.php';
require_once 'db_config.php';


if (isset($_POST['id'])) {
    $products->hideProduct($_POST['id']);
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>
