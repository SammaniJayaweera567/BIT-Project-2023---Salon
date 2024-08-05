<?php
ob_start();
include_once '../init.php';

$link = "Leave Management";
$breadcrumb_item = "Leave";
$breadcrumb_item_active = "Manage";
?>

<div class="row">
    <div class="col-12">
        <!--Add 'new' button hyperlink-->
        <a href="<?= SYS_URL ?>leave/add.php" class="btn btn-dark mb-2"><i class="fas fa-plus-circle"></i> Add New Leave</a>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Leave Details</h3>

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
                $sql = "SELECT * FROM `leave`";
                $result = $db->query($sql);
                ?>
                <table id="leave" class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Leave ID</th>
                            <th>Employee ID</th>
                            <th>Leave Type</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Notes</th>
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
                                    <td><?= $row['leave_id'] ?></td>
                                    <td><?= $row['EmployeeId'] ?></td>
                                    <td><?= $row['leave_type'] ?></td>
                                    <td><?= $row['start_date'] ?></td>
                                    <td><?= $row['end_date'] ?></td>
                                    <td><?= $row['status'] ?></td>
                                    <td><?= $row['notes'] ?></td>
                                    <!--Pass leave_id to edit.php-->
                                    <td><a href="<?= SYS_URL ?>leave/edit.php?leave_id=<?= $row['leave_id'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a></td>
                                    <td><a href="<?= SYS_URL ?>leave/delete.php?leave_id=<?= $row['leave_id'] ?>" class="btn btn-danger" onclick="return confirmDelete()"><i class="fas fa-trash"></i> Delete</a></td>
                                </tr>

                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="9">No leave records found</td>
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

<!--Adding a datatable in this form-->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#leave').DataTable({
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
