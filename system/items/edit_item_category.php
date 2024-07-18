<?php
ob_start();
include_once '../init.php';

$link = "Item Management";
$breadcrumb_item = "Item";
$breadcrumb_item_active = "Edit Category";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $category_id = $_GET['id'];
    $db = dbConn();
    $sql = "SELECT * FROM item_category WHERE id='$category_id'";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();

    $category_name = $row['category_name'];
    $status = $row['status'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    extract($_POST);
    $category_name = dataClean($category_name);
    $status = dataClean($status); // Added status field
    $category_id = dataClean($category_id);

    $message = array();
    if (empty($category_name)) {
        $message['category_name'] = "The Category Name should not be blank!";
    }
    if (empty($status)) {
        $message['status'] = "The Status should not be blank!";
    }

    // Check if category name already exists
    $db = dbConn();
    $check_query = "SELECT * FROM item_category WHERE category_name = '$category_name' AND id != '$category_id'";
    $check_result = $db->query($check_query);
    if ($check_result->num_rows > 0) {
        $message['category_name'] = "Category Name already exists!";
    }

    // If no errors, update category in the database
    if (empty($message)) {
        $update_query = "UPDATE item_category SET category_name='$category_name', status='$status' WHERE id='$category_id'";
        $update_result = $db->query($update_query);
        if ($update_result) {
            header("Location: manage.php");
        } else {
            $message['error'] = "Failed to update category. Please try again.";
        }
    }
}
?>

<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Item Category</h3>
            </div>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <input type="hidden" name="category_id" value="<?= $category_id ?>">
                <div class="card-body">
                    <div class="form-group">
                        <label for="category_name">Category Name</label>
                        <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Enter Category Name" value="<?= isset($category_name) ? htmlspecialchars($category_name) : '' ?>">
                        <span class="text-danger"><?= @$message['category_name'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" class="form-control" id="status" name="status" placeholder="Enter Status" value="<?= @$status ?>">
                        <span class="text-danger"><?= @$message['status'] ?></span>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update Category</button>
                    <a href="category.php" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include '../layouts.php';
?>
