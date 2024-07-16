
<!-- Footer Start -->
<div class="container-fluid bg-dark-blue text-white-50 footer pt-5 mt-5">
    <div class="container py-5">
        <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
            <div class="row g-4">
                <div class="col-lg-6">
                    <a href="#">
                        <h1 class="text-white mb-0">Salon Angel</h1>
                        <p class="text-light-yellow mb-0">Quality Services</p>
                    </a>
                </div>
                <div class="col-lg-6">
                    <div class="d-flex justify-content-end pt-3">
                        <a class="btn  btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-secondary btn-md-square rounded-circle" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <div class="footer-item">
                    <h4 class="text-light mb-3">Why People Like us!</h4>
                    <p class="mb-4">typesetting, remaining essentially unchanged. It was 
                        popularised in the 1960s with the like Aldus PageMaker including of Lorem Ipsum.</p>
                    <a href="about.php" class="btn py-2 px-4 rounded-pill text-primary btn btn-primary me-4">Read More</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-flex flex-column text-start footer-item">
                    <h4 class="text-light mb-3">Salon Info</h4>
                    <a class="btn-link" href="about.php">About</a>
                    <a class="btn-link" href="services.php">Services</a>
                    <a class="btn-link" href="gallery.php">Gallery</a>
                    <a class="btn-link" href="product.php">Products</a>
                    <a class="btn-link" href="contact.php">Contact Us</a>
                    <!--<a class="btn-link" href="">Return Policy</a>-->
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-flex flex-column text-start footer-item">
                    <h4 class="text-light mb-3">Account</h4>
                    <a class="btn-link" href="profile_management.php">My Account</a>
                    <!--<a class="btn-link" href="product.php">Products</a>-->
                    <a class="btn-link" href="cart.php">Shopping Cart</a>
                    <a class="btn-link" href="chackout.php">Checkout</a>
                    <a class="btn-link" href="order_history.php">Order History</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-item">
                    <h4 class="text-light mb-3">Contact</h4>
                    <p>Address: No.07, Hungama Road, Angunakolapelessa.</p>
                    <p>Email: sammanijayaweera0411@gmail.com</p>
                    <p>Phone: +94 714523496</p>
                    <p>Payment Accepted</p>
                    <img src="assets/img/payment.png" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Copyright Start -->
<div class="container-fluid copyright bg-dark-yellow py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Salon Angel</a>, All right reserved.</span>
            </div>
            <div class="col-md-6 my-auto text-center text-md-end text-white">
                <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                Designed By <a class="border-bottom" href="https://htmlcodex.com">Sammani Jayaweera</a> Distributed By <a class="border-bottom" href="https://themewagon.com">ThemeWagon</a>
            </div>
        </div>
    </div>
</div>
<!-- Copyright End -->



<!-- Back to Top -->
<a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   


<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<!--        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>-->
<script src="assets/lib/easing/easing.min.js"></script>
<script src="assets/lib/waypoints/waypoints.min.js"></script>
<script src="assets/lib/lightbox/js/lightbox.min.js"></script>
<script src="assets/lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Template Javascript -->
<script src="assets/js/main.js"></script>

<script>
    const gallery = document.querySelector('.gallery');
    const track = document.querySelector('.gallery-track');
    const cards = document.querySelectorAll('.card');
    const easing = 0.05;
    let startY = 0;
    let endY = 0;
    let raf;

    const lerp = (start, end, t) => start * (1 - t) + end * t;

    function updateScroll() {
        startY = lerp(startY, endY, easing);
        gallery.style.height = `${track.clientHeight}px`;
        track.style.transform = `translateY(-${startY}px)`;
        activateParallax();
        raf = requestAnimationFrame(updateScroll);
        if (startY.toFixed(1) === window.scrollY.toFixed(1))
            cancelAnimationFrame(raf);
    }

    function startScroll() {
        endY = window.scrollY;
        cancelAnimationFrame(raf);
        raf = requestAnimationFrame(updateScroll);
    }

    function parallax(card) {
        const wrapper = card.querySelector('.card-image-wrapper');
        const diff = card.offsetHeight - wrapper.offsetHeight;
        const {top} = card.getBoundingClientRect();
        const progress = top / window.innerHeight;
        const yPos = diff * progress;
        wrapper.style.transform = `translateY(${yPos}px)`;
    }

    const activateParallax = () => cards.forEach(parallax);

    function init() {
        activateParallax();
        startScroll();
    }

    window.addEventListener('load', updateScroll, false);
    window.addEventListener('scroll', init, false);
    window.addEventListener('resize', updateScroll, false);
</script>

<script>
    $('.brand-carousel').owlCarousel({
        loop: true,
        margin: 10,
        autoplay: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    });

</script>



<script>
    function updateProfilePicture(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('profilePicture').src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function removeProfilePicture() {
        document.getElementById('profilePicture').src = 'default-profile.png'; // Update this to your default profile image path
        document.getElementById('profilePictureInput').value = '';
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
</body>
</html>

