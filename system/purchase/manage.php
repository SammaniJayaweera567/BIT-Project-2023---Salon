<?php
ob_start();
include_once '../init.php';

$link = "Purchase Management";
$breadcrumb_item = "Purchase";
$breadcrumb_item_active = "Manage Purchase Orders";

$db = dbConn();

// Fetch purchase orders
$query_po = "
    SELECT 
        po.purchase_order_id,
        po.supplier_id,
        po.order_date,
        po.status,
        s.supplier_name
    FROM 
        purchase_order po
    LEFT JOIN 
        supplier s ON po.supplier_id = s.supplier_id
";
$result_po = $db->query($query_po);

// Fetch purchase order items
$query_poi = "
    SELECT 
        poi.purchase_order_item_id,
        poi.purchase_order_id,
        poi.item_id,
        poi.quantity,
        poi.unit_price,
        poi.total_price,
        p.item_name
    FROM 
        purchase_order_item poi
    LEFT JOIN 
        items p ON poi.item_id = p.item_id
";
$result_poi = $db->query($query_poi);
?>

<div class="row">
    <div class="col-12">
        <a href="<?= SYS_URL ?>purchase/add_purchase_order.php" class="btn btn-dark mb-2"><i class="fas fa-plus-circle"></i> Add New Purchase Order</a>
        <a href="<?= SYS_URL ?>purchase/add_purchase_order_item.php" class="btn btn-dark mb-2"><i class="fas fa-plus-circle"></i> Add Purchase Order Item</a>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Manage Purchase Orders</h3>
            </div>
            <div class="card-body">
                <table id="purchase_orders" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Supplier Name</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result_po->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['purchase_order_id']) ?></td>
                                <td><?= htmlspecialchars($row['supplier_name']) ?></td>
                                <td><?= htmlspecialchars($row['order_date']) ?></td>
                                <td><?= htmlspecialchars($row['status']) ?></td>
                                <td>
                                    <a href="edit_purchase_order.php?id=<?= $row['purchase_order_id'] ?>" class="btn btn-warning">Edit</a>
                                    <a href="delete_purchase_order.php?id=<?= $row['purchase_order_id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this purchase order?')">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Manage Purchase Order Items</h3>
            </div>
            <div class="card-body">
                <table id="purchase_order_items" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Item ID</th>
                            <th>Order ID</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result_poi->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['purchase_order_item_id']) ?></td>
                                <td><?= htmlspecialchars($row['purchase_order_id']) ?></td>
                                <td><?= htmlspecialchars($row['item_name']) ?></td>
                                <td><?= htmlspecialchars($row['quantity']) ?></td>
                                <td><?= htmlspecialchars($row['unit_price']) ?></td>
                                <td><?= htmlspecialchars($row['total_price']) ?></td>
                                <td>
                                    <a href="edit_purchase_order_item.php?id=<?= $row['purchase_order_item_id'] ?>" class="btn btn-warning">Edit</a>
                                    <a href="delete_purchase_order_item.php?id=<?= $row['purchase_order_item_id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this purchase order item?')">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include '../layouts.php';
?>

<!-- Adding datatables to this form -->
<script>
  $(function () {
    $("#purchase_orders").DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

    $("#purchase_order_items").DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
