<?php
ob_start();
include_once '../init.php';

$link = "Leave Management";
$breadcrumb_item = "Leave";
$breadcrumb_item_active = "Add";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $EmployeeId = dataClean($_POST['EmployeeId']);
    $leave_type = dataClean($_POST['leave_type']);
    $start_date = dataClean($_POST['start_date']);
    $end_date = dataClean($_POST['end_date']);
    $status = dataClean($_POST['status']);
    $notes = dataClean($_POST['notes']);

    $message = array();
    if (empty($EmployeeId)) {
        $message['EmployeeId'] = "Employee ID is required!";
    }
    if (empty($leave_type)) {
        $message['leave_type'] = "Leave Type is required!";
    }
    if (empty($start_date)) {
        $message['start_date'] = "Start Date is required!";
    }
    if (empty($end_date)) {
        $message['end_date'] = "End Date is required!";
    }
    if (empty($status)) {
        $message['status'] = "Status is required!";
    }

    if (empty($message)) {
        $db = dbConn();
        $sql = "INSERT INTO `leave` (EmployeeId, leave_type, start_date, end_date, status, notes) 
                VALUES ('$EmployeeId', '$leave_type', '$start_date', '$end_date', '$status', '$notes')";
        if ($db->query($sql)) {
            header("Location: manage.php");
            exit();
        } else {
            $message['db_error'] = "Database error: " . $db->error;
        }
    }
}
?>

<div class="row">
    <div class="col-12">
        <a href="<?= SYS_URL ?>leave/manage.php" class="btn btn-dark mb-3"><i class="fas fa-arrow-left"></i> Back to Manage</a>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Add Leave</h3>
            </div>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="EmployeeId">Employee ID</label>
                            <input type="text" class="form-control" id="EmployeeId" name="EmployeeId" placeholder="Enter Employee ID" value="<?= htmlspecialchars($_POST['EmployeeId'] ?? '') ?>">
                            <span class="text-danger"><?= @$message['EmployeeId'] ?></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="leave_type">Leave Type</label>
                            <select class="form-control" id="leave_type" name="leave_type">
                                <option value="">Select Leave Type</option>
                                <option value="Sick Leave" <?= isset($_POST['leave_type']) && $_POST['leave_type'] == 'Sick Leave' ? 'selected' : '' ?>>Sick Leave</option>
                                <option value="Casual Leave" <?= isset($_POST['leave_type']) && $_POST['leave_type'] == 'Casual Leave' ? 'selected' : '' ?>>Casual Leave</option>
                                <option value="Annual Leave" <?= isset($_POST['leave_type']) && $_POST['leave_type'] == 'Annual Leave' ? 'selected' : '' ?>>Annual Leave</option>
                            </select>
                            <span class="text-danger"><?= @$message['leave_type'] ?></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" value="<?= htmlspecialchars($_POST['start_date'] ?? '') ?>">
                            <span class="text-danger"><?= @$message['start_date'] ?></span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" value="<?= htmlspecialchars($_POST['end_date'] ?? '') ?>">
                            <span class="text-danger"><?= @$message['end_date'] ?></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="">Select Status</option>
                                <option value="Pending" <?= isset($_POST['status']) && $_POST['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="Approved" <?= isset($_POST['status']) && $_POST['status'] == 'Approved' ? 'selected' : '' ?>>Approved</option>
                                <option value="Rejected" <?= isset($_POST['status']) && $_POST['status'] == 'Rejected' ? 'selected' : '' ?>>Rejected</option>
                            </select>
                            <span class="text-danger"><?= @$message['status'] ?></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="notes">Notes</label>
                            <textarea class="form-control" id="notes" name="notes" placeholder="Enter Notes"><?= htmlspecialchars($_POST['notes'] ?? '') ?></textarea>
                            <span class="text-danger"><?= @$message['notes'] ?></span>
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

