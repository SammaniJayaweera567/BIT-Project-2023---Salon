<?php
ob_start();
include_once '../init.php';

$link = "Supplier Management";
$breadcrumb_item = "Supplier";
$breadcrumb_item_active = "Edit Supplier";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    extract($_GET);
    $db = dbConn();
    $sql = "SELECT * FROM supplier WHERE id='$id'";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();

    $supplier_name = $row['supplier_name'];
    $register_date = $row['register_date'];
    $status = $row['status'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    extract($_POST);
    $supplier_name = dataClean($supplier_name);
    $register_date = dataClean($register_date);
    $status = dataClean($status);

    $message = array();
    if (empty($supplier_name)) {
        $message['supplier_name'] = "The Supplier Name should not be blank!";
    }
    if (empty($register_date)) {
        $message['register_date'] = "The Register Date should not be blank!";
    }
    if (empty($status)) {
        $message['status'] = "The Status should not be blank!";
    }

    if (empty($message)) {
        $db = dbConn();
        $update_query = "UPDATE supplier SET supplier_name='$supplier_name', register_date='$register_date', status='$status' WHERE id='$id'";
        $update_result = $db->query($update_query);
        if ($update_result) {
            header("Location: manage.php");
        } else {
            $message['error'] = "Failed to update supplier. Please try again.";
        }
    }
}
?>

<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Supplier</h3>
            </div>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="supplier_name">Supplier Name</label>
                        <input type="text" class="form-control" id="supplier_name" name="supplier_name" placeholder="Enter Supplier Name" value="<?= isset($supplier_name) ? htmlspecialchars($supplier_name) : '' ?>">
                        <span class="text-danger"><?= @$message['supplier_name'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="register_date">Register Date</label>
                        <input type="date" class="form-control" id="register_date" name="register_date" value="<?= isset($register_date) ? htmlspecialchars($register_date) : '' ?>">
                        <span class="text-danger"><?= @$message['register_date'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" class="form-control" id="status" name="status" placeholder="Enter Status" value="<?= isset($status) ? htmlspecialchars($status) : '' ?>">
                        <span class="text-danger"><?= @$message['status'] ?></span>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update Supplier</button>
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
