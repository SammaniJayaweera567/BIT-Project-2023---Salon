<?php
session_start();
ob_start(); // Multiple header error removal
include 'header2.php';
include '../function.php'; // Verify this path is correct and adjust if necessary.
?>

<main id="main">
   <div class="container mt-5 py-5">
    <h1>Profile Management</h1>

    <!-- Profile Management Card -->
    <div class="card card-profile-manage mb-3 my-5 border mx-auto">
        <div class="card-header card-header bg-dark-black text-light-yellow">
            Personal Information
        </div>
        <div class="card-body">
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" role="form" class="php-email-form mt-5 bg-white rounded" novalidate>
                
                <!-- Profile Picture -->
                <div class="mb-3 text-center">
                    <img src="path_to_customer_profile_image" alt="Profile Picture" id="profilePicture" class="rounded-circle mb-3" style="width: 150px; height: 150px;">
                    <div>
                        <button type="button" class="btn btn-secondary" onclick="document.getElementById('profilePictureInput').click();">Change Picture</button>
                        <button type="button" class="btn btn-danger" onclick="removeProfilePicture();">Delete Picture</button>
                    </div>
                    <input type="file" id="profilePictureInput" name="profilePicture" accept="image/*" style="display: none;" onchange="updateProfilePicture(this);">
                </div>
                
                <!-- Personal Information Form Fields -->
                <div class="form row">
                    <div class="section-title text-center">
                        <h2 class="py-3">Customer Profile</h2>
                        <h5 class="pb-5 text-dark-yellow">View customer profile</h5>
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
                
                <!-- Action Buttons -->
                <button type="submit" class="btn btn-primary me-4 py-2 px-4 rounded-pill">Update Profile</button>
                <button type="reset" class="btn btn-secondary py-2 px-4 rounded-pill">Reset</button>
            </form>
        </div>
    </div>
</div>
</main>
<?php
include 'footer.php';
ob_end_flush();
?>
