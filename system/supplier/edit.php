<?php
ob_start();
include_once '../init.php';

$link = "Supplier Management";
$breadcrumb_item = "Supplier";
$breadcrumb_item_active = "Edit";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    extract($_GET);
    $db = dbConn();
    $sql = "SELECT * FROM supplier WHERE supplier_id='$id'"; // Corrected column name

    $result = $db->query($sql);
    $row = $result->fetch_assoc();

    $supplier_name = $row['supplier_name'];
    $register_date = $row['register_date'];
    $phone = $row['phone'];
    $email = $row['email'];
    $supplier_address = $row['supplier_address'];
    $status = $row['status'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    extract($_POST);
    $supplier_name = dataClean($supplier_name);
    $register_date = dataClean($register_date);
    $phone = dataClean($phone);
    $email = dataClean($email);
    $supplier_address = dataClean($supplier_address);
    $status = dataClean($status);

    $message = array();
    if (empty($supplier_name)) {
        $message['supplier_name'] = "The Supplier Name should not be blank!";
    }
    if (empty($register_date)) {
        $message['register_date'] = "The Register Date should not be blank!";
    }
    if (empty($phone)) {
        $message['phone'] = "The Phone number should not be blank!";
    }
    if (empty($email)) {
        $message['email'] = "The Email should not be blank!";
    }
    if (empty($supplier_address)) {
        $message['supplier_address'] = "The Supplier Address should not be blank!";
    }
    if (!isset($status)) {
        $message['status'] = "The Status should not be blank!";
    }

    if (empty($message)) {
        $db = dbConn();
        $sql = "UPDATE supplier SET supplier_name='$supplier_name', register_date='$register_date', phone='$phone', email='$email', supplier_address='$supplier_address', status='$status' WHERE supplier_id='$id'"; // Corrected column name
        $db->query($sql);
        header("Location: manage.php");
        exit();
    }
}
?>

<div class="row">
    <div class="col-12">
        <a href="<?= SYS_URL ?>supplier/manage.php" class="btn btn-dark mb-3"><i class="fas fa-arrow-left"></i> Back to Manage</a>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Supplier</h3>
            </div>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="card-body">
                    <div class="form row">
                        <div class="form-group col-md-6">
                            <label for="supplier_name">Supplier Name</label>
                            <input type="text" class="form-control" id="supplier_name" name="supplier_name" placeholder="Enter Supplier Name" value="<?= @$supplier_name ?>">
                            <span class="text-danger"><?= @$message['supplier_name'] ?></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="register_date">Register Date</label>
                            <input type="date" class="form-control" id="register_date" name="register_date" value="<?= @$register_date ?>">
                            <span class="text-danger"><?= @$message['register_date'] ?></span>
                        </div>
                    </div>

                    <div class="form row">
                        <div class="form-group col-md-6">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" value="<?= @$phone ?>">
                            <span class="text-danger"><?= @$message['phone'] ?></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="<?= @$email ?>">
                            <span class="text-danger"><?= @$message['email'] ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="supplier_address">Supplier Address</label>
                        <textarea class="form-control" id="supplier_address" name="supplier_address" placeholder="Enter Supplier Address"><?= @$supplier_address ?></textarea>
                        <span class="text-danger"><?= @$message['supplier_address'] ?></span>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="1" <?= @$status == '1' ? 'selected' : '' ?>>Active</option>
                            <option value="0" <?= @$status == '0' ? 'selected' : '' ?>>Inactive</option>
                        </select>
                        <span class="text-danger"><?= @$message['status'] ?></span>
                    </div>
                </div>
                <div class="card-footer">
                    <input type="hidden" name="id" value="<?= $id ?>">
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
