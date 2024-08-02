<?php
ob_start();
include_once '../init.php';

$link = "Attendance Management";
$breadcrumb_item = "Attendance";
$breadcrumb_item_active = "Edit";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $attendance_id = isset($_GET['attendance_id']) ? $_GET['attendance_id'] : '';

    $db = dbConn();
    $sql = "SELECT * FROM attendance WHERE attendance_id='$attendance_id'";
    $result = $db->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $employee_id = $row['employee_id'];
        $attendance_date = $row['attendance_date'];
        $check_in_time = $row['check_in_time'];
        $check_out_time = $row['check_out_time'];
        $status = $row['status'];
    } else {
        // Handle case where no record is found
        $message = "Record not found.";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $attendance_id = $_POST['attendance_id'];
    $employee_id = dataClean($_POST['employee_id']);
    $attendance_date = dataClean($_POST['attendance_date']);
    $check_in_time = dataClean($_POST['check_in_time']);
    $check_out_time = dataClean($_POST['check_out_time']);
    $status = dataClean($_POST['status']);

    $message = array();
    if (empty($employee_id)) {
        $message['employee_id'] = "Employee ID is required!";
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
        $sql = "UPDATE attendance SET 
                employee_id='$employee_id', 
                attendance_date='$attendance_date', 
                check_in_time='$check_in_time', 
                check_out_time='$check_out_time', 
                status='$status' 
                WHERE attendance_id='$attendance_id'";
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
                <h3 class="card-title">Edit Attendance</h3>
            </div>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="card-body">
                    <?php if (isset($message)) : ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($message) ?></div>
                    <?php endif; ?>
                    
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="employee_id">Employee ID</label>
                            <input type="text" class="form-control" id="employee_id" name="employee_id" placeholder="Enter Employee ID" value="<?= htmlspecialchars($employee_id ?? '') ?>">
                            <span class="text-danger"><?= @$message['employee_id'] ?></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="attendance_date">Attendance Date</label>
                            <input type="date" class="form-control" id="attendance_date" name="attendance_date" value="<?= htmlspecialchars($attendance_date ?? '') ?>">
                            <span class="text-danger"><?= @$message['attendance_date'] ?></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="check_in_time">Check-in Time</label>
                            <input type="time" class="form-control" id="check_in_time" name="check_in_time" value="<?= htmlspecialchars($check_in_time ?? '') ?>">
                            <span class="text-danger"><?= @$message['check_in_time'] ?></span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="check_out_time">Check-out Time</label>
                            <input type="time" class="form-control" id="check_out_time" name="check_out_time" value="<?= htmlspecialchars($check_out_time ?? '') ?>">
                            <span class="text-danger"><?= @$message['check_out_time'] ?></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="">Select Status</option>
                                <option value="Present" <?= isset($status) && $status == 'Present' ? 'selected' : '' ?>>Present</option>
                                <option value="Absent" <?= isset($status) && $status == 'Absent' ? 'selected' : '' ?>>Absent</option>
                                <option value="Leave" <?= isset($status) && $status == 'Leave' ? 'selected' : '' ?>>Leave</option>
                            </select>
                            <span class="text-danger"><?= @$message['status'] ?></span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <input type="hidden" name="attendance_id" value="<?= htmlspecialchars($attendance_id ?? '') ?>">
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
