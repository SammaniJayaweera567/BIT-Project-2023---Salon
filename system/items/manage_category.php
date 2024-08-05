<?php
ob_start();
include_once '../init.php';

$link = "Item Management";
$breadcrumb_item = "Item";
$breadcrumb_item_active = "Manage Item Categories";

$db = dbConn();

// Fetch item categories from the database
$query = "SELECT id, category_name, status FROM item_category";
$result = $db->query($query);
?>

<div class="row">
    <div class="col-12">
        <a href="<?= SYS_URL ?>items/add_category.php" class="btn btn-dark mb-2"><i class="fas fa-plus-circle"></i> Add Item Category</a>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Manage Item Categories</h3>
            </div>
            <div class="card-body">
                <table id="categories" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Category ID</th>
                            <th>Category Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['id']) ?></td>
                                <td><?= htmlspecialchars($row['category_name']) ?></td>
                                <td>
                                    <?php if ($row['status'] == 1): ?>
                                        <span class="badge badge-success">Active</span>
                                    <?php else: ?>
                                        <span class="badge badge-danger">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="edit_category.php?id=<?= $row['id'] ?>" class="btn btn-warning">Edit</a>
                                    <a href="delete_category.php?id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
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

<!-- Adding a datatable to this form -->
<script>
  $(function () {
    $("#categories").DataTable({
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

