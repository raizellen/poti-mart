<?php
include('../features/header.php');

$id = intval($_GET['product_id']);
$query = "SELECT * FROM products WHERE product_id = $id";
$result = mysqli_query($db, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "<p>Product not found.</p>";
}

$product = mysqli_fetch_assoc($result);

$disabled = $product['in_stock'] == 0 ? 'disabled' : '';
$class = $product['in_stock'] == 0 ? 'add-to-cart out-of-stock' : 'add-to-cart';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Grocery Store</title>
    <link rel="stylesheet" href="/poti assignment 1/assets/styles/styles.css">
    <script src="/poti assignment 1/assets/js/script.js" defer></script>
    <script src="/poti assignment 1/assets/js/cart.js" defer></script>
</head>

<div class="single-product">
    <img src="<?= $product['image'] ?>" alt="<?= $product['product_name'] ?>" class="product-image">
    <div class="product-details">
        <h2><?= $product['product_name'] ?></h2>
        <p class="product-price">$<?= number_format($product['unit_price'], 2) ?></p>
        <p class="details">Unit: <?= $product['unit_quantity'] ?></p>
        <p class="details">
            <?= $product['in_stock'] > 0 ? "In Stock ({$product['in_stock']} available)" : "Out of Stock" ?>
        </p><br>
        <form action="../features/cart.php" method="POST">
            <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
            <button type="submit" class="<?= $class ?>" <?= $disabled ?>>
                <?= $product['in_stock'] == 0 ? "Out of Stock" : "Add to Cart" ?>
            </button>
        </form>
    </div>
</div>
</html>

<?php include('../features/footer.php'); ?>