<?php
require_once 'CProducts.php';

$host = '127.0.0.1';
$username = 'root';
$password = '';
$dbname = 'test_db';

$products = new CProducts($host, $username, $password, $dbname);
?>
