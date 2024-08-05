<?php
ob_start();
include_once '../init.php';

$link = "Item Management";
$breadcrumb_item = "Item";
$breadcrumb_item_active = "Update";
extract($_GET);
extract($_POST);

$db = dbConn();
$categories_query = "SELECT * FROM item_category WHERE status = 1";
$categories_result = $db->query($categories_query);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $db = dbConn();
    $sql = "SELECT * FROM items WHERE item_id='$id'";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();

    $item_name = $row['item_name'];
    $item_category = $row['item_category'];
    $item_image = $row['item_image'];
    $status = $row['status'];
    $item_id = $row['item_id'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $item_name = dataClean($item_name);
    $item_category = dataClean($item_category);
    $status = dataClean($status);

    $message = array();
    if (empty($item_name)) {
        $message['item_name'] = "The Item Name should not be blank!";
    }
    if (empty($item_category)) {
        $message['item_category'] = "The Item Category should not be blank!";
    }
    if (empty($status)) {
        $message['status'] = "The Status should not be blank!";
    }

    // Image upload
    $item_image = $old_image; // Initialize variable to store image path, if new image upladed then old image removed
    if ($_FILES['item_image']['name']) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["item_image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["item_image"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["item_image"]["tmp_name"], $target_file)) {
                $item_image = $target_file;
            } else {
                $message['item_image'] = "Sorry, there was an error uploading your file.";
            }
        } else {
            $message['item_image'] = "File is not an image.";
        }
    }

    // Update item details in database
    if (empty($message)) {
        $db = dbConn();

        $sql = "UPDATE items SET item_name='$item_name', item_category='$item_category', status='$status' ,item_image='$item_image' WHERE item_id='$item_id'";
        $db->query($sql);
        //header("Location: manage.php");
    }
}
?>
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Update Item</h3>
            </div>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                <div class="card-body">

                    <div class="form-group col-md-6">
                        <label for="item_id">Item ID</label>
                        <input type="text" class="form-control" id="item_id" name="item_id" value="<?= htmlspecialchars($item_id) ?>" readonly> 
                    </div>
                    <div class="form-group col-md-6">
                        <label for="item_name">Item Name</label>
                        <input type="text" class="form-control" id="item_name" name="item_name" placeholder="Enter Item Name" value="<?= @$item_name ?>">
                        <span class="text-danger"><?= @$message['item_name'] ?></span>
                    </div>
                    <div class="form-group col-md-6" id="item_category" name="item_category">
                        <label for="item_category">Item Category</label>
                        <select class="form-control" id="item_category" name="item_category">
                            <option value="">Select Category</option>
                            <?php while ($row = $categories_result->fetch_assoc()): ?>
                                <option value="<?= htmlspecialchars($row['id']) ?>" <?= (isset($item_category) && $item_category == $row['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($row['category_name']) ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="item_image">Item Image</label>
                        <input type="file" class="form-control" id="item_image" name="item_image">
                        <span class="text-danger"><?= @$message['item_image'] ?></span>
                        <?php if (!empty($item_image)) : ?>
                            <img src="<?= $item_image ?>" class="img-fluid mt-2" style="max-height: 200px;" alt="Item Image">
                        <?php endif; ?>
                        <div class="form-group col-md-6" style="display:none;"> 
                            <input type="hidden" name="old_image" value="<?= htmlspecialchars($item_image) ?>">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="">Select Status</option>
                            <option value="1" <?= (isset($status) && $status == '1') ? 'selected' : '' ?>>Active</option>
                            <option value="0" <?= (isset($status) && $status == '0') ? 'selected' : '' ?>>Inactive</option>
                        </select>
                        <span class="text-danger"><?= @$message['status'] ?></span>
                    </div>

                </div>
                <div class="card-footer">

                    <button type="submit" class="btn btn-primary">Update</button>
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
