<?php
include(__DIR__ . '/database.php');
$basePath = '/poti assignment 1';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$cartCount = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cartCount += $item['qty'];
    }
}

$currentPage = basename($_SERVER['PHP_SELF']);
$minimalHeader = in_array($currentPage, ['delivery.php', 'checkout.php']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POTI Mart</title>
    <link rel="stylesheet" href="<?= $basePath ?>/assets/styles/header.css">
    <script src="<?= $basePath ?>/assets/js/script.js" defer></script>
    <script src="<?= $basePath ?>/assets/js/cart.js" defer></script>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const params = new URLSearchParams(window.location.search);
            if (params.get('cart') === 'open') {
                toggleCart();
                history.replaceState(null, '', window.location.pathname);
            }
        });
    </script>
</head>

<nav class = "navbar">
    <div class="container">
        <div class="logo">
            <a href="<?= $basePath ?>/index.php">
                <img src="<?= $basePath ?>/assets/images/logo2.png" alt="POTI Mart Logo">
            </a>
        </div>

        <?php if (!$minimalHeader): ?>
            <ul class="categories">
                <li class="category-item">
                    <a href="<?= $basePath ?>/pages/searchResults.php?category=FV">Fruits and Vegetables</a>
                    <div class="subcategory">
                        <a href="<?= $basePath ?>/pages/searchResults.php?category=FV&subcategory=Fruits">Fruits</a>
                        <a href="<?= $basePath ?>/pages/searchResults.php?category=FV&subcategory=Vegetables">Vegetables</a>
                    </div>
                </li>

                <li class="category-item">
                    <a href="<?= $basePath ?>/pages/searchResults.php?category=Dairy">Dairy</a>
                </li>

                <li class="category-item">
                    <a href="<?= $basePath ?>/pages/searchResults.php?category=PMS">Poultry, Meat and Seafood</a>
                    <div class="subcategory">
                        <a href="<?= $basePath ?>/pages/searchResults.php?category=PMS&subcategory=Poultry">Poultry</a>
                        <a href="<?= $basePath ?>/pages/searchResults.php?category=PMS&subcategory=Meat">Meat</a>
                        <a href="<?= $basePath ?>/pages/searchResults.php?category=PMS&subcategory=Seafood">Seafood</a>
                    </div>
                </li>

                <li class="category-item">
                    <a href="<?= $basePath ?>/pages/searchResults.php?category=Drinks">Drinks</a>
                </li>
                
                <li class="category-item">
                    <a href="<?= $basePath ?>/pages/searchResults.php?category=Pantry">Pantry</a>
                </li>

                <li class="category-item">
                    <a href="<?= $basePath ?>/pages/searchResults.php?category=Pet">Pet</a>
                </li>

                <li class="category-item">
                    <a href="<?= $basePath ?>/pages/searchResults.php?category=HL">Home and Lifestyle</a>
                    <div class="subcategory">
                        <a href="<?= $basePath ?>/pages/searchResults.php?category=HL&subcategory=Home">Home</a>
                        <a href="<?= $basePath ?>/pages/searchResults.php?category=HL&subcategory=Lifestyle">Lifestyle</a>
                    </div>
                </li>
            </ul>

            <div class="right-section">
                <div class="search-bar">
                    <form action="<?= $basePath ?>/pages/searchResults.php" method="GET">
                        <input type="text" name="query" placeholder="Search for products">
                        <button type="submit">Search</button>
                    </form>
                </div>

                <div class="cart" onclick="toggleCart()">
                    <img src="<?= $basePath ?>/assets/images/cart.png" alt="Shopping Cart">
                    <span id="cart-count"><?= $cartCount ?></span>
                </div>
            </div>
            
            <div id="cart-panel" class="cart-panel">
                <div class="cart-header">
                    <h3>Shopping Cart</h3>
                    <span id="cart-close">&times;</span>
                </div>
                <div id="cart-items"></div>
                <div class="cart-summary">
                    <p>Total: $0.00</p>
                    <button id="clear-btn" <?= $cartCount == 0 ? 'disabled' : '' ?>>Clear Cart</button><br>
                    <button id="checkout-btn">Proceed to Checkout</button>
                </div>
            </div>
        <?php endif; ?>
    </div>
<iframe name="hidden-frame" style="display:none;"></iframe>
</nav>
</html>