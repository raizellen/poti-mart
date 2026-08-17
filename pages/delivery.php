<?php
include('../features/header.php');
$states = ["NSW", "VIC", "QLD", "WA", "SA", "TAS", "ACT", "NT", "Others"];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];

    $name = trim($_POST['name'] ?? '');
    $street = trim($_POST['street'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $state = $_POST['state'] ?? '';
    $mobile = trim($_POST['mobile'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if (empty($name)) $errors['name'] = 'Name is required.';
    if (empty($street)) $errors['street'] = 'Street is required.';
    if (empty($city)) $errors['city'] = 'City/Suburb is required.';
    if (!in_array($state, $states)) $errors['state'] = 'Please select a valid state.';
    if (!preg_match('/^\d{10}$/', $mobile)) $errors['mobile'] = 'Enter a valid 10-digit mobile number.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Enter a valid email address.';

    $email = $_POST['email'];
    $_SESSION['user_email'] = $email;

    if (empty($errors)) {
        header("Location: checkout.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delivery</title>
    <link rel="stylesheet" href="/poti assignment 1/assets/styles/styles.css">
    <script src="/poti assignment 1/assets/js/script.js" defer></script>
    <script src="/poti assignment 1/assets/js/cart.js" defer></script>
</head>

<body>
    <h1 class="checkout">Delivery Information</h1>
    <div class="delivery-form-container">
        <form action="delivery.php" method="POST" novalidate class="delivery-form">
            <label>Recipient Name:</label>
            <input type="text" name="name" required value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
            <span style="color: red;"><?= $errors['name'] ?? '' ?></span>
            <br><br>

            <label>Street:</label>
            <input type="text" name="street" required value="<?= htmlspecialchars($_POST['street'] ?? '') ?>">
            <span style="color: red;"><?= $errors['street'] ?? '' ?></span>
            <br><br>

            <label>City/Suburb:</label>
            <input type="text" name="city" required value="<?= htmlspecialchars($_POST['city'] ?? '') ?>">
            <span style="color: red;"><?= $errors['city'] ?? '' ?></span>
            <br><br>
            
            <label>State/Territory:</label>
            <select name="state" required>
                <option value="">-- Select State --</option>
                <?php foreach ($states as $s): ?>
                    <option value="<?= $s ?>" <?= ($state ?? '') === $s ? 'selected' : '' ?>><?= $s ?></option>
                <?php endforeach; ?>
            </select>
            <span style="color: red;"><?= $errors['state'] ?? '' ?></span>
            <br><br>

            <label>Mobile Number:</label>
            <input type="text" name="mobile" required value="<?= htmlspecialchars($_POST['mobile'] ?? '') ?>">
            <span style="color: red;"><?= $errors['mobile'] ?? '' ?></span>
            <br><br>

            <label>Email Address:</label>
            <input type="email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            <span style="color: red;"><?= $errors['email'] ?? '' ?></span>
            <br><br>

            <button type="submit">Proceed to Payment</button>
        </form>
    </div>
</body>
</html>

<?php include('../features/footer.php'); ?>