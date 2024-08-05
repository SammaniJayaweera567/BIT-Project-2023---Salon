<?php
session_start();
include 'header2.php';

if (!isset($_SESSION['order_number']) || !isset($_SESSION['order_id'])) {
    header("Location: checkout.php");
    exit();
}

$order_number = $_SESSION['order_number'];
$order_id = $_SESSION['order_id'];
unset($_SESSION['order_number']);
unset($_SESSION['order_id']);
?>
<main id="main">
    <div class="container py-5">
        <h2 class="text-center">Order Success</h2>
        <div class="alert alert-success text-center">
            <p>Your order has been successfully placed!</p>
            <p>Your order number is: <strong><?= htmlspecialchars($order_number); ?></strong></p>
            <p>Order ID: <strong><?= htmlspecialchars($order_id); ?></strong></p>
            <a href="index.php" class="btn btn-primary">Return to Homepage</a>
        </div>
    </div>
</main>
<?php include 'footer.php'; ?>
