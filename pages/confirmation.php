<?php
include('../features/header.php');
$userEmail = $_SESSION['user_email'] ?? 'Unknown';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
    <link rel="stylesheet" href="/poti assignment 1/assets/styles/styles.css">
    <script src="/poti assignment 1/assets/js/script.js" defer></script>
    <script src="/poti assignment 1/assets/js/cart.js" defer></script>
</head>

<body>
    <h1 class="checkout" style="padding-top: 100px;">Your order has been confirmed!</h1>
    <p style="text-align: center;">Your invoice has been sent to <?php echo htmlspecialchars($userEmail); ?>.</p>
</body>
</html>

<?php include('../features/footer.php'); ?>