<?php
ob_start();
include_once '../init.php';

$link = "Payment Management";
$breadcrumb_item = "Payment";
$breadcrumb_item_active = "Add";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    extract($_POST);
    $invoice_id = dataClean($invoice_id);
    $payment_date = dataClean($payment_date);
    $payment_amount = dataClean($payment_amount);
    $payment_method = dataClean($payment_method);
    $payment_type = dataClean($payment_type);
    $transaction_id = dataClean($transaction_id);

    $message = array();
    if (empty($invoice_id)) {
        $message['invoice_id'] = "The Invoice ID should not be blank!";
    }
    if (empty($payment_date)) {
        $message['payment_date'] = "The Payment Date should not be blank!";
    }
    if (empty($payment_amount)) {
        $message['payment_amount'] = "The Payment Amount should not be blank!";
    }
    if (empty($payment_method)) {
        $message['payment_method'] = "The Payment Method should not be blank!";
    }
    if (empty($payment_type)) {
        $message['payment_type'] = "The Payment Type should not be blank!";
    }
    if (empty($transaction_id)) {
        $message['transaction_id'] = "The Transaction ID should not be blank!";
    }

    if (empty($message)) {
        $db = dbConn();

        // Check if the invoice_id exists in the invoice table
        $checkInvoiceSql = "SELECT COUNT(*) as count FROM invoice WHERE invoice_id = '$invoice_id'";
        $result = $db->query($checkInvoiceSql);
        $row = $result->fetch_assoc();

        if ($row['count'] > 0) {
            // Invoice exists, proceed with insertion
            $sql = "INSERT INTO payments (invoice_id, payment_date, payment_amount, payment_method, payment_type, transaction_id) 
                    VALUES ('$invoice_id', '$payment_date', '$payment_amount', '$payment_method', '$payment_type', '$transaction_id')";
            $db->query($sql);
            header("Location: manage.php");
        } else {
            $message['invoice_id'] = "The Invoice ID does not exist!";
        }
    }
}
?>
<div class="row">
    <div class="col-12">
        <a href="" class="btn btn-dark mb-3"><i class="fas fa-plus-circle"></i> New</a>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Add New Payment</h3>
            </div>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="card-body">
                    <div class="form row">
                        <div class="form-group col-md-4">
                            <label for="invoice_id">Invoice ID</label>
                            <input type="text" class="form-control" id="invoice_id" name="invoice_id" placeholder="Enter Invoice ID" value="<?= @$invoice_id ?>">
                            <span class="text-danger"><?= @$message['invoice_id'] ?></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="payment_date">Payment Date</label>
                            <input type="date" class="form-control" id="payment_date" name="payment_date" value="<?= @$payment_date ?>">
                            <span class="text-danger"><?= @$message['payment_date'] ?></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="payment_amount">Payment Amount (LKR)</label>
                            <input type="number" class="form-control" id="payment_amount" name="payment_amount" placeholder="Enter Payment Amount" value="<?= @$payment_amount ?>">
                            <span class="text-danger"><?= @$message['payment_amount'] ?></span>
                        </div>
                    </div>

                    <div class="form row">
                        <div class="form-group col-md-6">
                            <label for="payment_method">Payment Method</label>
                            <select class="form-control" id="payment_method" name="payment_method">
                                <option value="">Select Payment Method</option>
                                <option value="Cash" <?= @$payment_method == 'Cash' ? 'selected' : '' ?>>Cash</option>
                                <option value="Bank Transfer" <?= @$payment_method == 'Bank Transfer' ? 'selected' : '' ?>>Bank Transfer</option>
                            </select>
                            <span class="text-danger"><?= @$message['payment_method'] ?></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="payment_type">Payment Type</label>
                            <select class="form-control" id="payment_type" name="payment_type">
                                <option value="">Select Payment Type</option>
                                <option value="Appointment" <?= @$payment_type == 'Appointment' ? 'selected' : '' ?>>Appointment</option>
                                <option value="Product" <?= @$payment_type == 'Product' ? 'selected' : '' ?>>Product</option>
                            </select>
                            <span class="text-danger"><?= @$message['payment_type'] ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="transaction_id">Transaction ID</label>
                        <input type="text" class="form-control" id="transaction_id" name="transaction_id" placeholder="Enter Transaction ID" value="<?= @$transaction_id ?>">
                        <span class="text-danger"><?= @$message['transaction_id'] ?></span>
                    </div>
                </div>
                <div class="card-footer">
                    <input type="hidden" name="payment_id" value="<?= $payment_id ?>">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include '../layouts.php';
?>
