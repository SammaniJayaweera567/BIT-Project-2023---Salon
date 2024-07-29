<?php
session_start();
ob_start(); // Multiple header error removal
include 'header2.php';
include '../function.php';

// Check if user is logged in
if (!isset($_SESSION['USERID'])) {
    header("Location: login.php");
    exit();
}

$db = dbConn();
$userid = $_SESSION['USERID'];

// Fetch customer ID
$sql = "SELECT CustomerId FROM customers WHERE UserId='$userid'";
$result = $db->query($sql);
$row = $result->fetch_assoc();
$customerid = $row['CustomerId'];

// Fetch orders
$sql = "SELECT * FROM orders WHERE customer_id='$customerid' ORDER BY order_date DESC";
$orders = $db->query($sql);

// Check if there is a success message
$order_success_message = '';
if (isset($_GET['status']) && $_GET['status'] === 'success') {
    $order_success_message = 'Order placed successfully! Your order ID is ' . (isset($_SESSION['order_id']) ? htmlspecialchars($_SESSION['order_id'], ENT_QUOTES, 'UTF-8') : 'N/A');
    unset($_SESSION['order_id']); // Clear the order ID after displaying the message
}
?>

<main id="main">
    <section class="order-history-section py-5 my-5">
        <div class="container mt-5 py-5">
            <!-- Profile Management Card -->
            <div class="card card-profile-manage mb-3 my-5 border mx-auto">
                <div class="card-header card-header bg-dark-black text-light-yellow">
                    Order History
                </div>
                <div class="card-body">
                    <?php if ($order_success_message): ?>
                        <div class="alert alert-success">
                            <?= htmlspecialchars($order_success_message, ENT_QUOTES, 'UTF-8'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($orders->num_rows > 0): ?>
                        <table class="table table-bordered mt-4">
                            <thead>
                                <tr>
                                    <th>Order Number</th>
                                    <th>Order Date</th>
                                    <th>Delivery Name</th>
                                    <th>Delivery Address</th>
                                    <th>Billing Name</th>
                                    <th>Billing Address</th>
                                    <th>Shipping Method</th>
                                    <th>Payment Method</th>
                                    <th>Order Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($order = $orders->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($order['order_number'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?= htmlspecialchars($order['order_date'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?= htmlspecialchars($order['delivery_name'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?= htmlspecialchars($order['delivery_address'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?= htmlspecialchars($order['billing_name'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?= htmlspecialchars($order['billing_address'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?= htmlspecialchars($order['shipping_method'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?= htmlspecialchars($order['payment_method'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td>
                                            <a href="order_details.php?order_id=<?= htmlspecialchars($order['order_id'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-info">View Details</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>No orders found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
include 'footer.php';
ob_end_flush();
?>
