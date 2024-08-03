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

// Apply discount and calculate net subtotal
$discount_percentage = 0.03; // 3% discount
$discount = $total * $discount_percentage;
$net_subtotal = $total - $discount;

// Initialize shipping cost
$shipping_cost = 0;
$shipping_method = '';

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $payment_method = $_POST['payment_method'] ?? '';
    $payment_slip = isset($_FILES['payment_slip']) ? $_FILES['payment_slip'] : null;
    $message = array();

    if (empty($payment_method)) {
        $message['payment_method'] = "Please select a payment method.";
    }
    
    if ($payment_method == 'bank_slip' && !$payment_slip) {
        $message['payment_slip'] = "Please upload a bank slip.";
    }

    // Set shipping cost based on the selected payment method
    if ($payment_method == 'cash_on_delivery') {
        $shipping_cost = 300.00; // Fixed shipping cost for cash on delivery
    } elseif ($payment_method == 'bank_slip') {
        $shipping_method = $_POST['shipping_method'] ?? '';
        if ($shipping_method == 'express') {
            $shipping_cost = 300.00;
        } elseif ($shipping_method == 'standard') {
            $shipping_cost = 150.00;
        } elseif ($shipping_method == '') {
            $message['shipping_method'] = "Please select a shipping method.";
        }
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
        $sql = "INSERT INTO orders(order_date, customer_id, delivery_name, delivery_address, delivery_phone, billing_name, billing_address, billing_phone, order_number, shipping_method, payment_method, shipping_cost) 
                VALUES ('$order_date', '$customerid', '$delivery_name', '$delivery_address', '$delivery_phone', '$billing_name', '$billing_address', '$billing_phone', '$order_number', '$shipping_method', '$payment_method', '$shipping_cost')";
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

// Calculate total with shipping cost
$total_with_shipping = $net_subtotal + $shipping_cost;
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
                                    <td id="subtotal"><?= number_format($total, 2); ?> LKR</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-end">Discount (3%)</td>
                                    <td id="discount"><?= number_format($discount, 2); ?> LKR</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-end">Net Subtotal</td>
                                    <td id="net_subtotal"><?= number_format($net_subtotal, 2); ?> LKR</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-end">Shipping Cost</td>
                                    <td id="shipping_cost"><?= number_format($shipping_cost, 2); ?> LKR</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-end fw-bold">Total</td>
                                    <td class="fw-bold" id="total_with_shipping"><?= number_format($total_with_shipping, 2); ?> LKR</td>
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
                                     <div id="shipping_method_select" style="display: none;">
<!--                                    <input type="radio" name="shipping_method" value="express" id="express">
                                    <label for="express" class="ms-2">Express Delivery - 300 LKR</label>
                                    <br>-->
                                    <?php if (isset($message['shipping_method'])): ?>
                                        <div class="text-danger"><?= htmlspecialchars($message['shipping_method']); ?></div>
                                    <?php endif; ?>
                                </div>
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
                            </div>
                            
                        </div>
                        <div class="mt-5">
                            <input type="submit" class="btn btn-primary" value="Place Order">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const paymentMethodRadios = document.querySelectorAll('input[name="payment_method"]');
    const paymentSlipUpload = document.getElementById('payment_slip_upload');
    const shippingMethodSelect = document.getElementById('shipping_method_select');
    const shippingCostElement = document.getElementById('shipping_cost');
    const totalWithShippingElement = document.getElementById('total_with_shipping');
    
    paymentMethodRadios.forEach(radio => {
        radio.addEventListener('change', function () {
            if (this.value === 'bank_slip') {
                paymentSlipUpload.style.display = 'block';
                shippingMethodSelect.style.display = 'block';
            } else {
                paymentSlipUpload.style.display = 'none';
                shippingMethodSelect.style.display = 'none';
            }
            if (this.value === 'cash_on_delivery') {
                shippingCostElement.textContent = '300.00 LKR'; // Fixed shipping cost
                updateTotal();
            } else {
                shippingCostElement.textContent = '0.00 LKR';
                updateTotal();
            }
        });
    });

    document.querySelectorAll('input[name="shipping_method"]').forEach(radio => {
        radio.addEventListener('change', function () {
            let shippingCost = 0;
            if (this.value === 'express') {
                shippingCost = 300;
            } else if (this.value === 'standard') {
                shippingCost = 150;
            }
            shippingCostElement.textContent = `${shippingCost.toFixed(2)} LKR`;
            updateTotal();
        });
    });

    function updateTotal() {
        const shippingCost = parseFloat(shippingCostElement.textContent);
        const netSubtotal = parseFloat(document.getElementById('net_subtotal').textContent);
        totalWithShippingElement.textContent = `${(netSubtotal + shippingCost).toFixed(2)} LKR`;
    }
});
</script>

<?php include 'footer.php'; ?>
