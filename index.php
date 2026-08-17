<?php
include('features/header.php');
$result = $db->query("SELECT * FROM products WHERE in_stock > 0 LIMIT 5");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Grocery Store</title>
    <link rel="stylesheet" href="assets/styles/styles.css">
    <script src="/poti assignment 1/assets/js/script.js" defer></script>
    <script src="/poti assignment 1/assets/js/cart.js" defer></script>
</head>

<body>
    <div class="welcome">
        <img src="<?= $basePath ?>/assets/images/logo.png" alt="POTI Mart Logo">
        <h1>Welcome to POTI<br>Online Grocery Store!</h1>
    </div>

    <div class="featured">
        <h2>Featured products</h2>
        <div class="product-list">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="product">
                    <a href="pages/product.php?product_id=<?= $row['product_id'] ?>">
                        <img src="<?= $row['image'] ?>" alt="<?= $row['product_name'] ?>">
                        <h3><?= $row['product_name'] ?></h3>
                    </a>
                    <p><?=$row['unit_quantity'] ?></p>
                    <p>$<?= number_format($row['unit_price'], 2) ?></p>
                    <form action="./features/cart.php" method="POST">
                        <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
                        <button type="submit" class="add-to-cart">Add to Cart</button>
                    </form>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>

<?php include('features/footer.php'); ?>