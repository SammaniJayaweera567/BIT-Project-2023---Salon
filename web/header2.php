<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
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
        <!--        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">-->

        <!-- Template Stylesheet -->
        <link href="assets/css/mystyles.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">
        <!--sweet alert plugin script-->
        <script src="assets/js/sweetalert2@11.js" type="text/javascript"></script>


    </head>

    <body>

        <header>
            <!-- Spinner Start -->
            <!--            <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
                            <div class="spinner-grow text-primary" role="status"></div>
                        </div>-->
            <!-- Spinner End -->


            <!-- Navbar start -->
            <div class="container-fluid fixed-top">
                <div class="container topbar bg-primary d-none d-lg-block">
                    <div class="d-flex justify-content-between">
                        <div class="top-info ps-2">
                            <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-white"></i> <a href="#" class="text-white">No.07, Hungama Road, Angunakolapelessa.</a></small>
                            <small class="me-3"><i class="fas fa-envelope me-2 text-white"></i><a href="#" class="text-white">Email@Example.com</a></small>
                        </div>
                        <div class="top-link pe-2">
                            <a href="#" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                            <a href="#" class="text-white"><small class="text-white mx-2">Terms of Use</small>/</a>
                            <a href="#" class="text-white"><small class="text-white ms-2">Sales and Refunds</small></a>
                        </div>
                    </div>
                </div>
                <div class="container px-0">
                    <nav class="navbar navbar-light bg-white navbar-expand-xl">
                        <a href="index.php" class="navbar-brand"><h1 class="text-primary display-6">SALON ANGEL</h1></a>
                        <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                            <span class="fa fa-bars text-primary"></span>
                        </button>
                        <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                            <div class="navbar-nav mx-auto">
                                <div class="navbar-nav mx-auto">
                                    <a href="index.php" class="nav-item nav-link active">Home</a>
                                    <a href="about.php" class="nav-item nav-link active">About</a>
                                    <a href="services.php" class="nav-item nav-link">Services</a>
                                    <a href="product.php" class="nav-item nav-link">Products</a>
                                    <a href="gallery.php" class="nav-item nav-link">Gallery</a>
                                    <a href="booking.php" class="nav-item nav-link">Booking</a>
                                    <a href="contact.php" class="nav-item nav-link">Contact</a>
                                </div>
                            </div>
                            <div class="d-inline-flex list-unstyled menu-rigth mb-0">
                                <ul class="d-inline-flex list-unstyled">
                                    <li><a href="cart.php" class="position-relative me-4 my-auto">
                                            <i class="fa fa-shopping-bag fa-2x"></i>
                                            <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-white px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;">3</span>
                                        </a>    
                                    </li>
                                    <li><a href="#" class="position-relative me-4 my-auto">
                                            <i class="fas fa-heart fa-2x text-dark-yellow"></i>
                                            <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-white px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;">3</span>
                                        </a>    
                                    </li>
                                    <?php
                                    if (isset($_SESSION['USERID'])) {
                                        ?>
        <!--                                        <li><a class="btn btn-primary me-4 py-2 rounded-pill" href="register.php" >Welcome, <?= $_SESSION['FIRSTNAME'] ?></a></li>
                                                <li><a class="btn btn-primary me-4 py-2 rounded-pill" href="logout.php">Logout</a></li>-->
                                        <?php
                                    } else {
                                        ?>
                                        <li><a href="register.php"><button type="button" class="btn btn-primary me-4 py-2 rounded-pill">Register</button></a></li>
                                        <li><a href="login.php"><button type="button" class="btn btn-primary me-4 py-2 rounded-pill">Login</button></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>

                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <!-- Navbar End -->
        </header>
