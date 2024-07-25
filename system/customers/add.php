<?php
ob_start();
include_once '../init.php';

$link = "Customer Management";
$breadcrumb_item = "Customer";
$breadcrumb_item_active = "Add";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    extract($_POST);
    $first_name = dataClean($first_name);
    $last_name = dataClean($last_name);
    $email = dataClean($email);
    $address_line1 = dataClean($address_line1);
    $address_line2 = dataClean($address_line2);
    $address_line3 = dataClean($address_line3);
    $telno = dataClean($telno);
    $mobile_no = dataClean($mobile_no);
    $username = dataClean($username);
    $password = dataClean($password);
    $gender = isset($gender) ? dataClean($gender) : null;
    $district = isset($district) && !empty($district) ? dataClean($district) : null; // Handle district

    $message = array();
    // Required validation
    if (empty($first_name)) {
        $message['first_name'] = "The first name should not be blank...!";
    }
    if (empty($last_name)) {
        $message['last_name'] = "The last name should not be blank...!";
    }
    if (empty($email)) {
        $message['email'] = "Email is required";
    }
    if (empty($address_line1)) {
        $message['address_line1'] = "Address Line 1 is required";
    }
    if (empty($telno)) {
        $message['telno'] = "Telephone number is required";
    }
    if (empty($mobile_no)) {
        $message['mobile_no'] = "Mobile number is required";
    }
    if (empty($username)) {
        $message['username'] = "User Name is required";
    }
    if (empty($password)) {
        $message['password'] = "Password is required";
    }
    if (!isset($gender)) {
        $message['gender'] = "Gender is required";
    }

    // Advance validation
    if (ctype_alpha(str_replace(' ', '', $first_name)) === false) {
        $message['first_name'] = "Only letters and white space allowed";
    }
    if (ctype_alpha(str_replace(' ', '', $last_name)) === false) {
        $message['last_name'] = "Only letters and white space allowed";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message['email'] = "Invalid Email Address...!";
    } else {
        $db = dbConn();
        $sql = "SELECT * FROM customers WHERE Email='$email'";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $message['email'] = "This Email address already exists...!";
        }
    }

    if (!empty($username)) {
        $db = dbConn();
        $sql = "SELECT * FROM users WHERE UserName='$username'";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $message['username'] = "This User Name already exists...!";
        }
    }

    // Password strength validation
    if (!empty($password)) {
        if (strlen($password) < 8) {
            $message['password'] = "The password should be 8 characters or more";
        }
    }

    // Handle form submission
    if (empty($message)) {
        // Use bcrypt hashing algorithm
        $pw_hashed = password_hash($password, PASSWORD_DEFAULT);
        $db = dbConn();
        $sql = "INSERT INTO `users`(`UserName`,`Password`,`UserType`, `State`) VALUES ('$username', '$pw_hashed','customer', '1')";
        $db->query($sql);

        $user_id = $db->insert_id;

        // Register number generation
        $reg_number = date('Y') . date('m') . date('d') . $user_id;
        $_SESSION['RNO'] = $reg_number;

        // Adjusted query to handle null value for DistrictId
        $district_value = $district ? $district : 'NULL'; // Set to 'NULL' if not selected
        $sql = "INSERT INTO `customers`(`FirstName`, `LastName`, `Email`, `AddressLine1`, `AddressLine2`, `AddressLine3`, `TelNo`, `MobileNo`, `Gender`, `DistrictId`, `RegNo`, `UserId`) VALUES ('$first_name', '$last_name', '$email', '$address_line1', '$address_line2', '$address_line3', '$telno', '$mobile_no', '$gender', $district_value, '$reg_number', '$user_id')";
        $db->query($sql);
        $msg = "<h1>SUCCESS</h1>";
        $msg .= "<h2>Congratulations</h2>";
        $msg .= "<p>Your account has been successfully created.</p>";
        $msg .= "<a href='http://localhost/sms/verify.php'>Click here to verify your account</a>";

        $emailreg = sendEmail($email, $first_name, "Account Verification", $msg);

        // Redirect to success page
        $_SESSION['SENDEM'] = $emailreg;
        $_SESSION['SUCCESS'] = true;
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}
?>

