<?php
ob_start();
include_once '../init.php';

$link = "Inventory Management";
$breadcrumb_item = "Inventory";
$breadcrumb_item_active = "Manage";
?> 
<div class="row">
    <div class="col-12">
        <a href="<?= SYS_URL ?>inventory/add_stock.php" class="btn btn-dark mb-2"><i class="fas fa-plus-circle"></i> Add Stock</a>
         <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
             <input type="date" name="from_date">
             <input type="date" name="to_date">
             <input type="text" name="supplier">
             <button type="submit">Search</button>
         </form>
        <div class="card">
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
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
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
               echo $sql = "SELECT
    `item_stock`.`id`
    , `items`.`item_name`
    , `item_category`.`category_name`
    , `item_stock`.`unit_price`
    , `item_stock`.`qty`
    , `item_stock`.`purchase_date`
    , `supplier`.`supplier_name`
FROM
    `items`
    INNER JOIN `item_stock` 
        ON (`items`.`id` = `item_stock`.`item_id`)
    INNER JOIN `item_category` 
        ON (`item_category`.`id` = `items`.`item_category`)
    INNER JOIN `supplier` 
        ON (`supplier`.`id` = `item_stock`.`supplier_id`) $where;";
                $result = $db->query($sql);
                ?>
                
                <table class="table table-hover text-nowrap" id="myTable">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Category</th>
                            <th>Unit Price</th>
                            <th>Qty</th>
                            <th>Purchase Date</th>
                            <th>Supplier</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?= $row['item_name'] ?></td>
                                    <td><?= $row['category_name'] ?></td>
                                    <td><?= $row['unit_price'] ?></td>
                                    <td><?= $row['qty'] ?></td>
                                    <td><?= $row['purchase_date'] ?></td>
                                    <td><?= $row['supplier_name'] ?></td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                
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


