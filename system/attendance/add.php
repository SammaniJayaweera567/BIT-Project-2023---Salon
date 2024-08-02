<?php
ob_start();
include_once '../init.php';

$link = "Attendance Management";
$breadcrumb_item = "Attendance";
$breadcrumb_item_active = "Add";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $EmployeeId = dataClean($_POST['EmployeeId']);
    $attendance_date = dataClean($_POST['attendance_date']);
    $check_in_time = dataClean($_POST['check_in_time']);
    $check_out_time = dataClean($_POST['check_out_time']);
    $status = dataClean($_POST['status']);

    $message = array();
    if (empty($EmployeeId)) {
        $message['EmployeeId'] = "Employee ID is required!";
    }
    if (empty($attendance_date)) {
        $message['attendance_date'] = "Attendance Date is required!";
    }
    if (empty($check_in_time)) {
        $message['check_in_time'] = "Check-in Time is required!";
    }
    if (empty($check_out_time)) {
        $message['check_out_time'] = "Check-out Time is required!";
    }
    if (empty($status)) {
        $message['status'] = "Status is required!";
    }

    if (empty($message)) {
        $db = dbConn();
        $sql = "INSERT INTO attendance (EmployeeId, attendance_date, check_in_time, check_out_time, status) 
                VALUES ('$EmployeeId', '$attendance_date', '$check_in_time', '$check_out_time', '$status')";
        $db->query($sql);
        header("Location: manage.php");
        exit();
    }
}
?>
<div class="row">
    <div class="col-12">
        <a href="<?= SYS_URL ?>attendance/manage.php" class="btn btn-dark mb-3"><i class="fas fa-arrow-left"></i> Back to Manage</a>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Add Attendance</h3>
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
                            <label for="attendance_date">Attendance Date</label>
                            <input type="date" class="form-control" id="attendance_date" name="attendance_date" value="<?= htmlspecialchars($_POST['attendance_date'] ?? '') ?>">
                            <span class="text-danger"><?= @$message['attendance_date'] ?></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="check_in_time">Check-in Time</label>
                            <input type="time" class="form-control" id="check_in_time" name="check_in_time" value="<?= htmlspecialchars($_POST['check_in_time'] ?? '') ?>">
                            <span class="text-danger"><?= @$message['check_in_time'] ?></span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="check_out_time">Check-out Time</label>
                            <input type="time" class="form-control" id="check_out_time" name="check_out_time" value="<?= htmlspecialchars($_POST['check_out_time'] ?? '') ?>">
                            <span class="text-danger"><?= @$message['check_out_time'] ?></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="">Select Status</option>
                                <option value="Present" <?= isset($_POST['status']) && $_POST['status'] == 'Present' ? 'selected' : '' ?>>Present</option>
                                <option value="Absent" <?= isset($_POST['status']) && $_POST['status'] == 'Absent' ? 'selected' : '' ?>>Absent</option>
                                <option value="Leave" <?= isset($_POST['status']) && $_POST['status'] == 'Leave' ? 'selected' : '' ?>>Leave</option>
                            </select>
                            <span class="text-danger"><?= @$message['status'] ?></span>
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
