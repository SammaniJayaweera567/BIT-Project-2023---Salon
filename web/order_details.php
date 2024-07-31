<?php
session_start();
include 'header2.php';
include '../function.php';

// Check if user is logged in
if (!isset($_SESSION['USERID'])) {
    header("Location: login.php");
    exit();
}

// Retrieve session data
$delivery_name = $_SESSION['delivery_name'] ?? '';
$delivery_address = $_SESSION['delivery_address'] ?? '';
$delivery_phone = $_SESSION['delivery_phone'] ?? '';
$billing_name = $_SESSION['billing_name'] ?? '';
$billing_address = $_SESSION['billing_address'] ?? '';
$billing_phone = $_SESSION['billing_phone'] ?? '';

// Initialize cart and total
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$total = 0;
foreach ($cart as $item) {
    $total += $item['qty'] * $item['unit_price'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process the order
    $shipping_method = $_POST['shipping_method'] ?? '';
    $payment_method = $_POST['payment_method'] ?? '';
    $payment_slip = isset($_FILES['payment_slip']) ? $_FILES['payment_slip'] : null;
    $message = array();

    if (empty($shipping_method)) {
        $message['shipping_method'] = "Please select a shipping method.";
    }
    if (empty($payment_method)) {
        $message['payment_method'] = "Please select a payment method.";
    }
    if ($payment_method == 'bank_slip' && !$payment_slip) {
        $message['payment_slip'] = "Please upload a bank slip.";
    }

    if (empty($message)) {
        $db = dbConn();
        $userid = $_SESSION['USERID'];
        $sql = "SELECT CustomerId FROM customers WHERE UserId='$userid'";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        $customerid = $row['CustomerId'];
        $order_date = date('Y-m-d');
        $order_number = date('Y') . date('m') . date('d') . $customerid;

        // Insert order into the database
        $sql = "INSERT INTO orders(order_date, customer_id, delivery_name, delivery_address, delivery_phone, billing_name, billing_address, billing_phone, order_number, shipping_method, payment_method) 
                VALUES ('$order_date', '$customerid', '$delivery_name', '$delivery_address', '$delivery_phone', '$billing_name', '$billing_address', '$billing_phone', '$order_number', '$shipping_method', '$payment_method')";
        $db->query($sql);

        // Get the newly created order ID
        $order_id = $db->insert_id;

        foreach ($cart as $key => $value) {
            $stock_id = $value['stock_id'];
            $item_id = $value['item_id'];
            $unit_price = $value['unit_price'];
            $qty = $value['qty'];
            $sql = "INSERT INTO order_items(order_id, item_id, stock_id, unit_price, qty) VALUES ('$order_id', '$item_id', '$stock_id', '$unit_price', '$qty')";
            $db->query($sql);
        }

        if ($payment_method == 'bank_slip' && $payment_slip) {
            $upload_dir = '../uploads/';
            $upload_file = $upload_dir . basename($payment_slip['name']);
            if (move_uploaded_file($payment_slip['tmp_name'], $upload_file)) {
                $sql = "UPDATE orders SET payment_slip = '$upload_file' WHERE order_id = '$order_id'";
                $db->query($sql);
            } else {
                $message['payment_slip'] = "Failed to upload bank slip.";
            }
        }

        if (empty($message)) {
            $_SESSION['order_id'] = $order_id; // Save the order ID in session
            $_SESSION['order_number'] = $order_number; // Save the order number in session
            header("Location: order_history.php?status=success");
            exit();
        }
    }
}
?>

<main id="main">
    <div class="container-fluid py-5" style="margin-top: 120px;">
        <div class="container py-5">
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-7 col-lg-7 col-xl-7 pe-5">
                        <h4 class="px-0">Order Summary</h4>
                        <table class="table text-center mt-5">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cart as $item): ?>
                                    <tr>
                                        <td><img src="assets/img/<?= htmlspecialchars($item['item_image'] ?? '') ?>" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt=""></td>
                                        <td><?= htmlspecialchars($item['item_name']); ?></td>
                                        <td><?= htmlspecialchars($item['qty']); ?></td>
                                        <td><?= number_format($item['unit_price'], 2); ?> LKR</td>
                                        <td><?= number_format($item['qty'] * $item['unit_price'], 2); ?> LKR</td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr class="border-bottom">
                                    <td colspan="4" class="text-end">Subtotal</td>
                                    <td><?= number_format($total, 2); ?> LKR</td>
                                </tr>
                                <tr class="border-bottom">
                                    <td colspan="4" class="text-end">Shipping</td>
                                    <td>
                                        <select name="shipping_method" id="shipping_method" class="form-select">
                                            <option value="">Select a shipping method</option>
                                            <option value="express">Express - 300.00 LKR</option>
                                            <option value="standard">Standard - 150.00 LKR</option>
                                        </select>
                                        <?php if (isset($message['shipping_method'])): ?>
                                            <div class="text-danger"><?= htmlspecialchars($message['shipping_method']); ?></div>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-end fw-bold">Total</td>
                                    <td class="fw-bold"><?= number_format($total, 2); ?> LKR</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-5 col-lg-5 col-xl-5 border-start ps-5">
                        <div class="row">
                            <div class="col-12">
                                <h4>Payment Method</h4>
                                <div class="mt-4">
                                    <input type="radio" name="payment_method" value="cash_on_delivery" id="cash_on_delivery">
                                    <label for="cash_on_delivery" class="ms-2">Cash on Delivery</label>
                                </div>
                                <div class="mt-3">
                                    <input type="radio" name="payment_method" value="bank_slip" id="bank_slip">
                                    <label for="bank_slip" class="ms-2">Bank Slip</label>
                                </div>
                                <div id="payment_slip_upload" class="mt-3" style="display: none;">
                                    <label for="payment_slip">Upload Bank Slip:</label>
                                    <input type="file" name="payment_slip" id="payment_slip" class="form-control">
                                    <?php if (isset($message['payment_slip'])): ?>
                                        <div class="text-danger"><?= htmlspecialchars($message['payment_slip']); ?></div>
                                    <?php endif; ?>
                                </div>
                                <?php if (isset($message['payment_method'])): ?>
                                    <div class="text-danger"><?= htmlspecialchars($message['payment_method']); ?></div>
                                <?php endif; ?>
                                <script>
                                    document.getElementById('bank_slip').addEventListener('change', function () {
                                        document.getElementById('payment_slip_upload').style.display = 'block';
                                    });
                                    document.getElementById('cash_on_delivery').addEventListener('change', function () {
                                        document.getElementById('payment_slip_upload').style.display = 'none';
                                    });
                                </script>
                            </div>
                        </div>
                        <div class="mt-5">
                            <a href="order_history.php" type="submit"class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4">Place Order</a>
                        </div>  
                        
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>
