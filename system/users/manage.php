<?php
ob_start();
include_once '../init.php';

$link = "User Management";
$breadcrumb_item = "User";
$breadcrumb_item_active = "Manage";
?>

<div class="row">
    <div class="col-12">
        <!--Add 'new' button hyperlink-->
        <a href="<?= SYS_URL ?>users/add.php" class="btn btn-dark mb-2 manage-button"><i class="fas fa-plus-circle"></i> Add New User</a>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">User Details</h3>

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
                $sql = "SELECT * FROM users u "
                        . "INNER JOIN employee e ON e.UserId=u.UserId "
                        . "LEFT JOIN designations p ON p.Id=e.DesignationId";
                $result = $db->query($sql);
                ?>
                <table id="users" class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>App. Date</th>
                            <th>Designation</th>
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
                                    <td><?= $row['UserId'] ?></td>
                                    <td><?= $row['FirstName'] ?></td>
                                    <td><?= $row['LastName'] ?></td>
                                    <td><?= $row['AppDate'] ?></td>
                                    <td><?= $row['Designation'] ?></td>
                                    <!--Pass userid to edit.php-->
                                    <td><a href="<?= SYS_URL ?>users/edit.php?userid=<?= $row['UserId'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a></td>
                                    <td><a href="<?= SYS_URL ?>users/delete.php?userid=<?= $row['UserId'] ?>" class="btn btn-danger" onclick="return confirmDelete()"><i class="fas fa-trash"></i> Delete</a></td>
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

<!--Adding a datatable in this form-->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#users').DataTable({
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
