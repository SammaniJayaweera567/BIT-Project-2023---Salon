<?php
ob_start();
include_once '../init.php';

$link = "Service Management";
$breadcrumb_item = "Service";
$breadcrumb_item_active = "Add";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    extract($_POST);
    $ServiceCategoryName = dataClean($ServiceCategoryName);
    $SubServiceName = dataClean($SubServiceName);
    $ServiceName = dataClean($ServiceName);
    $Description = dataClean($Description);
    $Duration = dataClean($Duration);
    $Price = dataClean($Price);

    $message = array();
    if (empty($ServiceCategoryName)) {
        $message['ServiceCategoryName'] = "The Service Category Name should not be blank!";
    }
    if (empty($SubServiceName)) {
        $message['SubServiceName'] = "The Sub Service Name should not be blank!";
    }
    if (empty($ServiceName)) {
        $message['ServiceName'] = "The Service Name should not be blank!";
    }
    if (empty($Description)) {
        $message['Description'] = "The Description should not be blank!";
    }
    if (empty($Duration)) {
        $message['Duration'] = "The Duration should not be blank!";
    }
    if (empty($Price)) {
        $message['Price'] = "The Price should not be blank!";
    }

    if (empty($message)) {
        $db = dbConn();
        $sql = "INSERT INTO services (ServiceCategoryName, SubServiceName, ServiceName, Description, Duration, Price) VALUES ('$ServiceCategoryName', '$SubServiceName', '$ServiceName', '$Description', '$Duration', '$Price')";
        $db->query($sql);
        header("Location: manage.php");
    }
}
?>
<div class="row">
    <div class="col-12">
        <a href="manage.php" class="btn btn-info mb-2"><i class="fa fa-undo"></i> Go Back</a>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Add New Service</h3>
            </div>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="card-body">
                    <div class="form row">
                        <div class="form-group col-md-4">
                            <label for="ServiceCategoryName">Service Category Name</label>
                            <input type="text" class="form-control" id="ServiceCategoryName" name="ServiceCategoryName" placeholder="Enter Service Category Name" value="<?= @$ServiceCategoryName ?>">
                            <span class="text-danger"><?= @$message['ServiceCategoryName'] ?></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="SubServiceName">Sub Service Name</label>
                            <input type="text" class="form-control" id="SubServiceName" name="SubServiceName" placeholder="Enter Sub Service Name" value="<?= @$SubServiceName ?>">
                            <span class="text-danger"><?= @$message['SubServiceName'] ?></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="ServiceName">Service Name</label>
                            <input type="text" class="form-control" id="ServiceName" name="ServiceName" placeholder="Enter Service Name" value="<?= @$ServiceName ?>">
                            <span class="text-danger"><?= @$message['ServiceName'] ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Description">Description</label>
                        <textarea class="form-control" id="Description" name="Description" placeholder="Enter Description"><?= @$Description ?></textarea>
                        <span class="text-danger"><?= @$message['Description'] ?></span>
                    </div>
                    <div class="form row">
                        <div class="form-group col-md-6">
                            <label for="Duration">Duration (in minutes)</label>
                            <input type="number" class="form-control" id="Duration" name="Duration" placeholder="Enter Duration" value="<?= @$Duration ?>">
                            <span class="text-danger"><?= @$message['Duration'] ?></span>
                        </div>
                        <div class="form-group col-md-6">
                        <label for="Price">Price (LKR)</label>
                        <input type="number" class="form-control" id="Price" name="Price" placeholder="Enter Price" value="<?= @$Price ?>">
                        <span class="text-danger"><?= @$message['Price'] ?></span>
                    </div>
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
