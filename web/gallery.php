<?php
session_start();
ob_start(); // Multiple header error removal
include 'header2.php';
include '../function.php'; // Verify this path is correct and adjust if necessary.
?>

<main id="main">

    <!-- Single Page Header Start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Gallery</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active text-white">Gallery</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Single Page Header Start -->
    <div class="container-fluid gallery py-5 my-5">
        <div class="gallery-image">
            <div class="img-box">
                <img src="assets/img/gallery1.jpg" alt="" />
                <div class="transparent-box">
                    <div class="caption">
                        <p>Bridal</p>
                        <p class="opacity-low">Bridal Dressing</p>
                    </div>
                </div> 
            </div>
            <div class="img-box">
                <img src="assets/img/gallery2.jpg" alt="" />
                <div class="transparent-box">
                    <div class="caption">
                        <p>Bridal</p>
                        <p class="opacity-low">Bridal Dressing</p>
                    </div>
                </div>
            </div>
            <div class="img-box">
                <img src="assets/img/gallery3.jpg" alt="" />
                <div class="transparent-box">
                    <div class="caption">
                        <p>Dressing & Makeup</p>
                        <p class="opacity-low">Makeup</p>
                    </div>
                </div>
            </div>
            <div class="img-box">
                <img src="assets/img/gallery4.jpg" alt="" />
                <div class="transparent-box">
                    <div class="caption">
                        <p>Dressing & Makeup</p>
                        <p class="opacity-low">Makeup</p>
                    </div>
                </div> 
            </div>
            <div class="img-box">
                <img src="assets/img/gallery5.jpg" alt="" />
                <div class="transparent-box">
                    <div class="caption">
                        <p>Hair Cut</p>
                        <p class="opacity-low">Hair Care</p>
                    </div>
                </div> 
            </div>
            <div class="img-box">
                <img src="assets/img/gallery6.jpg" alt="" />
                <div class="transparent-box">
                    <div class="caption">
                        <p>Hair Conditioning</p>
                        <p class="opacity-low">Hair Care</p>
                    </div>
                </div> 
            </div>
            <div class="img-box">
                <img src="assets/img/gallery7.jpg" alt="" />
                <div class="transparent-box">
                    <div class="caption">
                        <p>Hair Setting</p>
                        <p class="opacity-low">Hair Care</p>
                    </div>
                </div> 
            </div>
            <div class="img-box">
                <img src="assets/img/gallery8.jpg" alt="" />
                <div class="transparent-box">
                    <div class="caption">
                        <p>Hair Color</p>
                        <p class="opacity-low">Hair Care</p>
                    </div>
                </div> 
            </div>
            <div class="img-box">
                <img src="assets/img/gallery9.jpg" alt="" />
                <div class="transparent-box">
                    <div class="caption">
                        <p>Makeup</p>
                        <p class="opacity-low">Dressing and Makeup</p>
                    </div>
                </div> 
            </div>
            <div class="img-box">
                <img src="assets/img/gallery10.jpg" alt="" />
                <div class="transparent-box">
                    <div class="caption">
                        <p>Dressing</p>
                        <p class="opacity-low">Dressing and Makeup</p>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <!-- Single Page Header End -->


</main>

<?php
include 'footer.php';
ob_end_flush();
?>

