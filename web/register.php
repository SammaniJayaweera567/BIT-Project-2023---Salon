<?php
ob_start();
include 'header2.php';
include '../function.php';
include '../mail.php';


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
    
    print_r($message);

    if (empty($message)) {
        // Use bcrypt hashing algorithm
        $pw_hashed = password_hash($password, PASSWORD_DEFAULT);
        $db = dbConn();
        echo $sql = "INSERT INTO `users`(`UserName`,`Password`,`UserType`, `State`) VALUES ('$username', '$pw_hashed','customer', '1')";
        $db->query($sql);

        $user_id = $db->insert_id;

        // Register number generation
        $reg_number = date('Y') . date('m') . date('d') . $user_id;
        $_SESSION['RNO'] = $reg_number;
        echo $sql = "INSERT INTO `customers`(`FirstName`, `LastName`, `Email`, `AddressLine1`, `AddressLine2`, `AddressLine3`, `TelNo`, `MobileNo`, `Gender`, `DistrictId`, `RegNo`, `UserId`) VALUES ('$first_name', '$last_name', '$email', '$address_line1', '$address_line2', '$address_line3', '$telno', '$mobile_no', '$gender', '$district', '$reg_number', '$user_id')";
        $db->query($sql);
        $msg="<h1>SUCCESS</h1>";
        $msg.="<h2>Congratulations</h2>";
        $msg.="<p>Your account has been successfully created.</p>";
        $msg.="<a href='http://localhost/sms/verify.php'>Click here to verify your account</a>";
        
        $emailreg = sendEmail($email,$first_name,"Account Verification",$msg);

        // Redirect to success page
        $_SESSION['SENDEM'] = $emailreg;  //new
        header("Location: register_success.php");
        
    }
}
?>

<section id="contact" class="contact">
    <div class="container Regiter-page">
        <div class="row">
            <div class="col-md-6 register-image p-0">
                <img src="assets/img/3858807.jpg" class="img-fluid w-100 rounded-top" alt="">
            </div>
            <div class="col-md-6 register-form-section p-5">
                <div class="row justify-content-center">
                    <div class="col-md-12 mt-lg-0 align-items-stretch" data-aos="fade-up">

                        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" role="form" class="php-email-form mt-5 bg-white rounded" novalidate>
                            <div class="row">
                                <div class="section-title text-center">
                                    <h2>Customer</h2>
                                    <p>Register</p>
                                </div>
                            </div>
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
                            <div class="form-group pb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?= @$email ?>" required>
                                <span class="text-danger"><?= @$message['email'] ?></span>
                            </div>
                            <div class="form-group pb-3">
                                <label for="address_line1">Address Line 1</label>
                                <input type="text" class="form-control" name="address_line1" id="address_line1" placeholder="Address Line 1" value="<?= @$address_line1 ?>" required>
                                <span class="text-danger"><?= @$message['address_line1'] ?></span>
                            </div>
                            <div class="form-group pb-3">
                                <label for="address_line2">Address Line 2</label>
                                <input type="text" class="form-control" name="address_line2" id="address_line2" placeholder="Address Line 2" value="<?= @$address_line2 ?>">
                            </div>
                            <div class="form-group pb-3">
                                <label for="address_line3">Address Line 3</label>
                                <input type="text" class="form-control" name="address_line3" id="address_line3" placeholder="Address Line 3" value="<?= @$address_line3 ?>">
                            </div>
                            <div class="form row">
                                <div class="form-group col-md-6 pb-3">
                                    <label for="telno">Tel. No.(Home)</label>
                                    <input type="text" class="form-control" name="telno" id="telno" placeholder="Tel. No." value="<?= @$telno ?>" required>
                                    <span class="text-danger"><?= @$message['telno'] ?></span>
                                </div>
                                <div class="form-group col-md-6 pb-3">
                                    <label for="mobile_no">Mobile No.</label>
                                    <input type="text" class="form-control" name="mobile_no" id="mobile_no" placeholder="Mobile No" value="<?= @$mobile_no ?>" required>
                                    <span class="text-danger"><?= @$message['mobile_no'] ?></span>
                                </div>
                            </div>
                            <div class="form row">
                                <div class="form-group col-md-6 pb-3">
                                    <label for="inputCity">City</label>
                                    <input type="text" class="form-control" name="city" id="inputCity" placeholder="City" value="<?= @$city ?>">
                                </div>
                                <div class="form-group col-md-4 pb-3">
                                    <label>Select Gender</label>
                                    <div class="form-check">
                                        <input class="form-check-input border border-1 border-dark" type="radio" name="gender" id="male" value="male" <?= (isset($gender) && $gender == 'male') ? 'checked' : ''?>>
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input border border-1 border-dark" type="radio" name="gender" id="female" value="female" <?= (isset($gender) && $gender == 'female') ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                    <span class="text-danger mt-4"><?= @$message['gender'] ?></span>
                                </div>
                            </div>
                            <div class="form row">
                                <div class="form-group col-md-12 pb-3">
                                    <!-- Call the district table of the Db -->
                                    <?php
                                    $db = dbConn();
                                    $sql = "SELECT * FROM districts";
                                    $result = $db->query($sql);
                                    ?>
                                    <label for="district">District</label>
                                    <select name="district" id="district" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                        <option value="">--</option>
                                        <?php
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <option value="<?= $row['Id'] ?>" <?= (isset($district) && $district == $row['Id']) ? 'selected' : '' ?>><?= $row['Name'] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select> 
                                    <span class="text-danger"><?= @$message['district'] ?></span>
                                </div>
                            </div>
                            <div class="form row">
                                <div class="form-group col-md-6 pb-3">
                                    <label for="username">User Name</label>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="User Name" value="<?= @$username ?>" required>
                                    <span class="text-danger"><?= @$message['username'] ?></span>
                                </div>
                                <div class="form-group col-md-6 pb-3">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                                    <span class="text-danger"><?= @$message['password'] ?></span>
                                </div>
                            </div>
                            <div class="form-group pb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gridCheck" required>
                                    <label class="form-check-label" for="gridCheck">
                                        Check me out
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary me-4 py-2 px-4 rounded-pill">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include 'footer.php';
ob_end_flush();
?>
