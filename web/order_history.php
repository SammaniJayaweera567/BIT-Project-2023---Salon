<?php
session_start();
ob_start(); // For avoiding multiple header errors
include 'header2.php';
include '../function.php';

// Check if user is logged in
if (!isset($_SESSION['USERID'])) {
    header("Location: login.php");
    exit();
}

// Fetch customer ID
$db = dbConn();
$userid = $_SESSION['USERID'];
$sql = "SELECT CustomerId FROM customers WHERE UserId='$userid'";
$result = $db->query($sql);
$row = $result->fetch_assoc();
$customerid = $row['CustomerId'];

// Fetch order details
$sql = "SELECT * FROM orders WHERE customer_id='$customerid' ORDER BY order_date DESC";
$result = $db->query($sql);

// Handle any status messages
$status_message = '';
if (isset($_GET['status']) && $_GET['status'] == 'success') {
    $order_id = $_SESSION['order_id'] ?? 'N/A';
    $order_number = $_SESSION['order_number'] ?? 'N/A';
    $status_message = "Your order has been successfully placed. Order Number: " . htmlspecialchars($order_number);
    unset($_SESSION['order_id']); // Clear the order ID from session
    unset($_SESSION['order_number']); // Clear the order number from session
}
?>

<main id="main">
    <div class="container-fluid py-5" style="margin-top: 120px;">
        <div class="container py-5">
            <h3 class="fw-bolder mb-5">Order Details</h3>

            <?php if ($status_message): ?>
                <div class="alert alert-success" role="alert">
                    <?= $status_message; ?>
                </div>
            <?php endif; ?>

            <?php if ($result->num_rows > 0): ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>Order ID</th>
                                <th>Order Date</th>
                                <th>Delivery Name</th>
                                <th>Billing Name</th>
                                <th>Order Number</th>
                                <th>Total</th>
                                <th>Order Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($order = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($order['order_id'] ?? 'N/A'); ?></td>
                                    <td><?= htmlspecialchars($order['order_date'] ?? 'N/A'); ?></td>
                                    <td><?= htmlspecialchars($order['delivery_name'] ?? 'N/A'); ?></td>
                                    <td><?= htmlspecialchars($order['billing_name'] ?? 'N/A'); ?></td>
                                    <td><?= htmlspecialchars($order['order_number'] ?? 'N/A'); ?></td>
                                    <td><?= number_format($order['total'] ?? 0.00, 2); ?> LKR</td>
                                    <td><?= htmlspecialchars($order['order_status'] ?? 'N/A'); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p>No orders found.</p>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>
