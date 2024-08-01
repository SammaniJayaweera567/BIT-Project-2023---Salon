<?php
ob_start();
include_once '../init.php';

$link = "Order Management";
$breadcrumb_item = "Order";
$breadcrumb_item_active = "View Items";

extract($_GET);

$db = dbConn();
$order_sql = "SELECT o.*, c.FirstName, c.LastName FROM `orders` o INNER JOIN customers c ON c.CustomerId = o.customer_id WHERE o.id = '$order_id'";
$order_result = $db->query($order_sql);
$order_row = $order_result->fetch_assoc();
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Order Items Details</h3>

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
            <div class="card-body table-responsive p-0">
                <div class="row">
                    <div class="col">
                        <div class="card m-3">
                            <div class="card-body">
                                <h4>Customer Details</h4>
                                <?= htmlspecialchars($order_row['FirstName']) ?> <?= htmlspecialchars($order_row['LastName']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card m-3">
                            <div class="card-body">
                                <h4>Billing Details</h4>
                                <?= htmlspecialchars($order_row['billing_name']) ?> 
                                <br>
                                <?= htmlspecialchars($order_row['billing_address']) ?>   
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card m-3">
                            <div class="card-body">
                                <h4>Delivery Details</h4>
                                <?= htmlspecialchars($order_row['delivery_name']) ?> 
                                <br>
                                <?= htmlspecialchars($order_row['delivery_address']) ?> 
                                <br>
                                <?= htmlspecialchars($order_row['delivery_phone']) ?> 
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                $item_sql = "SELECT order_items.item_id, items.item_name, order_items.qty, order_items.unit_price, (stock.tqty - COALESCE(stock.iqty, 0)) AS remqty 
                             FROM order_items 
                             INNER JOIN items ON items.id = order_items.item_id 
                             LEFT JOIN (
                                SELECT item_id, unit_price, SUM(qty) AS tqty, SUM(issued_qty) AS iqty 
                                FROM item_stock 
                                GROUP BY item_id, unit_price
                             ) AS stock ON stock.item_id = order_items.item_id AND stock.unit_price = order_items.unit_price 
                             WHERE order_items.order_id = '$order_id'";
                $item_result = $db->query($item_sql);
                ?>
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Unit Price</th>
                            <th>Qty</th>
                            <th>Rem.Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($item_result->num_rows > 0) {
                            while ($item_row = $item_result->fetch_assoc()) {
                                $item_id = $item_row['item_id'];
                                $unit_price = $item_row['unit_price'];
                                $remqty_sql = "SELECT (qty - COALESCE(issued_qty, 0)) as remqty FROM `item_stock` WHERE item_id = '$item_id' AND unit_price = '$unit_price'";
                                $remqty_result = $db->query($remqty_sql);
                                $remqty_row = $remqty_result->fetch_assoc();
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($item_row['item_name']) ?></td>
                                    <td><?= htmlspecialchars($unit_price) ?></td>
                                    <td><?= htmlspecialchars($item_row['qty']) ?></td>
                                    <td><?= htmlspecialchars($remqty_row['remqty']) ?></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
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
