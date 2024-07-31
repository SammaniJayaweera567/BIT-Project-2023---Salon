<?php
session_start();
include 'header2.php';
include '../function.php'; // Verify this path is correct and adjust if necessary.

extract($_GET);

if ($_SERVER['REQUEST_METHOD'] == 'GET' && @$action == 'del') {
    // Remove item from cart
    $cart = $_SESSION['cart'];
    unset($cart[$id]);
    $_SESSION['cart'] = $cart;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && @$action == 'empty') {
    $_SESSION['cart'] = array();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && @$action == 'update_qty') {
    $cart = $_SESSION['cart'];
    $cart[$id]['qty'] = $_GET['qty'];
    $_SESSION['cart'] = $cart;
}
?>

<main id="main cart-page">
    <!-- Cart Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="table-responsive">
                <a href="cart.php?action=empty" class="empty-card-link">Empty Cart</a>
                <table class="table cart">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        foreach ($_SESSION['cart'] as $key => $value) {
                            ?>
                            <tr>
                                <td>
                                    <img src="assets/img/<?= htmlspecialchars($value['item_image'] ?? '') ?>" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                </td>
                                <td>
                                    <p class="mb-0 mt-4"><?= htmlspecialchars($value['item_name'] ?? '') ?></p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4"><?= number_format($value['unit_price'] ?? 0, 2) ?></p>
                                </td>
                                <td>
                                    <p>
                                    <form method="get" action="cart.php">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($key) ?>">
                                        <input type="hidden" name="action" value="update_qty">
                                        <input type="number" value="<?= htmlspecialchars($value['qty'] ?? 0) ?>" name="qty" onchange="this.form.submit()">
                                    </form>
                                    </p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4"><?php
                                        $amt = ($value['unit_price'] ?? 0) * ($value['qty'] ?? 0);
                                        $total += $amt;
                                        echo number_format($amt, 2);
                                        ?></p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4"><a href="cart.php?id=<?= htmlspecialchars($key) ?>&action=del">Remove</a></p>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>Total</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-align: left"><?= number_format($total, 2) ?></td>
                        </tr>
                        <tr>
                            <td>Discount (3%)</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-align: left"><?= number_format($total * 0.03, 2) ?></td>
                        </tr>
                        <tr>
                            <td>Net</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-align: left"><?= number_format(($total - $total * 0.03), 2) ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="mt-5">
                <div class="row g-4 justify-content-end">
                    <div class="col-8"></div>
                    <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                        <div class="bg-light rounded">
                            <div class="p-4">
                                <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                                <div class="d-flex justify-content-between mb-4">
                                    <h5 class="mb-0 me-4">Subtotal:</h5>
                                    <p class="mb-0">LKR <?= number_format($total, 2) ?></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h5 class="mb-0 me-4">Shipping</h5>
                                    <p class="mb-0">Flat rate: LKR 3.00</p>
                                </div>
                                <p class="mb-0 text-end">Shipping to Sri Lanka.</p>
                            </div>
                            <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                                <h5 class="mb-0 ps-4 me-4">Total</h5>
                                <p class="mb-0 pe-4">LKR <?= number_format($total + 3, 2) ?></p>
                            </div>
                            <a href="checkout.php" class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4">Proceed Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Page End -->
</main>

<?php include 'footer.php'; ?>
