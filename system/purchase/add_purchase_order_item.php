<?php
ob_start();
include_once '../init.php';

$link = "Purchase Management";
$breadcrumb_item = "Purchase";
$breadcrumb_item_active = "Edit Purchase Order";

$db = dbConn();

if (isset($_GET['id'])) {
    $purchase_order_id = intval($_GET['id']);
    $sql = "SELECT * FROM purchase_order WHERE id = $purchase_order_id";
    $result = $db->query($sql);
    $purchase_order = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $purchase_order_id = intval($_POST['id']);
    $supplier_id = intval($_POST['supplier_id']);
    $order_date = $_POST['order_date'];
    $status = $_POST['status'];

    $message = array();
    if (empty($supplier_id)) {
        $message['supplier_id'] = "The Supplier ID should not be blank!";
    }
    if (empty($order_date)) {
        $message['order_date'] = "The Order Date should not be blank!";
    }
    if (empty($status)) {
        $message['status'] = "The Status should not be blank!";
    }

    if (empty($message)) {
        $sql = "UPDATE purchase_order SET supplier_id = '$supplier_id', order_date = '$order_date', status = '$status' WHERE id = $purchase_order_id";
        if ($db->query($sql)) {
            header("Location: manage_purchase_orders.php");
        } else {
            echo "Error: " . $db->error;
        }
    }
}
?>
<div class="row">
    <div class="col-12">
        <a href="manage.php" class="btn btn-info mb-2"><i class="fa fa-undo"></i> Go Back</a>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Purchase Order</h3>
            </div>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="card-body">
                    <input type="hidden" name="id" value="<?= @$purchase_order['id'] ?>">
                    <div class="form-group">
                        <label for="supplier_id">Supplier ID</label>
                        <input type="number" class="form-control" id="supplier_id" name="supplier_id" placeholder="Enter Supplier ID" value="<?= @$purchase_order['supplier_id'] ?>">
                        <span class="text-danger"><?= @$message['supplier_id'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="order_date">Order Date</label>
                        <input type="date" class="form-control" id="order_date" name="order_date" placeholder="Enter Order Date" value="<?= @$purchase_order['order_date'] ?>">
                        <span class="text-danger"><?= @$message['order_date'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" class="form-control" id="status" name="status" placeholder="Enter Status" value="<?= @$purchase_order['status'] ?>">
                        <span class="text-danger"><?= @$message['status'] ?></span>
                    </div>
                </div>
                <div class="card-footer">
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
