<?php
session_start();
require_once './database.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_POST['product_id'])) {
    $productId = intval($_POST['product_id']);

    $stmt = $db->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();

    if ($product && $product['in_stock'] > 0) {
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['qty'] += 1;
            $_SESSION['cart'][$productId]['total'] = $_SESSION['cart'][$productId]['qty'] * $product['unit_price'];
        } else {
            $_SESSION['cart'][$productId] = [
                'product_id' => $product['product_id'],
                'name' => $product['product_name'],
                'image' => $product['image'],
                'unit_quantity' => $product['unit_quantity'],
                'price' => floatval($product['unit_price']),
                'qty' => 1,
                'total' => $product['unit_price']
            ];
        }
    }
}

header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
?>