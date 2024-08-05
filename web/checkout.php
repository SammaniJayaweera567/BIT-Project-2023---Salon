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
$shipping_method = isset($_POST['shipping_method']) ? $_POST['shipping_method'] : '';

print_r($_POST);

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Extract delivery and billing details
    $delivery_name = dataClean($_POST['delivery_name']);
    $delivery_address = dataClean($_POST['delivery_address']);
    $delivery_phone = dataClean($_POST['delivery_phone']);
    $billing_name = dataClean($_POST['billing_name']);
    $billing_address = dataClean($_POST['billing_address']);
    $billing_phone = dataClean($_POST['billing_phone']);

    // Extract payment and shipping details
    $payment_method = $_POST['payment_method'] ?? '';
    $payment_slip = isset($_FILES['payment_slip']) ? $_FILES['payment_slip'] : null;
    $shipping_method = $_POST['shipping_method'] ?? '';

    $message = array();

    // Validate required fields
    if (empty($delivery_name)) {
        $message['delivery_name'] = "The delivery name should not be blank...!";
    }
    if (empty($delivery_address)) {
        $message['delivery_address'] = "The delivery address is required";
    }
    if (empty($delivery_phone)) {
        $message['delivery_phone'] = "The delivery phone should not be blank...!";
    }
    if (empty($billing_name)) {
        $message['billing_name'] = "The billing name is required";
    }
    if (empty($billing_address)) {
        $message['billing_address'] = "The billing address is required";
    }
    if (empty($billing_phone)) {
        $message['billing_phone'] = "The billing phone is required";
    }
    if (empty($payment_method)) {
        $message['payment_method'] = "Please select a payment method.";
    }
    if ($payment_method == 'bank_transfer' && !$payment_slip) {
        $message['payment_slip'] = "Please upload a bank slip.";
    }
    if ($payment_method == 'bank_transfer' && empty($shipping_method)) {
        $message['shipping_method'] = "Please select a shipping method.";
    }

    // Set shipping cost based on the selected payment method
    if ($payment_method == 'cash_on_delivery') {
        $shipping_cost = 300.00; // Fixed shipping cost for cash on delivery
    } elseif ($payment_method == 'bank_transfer' && $shipping_method == 'standard') {
        $shipping_cost = 150.00;
    }

    if (empty($message)) {
        $db = dbConn();
        $userid = $_SESSION['USERID'];
       echo $sql = "SELECT CustomerId FROM customers WHERE UserId='$userid'";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        $customerid = $row['CustomerId'];
        $order_date = date('Y-m-d');
        $order_number = date('Y') . date('m') . date('d') . $customerid;

        // Insert order into the database
        $sql = "INSERT INTO orders (
        order_date, customer_id, delivery_name, delivery_address, delivery_phone, 
        billing_name, billing_address, billing_phone, order_number, 
        shipping_method, payment_method, shipping_cost
        ) VALUES (
        '$order_date', '$customerid', '$delivery_name', '$delivery_address', 
        '$delivery_phone', '$billing_name', '$billing_address', '$billing_phone', 
        '$order_number', '$shipping_method', '$payment_method', '$shipping_cost'
        )";
        if ($db->query($sql) === FALSE) {
            die("Error: " . $db->error);
        }

        // Get the newly created order ID
        $order_id = $db->insert_id;

        foreach ($cart as $key => $value) {
            $stock_id = $value['stock_id'];
            $item_id = $value['item_id'];
            $unit_price = $value['unit_price'];
            $qty = $value['qty'];
            $sql = "INSERT INTO order_items(order_id, item_id, stock_id, unit_price, qty) VALUES('$order_id', '$item_id', '$stock_id', '$unit_price', '$qty')";
            if ($db->query($sql) === FALSE) {
                die("Error: " . $db->error);
            }
        }

        if ($payment_method == 'bank_transfer' && $payment_slip) {
            $upload_dir = '../uploads/';
            $upload_file = $upload_dir . basename($payment_slip['name']);
            if (move_uploaded_file($payment_slip['tmp_name'], $upload_file)) {
                $sql = "UPDATE orders SET payment_slip = '$upload_file' WHERE order_id = '$order_id'";
                if ($db->query($sql) === FALSE) {
                    die("Error: " . $db->error);
                }
            } else {
                $message['payment_slip'] = "Failed to upload bank slip.";
            }
        }

        if (empty($message)) {
            $_SESSION['order_id'] = $order_id; // Save the order ID in session
            $_SESSION['order_number'] = $order_number; // Save the order number in session
            header("Location: order_success.php");
            exit();
        }
    }
}

