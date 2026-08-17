<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = (int)$_POST['product_id'];
    $change = (int)$_POST['change'];

    if (isset($_SESSION['cart'][$productId])) {
        $newQty = $_SESSION['cart'][$productId]['qty'] + $change;
        if ($newQty > 0) {
            $_SESSION['cart'][$productId]['qty'] = $newQty;
            $_SESSION['cart'][$productId]['total'] = $newQty * $_SESSION['cart'][$productId]['price'];
        } else {
            unset($_SESSION['cart'][$productId]);
        }
    }
}

echo "<script>parent.loadCart();</script>";
?>