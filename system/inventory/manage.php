<?php
ob_start();
include_once '../init.php';

$link = "Inventory Management";
$breadcrumb_item = "Inventory";
$breadcrumb_item_active = "Manage Item Stock";
?>

<div class="row">
    <div class="col-12">
        <a href="<?= SYS_URL ?>inventory/add_stock.php" class="btn btn-dark mb-2"><i class="fas fa-plus-circle"></i> Add Item Stock</a>
        <a href="<?= SYS_URL ?>inventory/manage.php" class="btn btn-info mb-2"><i class="fas fa-arrow-circle-left"></i> Back</a>
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <input type="date" name="from_date">
            <input type="date" name="to_date">
            <input type="text" name="supplier">
            <button type="submit">Search</button>
        </form>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Stock Details</h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?php
                $where = null;
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    extract($_POST);
                    if (!empty($from_date) && !empty($to_date)) {
                        $where .= " (item_stock.purchase_date BETWEEN '$from_date' AND '$to_date') AND";
                    }

                    if (!empty($supplier)) {
                        $where .= " supplier.supplier_name = '$supplier' AND";
                    }

                    if (!empty($where)) {
                        $where = substr($where, 0, -3);
                        $where = " WHERE $where";
                    }
                }

                $db = dbConn();
                $sql = "SELECT
    `item_stock`.`id` AS stock_id,
    `items`.`item_name`,
    `item_category`.`category_name`,
    `item_stock`.`unit_price`,
    `item_stock`.`qty`,
    `item_stock`.`purchase_date`,
    `supplier`.`supplier_name`
FROM
    `items`
    INNER JOIN `item_stock` ON `items`.`item_id` = `item_stock`.`item_id`
    INNER JOIN `item_category` ON `item_category`.`id` = `items`.`item_category`
    INNER JOIN `supplier` ON `supplier`.`supplier_id` = `item_stock`.`supplier_id`
$where;";
                $result = $db->query($sql);
                ?>
                <table id="item_stock" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Stock ID</th>
                            <th>Item Name</th>
                            <th>Category Name</th>
                            <th>Unit Price</th>
                            <th>Quantity</th>
                            <th>Purchase Date</th>
                            <th>Supplier Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['stock_id'] ?? '') ?></td>
                                <td><?= htmlspecialchars($row['item_name'] ?? '') ?></td>
                                <td><?= htmlspecialchars($row['category_name'] ?? '') ?></td>
                                <td><?= htmlspecialchars($row['unit_price'] ?? '') ?></td>
                                <td><?= htmlspecialchars($row['qty'] ?? '') ?></td>
                                <td><?= htmlspecialchars($row['purchase_date'] ?? '') ?></td>
                                <td><?= htmlspecialchars($row['supplier_name'] ?? '') ?></td>
                                <td>
                                    <a href="edit_stock.php?id=<?= $row['stock_id'] ?>" class="btn btn-warning">Edit</a>
                                    <a href="delete_stock.php?id=<?= $row['stock_id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this stock?')">Delete</a>
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

<!-- Adding a datatable to this form -->
<script>
    $(function () {
        $("#item_stock").DataTable({
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
