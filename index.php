<?php
require_once 'CProducts.php';
require_once 'db_config.php';

$data = $products->getProducts();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Article</th>
                <th>Quantity</th>
                <th>Date Created</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $product): ?>
                <tr data-id="<?= $product['ID'] ?>">
                    <td><?= $product['PRODUCT_ID'] ?></td>
                    <td><?= $product['PRODUCT_NAME'] ?></td>
                    <td><?= $product['PRODUCT_PRICE'] ?></td>
                    <td><?= $product['PRODUCT_ARTICLE'] ?></td>
                    <td>
                        <span><?= $product['PRODUCT_QUANTITY'] ?></span>
                        <button class="decrease">-</button>
                        <button class="increase">+</button>
                    </td>
                    <td><?= $product['DATE_CREATE'] ?></td>
                    <td><button class="hide-button">Скрыть</button></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        $(document).on('click', '.hide-button', function() {
            const row = $(this).closest('tr');
            const id = row.data('id');

            $.post('hide_product.php', { id: id }, function(response) {
                if (response.success) {
                    row.remove();
                }
            }, 'json');
        });

        $(document).on('click', '.increase, .decrease', function() {
            const row = $(this).closest('tr');
            const id = row.data('id');
            const span = row.find('td:nth-child(5) span');
            let quantity = parseInt(span.text());
            quantity += $(this).hasClass('increase') ? 1 : -1;

            if (quantity >= 0) {
                $.post('update_quantity.php', { id: id, quantity: quantity }, function(response) {
                    if (response.success) {
                        span.text(quantity);
                    }
                }, 'json');
            }
        });
    </script>
</body>
</html>
