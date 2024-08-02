<?php
ob_start();
include_once '../init.php';

$link = "Supplier Management";
$breadcrumb_item = "Supplier";
$breadcrumb_item_active = "Manage";
?>

<div class="row">
    <div class="col-12">
        <!-- Add 'new' button hyperlink -->
        <a href="<?= SYS_URL ?>supplier/add.php" class="btn btn-dark mb-2"><i class="fas fa-plus-circle"></i> New</a>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Supplier Details</h3>

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
                $sql = "SELECT * FROM supplier";
                $result = $db->query($sql);
                ?>
                <table id="suppliers" class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Supplier ID</th>
                            <th>Supplier Name</th>
                            <th>Register Date</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
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
                                    <td><?= $row['supplier_id'] ?></td>
                                    <td><?= $row['supplier_name'] ?></td>
                                    <td><?= $row['register_date'] ?></td>
                                    <td><?= $row['phone'] ?></td>
                                    <td><?= $row['email'] ?></td>
                                    <td><?= $row['supplier_address'] ?></td>
                                    <td><?= $row['status'] == 1 ? 'Active' : 'Inactive' ?></td>
                                    <!-- Pass id to edit.php -->
                                    <td><a href="<?= SYS_URL ?>supplier/edit.php?id=<?= $row['supplier_id'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a></td>
                                    <td><a href="<?= SYS_URL ?>supplier/delete.php?id=<?= $row['supplier_id'] ?>" class="btn btn-danger" onclick="return confirmDelete()"><i class="fas fa-trash"></i> Delete</a></td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="9">No suppliers found</td>
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

<!-- Adding a datatable in this form -->
<script>
  $(function () {
    $("#suppliers").DataTable({
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
