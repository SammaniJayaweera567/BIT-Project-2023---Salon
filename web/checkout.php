<?php
session_start();
ob_start(); //multiple header error removal
include 'header2.php';
include '../function.php';

// Check if user is logged in
if (!isset($_SESSION['USERID'])) {
    header("Location:login.php");
}

$total = 0;
$noitmes = 0;
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
    foreach ($cart as $key => $value) {
        $total += $value['qty'] * $value['unit_price'];
        $noitmes += $value['qty'];
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    extract($_POST);
    $delivery_name = dataClean($delivery_name);
    $delivery_address = dataClean($delivery_address);
    $delivery_phone = dataClean($delivery_phone);
    $billing_name = dataClean($billing_name);
    $billing_address = dataClean($billing_address);
    $billing_phone = dataClean($billing_phone);

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
    if (!isset($billing_name)) {
        $message['billing_name'] = "The billing name is required";
    }
    if (empty($billing_address)) {
        $message['billing_address'] = "The billing address is required";
    }
    if (empty($billing_phone)) {
        $message['billing_phone'] = "The billing phone is required";
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

        $sql = "INSERT INTO `orders`(`order_date`,`customer_id`,`delivery_name`,`delivery_address`,`delivery_phone`,`billing_name`,`billing_address`,`billing_phone`,order_number) VALUES ('$order_date','$customerid','$delivery_name','$delivery_address','$delivery_phone','$billing_name','$billing_address','$billing_phone','$order_number')";
        $db->query($sql);

        $order_id = $db->insert_id;

        foreach ($cart as $key => $value) {
            $stock_id = $value['stock_id'];
            $item_id = $value['item_id'];
            $unit_price = $value['unit_price'];
            $qty = $value['qty'];
            $sql = "INSERT INTO `order_items`(`order_id`,`item_id`,`stock_id`,`unit_price`,`qty`) VALUES ('$order_id','$item_id','$stock_id','$unit_price','$qty')";
            $db->query($sql);
        }
        header("Location:order_success.php");
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
            <h1 class="mb-4">Billing details</h1>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="row g-5">
                    <div class="col-md-12 col-lg-6 col-xl-7">
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">First Name<sup>*</sup></label>
                                    <input type="text" class="form-control" name="delivery_name" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">Last Name<sup>*</sup></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Company Name</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Address <sup>*</sup></label>
                            <input type="text" class="form-control" placeholder="House Number Street Name" name="delivery_address" required>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Town/City<sup>*</sup></label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Country<sup>*</sup></label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Postcode/Zip<sup>*</sup></label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Mobile<sup>*</sup></label>
                            <input type="tel" class="form-control" name="delivery_phone" required>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Email Address<sup>*</sup></label>
                            <input type="email" class="form-control">
                        </div>
                        <div class="form-check my-3">
                            <input type="checkbox" class="form-check-input" id="Account-1" name="Accounts" value="Accounts">
                            <label class="form-check-label" for="Account-1">Create an account?</label>
                        </div>
                        <hr>
                        <div class="form-check my-3">
                            <input class="form-check-input" type="checkbox" id="Address-1" name="same_as_delivery" value="1">
                            <label class="form-check-label" for="Address-1">Ship to a different address?</label>
                        </div>
                        <div class="form-item">
                            <textarea name="order_notes" class="form-control" spellcheck="false" cols="30" rows="11" placeholder="Order Notes (Optional)"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-5">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Products</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($cart)): ?>
                                        <?php foreach ($cart as $item): ?>
                                            <tr>
                                                <th scope="row">
                                                    <div class="d-flex align-items-center mt-2">
                                                        <img src="img/vegetable-item-2.jpg" class="img-fluid rounded-circle" style="width: 90px; height: 90px;" alt="">
                                                    </div>
                                                </th>
                                                <td><?= $item['name']; ?></td>
                                                <td><?= $item['unit_price']; ?></td>
                                                <td><?= $item['qty']; ?></td>
                                                <td><?= $item['qty'] * $item['unit_price']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4">Total</th>
                                        <td><?= $total; ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <h4 class="mt-5">Shipping</h4>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="shipping_method" id="free_shipping" value="free_shipping" checked>
                            <label class="form-check-label" for="free_shipping">Free Shipping</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="shipping_method" id="flat_rate" value="flat_rate">
                            <label class="form-check-label" for="flat_rate">Flat Rate</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="shipping_method" id="local_pickup" value="local_pickup">
                            <label class="form-check-label" for="local_pickup">Local Pickup</label>
                        </div>

                        <h4 class="mt-5">Payment Method</h4>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="bank_transfer" value="bank_transfer" checked>
                            <label class="form-check-label" for="bank_transfer">Direct Bank Transfer</label>
                            <p class="text-muted">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won't be shipped until the funds have cleared in our account.</p>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="check_payments" value="check_payments">
                            <label class="form-check-label" for="check_payments">Check Payments</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="cash_on_delivery" value="cash_on_delivery">
                            <label class="form-check-label" for="cash_on_delivery">Cash on Delivery</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="paypal" value="paypal">
                            <label class="form-check-label" for="paypal">PayPal</label>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3 w-100 py-3">Place Order</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Checkout Page End -->
</main>

<?php
include 'footer.php';
ob_end_flush();
?>
