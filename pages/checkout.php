<?php
include('../features/header.php');
require_once '../features/database.php';

$cart = $_SESSION['cart'] ?? [];
$cartItems = [];
$errors = [];
$hasError = false;

if (!empty($cart)) {
    $ids = implode(',', array_keys($cart));
    $query = "SELECT * FROM products WHERE product_id IN ($ids)";
    $result = $db->query($query);

    while ($row = $result->fetch_assoc()) {
        $id = $row['product_id'];
        $qty = $cart[$id]['qty'];
        $total = $qty * (float)$row['unit_price'];

        $cartItems[] = [
            'name' => $row['product_name'],
            'unit_price' => $row['unit_price'],
            'qty' => $qty,
            'total' => $total,
            'image' => $row['image']
        ];
    }
}

$totalCost = array_sum(array_column($cartItems, 'total'));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($cart)) {
        foreach ($cart as $id => $item) {
            $stmt = $db->prepare("SELECT in_stock FROM products WHERE product_id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if (!$row || $row['in_stock'] < $item['qty']) {
                $errors[] = "There is not enough {$item['name']} in stock.";
            }

            $stmt->close();
        }

        if (!empty($errors)) {
            $_SESSION['checkout_errors'] = $errors;
        } else {
            foreach ($cart as $id => $item) {
                $stmt = $db->prepare("UPDATE products SET in_stock = in_stock - ? WHERE product_id = ?");
                $stmt->bind_param("ii", $item['qty'], $id);
                $stmt->execute();
                $stmt->close();
            }
            
            unset($_SESSION['cart']);
            header('Location: confirmation.php');
            exit();
        }
    }
}

if (!empty($errors)) {
    $hasError = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="/poti assignment 1/assets/styles/styles.css">
    <script src="/poti assignment 1/assets/js/script.js" defer></script>
    <script src="/poti assignment 1/assets/js/cart.js" defer></script>
</head>

<?php if (!empty($errors)): ?>
    <div class="error-box">
        <h3>Stock Error</h3>
        <ul>
            <?php foreach ($errors as $err): ?>
                <li><?= htmlspecialchars($err) ?></li>
            <?php endforeach; ?>
        </ul>
        <p>Please return to update shopping cart.</p>
    </div>
<?php endif; ?>

<body>
    <h1 class="checkout">Checkout</h1>
    <div class="order-summary">
        <h2 class="order-summary">Your Order Summary</h2>

        <?php if (!empty($cartItems)): ?>
            <ul>
                <?php foreach ($cartItems as $item): ?>
                    <li>
                        <img src="<?= $item['image'] ?>" alt="<?= $item['name'] ?>" width="50">
                        <span><?= $item['name'] ?> (x<?= $item['qty'] ?>) <br> $<?= number_format($item['total'], 2) ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
            <p><strong>Total Cost: $<?= number_format($totalCost, 2) ?></strong></p>
        <?php endif; ?>

        <h3>Payment Method</h3>
        <form action="checkout.php" method="POST">
            <label for="payment-method">Select Payment Method:</label>
            <select name="payment_method" id="payment-method" required>
                <option value="Credit Card">Credit Card</option>
                <option value="PayPal">PayPal</option>
                <option value="Bank Transfer">Bank Transfer</option>
            </select>

            <button class="transaction-btn" type="submit" <?= $hasError ? 'disabled' : '' ?>>Complete Transaction</button>
        </form>
    </div>
</body>
</html>

<?php include('../features/footer.php'); ?>