// Calculate total with shipping cost
$total_with_shipping = $net_subtotal + $shipping_cost;
?>

<main id="main">
    <?php
    // Display cart total and item count
    $total = 0;
    $noitmes = 0;
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
        foreach ($cart as $key => $value) {
            $total += $value['qty'] * $value['unit_price'];
            $noitmes += $value['qty'];
        }
    }
    echo "<a href = 'cart.php'>" . $total . "[" . $noitmes . "]" . "</a>";
    ?>
    <div class="container-fluid checkout" style="margin-top: 120px;
         ">
        <div class="container py-5">
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
                <div class="row g-5">
                    <div class="col-md-6 pe-5">
                        <h4 class="px-0">Delivery Details</h4>
                        <div class="form-item w-100 px-0">
                            <label class="form-label my-3" for="delivery_name">Name<sup>*</sup></label>
                            <input type="text" class="form-control" id="delivery_name" name="delivery_name" required value="<?= htmlspecialchars($delivery_name); ?>">
                        </div>
                        <div class="form-item w-100 px-0">
                            <label class="form-label my-3" for="delivery_address">Address<sup>*</sup></label>
                            <input type="text" class="form-control" id="delivery_address" name="delivery_address" required value="<?= htmlspecialchars($delivery_address); ?>">
                        </div>
                        <div class="form-item px-0">
                            <label class="form-label my-3" for="delivery_phone">Phone</label>
                            <input type="text" class="form-control" id="delivery_phone" name="delivery_phone" required value="<?= htmlspecialchars($delivery_phone); ?>">
                        </div>
                        <div class="form-check my-3 px-0 ms-4">
                            <input type="checkbox" class="form-check-input" id="same_as_delivery" name="same_as_delivery" value="same_as_delivery">
                            <label class="form-check-label" for="same_as_delivery">Same as Delivery Details</label>
                        </div>
                    </div>
                    <div class="col-md-6 ps-2">
                        <h4 class="px-0">Billing Details</h4>
                        <div class="form-item w-100 px-0">
                            <label class="form-label my-3" for="billing_name">Name<sup>*</sup></label>
                            <input type="text" class="form-control" id="billing_name" name="billing_name" required value="<?= htmlspecialchars($billing_name); ?>">
                        </div>
                        <div class="form-item w-100 px-0">
                            <label class="form-label my-3" for="billing_address">Address<sup>*</sup></label>
                            <input type="text" class="form-control" id="billing_address" name="billing_address" required value="<?= htmlspecialchars($billing_address); ?>">
                        </div>
                        <div class="form-item px-0">
                            <label class="form-label my-3" for="billing_phone">Phone</label>
                            <input type="text" class="form-control" id="billing_phone" name="billing_phone" required value="<?= htmlspecialchars($billing_phone); ?>">
                        </div>
                    </div>
                </div>
                <div class="row g-5 mt-2 px-4">
                    <div class="col-md-12 ps-2">
                        <h4 class="px-0">Shipping Method</h4>
                        <div class="form-check my-3 px-0">
                            <input type="radio" class="form-check-input" id="shipping_standard" name="shipping_method" value="standard" required>
                            <label class="form-check-label" for="shipping_standard">Express Shipping</label>
                        </div>
                    </div>
                </div>
                <div class="row g-5 my-2">
                    <div class="col-md-12">
                        <h4 class="px-0">Order Summary</h4>
                        <table class="table mt-4">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Qty</th>
                                    <th>Unit Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cart as $item): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($item['item_name']); ?></td>
                                        <td><?= htmlspecialchars($item['qty']); ?></td>
                                        <td><?= number_format($item['unit_price'], 2); ?> LKR</td>
                                        <td><?= number_format($item['qty'] * $item['unit_price'], 2); ?> LKR</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between mt-3">
                            <h5>Subtotal:</h5>
                            <h5><?= number_format($total, 2); ?> LKR</h5>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <h5>Discount (3%):</h5>
                            <h5>- <?= number_format($discount, 2); ?> LKR</h5>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <h5>Shipping Cost:</h5>
                            <h5 id="shipping_cost"><?= number_format($shipping_cost, 2); ?> LKR</h5>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <h5>Total:</h5>
                            <h5 id="total_with_shipping"><?= number_format($total_with_shipping, 2); ?> LKR</h5>
                        </div>
                    </div>
                </div>
                
                <div class="row g-5 mt-5 px-4"></div>
                <div class="col-md-12 pe-5">
                        <h4 class="px-0">Payment Method</h4>
                        <div class="form-check my-3 px-0">
                            <input type="radio" class="form-check-input" id="payment_cash" name="payment_method" value="cash_on_delivery" required>
                            <label class="form-check-label" for="payment_cash">Cash on Delivery</label>
                        </div>
                        <div class="form-check my-3 px-0">
                            <input type="radio" class="form-check-input" id="payment_slip" name="payment_method" value="bank_transfer" required>
                            <label class="form-check-label" for="payment_slip">Bank Transfer</label>
                        </div>
                        <div class="form-item px-0" id="payment_slip_container" style="display: none;">
                            <label class="form-label my-3" for="payment_slip_upload">Upload Bank Slip</label>
                            <input type="file" class="form-control" id="payment_slip_upload" name="payment_slip">
                        </div>
                        <div class="form-item px-0 mt-5" id="bank_details_container" style="display: none;">
                            <h4 style="color: #dfc27d;">Bank Details</h4>
                            <p>If you select direct bank transfer as method of payment, make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be delivered until the funds have cleared in our account.</p>
                            <p>Bank: Bank of Ceylon</p>
                            <p>Branch: Tangalle</p>
                            <p>Account Name: Salon Angel</p>
                            <p>Account No: 8278000673</p>
                        </div>
                    </div>
                <div class="mt-4 mt-4">
                    <button type="submit" class="btn btn-primary p-2">Place Order</button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const shippingRadios = document.querySelectorAll('input[name="shipping_method"]');
        const shippingCostElement = document.getElementById('shipping_cost');
        const totalWithShippingElement = document.getElementById('total_with_shipping');
        const sameAsDeliveryCheckbox = document.getElementById('same_as_delivery');
        const paymentSlipContainer = document.getElementById('payment_slip_container');
        const bankDetailsContainer = document.getElementById('bank_details_container');
        const paymentSlipRadios = document.querySelectorAll('input[name="payment_method"]');

        const updateShippingCost = () => {
            let shippingCost = 0.00; // Default shipping cost is 0
            const selectedShippingMethod = document.querySelector('input[name="shipping_method"]:checked');

            if (selectedShippingMethod) {
                if (selectedShippingMethod.value === 'standard') {
                    shippingCost = 350.00; // Standard shipping cost
                }
            }

            let total = <?= json_encode($total); ?>;
            let discount = <?= json_encode($discount); ?>;

            shippingCostElement.textContent = shippingCost.toFixed(2) + ' LKR';
            totalWithShippingElement.textContent = (total - discount + shippingCost).toFixed(2) + ' LKR';
        };

        const fillBillingDetails = () => {
            if (sameAsDeliveryCheckbox.checked) {
                document.getElementById('billing_name').value = document.getElementById('delivery_name').value;
                document.getElementById('billing_address').value = document.getElementById('delivery_address').value;
                document.getElementById('billing_phone').value = document.getElementById('delivery_phone').value;
            }
        };

        const handlePaymentMethodChange = () => {
            const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
            if (paymentMethod === 'bank_transfer') {
                paymentSlipContainer.style.display = 'block';
                bankDetailsContainer.style.display = 'block'; // Show bank details
            } else {
                paymentSlipContainer.style.display = 'none';
                bankDetailsContainer.style.display = 'none'; // Hide bank details
            }
        };

        shippingRadios.forEach(radio => {
            radio.addEventListener('change', updateShippingCost);
        });

        paymentSlipRadios.forEach(radio => {
            radio.addEventListener('change', handlePaymentMethodChange);
        });

        sameAsDeliveryCheckbox.addEventListener('change', fillBillingDetails);

        updateShippingCost(); // Initialize shipping cost display
        handlePaymentMethodChange(); // Initialize payment method display
    });

</script>
