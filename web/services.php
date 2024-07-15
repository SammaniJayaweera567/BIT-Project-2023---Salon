<?php
session_start();
ob_start(); // Multiple header error removal
include 'header2.php';
include '../function.php'; // Verify this path is correct and adjust if necessary.
?>

<main id="main">

    <!-- Single Page Header Start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Services</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active text-white">Services</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Services section Start-->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <h4 class="px-4 py-2 rounded subservice-title text-center text-light-yellow bg-dark-black">Skin Care</h4>
            <div class="row g-4 my-5">
                <div class="sub-services-title">
                    <h3 class="text-dark-yellow border-bottom-red">Threading</h3>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Eyebrows Threading</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 350.00</p>
                                <p class="text-dark-yellow">15min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Upper Lip Threading</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 250.00</p>
                                <p class="text-dark-yellow">10min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Chin Threading</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 250.00</p>
                                <p class="text-dark-yellow">10min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Full Face Threading</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 1500.00</p>
                                <p class="text-dark-yellow">60min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 my-5">
                <div class="sub-services-title">
                    <h3 class="text-dark-yellow border-bottom-red">Facials</h3>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Basic Cleanup</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 2500.00</p>
                                <p class="text-dark-yellow">90min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Basic Facials</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 3000.00</p>
                                <p class="text-dark-yellow">120min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Eye Treatment</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 1500.00</p>
                                <p class="text-dark-yellow">30min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Youth Treatment</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 4000.00</p>
                                <p class="text-dark-yellow">60min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Gold Facials</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 4000.00</p>
                                <p class="text-dark-yellow">90min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Whitening Facial</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 4000.00</p>
                                <p class="text-dark-yellow">90min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row g-4 my-5">
                <div class="sub-services-title">
                    <h3 class="text-dark-yellow border-bottom-red">Waxing</h3>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Upper Lip Waxing</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 400.00</p>
                                <p class="text-dark-yellow">15min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Full Face Waxing</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 1500.00</p>
                                <p class="text-dark-yellow">30min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Full Legs Waxing</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 1500.00</p>
                                <p class="text-dark-yellow">45min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Full Arms Waxing</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 1000.00</p>
                                <p class="text-dark-yellow">30min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Half Legs Waxing</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 1500.00</p>
                                <p class="text-dark-yellow">45min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Under Arms Waxing</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 1500.00</p>
                                <p class="text-dark-yellow">30min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Chest Waxing</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 1500.00</p>
                                <p class="text-dark-yellow">30min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row g-4 my-5">
                <div class="sub-services-title">
                    <h3 class="text-dark-yellow border-bottom-red">Others</h3>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Eyelash Extension</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 5000.00</p>
                                <p class="text-dark-yellow">60min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container py-5">
            <h4 class="px-4 py-2 rounded subservice-title text-center text-light-yellow bg-dark-black">Hair Care</h4>
            <div class="row g-4 my-5">
                <div class="sub-services-title">
                    <h3 class="text-dark-yellow border-bottom-red">Hair</h3>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Kids Haircut</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 1000.00</p>
                                <p class="text-dark-yellow">30min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Shampoo Blow Dry</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 2000.00</p>
                                <p class="text-dark-yellow">45min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Hair Ironing</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 4000.00</p>
                                <p class="text-dark-yellow">60min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Roller Setting</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 5000.00</p>
                                <p class="text-dark-yellow">60min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Hair Style</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 3500.00</p>
                                <p class="text-dark-yellow">60min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Hair Extension</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 10000.00</p>
                                <p class="text-dark-yellow">90min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

            <div class="row g-4 my-5">
                <div class="sub-services-title">
                    <h3 class="text-dark-yellow border-bottom-red">Hair Treatments</h3>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>L'OREAL Keratin Treatment</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 25000.00</p>
                                <p class="text-dark-yellow">120min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>KENUE Hair Conditioning Treatment</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 4000.00</p>
                                <p class="text-dark-yellow">60min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>KENUE Scalf Treatment</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 3000.00</p>
                                <p class="text-dark-yellow">60min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>KENUE Pure Moisturizing Treatment</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 4000.00</p>
                                <p class="text-dark-yellow">60min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Deep Moisturizing Treatment</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 5000.00</p>
                                <p class="text-dark-yellow">90min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Head Oil Massage</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 1000.00</p>
                                <p class="text-dark-yellow">30min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row g-4 my-5">
                <div class="sub-services-title">
                    <h3 class="text-dark-yellow border-bottom-red">Hair Relaxing / Bonding</h3>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Hair Relaxing</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 10000.00</p>
                                <p class="text-dark-yellow">240min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Hair Re-Bonding</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 10000.00</p>
                                <p class="text-dark-yellow">240min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Hair Semi-Bonding</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 14000.00</p>
                                <p class="text-dark-yellow">240min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Keratin Treatment</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 20000.00</p>
                                <p class="text-dark-yellow">180min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row g-4 my-5">
                <div class="sub-services-title">
                    <h3 class="text-dark-yellow border-bottom-red">Hair Color</h3>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Full Head Color</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 10000.00</p>
                                <p class="text-dark-yellow">120min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Highlights</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 15000.00</p>
                                <p class="text-dark-yellow">120min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>One Streak Color</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 3500.00</p>
                                <p class="text-dark-yellow">45min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Semi Color Roots</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 5000.00</p>
                                <p class="text-dark-yellow">60min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Semi Color Full Head</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 9000.00</p>
                                <p class="text-dark-yellow">60min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>KEUNE Pure Hair Color Roots</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 10000.00</p>
                                <p class="text-dark-yellow">60min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>KEUNE Pure Hair Color Full Head</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 15000.00</p>
                                <p class="text-dark-yellow">90min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container py-5">
            <h4 class="px-4 py-2 rounded subservice-title text-center text-light-yellow bg-dark-black">Nail Care</h4>
            <div class="row g-4 my-5">
                <div class="sub-services-title">
                    <h3 class="text-dark-yellow border-bottom-red">Manicures</h3>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Basic Manicure</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 2500.00</p>
                                <p class="text-dark-yellow">60min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Gel Manicure</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 2500.00</p>
                                <p class="text-dark-yellow">60min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>French Manicure</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 3000.00</p>
                                <p class="text-dark-yellow">60min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Acrylic Nails</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 3500.00</p>
                                <p class="text-dark-yellow">90min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Dip Powder Nails</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 3500.00</p>
                                <p class="text-dark-yellow">90min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Nail Art</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 3500.00</p>
                                <p class="text-dark-yellow">90min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Color Change</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 2000.00</p>
                                <p class="text-dark-yellow">45min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Spa Manicure</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 3500.00</p>
                                <p class="text-dark-yellow">45min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Remove Acrylic / Gel Nails</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 4000.00</p>
                                <p class="text-dark-yellow">60min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Powder Dip Color Manicure</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 4000.00</p>
                                <p class="text-dark-yellow">60min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

            <div class="row g-4 my-5">
                <div class="sub-services-title">
                    <h3 class="text-dark-yellow border-bottom-red">Nail Treatment</h3>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Nail Repair</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 2500.00</p>
                                <p class="text-dark-yellow">30min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Paraffin Wax Treatment</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 3000.00</p>
                                <p class="text-dark-yellow">60min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Nail Strengthening Treatments</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 3000.00</p>
                                <p class="text-dark-yellow">60min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container py-5">
            <h4 class="px-4 py-2 rounded subservice-title text-center text-light-yellow bg-dark-black">Foot Care</h4>
            <div class="row g-4 my-5">
                <div class="sub-services-title">
                    <h3 class="text-dark-yellow border-bottom-red">Pedicures</h3>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Basic Pedicure</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 3000.00</p>
                                <p class="text-dark-yellow">60min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Spa Pedicure</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 3500.00</p>
                                <p class="text-dark-yellow">90min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Gel Pedicure</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 3000.00</p>
                                <p class="text-dark-yellow">60min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>French Pedicure</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 1500.00</p>
                                <p class="text-dark-yellow">90min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Powder Dip Color Pedicure</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 4000.00</p>
                                <p class="text-dark-yellow">60min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 my-5">
                <div class="sub-services-title">
                    <h3 class="text-dark-yellow border-bottom-red">Foot Treatments</h3>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Callus Removal</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 2500.00</p>
                                <p class="text-dark-yellow">30min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Paraffin Wax Treatment</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 4000.00</p>
                                <p class="text-dark-yellow">90min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Foot Masks and Exfoliation</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 5000.00</p>
                                <p class="text-dark-yellow">90min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Foot Massage</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 4000.00</p>
                                <p class="text-dark-yellow">60min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Foot Scrub</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 4000.00</p>
                                <p class="text-dark-yellow">60min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container py-5">
            <h4 class="px-4 py-2 rounded subservice-title text-center text-light-yellow bg-dark-black">Dressing and Makeup</h4>
            <div class="row g-4 my-5">
                <div class="sub-services-title">
                    <h3 class="text-dark-yellow border-bottom-red">Dressing</h3>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Full Dressing(Makeup/Hair/Saree)</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 4500.00</p>
                                <p class="text-dark-yellow">90min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Drape</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 4500.00</p>
                                <p class="text-dark-yellow">60min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Hair Style</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 3000.00</p>
                                <p class="text-dark-yellow">60min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Saree Drape</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 3000.00</p>
                                <p class="text-dark-yellow">60min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

            <div class="row g-4 my-5">
                <div class="sub-services-title">
                    <h3 class="text-dark-yellow border-bottom-red">Makeup</h3>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Basic Makeup</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 3000.00</p>
                                <p class="text-dark-yellow">60min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>MAC Makeup</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 3500.00</p>
                                <p class="text-dark-yellow">60min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container py-5">
            <h4 class="px-4 py-2 rounded subservice-title text-center text-light-yellow bg-dark-black">Bridal</h4>
            <div class="row g-4 my-5">
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Kandian</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Western</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Indian</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Hindu</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

            <div class="row g-4 my-5">
                <div class="sub-services-title">
                    <h3 class="text-dark-yellow border-bottom-red">Bridal Packages</h3>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Bridal Package 1</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 150,000.00</p>
                                <p class="text-dark-yellow">240min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Bridal Package 2</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 200,000.00</p>
                                <p class="text-dark-yellow">240min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Bridal Package 3</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 300,000.00</p>
                                <p class="text-dark-yellow">320min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>Bridal Package 4</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">LKR 400,000.00</p>
                                <p class="text-dark-yellow">320min</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select to Compare
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service section End-->


</main>

<?php
include 'footer.php';
ob_end_flush();
?>
