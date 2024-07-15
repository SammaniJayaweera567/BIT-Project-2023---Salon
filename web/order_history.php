<?php
session_start();
ob_start(); // Multiple header error removal
include 'header2.php';
include '../function.php'; // Verify this path is correct and adjust if necessary.
?>

<main id="main">
    <section class="order-history-section py-5  my-5">
        <div class="container mt-5 py-5">

            <!-- Profile Management Card -->
            <div class="card card-profile-manage mb-3 my-5 border mx-auto">
                <div class="card-header card-header bg-dark-black text-light-yellow">
                    Order History
                </div>
                <div class="card-body">
                    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" role="form" class="php-email-form mt-5 bg-white rounded" novalidate>

                    </form>
                </div>
            </div>
        </div>
    </section>

</main>

<?php
include 'footer.php';
ob_end_flush();
?>