<div class="row">
    <div class="col-12">
        <?php if (isset($_SESSION['SUCCESS']) && $_SESSION['SUCCESS']) : ?>
            <div class="alert alert-success">
                Customer added successfully! Registration Number: <?= $_SESSION['RNO'] ?>
            </div>
            <?php unset($_SESSION['SUCCESS']); ?>
        <?php endif; ?>
        <a href="" class="btn btn-dark mb-2"><i class="fas fa-plus-circle"></i> New</a>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Add New Customer</h3>
            </div>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="card-body">
                    <div class="form row">
                        <div class="form-group col-md-6 pb-3">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name" value="<?= @$first_name ?>" required>
                            <span class="text-danger"><?= @$message['first_name'] ?></span>
                        </div>
                        <div class="form-group col-md-6 pb-3">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" value="<?= @$last_name ?>" required>
                            <span class="text-danger"><?= @$message['last_name'] ?></span>
                        </div>
                    </div>
                    <div class="form row">
                        <div class="form-group col-md-6 pb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?= @$email ?>" required>
                            <span class="text-danger"><?= @$message['email'] ?></span>
                        </div>
                        <div class="form-group col-md-6 pb-3">
                            <label for="address_line1">Address Line 1</label>
                            <input type="text" class="form-control" name="address_line1" id="address_line1" placeholder="Address Line 1" value="<?= @$address_line1 ?>" required>
                            <span class="text-danger"><?= @$message['address_line1'] ?></span>
                        </div>
                    </div>

                    <div class="form row">
                        <div class="form-group col-md-6 pb-3">
                            <label for="address_line2">Address Line 2</label>
                            <input type="text" class="form-control" name="address_line2" id="address_line2" placeholder="Address Line 2" value="<?= @$address_line2 ?>">
                            <span class="text-danger"><?= @$message['address_line2'] ?></span>
                        </div>
                        <div class="form-group col-md-6 pb-3">
                            <label for="address_line3">Address Line 3</label>
                            <input type="text" class="form-control" name="address_line3" id="address_line3" placeholder="Address Line 3" value="<?= @$address_line3 ?>">
                            <span class="text-danger"><?= @$message['address_line3'] ?></span>
                        </div>
                    </div>

                    <div class="form row">
                        <div class="form-group col-md-6 pb-3">
                            <label for="telno">Telephone Number</label>
                            <input type="text" class="form-control" name="telno" id="telno" placeholder="Telephone Number" value="<?= @$telno ?>" required>
                            <span class="text-danger"><?= @$message['telno'] ?></span>
                        </div>
                        <div class="form-group col-md-6 pb-3">
                            <label for="mobile_no">Mobile Number</label>
                            <input type="text" class="form-control" name="mobile_no" id="mobile_no" placeholder="Mobile Number" value="<?= @$mobile_no ?>" required>
                            <span class="text-danger"><?= @$message['mobile_no'] ?></span>
                        </div>
                    </div>

                    <div class="form row">
                        <div class="form-group col-md-6 pb-3">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class="form-control">
                                <option value="">Select Gender</option>
                                <option value="Male" <?= (isset($gender) && $gender == 'Male') ? 'selected' : '' ?>>Male</option>
                                <option value="Female" <?= (isset($gender) && $gender == 'Female') ? 'selected' : '' ?>>Female</option>
                            </select>
                            <span class="text-danger"><?= @$message['gender'] ?></span>
                        </div>
                        <div class="form-group col-md-6 pb-3">
                            <label for="district">District</label>
                            <select name="district" id="district" class="form-control">
                                <option value="">Select District</option>
                                <?php
                                $db = dbConn();
                                $district_query = "SHOW TABLES LIKE 'district'";
                                $district_result = $db->query($district_query);

                                if ($district_result->num_rows > 0) {
                                    $district_sql = "SELECT * FROM district";
                                    $districts = $db->query($district_sql);
                                    while ($district = $districts->fetch_assoc()) {
                                        echo "<option value='" . htmlspecialchars($district['DistrictId']) . "' " . (isset($district) && $district['DistrictId'] == $district ? 'selected' : '') . ">" . htmlspecialchars($district['DistrictName']) . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>District table does not exist</option>";
                                }
                                ?>
                            </select>
                            <span class="text-danger"><?= @$message['district'] ?></span>
                        </div>
                    </div>

                    <div class="form row">
                        <div class="form-group col-md-6 pb-3">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?= @$username ?>" required>
                            <span class="text-danger"><?= @$message['username'] ?></span>
                        </div>
                        <div class="form-group col-md-6 pb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                            <span class="text-danger"><?= @$message['password'] ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Add Customer</button>
                    </div>
                </div>
                <!-- /.card-body -->
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>

<?php
$content = ob_get_clean();
include '../layouts.php';
?>
