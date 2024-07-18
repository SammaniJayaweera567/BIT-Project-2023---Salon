<?php
ob_start();
include_once '../init.php';

$link = "Item Management";
$breadcrumb_item = "Item";
$breadcrumb_item_active = "Edit Item Stock";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $stock_id = $_GET['id'];
    $db = dbConn();
    $sql = "SELECT * FROM item_stock WHERE id='$stock_id'";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();

    $item_id = $row['item_id'];
    $qty = $row['qty'];
    $unit_price = $row['unit_price'];
    $purchase_date = $row['purchase_date'];
    $supplier_id = $row['supplier_id'];
    $issued_qty = $row['issued_qty'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    extract($_POST);
    $item_id = dataClean($item_id);
    $qty = dataClean($qty);
    $unit_price = dataClean($unit_price);
    $purchase_date = dataClean($purchase_date);
    $supplier_id = dataClean($supplier_id);
    $issued_qty = dataClean($issued_qty);
    $stock_id = dataClean($stock_id);

    $message = array();
    if (empty($item_id)) {
        $message['item_id'] = "The Item ID should not be blank!";
    }
    if (empty($qty)) {
        $message['qty'] = "The Quantity should not be blank!";
    } elseif (!is_numeric($qty) || $qty <= 0) {
        $message['qty'] = "The Quantity should be a positive number!";
    }
    if (empty($unit_price)) {
        $message['unit_price'] = "The Unit Price should not be blank!";
    } elseif (!is_numeric($unit_price) || $unit_price <= 0) {
        $message['unit_price'] = "The Unit Price should be a positive number!";
    }
    if (empty($purchase_date)) {
        $message['purchase_date'] = "The Purchase Date should not be blank!";
    }
    if (empty($supplier_id)) {
        $message['supplier_id'] = "The Supplier ID should not be blank!";
    }
    if (empty($issued_qty)) {
        $issued_qty = 0; // Set issued_qty to 0 if not provided
    } elseif (!is_numeric($issued_qty) || $issued_qty < 0) {
        $message['issued_qty'] = "The Issued Quantity should be a non-negative number!";
    }

    // Check if item ID exists
    $db = dbConn();
    $check_item_query = "SELECT * FROM items WHERE id = '$item_id'";
    $check_item_result = $db->query($check_item_query);
    if ($check_item_result->num_rows == 0) {
        $message['item_id'] = "Item ID does not exist!";
    }

    // If no errors, update stock in the database
    if (empty($message)) {
        $update_query = "UPDATE item_stock SET item_id='$item_id', qty='$qty', unit_price='$unit_price', purchase_date='$purchase_date', supplier_id='$supplier_id', issued_qty='$issued_qty' WHERE id='$stock_id'";
        $update_result = $db->query($update_query);
        if ($update_result) {
            header("Location: manage_stock.php");
        } else {
            $message['error'] = "Failed to update stock. Please try again.";
        }
    }
}
?>

<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Item Stock</h3>
            </div>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <input type="hidden" name="stock_id" value="<?= $stock_id ?>">
                <div class="card-body">
                    <div class="form-group">
                        <label for="item_id">Item ID</label>
                        <input type="number" class="form-control" id="item_id" name="item_id" placeholder="Enter Item ID" value="<?= isset($item_id) ? htmlspecialchars($item_id) : '' ?>">
                        <span class="text-danger"><?= @$message['item_id'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="qty">Quantity</label>
                        <input type="number" class="form-control" id="qty" name="qty" placeholder="Enter Quantity" value="<?= isset($qty) ? htmlspecialchars($qty) : '' ?>">
                        <span class="text-danger"><?= @$message['qty'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="unit_price">Unit Price</label>
                        <input type="number" class="form-control" id="unit_price" name="unit_price" placeholder="Enter Unit Price" value="<?= isset($unit_price) ? htmlspecialchars($unit_price) : '' ?>">
                        <span class="text-danger"><?= @$message['unit_price'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="purchase_date">Purchase Date</label>
                        <input type="date" class="form-control" id="purchase_date" name="purchase_date" value="<?= isset($purchase_date) ? htmlspecialchars($purchase_date) : '' ?>">
                        <span class="text-danger"><?= @$message['purchase_date'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="supplier_id">Supplier ID</label>
                        <input type="number" class="form-control" id="supplier_id" name="supplier_id" placeholder="Enter Supplier ID" value="<?= isset($supplier_id) ? htmlspecialchars($supplier_id) : '' ?>">
                        <span class="text-danger"><?= @$message['supplier_id'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="issued_qty">Issued Quantity</label>
                        <input type="number" class="form-control" id="issued_qty" name="issued_qty" placeholder="Enter Issued Quantity" value="<?= isset($issued_qty) ? htmlspecialchars($issued_qty) : 0 ?>">
                        <span class="text-danger"><?= @$message['issued_qty'] ?></span>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update Stock</button>
                    <a href="manage_stock.php" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include '../layouts.php';
?>
