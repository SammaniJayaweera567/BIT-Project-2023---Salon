<?php
ob_start();
include_once '../init.php';

$link = "Courier Management";
$breadcrumb_item = "Courier";
$breadcrumb_item_active = "Manage";
?>

<div class="row">
    <div class="col-12">
        <!-- Add 'new' button hyperlink -->
        <a href="<?= SYS_URL ?>couriers/add.php" class="btn btn-dark mb-2 manage-button"><i class="fas fa-plus-circle"></i> New</a>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Courier Details</h3>

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
                $sql = "SELECT * FROM courier";
                $result = $db->query($sql);
                ?>
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Courier Name</th>
                            <th>Company Name</th>
                            <th>Company Address</th>
                            <th>Company Phone No</th>
                            <th>Company Email</th>
                            <th>Mobile Number</th>
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
                                    <td><?= $row['courier_id'] ?></td>
                                    <td><?= $row['courier_name'] ?></td>
                                    <td><?= $row['company_name'] ?></td>
                                    <td><?= $row['company_address'] ?></td>
                                    <td><?= $row['company_phone_no'] ?></td>
                                    <td><?= $row['company_email'] ?></td>
                                    <td><?= $row['mobile_number'] ?></td>
                                    <!-- Pass courier_id to edit.php -->
                                    <td><a href="<?= SYS_URL ?>couriers/edit.php?courier_id=<?= $row['courier_id'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a></td>
                                    <td><a href="<?= SYS_URL ?>couriers/delete.php?courier_id=<?= $row['courier_id'] ?>" class="btn btn-danger" onclick="return confirmDelete()"><i class="fas fa-trash"></i> Delete</a></td>
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

<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this record?");
    }
</script>
