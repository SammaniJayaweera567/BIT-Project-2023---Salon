<?php
ob_start();
include_once '../init.php';

$link = "Service Management";
$breadcrumb_item = "Service";
$breadcrumb_item_active = "Manage";
?>

<div class="row">
    <div class="col-12">
        <!--Add 'new' button hyperlink-->
        <a href="<?= SYS_URL ?>services/add.php" class="btn btn-dark mb-2"><i class="fas fa-plus-circle"></i> New</a>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Service Details</h3>

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
                $sql = "SELECT * FROM services";
                $result = $db->query($sql);
                ?>
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Service ID</th>
                            <th>Service Category Name</th>
                            <th>Sub Service Name</th>
                            <th>Service Name</th>
                            <th>Description</th>
                            <th>Duration (minutes)</th>
                            <th>Price (LKR)</th>
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
                                    <td><?= $row['ServiceId'] ?></td>
                                    <td><?= $row['ServiceCategoryName'] ?></td>
                                    <td><?= $row['SubServiceName'] ?></td>
                                    <td><?= $row['ServiceName'] ?></td>
                                    <td><?= $row['Description'] ?></td>
                                    <td><?= $row['Duration'] ?></td>
                                    <td><?= $row['Price'] ?></td>
                                    <!--Pass serviceid to edit.php-->
                                    <td><a href="<?= SYS_URL ?>services/edit.php?serviceid=<?= $row['ServiceId'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a></td>
                                    <td><a href="<?= SYS_URL ?>services/delete.php?serviceid=<?= $row['ServiceId'] ?>" class="btn btn-danger" onclick="return confirmDelete()"><i class="fas fa-trash"></i> Delete</a></td>
                                </tr>

                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="9">No services found</td>
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
