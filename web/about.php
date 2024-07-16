<?php
session_start();
ob_start(); // Multiple header error removal
include 'header2.php';
include '../function.php'; // Verify this path is correct and adjust if necessary.
?>

<main id="main">

    <!-- Single Page Header Start -->
    <div class="container-fluid page-header single-page-header py-5">
        <h1 class="text-center text-white display-6">About</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active text-white">About</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- About Us Section Start -->
    <div class="container-fluid featurs py-5">
        <div class="container py-5">
            <div class="col-lg-12 text-center">
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-6">
                    <div class="About-img text-center rounded bg-light">
                        <img src="assets/img/aboutus-img.jpg" class="img-fluid w-100 h-100 rounded" alt="Second slide">
                    </div>
                </div>

                <div class="col-md-6 col-lg-6">
                    <div class="Aboutus-content p-4">
                        <p class="mb-0">Salon Angel is a premier salon located in the heart of Tangalle, offering exceptional beauty and wellness services since 2012. With a dedication to enhancing natural beauty and providing unparalleled customer service, Salon Angel has become a trusted name in the community.</p><br>

                        <p class="mb-0">With an unparalleled system of continuous training, the Ramani Fernando brand continues to evoke the best in hair and beauty.The release of new hair collections each year ensures that our team is at the forefront in trends to provide a quality of work that is synonymous with excellence.

                            Our clients can relax in the knowledge that they are in expert hands, addressing their personal hair and beauty needs.

                            Visit any one of our conveniently located branches to get a taste of the difference.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- About us Section End -->

    <!--Vision-Mission Start-->
    <div class="container-fluid vis-mis py-5">
        <div class="container pb-5">
            <div class="vission-mission-section">
                <div class="second-sec d-flex">
                    <div class="row">
                        <div class="col mb-2">
                            <div class="card h-100 me-2">
                                <div class="card-body p-5">
                                    <div class="icon-viss-miss">
                                        <i class="far fa-lightbulb"></i>  
                                    </div>
                                    <h5 class="card-title">Vision</h5>
                                    <p class="card-text">Our vision is to be the leading salon in the Tangalle area, known for our excellence in beauty services and customer care. We aspire to be at the forefront of beauty trends, setting high standards for quality and service. We aim to inspire confidence in our clients, helping them feel beautiful both inside and out. Additionally, we are dedicated to building strong relationships within our community and giving back through various initiatives and partnerships.
                                    </p>
                                </div>
                            </div> 
                        </div>
                        <div class="col mb-2">
                            <div class="card h-100 ms-2">
                                <div class="card-body p-5">
                                    <div class="icon-viss-miss">
                                        <i class="far fa-compass"></i>
                                    </div>
                                    <h5 class="card-title">Mission</h5>
                                    <p class="card-text">At Salon Angel, our mission is to create a serene and welcoming environment where our clients can indulge in top-quality beauty services. We are committed to enhancing natural beauty using the finest products and latest techniques, aiming to bring out the best in our clients. Our focus is on providing a personalized experience that caters to the unique needs of each individual, ensuring exceptional customer service. We believe in ongoing education, continually improving our skills and staying updated with the latest trends and innovations in the beauty industry.
                                    </p>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Vision-Mission End-->

</main>

<?php
include 'footer.php';
ob_end_flush();
?>

