<?php
ob_start();
include_once '../init.php';

$link = "Purchase Management";
$breadcrumb_item = "Purchase";
$breadcrumb_item_active = "Add";

$db = dbConn();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect POST data
    $supplier_id = dataClean($_POST['supplier_id']);
    $order_date = dataClean($_POST['order_date']);
    $items = $_POST['items']; // An array of item details (product_id, quantity, unit_price)

    $message = array();
    if (empty($supplier_id)) {
        $message['supplier_id'] = "The Supplier ID should not be blank!";
    }
    if (empty($order_date)) {
        $message['order_date'] = "The Order Date should not be blank!";
    }
    if (empty($items) || !is_array($items) || count($items) == 0) {
        $message['items'] = "You must add at least one item!";
    }

    if (empty($message)) {
        // Start transaction
        $db->begin_transaction();

        try {
            // Insert into purchase_order table
            $insert_order_query = "
                INSERT INTO purchase_order (supplier_id, order_date, delivery_date, status, total_amount)
                VALUES (?, ?, ?, ?, ?)
            ";
            $status = 'Pending'; // Default status
            $total_amount = 0;

            $stmt = $db->prepare($insert_order_query);
            $stmt->bind_param('isssd', $supplier_id, $order_date, $delivery_date, $status, $total_amount);
            $stmt->execute();

            // Get the last inserted ID
            $purchase_order_id = $stmt->insert_id;

            // Insert each item into purchase_order_item table and calculate total amount
            foreach ($items as $index => $item) {
                $product_id = intval($item['product_id']);
                $quantity = intval($item['quantity']);
                $unit_price = floatval($item['unit_price']);
                $total_price = $quantity * $unit_price;
                $total_amount += $total_price;

                $insert_item_query = "
                    INSERT INTO purchase_order_item (purchase_order_id, product_id, quantity, unit_price, total_price)
                    VALUES (?, ?, ?, ?, ?)
                ";
                $stmt = $db->prepare($insert_item_query);
                $stmt->bind_param('iiidd', $purchase_order_id, $product_id, $quantity, $unit_price, $total_price);
                $stmt->execute();
            }

            // Update the total amount in purchase_order table
            $update_order_query = "
                UPDATE purchase_order 
                SET total_amount = ? 
                WHERE purchase_order_id = ?
            ";
            $stmt = $db->prepare($update_order_query);
            $stmt->bind_param('di', $total_amount, $purchase_order_id);
            $stmt->execute();

            // Commit transaction
            $db->commit();

            // Redirect to manage page or success page
            header("Location: manage_purchase_orders.php?success=true");
            exit;
        } catch (Exception $e) {
            // Rollback transaction in case of error
            $db->rollback();
            $message['error'] = "Failed to add purchase order. Please try again.";
        }
    }
}
?>

<div class="row">
    <div class="col-12">
        <a href="manage.php" class="btn btn-info mb-2"><i class="fa fa-undo"></i> Go Back</a>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Add Purchase Order</h3>
            </div>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="card-body">
                    <div class="form row">
                        <div class="form-group col-md-6">
                            <label for="supplier_id">Supplier ID</label>
                            <input type="text" class="form-control" id="supplier_id" name="supplier_id" placeholder="Enter Supplier ID" value="<?= @$supplier_id ?>">
                            <span class="text-danger"><?= @$message['supplier_id'] ?></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="order_date">Order Date</label>
                            <input type="date" class="form-control" id="order_date" name="order_date" value="<?= @$order_date ?>">
                            <span class="text-danger"><?= @$message['order_date'] ?></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="delivery_date">Delivery Date</label>
                            <input type="date" class="form-control" id="delivery_date" name="delivery_date" value="<?= @$delivery_date ?>">
                        </div>
                    </div>

                    <h3>Items</h3>
                    <div id="items-container">
                        <div class="form row item">
                            <div class="form-group col-md-4">
                                <label for="product_id">Product ID</label>
                                <input type="text" class="form-control" name="items[0][product_id]" placeholder="Enter Product ID" value="<?= @$items[0]['product_id'] ?>">
                                <span class="text-danger"><?= @$message['items'] ?></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control" name="items[0][quantity]" placeholder="Enter Quantity" value="<?= @$items[0]['quantity'] ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="unit_price">Unit Price (LKR)</label>
                                <input type="number" class="form-control" name="items[0][unit_price]" placeholder="Enter Unit Price" value="<?= @$items[0]['unit_price'] ?>">
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary" onclick="addItem()">Add Another Item</button>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let itemIndex = 1;
    function addItem() {
        const container = document.getElementById('items-container');
        const newItem = document.createElement('div');
        newItem.classList.add('form', 'row', 'item');
        newItem.innerHTML = `
            <div class="form-group col-md-4">
                <label for="product_id">Product ID</label>
                <input type="text" class="form-control" name="items[${itemIndex}][product_id]" placeholder="Enter Product ID">
            </div>
            <div class="form-group col-md-4">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" name="items[${itemIndex}][quantity]" placeholder="Enter Quantity">
            </div>
            <div class="form-group col-md-4">
                <label for="unit_price">Unit Price (LKR)</label>
                <input type="number" class="form-control" name="items[${itemIndex}][unit_price]" placeholder="Enter Unit Price">
            </div>
        `;
        container.appendChild(newItem);
        itemIndex++;
    }
</script>

<?php
$content = ob_get_clean();
include '../layouts.php';
?>
