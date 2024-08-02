<?php
ob_start();
include_once '../init.php';

$link = "Supplier Management";
$breadcrumb_item = "Supplier";
$breadcrumb_item_active = "Add Supplier";

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
        $message['status'] = "The Status should be selected!";
    }

    if (empty($message)) {
        $db = dbConn();
        $sql = "INSERT INTO supplier (supplier_name, register_date, phone, email, supplier_address, status) 
                VALUES ('$supplier_name', '$register_date', '$phone', '$email', '$supplier_address', '$status')";
        $db->query($sql);
        header("Location: manage.php");
        exit();
    }
}
?>

<div class="row">
    <div class="col-12">
        <a href="" class="btn btn-dark mb-3"><i class="fas fa-plus-circle"></i> New</a>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Add New Supplier</h3>
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
                            <label for="phone">Phone Number</label>
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
                        <input type="text" class="form-control" id="supplier_address" name="supplier_address" placeholder="Enter Supplier Address" value="<?= @$supplier_address ?>">
                        <span class="text-danger"><?= @$message['supplier_address'] ?></span>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="">Select Status</option>
                            <option value="1" <?= @$status == '1' ? 'selected' : '' ?>>Active</option>
                            <option value="0" <?= @$status == '0' ? 'selected' : '' ?>>Inactive</option>
                        </select>
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
