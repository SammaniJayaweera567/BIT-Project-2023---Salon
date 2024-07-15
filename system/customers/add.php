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
    $address = dataClean($address);
    $telno = dataClean($telno);
    $mobile_no = dataClean($mobile_no);

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
    if (empty($address)) {
        $message['address'] = "Address is required";
    }
    if (empty($telno)) {
        $message['telno'] = "Telephone number is required";
    }
    if (empty($mobile_no)) {
        $message['mobile_no'] = "Mobile number is required";
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

    print_r($message);

//    if (empty($message)) {
//        // Use bcrypt hashing algorithm
//        $pw_hashed = password_hash($password, PASSWORD_DEFAULT);
//        $db = dbConn();
//        echo $sql = "INSERT INTO `users`(`UserName`,`Password`,`UserType`) VALUES ('$username', '$pw_hashed','customer')";
//        $db->query($sql);
//
//        $user_id = $db->insert_id;
//
//        // Register number generation
//        $reg_number = date('Y') . date('m') . date('d') . $user_id;
//        $_SESSION['RNO'] = $reg_number;
//        echo $sql = "INSERT INTO `customers`(`FirstName`, `LastName`, `Email`, `AddressLine1`, `AddressLine2`, `AddressLine3`, `TelNo`, `MobileNo`, `Gender`, `DistrictId`, `RegNo`, `UserId`) VALUES ('$first_name', '$last_name', '$email', '$address_line1', '$address_line2', '$address_line3', '$telno', '$mobile_no', '$gender', '$district', '$reg_number', '$user_id')";
//        $db->query($sql);
//        $msg="<h1>SUCCESS</h1>";
//        $msg.="<h2>Congratulations</h2>";
//        $msg.="<p>Your account has been successfully created.</p>";
//        $msg.="<a href='http://localhost/sms/verify.php'>Click here to verify your account</a>";
//        
//        $emailreg = sendEmail($email,$first_name,"Account Verification",$msg);
//
//        // Redirect to success page
//        $_SESSION['SENDEM'] = $emailreg;  //new
//        header("Location: register_success.php");
//        
//    }   
}
?>
<div class="row">
    <div class="col-12">

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
                    <div class="form-group pb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?= @$email ?>" required>
                        <span class="text-danger"><?= @$message['email'] ?></span>
                    </div>
                    <div class="form-group pb-3">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" name="address" id="address" placeholder="Address" value="<?= @$address ?>" required>
                        <span class="text-danger"><?= @$message['address'] ?></span>
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
                        <div class="form-group col-md-4 pb-3">
                            <label>Select Gender</label>
                            <div class="form-check">
                                <input class="form-check-input border border-1 border-dark" type="radio" name="gender" id="male" value="male" <?= (isset($gender) && $gender == 'male') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input border border-1 border-dark" type="radio" name="gender" id="female" value="female" <?= (isset($gender) && $gender == 'female') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                            <span class="text-danger mt-4"><?= @$message['gender'] ?></span>
                        </div>
                    </div>
                    
                    
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
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
