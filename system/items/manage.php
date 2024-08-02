<?php
ob_start();
include_once '../init.php';

$link = "Item Management";
$breadcrumb_item = "Item";
$breadcrumb_item_active = "Manage Items";

$db = dbConn();

// Fetch data from the merged tables
$query = "
    SELECT 
        items.item_id AS item_id,
        items.item_name,
        item_category.category_name,
        item_category.status AS category_status,
        item_stock.qty,
        item_stock.unit_price,
        item_stock.purchase_date,
        item_stock.issued_qty
    FROM 
        items
    LEFT JOIN 
        item_category ON items.item_category = item_category.id
    LEFT JOIN 
        item_stock ON items.item_id = item_stock.item_id
";
$result = $db->query($query);
?>

<div class="row">
    <div class="col-12">
        <a href="<?= SYS_URL ?>items/add.php" class="btn btn-dark mb-2"><i class="fas fa-plus-circle"></i> Add New Item</a>
        <a href="<?= SYS_URL ?>items/add_item_category.php" class="btn btn-dark mb-2"><i class="fas fa-plus-circle"></i> Add Item Category</a>
        <a href="<?= SYS_URL ?>items/add_item_stock.php" class="btn btn-dark mb-2"><i class="fas fa-plus-circle"></i> Add Item Stock</a>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Manage Items</h3>
            </div>
            <div class="card-body">
                <table id="items" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Item ID</th>
                            <th>Item Name</th>
                            <th>Category Name</th>
                            <th>Category Status</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Purchase Date</th>
                            <th>Issued Quantity</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['item_id']) ?></td>
                                <td><?= htmlspecialchars($row['item_name']) ?></td>
                                <td><?= htmlspecialchars($row['category_name']) ?></td>
                                <td><?= htmlspecialchars($row['category_status']) ?></td>
                                <td><?= htmlspecialchars($row['qty']) ?></td>
                                <td><?= htmlspecialchars($row['unit_price']) ?></td>
                                <td><?= htmlspecialchars($row['purchase_date']) ?></td>
                                <td><?= htmlspecialchars($row['issued_qty']) ?></td>
                                <td>
                                    <a href="edit_item.php?id=<?= $row['item_id'] ?>" class="btn btn-warning">Edit</a>
                                    <a href="delete_item.php?id=<?= $row['item_id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
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

<!--Adding a datatable in this form-->
<script>
  $(function () {
    $("#items").DataTable({
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
