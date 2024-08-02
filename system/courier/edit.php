<?php
ob_start();
include_once '../init.php';

$link = "Courier Management";
$breadcrumb_item = "Courier";
$breadcrumb_item_active = "Update";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    extract($_GET);
    $db = dbConn();
    $sql = "SELECT * FROM courier WHERE courier_id='$courier_id'";

    $result = $db->query($sql);
    $row = $result->fetch_assoc();
    
    $CourierId = $row['courier_id'];
    $CourierName = $row['courier_name'];
    $CompanyName = $row['company_name'];
    $CompanyAddress = $row['company_address'];
    $CompanyPhoneNo = $row['company_phone_no'];
    $CompanyEmail = $row['company_email'];
    $MobileNumber = $row['mobile_number'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    extract($_POST);
    $CourierId = dataClean($CourierId);
    $CourierName = dataClean($CourierName);
    $CompanyName = dataClean($CompanyName);
    $CompanyAddress = dataClean($CompanyAddress);
    $CompanyPhoneNo = dataClean($CompanyPhoneNo);
    $CompanyEmail = dataClean($CompanyEmail);
    $MobileNumber = dataClean($MobileNumber);

    $message = array();
    if (empty($CourierId)) {
        $message['CourierId'] = "The Courier ID should not be blank...!";
    }
    if (empty($CourierName)) {
        $message['CourierName'] = "The Courier Name should not be blank...!";
    }
    if (empty($CompanyName)) {
        $message['CompanyName'] = "The Company Name should not be blank...!";
    }
    if (empty($CompanyAddress)) {
        $message['CompanyAddress'] = "The Company Address should not be blank...!";
    }
    if (empty($CompanyPhoneNo)) {
        $message['CompanyPhoneNo'] = "The Company Phone No should not be blank...!";
    }
    if (empty($CompanyEmail)) {
        $message['CompanyEmail'] = "The Company Email should not be blank...!";
    }
    if (empty($MobileNumber)) {
        $message['MobileNumber'] = "The Mobile Number should not be blank...!";
    }

    if (empty($message)) {
        $db = dbConn();
        $sql = "UPDATE courier SET courier_id='$CourierId', courier_name='$CourierName', company_name='$CompanyName', company_address='$CompanyAddress', company_phone_no='$CompanyPhoneNo', company_email='$CompanyEmail', mobile_number='$MobileNumber' WHERE courier_id='$CourierId'";
        $db->query($sql);

        header("Location:manage.php");
    }
}
?>
<div class="row">
    <div class="col-12">

        <a href="" class="btn btn-dark mb-2"><i class="fas fa-plus-circle"></i> New</a>

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Update Courier</h3>
            </div>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="card-body">

                    <div class="form-group">
                        <label for="CourierId">ID</label>
                        <input type="text" class="form-control" id="CourierId" name="CourierId" placeholder="Enter Courier ID" value="<?= @$CourierId ?>">
                        <span class="text-danger"><?= @$message['CourierId'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="CourierName">Courier Name</label>
                        <input type="text" class="form-control" id="CourierName" name="CourierName" placeholder="Enter Courier Name" value="<?= @$CourierName ?>">
                        <span class="text-danger"><?= @$message['CourierName'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="CompanyName">Company Name</label>
                        <input type="text" class="form-control" id="CompanyName" name="CompanyName" placeholder="Enter Company Name" value="<?= @$CompanyName ?>">
                        <span class="text-danger"><?= @$message['CompanyName'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="CompanyAddress">Company Address</label>
                        <textarea class="form-control" id="CompanyAddress" name="CompanyAddress" placeholder="Enter Company Address"><?= @$CompanyAddress ?></textarea>
                        <span class="text-danger"><?= @$message['CompanyAddress'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="CompanyPhoneNo">Company Phone No</label>
                        <input type="text" class="form-control" id="CompanyPhoneNo" name="CompanyPhoneNo" placeholder="Enter Company Phone No" value="<?= @$CompanyPhoneNo ?>">
                        <span class="text-danger"><?= @$message['CompanyPhoneNo'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="CompanyEmail">Company Email</label>
                        <input type="email" class="form-control" id="CompanyEmail" name="CompanyEmail" placeholder="Enter Company Email" value="<?= @$CompanyEmail ?>">
                        <span class="text-danger"><?= @$message['CompanyEmail'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="MobileNumber">Mobile Number</label>
                        <input type="text" class="form-control" id="MobileNumber" name="MobileNumber" placeholder="Enter Mobile Number" value="<?= @$MobileNumber ?>">
                        <span class="text-danger"><?= @$message['MobileNumber'] ?></span>
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <input type="hidden" name="courier_id" value="<?= $courier_id ?>">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>
        <!-- /.card -->
    </div>
</div>

<?php
$content = ob_get_clean();
include '../layouts.php';
?>
