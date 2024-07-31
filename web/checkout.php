<?php
session_start();
include 'header2.php';
include '../function.php';

// Check if user is logged in
if (!isset($_SESSION['USERID'])) {
    header("Location: login.php");
    exit();
}

// Ensure you process the order and set the order_id in the session before redirecting to order_details.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['delivery_name'] = $_POST['delivery_name'];
    $_SESSION['delivery_address'] = $_POST['delivery_address'];
    $_SESSION['delivery_phone'] = $_POST['delivery_phone'];
    $_SESSION['billing_name'] = $_POST['billing_name'];
    $_SESSION['billing_address'] = $_POST['billing_address'];
    $_SESSION['billing_phone'] = $_POST['billing_phone'];

    header("Location: order_details.php");
    exit();
}

    // Set the order ID in the session
    $_SESSION['order_id'] = $order_id; // Set $order_id after processing the order

    // Redirect to order_details.php
    header("Location: order_details.php");
    exit();
}
?>

<main id="main">
    <div class="container-fluid checkout" style="margin-top: 200px;">
        <div class="container py-5">
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="row g-5">
                    <div class="col-6 pe-5">
                        <h4 class="px-0">Delivery Details</h4>
                        <div class="form-item w-100 px-0">
                            <label class="form-label my-3" for="delivery_name">Name<sup>*</sup></label>
                            <input type="text" class="form-control" id="delivery_name" name="delivery_name" required>
                        </div>
                        <div class="form-item w-100 px-0">
                            <label class="form-label my-3" for="delivery_address">Address<sup>*</sup></label>
                            <input type="text" class="form-control" id="delivery_address" name="delivery_address" required>
                        </div>
                        <div class="form-item px-0">
                            <label class="form-label my-3" for="delivery_phone">Phone</label>
                            <input type="text" class="form-control" id="delivery_phone" name="delivery_phone" required>
                        </div>
                        <div class="form-check my-3 px-0 ms-4">
                            <input type="checkbox" class="form-check-input" id="same_as_delivery" name="same_as_delivery" value="same_as_delivery">
                            <label class="form-check-label" for="same_as_delivery">Same as Delivery Details</label>
                        </div>
                    </div>
                    <div class="col-6 ps-2">
                        <h4 class="px-0">Billing Details</h4>
                        <div class="form-item w-100 px-0">
                            <label class="form-label my-3" for="billing_name">Name<sup>*</sup></label>
                            <input type="text" class="form-control" id="billing_name" name="billing_name">
                        </div>
                        <div class="form-item w-100 px-0">
                            <label class="form-label my-3" for="billing_address">Address<sup>*</sup></label>
                            <input type="text" class="form-control" id="billing_address" name="billing_address">
                        </div>
                        <div class="form-item px-0">
                            <label class="form-label my-3" for="billing_phone">Phone</label>
                            <input type="text" class="form-control" id="billing_phone" name="billing_phone">
                        </div>
                    </div>

                    <a href="order_details.php" class="btn border-secondary rounded-pill px-4 py-3 mt-5 text-primary text-uppercase mb-4">Checkout</a>
                </div>
        </div>
        </form>
    </div>
</div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sameAsDeliveryCheckbox = document.getElementById('same_as_delivery');
        const deliveryName = document.getElementById('delivery_name');
        const deliveryAddress = document.getElementById('delivery_address');
        const deliveryPhone = document.getElementById('delivery_phone');
        const billingName = document.getElementById('billing_name');
        const billingAddress = document.getElementById('billing_address');
        const billingPhone = document.getElementById('billing_phone');

        sameAsDeliveryCheckbox.addEventListener('change', function () {
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
    });
</script>

<?php include 'footer.php'; ?>
