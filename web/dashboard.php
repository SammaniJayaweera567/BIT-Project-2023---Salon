<?php
session_start();
if (!isset($_SESSION['USERID'])) {
    header("Location:login.php");
}
include '../function.php';
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Fruitables - Vegetable Website Template</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="assets/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="assets/css/style.css" rel="stylesheet">
    </head>

    <body>

        <!-- Navbar start -->
        <div class="container-fluid bg-dark-blue";">
            <div class="container px-0">
                <nav class="navbar navbar-light navbar-expand-xl bg-dark-blue">
                    <a href="index.php" class="navbar-brand"><h1 class="text-primary display-6 text-white">SALON ANGEL</h1></a>
                    <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <div class="d-flex my-3 ms-auto">
                            <ul class="d-inline-flex list-unstyled">
                                <li> <a href="dashboard.php" class="btn btn-primary py-2 rounded-pill bg-white mx-3" style="color: #0b0b0b;">Welcome, <?= $_SESSION['FIRSTNAME'] ?></a></li>
                                <li><a href="login.php"><button type="button" class="btn btn-primary py-2 rounded-pill bg-white" style="color: #0b0b0b;">Logout</button></a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Navbar End -->

        <main id="main mt-5">
            <section class="breadcrumbs py-2 bg-dark-yellow">
                <div class="container px-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="text-white">Dashboard</h2>
                        <ol class="d-flex" style="list-style: none">
                            <li class="px-2"><a href="index.html">Customer / </a></li>
                            <li class="text-white">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </section>
            <section class="inner-page p-5">
                <div class="container px-0">
                    <!--Check if there is anything in the booking session-->
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        extract($_POST);
                        $userid = $_SESSION['USERID'];
                        $db = dbConn();
                        $time_duration = '01:00:00';

                        //Adding an extra time
                        $stime = strtotime($time);                          //convert string (01:00:00)to time
                        $endtime = date("H:i:s", strtotime("+60 minutes", $stime));       //create a function for find the end time(H:i:s is a time format)

                        $sql = "SELECT * FROM customers WHERE UserId='$userid'";
                        $result = $db->query($sql);
                        $row = $result->fetch_assoc();
                        $customer_id = $row['CustomerId'];

                        $sql = "INSERT INTO appointments(customer_id,date,start_time,end_time) VALUES('$customer_id','$date','$time','$endtime')";
                        $db->query($sql);

                        unset($_SESSION['action']);
                        unset($_SESSION['date']);
                        unset($_SESSION['time']);

                        echo "<div class='alert alert-success'>Your booking has been confirmed...!</div>";
                    }

                    if (isset($_SESSION['action'])) {
                        if ($_SESSION['action'] == 'booking') {
                            echo $_SESSION['date'];
                            echo $_SESSION['time'];
                            ?>
                            <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                <input type="hidden" name="date" value="<?= $_SESSION['date'] ?>">
                                <input type="hidden" name="time" value="<?= $_SESSION['time'] ?>">
                                <button type="submit" class="btn btn-warning">Click here to confirm your booking</button>
                            </form>

                            <?php
                        }
                    }
                    ?>
                </div>
            </section>


            <!-- Fruits Shop Start-->
            <div class="container-fluid dashboard-features pt-5">
                <div class="container py-5">
                    <h3 class="text-dark-black">Welcome, [Customer Name]</h3>
                    <div class="row g-4 my-5">
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="rounded position-relative fruite-item shadow p-3 mb-5 bg-white rounded">
                                <div class="fruite-img">
                                    <img src="assets/img/dash-profile-manage.jpg" class="img-fluid w-100 rounded-top" alt="">
                                </div>
                                <div class="p-4 rounded-bottom">
                                    <h5>Profile Management</h5>
                                    <a href="profile_management.php" class="btn btn-primary">View</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="rounded position-relative fruite-item shadow p-3 mb-5 bg-white rounded">
                                <div class="fruite-img">
                                    <img src="assets/img/dash-appointemt-history.jpg" class="img-fluid w-100 rounded-top" alt="">
                                </div>
                                <div class="p-4 rounded-bottom">
                                    <h5>Appointment History</h5>
                                    <a href="appointment_history.php" class="btn btn-primary">View</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="rounded position-relative fruite-item shadow p-3 mb-5 bg-white rounded">
                                <div class="fruite-img">
                                    <img src="assets/img/dash-appoi-manage.jpg" class="img-fluid w-100 rounded-top" alt="">
                                </div>
                                <div class="p-4 rounded-bottom">
                                    <h5>Manage Appointments</h5>
                                    <a href="manage_appointments.php" class="btn btn-primary">View</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="rounded position-relative fruite-item shadow p-3 mb-5 bg-white rounded">
                                <div class="fruite-img">
                                    <img src="assets/img/dash-order-history.jpg" class="img-fluid w-100 rounded-top" alt="">
                                </div>
                                <div class="p-4 rounded-bottom">
                                    <h5>order History</h5>
                                    <a href="order_history.php" class="btn btn-primary">View</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="rounded position-relative fruite-item shadow p-3 mb-5 bg-white rounded">
                                <div class="fruite-img">
                                    <img src="assets/img/dash-change-password.jpg" class="img-fluid w-100 rounded-top" alt="">
                                </div>
                                <div class="p-4 rounded-bottom">
                                    <h5>Change Password</h5>
                                    <a href="change_password.php" class="btn btn-primary">View</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="rounded position-relative fruite-item shadow p-3 mb-5 bg-white rounded">
                                <div class="fruite-img">
                                    <img src="assets/img/dash-chat.jpg" class="img-fluid w-100 rounded-top" alt="">
                                </div>
                                <div class="p-4 rounded-bottom">
                                    <h5>Message Center</h5>
                                    <a href="chat_form.php" class="btn btn-primary">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fruits Shop End-->
            
             <div class="container pb-5 mb-5">
                <a href="logout.php"><button type="button" class="btn btn-primary me-4 py-2 rounded-pill">Logout</button></a>
            </div>
            
           
        </main>


        <!-- Footer Start -->
        <div class="container-fluid bg-dark-blue text-white-50 footer">
            <div class="container py-4">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0 px-0">
                        <span class="text-light"><a href="#" class="text-light-yellow"><i class="fas fa-copyright text-light me-2"></i>Your Site Name</a>, All right reserved.</span>
                    </div>
                    <div class="col-md-6 my-auto text-center text-md-end text-white px-0">
                        <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                        <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                        <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                        Designed By <a class="border-bottom text-light-yellow" href="https://htmlcodex.com">Miss. Sammani</a>
                    </div>
                </div> 

            </div>
        </div>

        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="assets/lib/easing/easing.min.js"></script>
        <script src="assets/lib/waypoints/waypoints.min.js"></script>
        <script src="assets/lib/lightbox/js/lightbox.min.js"></script>
        <script src="assets/lib/owlcarousel/owl.carousel.min.js"></script>

        <!-- Template Javascript -->
        <script src="assets/js/main.js"></script>
    </body>

</html>
