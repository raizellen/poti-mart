<?php
include('../features/header.php');

$category = isset($_GET['category']) ? $db->real_escape_string($_GET['category']) : '';
$subcategory = isset($_GET['subcategory']) ? $db->real_escape_string($_GET['subcategory']) : '';
$search = isset($_GET['query']) ? $db->real_escape_string($_GET['query']) : '';

if ($category && $subcategory) {
    $sql = "SELECT * FROM products WHERE category = '$category' AND subcategory = '$subcategory'";
} elseif ($category) {
    $sql = "SELECT * FROM products WHERE category = '$category'";
} elseif ($search) {
    $sql = "SELECT * FROM products WHERE product_name LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM products";
}

$result = $db->query($sql);
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

<body>
    <h2>Search Results<?= $search ? " for '$search'" : '' ?></h2>
    <p style="text-align: center;"><?= mysqli_num_rows($result) == 0 ? "No results found." : ''?></p>
    <div class="product-list">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="product">
                <a href="product.php?product_id=<?= $row['product_id'] ?>">
                    <img src="<?= $row['image'] ?>" alt="<?= $row['product_name'] ?>">
                    <h3><?= $row['product_name'] ?></h3>
                </a>
                <p><?=$row['unit_quantity'] ?></p>
                <p>$<?= number_format($row['unit_price'], 2) ?></p>
                <form action="../features/cart.php" method="POST">
                    <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
                    <button type="submit" class="<?=$row['in_stock'] == 0 ? 'add-to-cart out-of-stock' : 'add-to-cart'?>" <?= $row['in_stock'] == 0 ? 'disabled' : '' ?>>
                        <?= $row['in_stock'] == 0 ? "Out of Stock" : "Add to Cart" ?>
                    </button>
                </form>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>

<?php include('../features/footer.php'); ?>