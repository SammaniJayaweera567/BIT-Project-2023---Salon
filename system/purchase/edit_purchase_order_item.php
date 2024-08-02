<?php
ob_start();
include_once '../init.php';

$link = "Purchase Management";
$breadcrumb_item = "Purchase";
$breadcrumb_item_active = "Edit Purchase Order Item";

$db = dbConn();

if (isset($_GET['id'])) {
    $item_id = intval($_GET['id']);
    $sql = "SELECT * FROM purchase_order_item WHERE id = $item_id";
    $result = $db->query($sql);
    $purchase_order_item = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_id = intval($_POST['id']);
    $purchase_order_id = intval($_POST['purchase_order_id']);
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);
    $unit_price = floatval($_POST['unit_price']);
    $total_price = $quantity * $unit_price;

    $message = array();
    if (empty($purchase_order_id)) {
        $message['purchase_order_id'] = "The Purchase Order ID should not be blank!";
    }
    if (empty($product_id)) {
        $message['product_id'] = "The Product ID should not be blank!";
    }
    if (empty($quantity)) {
        $message['quantity'] = "The Quantity should not be blank!";
    }
    if (empty($unit_price)) {
        $message['unit_price'] = "The Unit Price should not be blank!";
    }

    if (empty($message)) {
        $sql = "UPDATE purchase_order_item SET purchase_order_id = '$purchase_order_id', product_id = '$product_id', quantity = '$quantity', unit_price = '$unit_price', total_price = '$total_price' WHERE id = $item_id";
        if ($db->query($sql)) {
            header("Location: manage_purchase_order_item.php");
        } else {
            echo "Error: " . $db->error;
        }
    }
}
?>
<div class="row">
    <div class="col-12">
        <a href="manage_purchase_order_items.php" class="btn btn-dark mb-3"><i class="fas fa-arrow-left"></i> Back</a>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Purchase Order Item</h3>
            </div>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="card-body">
                    <input type="hidden" name="id" value="<?= @$purchase_order_item['id'] ?>">
                    <div class="form row">
                        <div class="form-group col-md-6">
                            <label for="purchase_order_id">Purchase Order ID</label>
                            <input type="number" class="form-control" id="purchase_order_id" name="purchase_order_id" placeholder="Enter Purchase Order ID" value="<?= @$purchase_order_item['purchase_order_id'] ?>">
                            <span class="text-danger"><?= @$message['purchase_order_id'] ?></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="product_id">Product ID</label>
                            <input type="number" class="form-control" id="product_id" name="product_id" placeholder="Enter Product ID" value="<?= @$purchase_order_item['product_id'] ?>">
                            <span class="text-danger"><?= @$message['product_id'] ?></span>
                        </div>
                    </div>

                    <div class="form row">
                        <div class="form-group col-md-6">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity" value="<?= @$purchase_order_item['quantity'] ?>">
                            <span class="text-danger"><?= @$message['quantity'] ?></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="unit_price">Unit Price (LKR)</label>
                            <input type="number" step="0.01" class="form-control" id="unit_price" name="unit_price" placeholder="Enter Unit Price" value="<?= @$purchase_order_item['unit_price'] ?>">
                            <span class="text-danger"><?= @$message['unit_price'] ?></span>
                        </div>
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
