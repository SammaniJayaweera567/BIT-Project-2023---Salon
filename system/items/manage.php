<?php
ob_start();
include_once '../init.php';

$link = "Items Management";
$breadcrumb_item = "Items";
$breadcrumb_item_active = "Manage";
?>

<div class="row">
    <div class="col-12">
        <a href="<?= SYS_URL ?>items/add.php" class="btn btn-dark mb-2"><i class="fas fa-plus-circle"></i> New</a>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Item Details</h3>

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
                $db = dbConn();
                $sql = "SELECT * FROM items";
                $result = $db->query($sql);
                ?>
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Item ID</th>
                            <th>Item Name</th>
                            <th>Item Category</th>
                            <th>Item Image</th>
                            <th>Status</th>
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
                                    <td><?= $row['id'] ?></td>
                                    <td><?= $row['item_name'] ?></td>
                                    <td><?= $row['item_category'] ?></td>
                                    <td><img src="<?= $row['item_image'] ?>" alt="<?= $row['item_name'] ?>" class="img-fluid" width="50"></td>
                                    <td><?= $row['status'] ?></td>
                                    <td><a href="<?= SYS_URL ?>items/edit.php?itemid=<?= $row['id'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a></td>
                                    <td><a href="<?= SYS_URL ?>items/delete.php?itemid=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirmDelete()"><i class="fas fa-trash"></i> Delete</a></td>
                                </tr>

                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="7">No items found</td>
                            </tr>
                            <?php
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

<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this record?");
    }
</script>
