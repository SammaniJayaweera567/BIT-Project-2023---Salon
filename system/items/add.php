<?php
ob_start();
include_once '../init.php';

$link = "Item Management";
$breadcrumb_item = "Item";
$breadcrumb_item_active = "Add";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    extract($_POST);
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
    if ($_FILES['item_image']['name']) {
        $target_dir = "uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
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
    } else {
        $message['item_image'] = "The Item Image should not be blank!";
    }

    if (empty($message)) {
        $db = dbConn();
        $sql = "INSERT INTO items (item_name, item_category, item_image, status) VALUES ('$item_name', '$item_category', '$item_image', '$status')";
        $db->query($sql);
        header("Location: manage.php");
    }
}
?>
<div class="row">
    <div class="col-12">
        <a href="" class="btn btn-dark mb-3"><i class="fas fa-plus-circle"></i> Item Management</a>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Add New Item</h3>
            </div>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form row">
                        <div class="form-group col-md-6">
                            <label for="item_name">Item Name</label>
                            <input type="text" class="form-control" id="item_name" name="item_name" placeholder="Enter Item Name" value="<?= @$item_name ?>">
                            <span class="text-danger"><?= @$message['item_name'] ?></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="item_category">Item Category</label>
                            <input type="text" class="form-control" id="item_category" name="item_category" placeholder="Enter Item Category" value="<?= @$item_category ?>">
                            <span class="text-danger"><?= @$message['item_category'] ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="item_image">Item Image</label>
                        <input type="file" class="form-control" id="item_image" name="item_image">
                        <span class="text-danger"><?= @$message['item_image'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" class="form-control" id="status" name="status" placeholder="Enter Status" value="<?= @$status ?>">
                        <span class="text-danger"><?= @$message['status'] ?></span>
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include '../layouts.php';
?>
