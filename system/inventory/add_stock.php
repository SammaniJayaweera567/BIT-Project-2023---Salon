<?php
ob_start();
include_once '../init.php';

$link = "Item Management";
$breadcrumb_item = "Item";
$breadcrumb_item_active = "Add Item Stock";

$db = dbConn();

// Fetch suppliers for the dropdown
$supplier_query = "SELECT supplier_id, supplier_name FROM supplier";
$supplier_result = $db->query($supplier_query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    extract($_POST);
    $item_id = dataClean($item_id);
    $qty = dataClean($qty);
    $unit_price = dataClean($unit_price);
    $purchase_date = dataClean($purchase_date);
    $supplier_id = dataClean($supplier_id);
    $issued_qty = dataClean($issued_qty);

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
    $check_item_query = "SELECT * FROM items WHERE item_id = '$item_id'";
    $check_item_result = $db->query($check_item_query);
    if ($check_item_result->num_rows == 0) {
        $message['item_id'] = "Item ID does not exist!";
    }

    // If no errors, insert stock into database
    if (empty($message)) {
        $insert_query = "INSERT INTO item_stock (item_id, qty, unit_price, purchase_date, supplier_id, issued_qty) VALUES ('$item_id', '$qty', '$unit_price', '$purchase_date', '$supplier_id', '0')";
        $insert_result = $db->query($insert_query);
        if ($insert_result) {
            header("Location: manage.php");
        } else {
            $message['error'] = "Failed to add stock. Please try again.";
        }
    }
}
?>

<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Add Item Stock</h3>
            </div>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="item_id">Item Name</label>
                        <?php
                        $db = dbConn();
                        $sql = "SELECT item_id, item_name FROM items"; // Include supplier_name
                        $result = $db->query($sql);
                        ?>
                        <select class="form-control" id="item_id" name="item_id">
                            <option value="">--</option>
                            <?php while ($row = $result->fetch_assoc()) { ?>
                                <option value="<?= $row['item_id'] ?>" <?= @$item_id == $row['item_id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($row['item_name']) ?> 
                                </option>
                            <?php } ?>
                        </select>
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
                        <label for="supplier_id">Supplier</label>
                        <?php
                        $db = dbConn();
                        $sql = "SELECT supplier_id, supplier_name FROM supplier"; // Include supplier_name
                        $result = $db->query($sql);
                        ?>
                        <select class="form-control" id="supplier_id" name="supplier_id">
                            <option value="">--</option>
                            <?php while ($row = $result->fetch_assoc()) { ?>
                                <option value="<?= $row['supplier_id'] ?>" <?= @$supplier_id == $row['supplier_id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($row['supplier_name']) ?> 
                                </option>
                            <?php } ?>
                        </select>
                        <span class="text-danger"><?= @$message['supplier_id'] ?></span>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Add Stock</button>
                    <a href="manage.php" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include '../layouts.php';
?>
