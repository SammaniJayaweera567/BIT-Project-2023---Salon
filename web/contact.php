<?php
session_start();
ob_start(); // Multiple header error removal
include 'header2.php';
include '../function.php'; // Verify this path is correct and adjust if necessary.

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    // Server-side validation
    if (empty($name)) {
        $errors['name'] = 'Name is required';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Valid email is required';
    }
    if (empty($message)) {
        $errors['message'] = 'Message is required';
    }

    if (empty($errors)) {
        // Process the form data (e.g., send an email)
        $success = 'Your message has been sent successfully!';
        // Reset form values
        $name = $email = $message = '';
    }
}
?>

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Contact</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Contact</li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- Contact Start -->
<div class="container-fluid contact py-5">
    <div class="container py-5">
        <div class="p-5 bg-light rounded">
            <div class="row g-4">
                <div class="col-12">
                    <div class="text-center mx-auto" style="max-width: 700px;">
                        <h1 class="text-primary">Get in touch</h1>
                        <p class="mb-4">The contact form is currently inactive. Get a functional and working contact form with Ajax & PHP in a few minutes. Just copy and paste the files, add a little code and you're done. <a href="https://htmlcodex.com/contact-form">Download Now</a>.</p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="h-100 rounded">
                        <iframe class="rounded w-100" 
                                style="height: 400px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d301877.26328868885!2d80.60352153910783!3d6.215194128508492!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae6ad0003d389ab%3A0x78ef2eda567487bf!2sSaloon%20Nisha!5e0!3m2!1sen!2slk!4v1721044488792!5m2!1sen!2slk" 
                                loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="col-lg-7">
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <?php foreach ($errors as $error): ?>
                                <p><?php echo $error; ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($success): ?>
                        <div class="alert alert-success">
                            <p><?php echo $success; ?></p>
                        </div>
                    <?php endif; ?>
                    <form id="contactForm" method="post" action="">
                        <input type="text" name="name" class="w-100 form-control border-0 py-3 mb-4" placeholder="Your Name" value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>" required>
                        <input type="email" name="email" class="w-100 form-control border-0 py-3 mb-4" placeholder="Enter Your Email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" required>
                        <textarea name="message" class="w-100 form-control border-0 mb-4" rows="5" cols="10" placeholder="Your Message" required><?php echo isset($message) ? htmlspecialchars($message) : ''; ?></textarea>
                        <button class="w-100 btn form-control border-secondary py-3 bg-white text-primary" type="submit">Submit</button>
                    </form>
                </div>
                <div class="col-lg-5">
                    <div class="d-flex p-4 rounded mb-4 bg-white">
                        <i class="fas fa-map-marker-alt fa-2x text-primary me-4"></i>
                        <div>
                            <h4>Address</h4>
                            <p class="mb-2"> No.07, Hungama Road, Angunakolapelessa.</p>
                        </div>
                    </div>
                    <div class="d-flex p-4 rounded mb-4 bg-white">
                        <i class="fas fa-envelope fa-2x text-primary me-4"></i>
                        <div>
                            <h4>Mail Us</h4>
                            <p class="mb-2">sammanijayaweera0411@gmail.com.com</p>
                        </div>
                    </div>
                    <!--Add Phone no -->
                    <div class="d-flex p-4 rounded bg-white">
                        <i class="fa fa-phone-alt fa-2x text-primary me-4"></i>
                        <div>
                            <h4>Telephone</h4>
                            <p class="mb-2">(+94) 714523496</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->

<?php
include 'footer.php';
ob_end_flush();
?>

<script>
document.getElementById('contactForm').addEventListener('submit', function(event) {
    let valid = true;

    // Clear previous error messages
    document.querySelectorAll('.error').forEach(function(element) {
        element.textContent = '';
    });

    // Client-side validation
    const name = document.querySelector('input[name="name"]');
    const email = document.querySelector('input[name="email"]');
    const message = document.querySelector('textarea[name="message"]');

    if (name.value.trim() === '') {
        document.querySelector('input[name="name"] + .error').textContent = 'Name is required';
        valid = false;
    }
    if (email.value.trim() === '') {
        document.querySelector('input[name="email"] + .error').textContent = 'Email is required';
        valid = false;
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
        document.querySelector('input[name="email"] + .error').textContent = 'Enter a valid email';
        valid = false;
    }
    if (message.value.trim() === '') {
        document.querySelector('textarea[name="message"] + .error').textContent = 'Message is required';
        valid = false;
    }

    if (!valid) {
        event.preventDefault();
    }
});
</script>
