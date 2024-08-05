<?php
ob_start();
include_once '../init.php';

$link = "Attendance Management";
$breadcrumb_item = "Attendance";
$breadcrumb_item_active = "Manage";
?>

<div class="row">
    <div class="col-12">
        <!--Add 'new' button hyperlink-->
        <a href="<?= SYS_URL ?>attendance/add.php" class="btn btn-dark mb-2"><i class="fas fa-plus-circle"></i> Add New Attendance</a>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Attendance Details</h3>

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
                $sql = "SELECT a.attendance_id, a.EmployeeId, a.attendance_date, a.check_in_time, a.check_out_time, a.status
                        FROM attendance a
                        JOIN employee e ON a.EmployeeId = e.EmployeeId";
                $result = $db->query($sql);
                ?>
                <table id="attendance" class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Attendance ID</th>
                            <th>Employee ID</th>
                            <th>Attendance Date</th>
                            <th>Check-in Time</th>
                            <th>Check-out Time</th>
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
                                    <td><?= $row['attendance_id'] ?></td>
                                    <td><?= $row['EmployeeId'] ?></td>
                                    <td><?= $row['attendance_date'] ?></td>
                                    <td><?= $row['check_in_time'] ?></td>
                                    <td><?= $row['check_out_time'] ?></td>
                                    <td><?= $row['status'] ?></td>
                                    <!--Pass attendance_id to edit.php-->
                                    <td><a href="<?= SYS_URL ?>attendance/edit.php?attendance_id=<?= $row['attendance_id'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a></td>
                                    <td><a href="<?= SYS_URL ?>attendance/delete.php?attendance_id=<?= $row['attendance_id'] ?>" class="btn btn-danger" onclick="return confirmDelete()"><i class="fas fa-trash"></i> Delete</a></td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="8">No attendance records found</td>
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
    $('#attendance').DataTable({
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
