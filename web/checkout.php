<?php
session_start();
include 'header2.php';
include '../function.php';

// Check if user is logged in
if (!isset($_SESSION['USERID'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Existing validation and order insertion code

    if (empty($message)) {
        $_SESSION['order_id'] = $order_id; // Store the order ID in the session
        // Instead of redirecting here, JavaScript will handle the redirection
        echo 'order_id=' . $order_id;
        exit();
    }
}

$total = 0;
$noitmes = 0;
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
foreach ($cart as $item) {
    $total += $item['qty'] * $item['unit_price'];
    $noitmes += $item['qty'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    extract($_POST);
    $delivery_name = dataClean($delivery_name);
    $delivery_address = dataClean($delivery_address);
    $delivery_phone = dataClean($delivery_phone);
    $billing_name = dataClean($billing_name);
    $billing_address = dataClean($billing_address);
    $billing_phone = dataClean($billing_phone);
    $shipping_method = isset($shipping_method) ? dataClean($shipping_method) : '';
    $payment_method = isset($payment_method) ? dataClean($payment_method) : '';
    $payment_slip = isset($_FILES['payment_slip']) ? $_FILES['payment_slip'] : null;

    $message = array();
    // Required validation
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
        // Pick customer id
        $sql = "SELECT CustomerId FROM customers WHERE UserId='$userid'";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        $customerid = $row['CustomerId'];
        $order_date = date('Y-m-d');
        $order_number = date('Y') . date('m') . date('d') . $customerid;

        $sql = "INSERT INTO orders(order_date, customer_id, delivery_name, delivery_address, delivery_phone, billing_name, billing_address, billing_phone, order_number, shipping_method, payment_method) VALUES ('$order_date', '$customerid', '$delivery_name', '$delivery_address', '$delivery_phone', '$billing_name', '$billing_address', '$billing_phone', '$order_number', '$shipping_method', '$payment_method')";
        $db->query($sql);

        $order_id = $db->insert_id;

        $cart = $_SESSION['cart'];

        foreach ($cart as $key => $value) {
            $stock_id = $value['stock_id'];
            $item_id = $value['item_id'];
            $unit_price = $value['unit_price'];
            $qty = $value['qty'];
            $sql = "INSERT INTO order_items(order_id, item_id, stock_id, unit_price, qty) VALUES ('$order_id', '$item_id', '$stock_id', '$unit_price', '$qty')";
            $db->query($sql);
        }

        if ($payment_method == 'bank_slip' && $payment_slip) {
            // Handle file upload
            $upload_dir = '../uploads/';
            $upload_file = $upload_dir . basename($payment_slip['name']);
            if (move_uploaded_file($payment_slip['tmp_name'], $upload_file)) {
                // Store file path in the database or further process
                $sql = "UPDATE orders SET payment_slip = '$upload_file' WHERE order_id = '$order_id'";
                $db->query($sql);
            } else {
                $message['payment_slip'] = "Failed to upload bank slip.";
            }
        }

        if (empty($message)) {
            $_SESSION['order_id'] = $order_id; // Store the order ID in the session
            header("Location: order_history.php?status=success");
            exit();
        }
    }
}
?>

<main id="main">
    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="input-group w-75 mx-auto d-flex">
                        <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Search End -->

    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Checkout</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Checkout</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Checkout Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                <div class="row g-5">
                    <div class="col-md-12 col-lg-6 col-xl-7">
                        <div class="row">
                            <h4 class="px-0">Delivery Details</h4>
                            <div class="form-item w-100 px-0">
                                <label class="form-label my-3" for="delivery_name">Name<sup>*</sup></label>
                                <input type="text" class="form-control" id="delivery_name" name="delivery_name" required>
                                <?php if (isset($message['delivery_name'])): ?>
                                    <div class="text-danger"><?= $message['delivery_name']; ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="form-item w-100 px-0">
                                <label class="form-label my-3" for="delivery_address">Address<sup>*</sup></label>
                                <input type="text" class="form-control" id="delivery_address" name="delivery_address" required>
                                <?php if (isset($message['delivery_address'])): ?>
                                    <div class="text-danger"><?= $message['delivery_address']; ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="form-item px-0">
                                <label class="form-label my-3" for="delivery_phone">Phone</label>
                                <input type="text" class="form-control" id="delivery_phone" name="delivery_phone" required>
                                <?php if (isset($message['delivery_phone'])): ?>
                                    <div class="text-danger"><?= $message['delivery_phone']; ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="form-check my-3 px-0 ms-4">
                                <input type="checkbox" class="form-check-input" id="same_as_delivery" name="same_as_delivery" value="same_as_delivery">
                                <label class="form-check-label" for="same_as_delivery">Same as Delivery Details</label>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <h4 class="px-0">Billing Details</h4>
                            <div class="form-item w-100 px-0">
                                <label class="form-label my-3" for="billing_name">Name<sup>*</sup></label>
                                <input type="text" class="form-control" id="billing_name" name="billing_name">
                                <?php if (isset($message['billing_name'])): ?>
                                    <div class="text-danger"><?= $message['billing_name']; ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="form-item w-100 px-0">
                                <label class="form-label my-3" for="billing_address">Address<sup>*</sup></label>
                                <input type="text" class="form-control" id="billing_address" name="billing_address">
                                <?php if (isset($message['billing_address'])): ?>
                                    <div class="text-danger"><?= $message['billing_address']; ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="form-item px-0">
                                <label class="form-label my-3" for="billing_phone">Phone</label>
                                <input type="text" class="form-control" id="billing_phone" name="billing_phone">
                                <?php if (isset($message['billing_phone'])): ?>
                                    <div class="text-danger"><?= $message['billing_phone']; ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-5">
                        <div class="row">
                            <h4 class="px-0">Order Summary</h4>
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cart as $item): ?>
                                        <tr>
                                            <td><img src="assets/img/<?= htmlspecialchars($value['item_image'] ?? '') ?>" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt=""></td>
                                            <td><?= $item['item_name']; ?></td>
                                            <td>LKR <?= number_format($item['unit_price'], 2); ?></td>
                                            <td><?= $item['qty']; ?></td>
                                            <td>LKR <?= number_format($item['qty'] * $item['unit_price'], 2); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td></td>
                                        <td colspan="3" class="text-end">Total:</td>
                                        <td><strong>LKR <?= number_format($total, 2); ?></strong></td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <div class="form-item w-100 px-0">
                                <label class="form-label my-3" for="shipping_method">Shipping Method<sup>*</sup></label>
                                <select id="shipping_method" name="shipping_method" class="form-control" required>
                                    <option value="">Select Shipping Method</option>
                                    <option value="standard">Standard Shipping</option>
                                    <option value="express">Express Shipping</option>
                                </select>
                                <?php if (isset($message['shipping_method'])): ?>
                                    <div class="text-danger"><?= $message['shipping_method']; ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="form-item w-100 px-0">
                                <label class="form-label my-3" for="payment_method">Payment Method<sup>*</sup></label>
                                <select id="payment_method" name="payment_method" class="form-control" required>
                                    <option value="">Select Payment Method</option>
                                    <option value="credit_card">Credit Card</option>
                                    <option value="bank_slip">Bank Slip</option>
                                    <option value="cash_on_delivery">Cash on Delivery</option>
                                </select>
                                <?php if (isset($message['payment_method'])): ?>
                                    <div class="text-danger"><?= $message['payment_method']; ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="form-item w-100 px-0" id="payment_slip_container" style="display: none;">
                                <label class="form-label my-3" for="payment_slip">Upload Bank Slip</label>
                                <input type="file" class="form-control" id="payment_slip" name="payment_slip">
                                <?php if (isset($message['payment_slip'])): ?>
                                    <div class="text-danger"><?= $message['payment_slip']; ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary w-100">Place Order</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Checkout Page End -->
</main>

<!-- JavaScript to copy billing details from delivery details -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sameAsDeliveryCheckbox = document.getElementById('same_as_delivery');
    const deliveryName = document.getElementById('delivery_name');
    const deliveryAddress = document.getElementById('delivery_address');
    const deliveryPhone = document.getElementById('delivery_phone');
    const billingName = document.getElementById('billing_name');
    const billingAddress = document.getElementById('billing_address');
    const billingPhone = document.getElementById('billing_phone');
    const paymentMethodSelect = document.getElementById('payment_method');
    const paymentSlipContainer = document.getElementById('payment_slip_container');

    sameAsDeliveryCheckbox.addEventListener('change', function() {
        if (this.checked) {
            billingName.value = deliveryName.value;
            billingAddress.value = deliveryAddress.value;
            billingPhone.value = deliveryPhone.value;
        } else {
            billingName.value = '';
            billingAddress.value = '';
            billingPhone.value = '';
        }
    });

    paymentMethodSelect.addEventListener('change', function() {
        if (this.value === 'bank_slip') {
            paymentSlipContainer.style.display = 'block';
        } else {
            paymentSlipContainer.style.display = 'none';
        }
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission
        
        const formData = new FormData(form);
        fetch(form.action, {
            method: 'POST',
            body: formData
        }).then(response => response.text())
          .then(data => {
              // Check for success and redirect
              if (data.includes('order_id')) {
                  window.location.href = 'order_history.php?status=success';
              } else {
                  // Handle errors or display messages as needed
                  alert('Order placement failed.');
              }
          }).catch(error => {
              console.error('Error:', error);
          });
    });

    // Additional JavaScript as before
});
</script>


<?php include 'footer.php'; ?>
