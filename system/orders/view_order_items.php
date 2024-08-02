<?php
ob_start();
include_once '../init.php';

$link = "Order Management";
$breadcrumb_item = "Order";
$breadcrumb_item_active = "View Items";

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
}

$db = dbConn();
$sql = "SELECT o.*, c.FirstName, c.LastName FROM `orders` o 
        INNER JOIN customers c ON c.CustomerId = o.customer_id 
        WHERE o.id = ?";
$stmt = $db->prepare($sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Order Item Details</h3>
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
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h4>Customer Details</h4>
                                <?= htmlspecialchars($row['FirstName']) ?> <?= htmlspecialchars($row['LastName']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h4>Billing Details</h4>
                                <?= htmlspecialchars($row['billing_name']) ?>
                                <br>
                                <?= htmlspecialchars($row['billing_address']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h4>Delivery Details</h4>
                                <?= htmlspecialchars($row['delivery_name']) ?>
                                <br>
                                <?= htmlspecialchars($row['delivery_address']) ?>
                                <br>
                                <?= htmlspecialchars($row['delivery_phone']) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $sql = "SELECT o.order_id, o.item_id, o.unit_price, SUM(o.qty) AS total_qty, i.item_name,
                               (COALESCE(stock_totals.total_qty, 0) - COALESCE(stock_totals.total_issued_qty, 0)) AS balance_qty
                        FROM order_items o 
                        INNER JOIN items i ON i.id = o.item_id 
                        LEFT JOIN (
                            SELECT item_id, unit_price, SUM(qty) AS total_qty, SUM(issued_qty) AS total_issued_qty 
                            FROM item_stock 
                            GROUP BY item_id, unit_price
                        ) AS stock_totals ON stock_totals.item_id = o.item_id AND stock_totals.unit_price = o.unit_price
                        WHERE o.order_id = ?
                        GROUP BY o.order_id, o.item_id, o.unit_price, i.item_name, balance_qty";
                $stmt = $db->prepare($sql);
                $stmt->bind_param("i", $order_id);
                $stmt->execute();
                $result = $stmt->get_result();
                ?>
                <form action="../inventory/issue.php" method="post">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Unit Price</th>
                                <th>Ordered Qty</th>
                                <th>Balance Qty</th>
                                <th>Issued Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['item_name']) ?></td>
                                        <td><?= htmlspecialchars($row['unit_price']) ?></td>
                                        <td><?= htmlspecialchars($row['total_qty']) ?></td>
                                        <td><?= htmlspecialchars($row['balance_qty']) ?></td>
                                        <td>
                                            <input type="hidden" name="items[]" value="<?= htmlspecialchars($row['item_id']) ?>">
                                            <input type="hidden" name="order_id" value="<?= htmlspecialchars($row['order_id']) ?>">
                                            <input type="hidden" name="prices[]" value="<?= htmlspecialchars($row['unit_price']) ?>">
                                            <input type="text" name="issued_qty[]" required>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary">Issue</button>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<?php
$content = ob_get_clean();
include '../layouts.php';
?>
