<?php
ob_start();
include_once '../init.php';

$link = "Customer Management";
$breadcrumb_item = "Customers";
$breadcrumb_item_active = "Manage";
?>

<div class="row">
    <div class="col-12">
        <!--Add 'new' button hyperlink-->
        <a href="<?= SYS_URL ?>customers/add.php" class="btn btn-dark mb-2"><i class="fas fa-plus-circle"></i> Add New Customer</a>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Customer Details</h3>

                <div class="card-tools">
                   
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <?php
                $db = dbConn();
                $sql = "SELECT * FROM customers";
                $result = $db->query($sql);
                ?>
                <table id="customers" class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Reg. No</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Address Line 1</th>
                            <th>Tel. No.</th>
                            <th>Mobile No.</th>
                            <th>Gender</th>
                            <!-- Removed District Column -->
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
                                    <td><?= htmlspecialchars($row['RegNo']) ?></td>
                                    <td><?= htmlspecialchars($row['FirstName']) ?></td>
                                    <td><?= htmlspecialchars($row['LastName']) ?></td>
                                    <td><?= htmlspecialchars($row['Email']) ?></td>
                                    <td><?= htmlspecialchars($row['AddressLine1']) ?></td>
                                    <td><?= htmlspecialchars($row['TelNo']) ?></td>
                                    <td><?= htmlspecialchars($row['MobileNo']) ?></td>
                                    <td><?= htmlspecialchars($row['Gender']) ?></td>
                                    <!-- Pass RegNo to edit.php and delete.php -->
                                    <td><a href="<?= SYS_URL ?>customers/edit.php?regno=<?= urlencode($row['RegNo']) ?>" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a></td>
                                    <td><a href="<?= SYS_URL ?>customers/delete.php?regno=<?= urlencode($row['RegNo']) ?>" class="btn btn-danger" onclick="return confirmDelete()"><i class="fas fa-trash"></i> Delete</a></td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="10">No customers found</td>
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

<!--Adding a datatable in this form-->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#customers').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
  });
</script>


<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this record?");
    }
</script>

