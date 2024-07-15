<?php
ob_start();                    //multiple header error remove
include 'header2.php';
include '../function.php';
?>
<main id="main">
    <!-- ======= Contact Us Section ======= -->
    <section id="login" class="login">
        <div class="container Login-Page" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-6 login-image p-0">
                    <img src="assets/img/2948393.jpg" class="img-fluid w-100 rounded-top" alt=""> 
                </div>

                <div class="col-lg-6 register-form-section p-5">
                    <?php
                    //Set all users state TO "0".
                    $db = dbConn();
                    $update_sql = "UPDATE users SET State = 0";
                    $update_stmt = $db->prepare($update_sql);
                    $update_stmt->execute();

                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                        extract($_POST);

                        $username = dataClean($username);
                        $password = dataClean($password);

                        $message = array();

                        //Required validation
                        if (empty($username)) {
                            $message['username'] = "User Name should not be empty...!";
                        }
                        if (empty($password)) {
                            $message['password'] = "Password should not be empty...!";
                        }

                        if (empty($message)) {
                            // Set the DB Connection
                            $db = dbConn();
                            $sql = "SELECT * FROM users u INNER JOIN customers c ON c.UserId=u.UserId WHERE u.UserName=?";
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $username);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows == 1) {
                                $row = $result->fetch_assoc();

                                if (password_verify($password, $row['Password'])) {
                                    $_SESSION['USERID'] = $row['UserId'];
                                    $_SESSION['FIRSTNAME'] = $row['FirstName'];

                                    // Update the State column to 1
                                    $update_sql = "UPDATE users SET State = 1 WHERE UserId = ?";
                                    $update_stmt = $db->prepare($update_sql);
                                    $update_stmt->bind_param("i", $row['UserId']);
                                    $update_stmt->execute();

                                    header("Location:dashboard.php");
                                } else {
                                    $message['password'] = "Invalid User Name or Password...!";
                                }
                            } else {
                                $message['password'] = "Invalid User Name or Password...!";
                            }
                        }
                    }
                    ?>
                    <div class="row justify-content-center register-form-section">
                        <div class="col-lg-12 mt-5 mt-lg-0 align-items-stretch register-form-section" data-aos="fade-up" data-aos-delay="200">
                            <form id="login-form" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" role="form" class="php-email-form p-3 bg-white rounded" novalidate>
                                <div class="row p-5">
                                    <div class="section-title text-center">
                                        <h2>Login</h2>
                                        <p>Contact Us to Get Started.</p>
                                    </div>
                                </div>
                                <div class="form row">
                                    <div class="form-group col-md-12 pb-3">
                                        <label for="username">User Name</label>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Enter your User Name" required>
                                        <span class="text-danger"><?= @$message['username'] ?></span>
                                    </div>
                                </div>
                                <div class="form row">
                                    <div class="form-group col-md-12 pb-3">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                                        <span class="text-danger"><?= @$message['password'] ?></span>
                                    </div>
                                </div>
                                <div class="form-group pb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="gridCheck">
                                        <label class="form-check-label" for="gridCheck">
                                            Check me out
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary me-4 py-2 px-4 rounded-pill">Login</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div> 
        </div>
    </section><!-- End Contact Us Section -->
</main>
<?php
include 'footer.php';
ob_end_flush();
?>
