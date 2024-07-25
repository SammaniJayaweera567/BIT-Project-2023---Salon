<?php
ob_start();
include_once '../init.php';

// Check if `regno` parameter is set
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['regno']) && !empty($_GET['regno'])) {
        $regno = $_GET['regno'];

        // Establish a database connection
        $db = dbConn();

        // Fetch customer details
        $sql = "SELECT * FROM customers WHERE RegNo = '$regno'";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $customer = $result->fetch_assoc();
        } else {
            // Redirect to manage page if customer not found
            header("Location: manage.php");
            exit;
        }
    } else {
        echo "No customer ID provided.";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect and clean POST data
    extract($_POST);
    $regno = dataClean($regno);
    $first_name = dataClean($first_name);
    $last_name = dataClean($last_name);
    $email = dataClean($email);
    $address_line1 = dataClean($address_line1);
    $address_line2 = dataClean($address_line2);
    $address_line3 = dataClean($address_line3);
    $telno = dataClean($telno);
    $mobile_no = dataClean($mobile_no);
    $gender = isset($gender) ? dataClean($gender) : null;
    $district = isset($district) && !empty($district) ? dataClean($district) : null; // Handle district

    $message = array();
    // Required validation
    if (empty($first_name)) {
        $message[] = "First name is required.";
    }
    if (empty($last_name)) {
        $message[] = "Last name is required.";
    }
    if (empty($email)) {
        $message[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message[] = "Invalid email format.";
    }
    if (empty($address_line1)) {
        $message[] = "Address Line 1 is required.";
    }

    if (empty($message)) {
        $db = dbConn();
        $sql = "UPDATE `customers` SET 
                `FirstName`='$first_name', 
                `LastName`='$last_name', 
                `Email`='$email', 
                `AddressLine1`='$address_line1', 
                `AddressLine2`='$address_line2', 
                `AddressLine3`='$address_line3', 
                `TelNo`='$telno', 
                `MobileNo`='$mobile_no', 
                `Gender`='$gender', 
                `DistrictId`=" . ($district ? "'$district'" : "NULL") . " 
                WHERE `RegNo`='$regno'";
        $db->query($sql);

        // Redirect to manage page
        header("Location: manage.php");
        exit;
    }
}
?>

<div class="row">
    <div class="col-12">
        <a href="<?= SYS_URL ?>customers/manage.php" class="btn btn-dark mb-2"><i class="fas fa-arrow-left"></i> Back to List</a>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Customer</h3>
            </div>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                <div class="card-body">
                    <!-- Include RegNo as hidden input -->
                    <input type="hidden" name="regno" value="<?= htmlspecialchars($customer['RegNo']) ?>">

                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="form-control" value="<?= htmlspecialchars($customer['FirstName']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="form-control" value="<?= htmlspecialchars($customer['LastName']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="<?= htmlspecialchars($customer['Email']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="address_line1">Address Line 1</label>
                        <input type="text" id="address_line1" name="address_line1" class="form-control" value="<?= htmlspecialchars($customer['AddressLine1']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="address_line2">Address Line 2</label>
                        <input type="text" id="address_line2" name="address_line2" class="form-control" value="<?= htmlspecialchars($customer['AddressLine2']) ?>">
                    </div>

                    <div class="form-group">
                        <label for="address_line3">Address Line 3</label>
                        <input type="text" id="address_line3" name="address_line3" class="form-control" value="<?= htmlspecialchars($customer['AddressLine3']) ?>">
                    </div>

                    <div class="form-group">
                        <label for="telno">Telephone No.</label>
                        <input type="text" id="telno" name="telno" class="form-control" value="<?= htmlspecialchars($customer['TelNo']) ?>">
                    </div>

                    <div class="form-group">
                        <label for="mobile_no">Mobile No.</label>
                        <input type="text" id="mobile_no" name="mobile_no" class="form-control" value="<?= htmlspecialchars($customer['MobileNo']) ?>">
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" class="form-control">
                            <option value="">Select Gender</option>
                            <option value="Male" <?= ($customer['Gender'] == 'Male') ? 'selected' : '' ?>>Male</option>
                            <option value="Female" <?= ($customer['Gender'] == 'Female') ? 'selected' : '' ?>>Female</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="district">District</label>
                        <input type="text" id="district" name="district" class="form-control" value="<?= htmlspecialchars($customer['DistrictId']) ?>">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update Customer</button>
                    </div>

                    <?php if (!empty($message)): ?>
                        <div class="alert alert-danger">
                            <?php foreach ($message as $msg): ?>
                                <p><?= htmlspecialchars($msg) ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                </div>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include '../layouts.php';
?>
