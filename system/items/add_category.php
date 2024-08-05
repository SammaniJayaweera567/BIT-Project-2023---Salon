<?php
ob_start();
include_once '../init.php';

$link = "Item Management";
$breadcrumb_item = "Item";
$breadcrumb_item_active = "Add Category";

// Fetch existing categories for the category dropdown
$db = dbConn();
$categories_query = "SELECT * FROM item_category";
$categories_result = $db->query($categories_query);

$selected_category = ''; // Initialize the variable
$status = ''; // Initialize the status variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    extract($_POST);
    $category_name = isset($_POST['category_name']) ? dataClean($_POST['category_name']) : '';
    $selected_category = isset($_POST['selected_category']) ? dataClean($_POST['selected_category']) : '';
    $status = isset($_POST['status']) ? dataClean($_POST['status']) : '';

    $message = array();
    if (empty($category_name)) {
        $message['category_name'] = "The Category Name should not be blank!";
    }
    if (empty($status)) {
        $message['status'] = "The Status should not be blank!";
    }

    // Check if category name already exists
    $check_query = "SELECT * FROM item_category WHERE category_name = '$category_name'";
    $check_result = $db->query($check_query);
    if ($check_result->num_rows > 0) {
        $message['category_name'] = "Category Name already exists!";
    }

    // If no errors, insert category into database
    if (empty($message)) {
        // Assuming 'status' is an integer in your database schema
        // Convert 'Active' to 1 and 'Inactive' to 0
        $status_value = ($status === 'Active') ? 1 : 0;
        $insert_query = "INSERT INTO item_category (category_name, status) VALUES ('$category_name', '$status_value')";
        $insert_result = $db->query($insert_query);
        if ($insert_result) {
            header("Location: manage_category.php");
        } else {
            $message['error'] = "Failed to add category. Please try again.";
        }
    }
}
?>

<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Add Item Category</h3>
            </div>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="category_name">Category Name</label>
                        <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Enter Category Name" value="<?= isset($category_name) ? htmlspecialchars($category_name) : '' ?>">
                        <span class="text-danger"><?= @$message['category_name'] ?></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="">Select Status</option>
                            <option value="Active" <?= (isset($status) && $status == 'Active') ? 'selected' : '' ?>>Active</option>
                            <option value="Inactive" <?= (isset($status) && $status == 'Inactive') ? 'selected' : '' ?>>Inactive</option>
                        </select>
                        <span class="text-danger"><?= @$message['status'] ?></span>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Add Category</button>
                    <a href="manage.php" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include '../layouts.php';
?>
