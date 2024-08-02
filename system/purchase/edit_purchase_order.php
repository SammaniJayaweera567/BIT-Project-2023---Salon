<?php
include_once '../init.php';

$link = "Purchase Management";
$breadcrumb_item = "Purchase";
$breadcrumb_item_active = "Edit";

$db = dbConn();

if (!isset($_GET['id'])) {
    echo "No purchase order ID provided.";
    exit;
}

$purchase_order_id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect POST data
    $supplier_id = intval($_POST['supplier_id']);
    $order_date = $_POST['order_date'];
    $items = $_POST['items']; // An array of item details (purchase_order_item_id, product_id, quantity, unit_price)

    // Start transaction
    $db->begin_transaction();

    try {
        // Update purchase_order table
        $update_order_query = "
            UPDATE purchase_order
            SET supplier_id = ?, order_date = ?
            WHERE purchase_order_id = ?
        ";
        $stmt = $db->prepare($update_order_query);
        $stmt->bind_param('isi', $supplier_id, $order_date, $purchase_order_id);
        $stmt->execute();

        // Delete existing items
        $delete_items_query = "
            DELETE FROM purchase_order_item
            WHERE purchase_order_id = ?
        ";
        $stmt = $db->prepare($delete_items_query);
        $stmt->bind_param('i', $purchase_order_id);
        $stmt->execute();

        // Insert updated items into purchase_order_item table
        foreach ($items as $item) {
            $product_id = intval($item['product_id']);
            $quantity = intval($item['quantity']);
            $unit_price = floatval($item['unit_price']);
            $total_price = $quantity * $unit_price;

            $insert_item_query = "
                INSERT INTO purchase_order_item (purchase_order_id, product_id, quantity, unit_price, total_price)
                VALUES (?, ?, ?, ?, ?)
            ";
            $stmt = $db->prepare($insert_item_query);
            $stmt->bind_param('iiidd', $purchase_order_id, $product_id, $quantity, $unit_price, $total_price);
            $stmt->execute();
        }

        // Commit transaction
        $db->commit();

        // Redirect to manage page or success page
        header("Location: manage_purchase_orders.php?success=true");
        exit;
    } catch (Exception $e) {
        // Rollback transaction in case of error
        $db->rollback();
        echo "Failed to update purchase order. Please try again.";
    }
} else {
    // Fetch purchase order data
    $query = "
        SELECT 
            po.supplier_id, po.order_date, 
            poi.purchase_order_item_id, poi.product_id, poi.quantity, poi.unit_price
        FROM 
            purchase_order po
        LEFT JOIN 
            purchase_order_item poi ON po.purchase_order_id = poi.purchase_order_id
        WHERE 
            po.purchase_order_id = ?
    ";
    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $purchase_order_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $purchase_order = $result->fetch_all(MYSQLI_ASSOC);
    if (!$purchase_order) {
        echo "Purchase order not found.";
        exit;
    }
    $order_date = $purchase_order[0]['order_date'];
    $supplier_id = $purchase_order[0]['supplier_id'];
    $items = [];
    foreach ($purchase_order as $po) {
        $items[] = [
            'purchase_order_item_id' => $po['purchase_order_item_id'],
            'product_id' => $po['product_id'],
            'quantity' => $po['quantity'],
            'unit_price' => $po['unit_price']
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Purchase Order</title>
    <link rel="stylesheet" href="../path/to/your/css/styles.css">
</head>
<body>
    <h1>Edit Purchase Order</h1>
    <form action="edit_purchase_order.php?id=<?= $purchase_order_id ?>" method="POST">
        <label for="supplier_id">Supplier ID:</label>
        <input type="text" id="supplier_id" name="supplier_id" value="<?= htmlspecialchars($supplier_id) ?>" required><br>

        <label for="order_date">Order Date:</label>
        <input type="date" id="order_date" name="order_date" value="<?= htmlspecialchars($order_date) ?>" required><br>

        <h3>Items</h3>
        <div id="items-container">
            <?php foreach ($items as $index => $item): ?>
                <div class="item">
                    <label for="product_id">Product ID:</label>
                    <input type="text" name="items[<?= $index ?>][product_id]" value="<?= htmlspecialchars($item['product_id']) ?>" required><br>

                    <label for="quantity">Quantity:</label>
                    <input type="number" name="items[<?= $index ?>][quantity]" value="<?= htmlspecialchars($item['quantity']) ?>" required><br>

                    <label for="unit_price">Unit Price:</label>
                    <input type="number" step="0.01" name="items[<?= $index ?>][unit_price]" value="<?= htmlspecialchars($item['unit_price']) ?>" required><br>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="button" onclick="addItem()">Add Another Item</button><br>

        <button type="submit">Update Purchase Order</button>
    </form>

    <script>
        let itemIndex = <?= count($items) ?>;
        function addItem() {
            const container = document.getElementById('items-container');
            const newItem = document.createElement('div');
            newItem.classList.add('item');
            newItem.innerHTML = `
                <label for="product_id">Product ID:</label>
                <input type="text" name="items[${itemIndex}][product_id]" required><br>

                <label for="quantity">Quantity:</label>
                <input type="number" name="items[${itemIndex}][quantity]" required><br>

                <label for="unit_price">Unit Price:</label>
                <input type="number" step="0.01" name="items[${itemIndex}][unit_price]" required><br>
            `;
            container.appendChild(newItem);
            itemIndex++;
        }
    </script>
</body>
</html>
