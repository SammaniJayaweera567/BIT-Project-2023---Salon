<?php
session_start();
include 'header2.php';
include '../function.php';

// Fetch customer appointment history
$customer_id = $_SESSION['customer_id'];
$conn = dbConn();
$sql = "SELECT * FROM appointments WHERE customer_id = ? ORDER BY date DESC, time DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<main id="main">
    <section class="mt-5 py-5 booking-section">
        <div class="container mt-5 py-5">
            <h3 class="mb-4 text-center text-blue py-3">Appointment History</h3>
            <div class="row">
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Appointment on <?= htmlspecialchars($row['date']); ?> at <?= htmlspecialchars($row['time']); ?></h5>
                                    <p class="card-text">Beautician: <?= htmlspecialchars($row['beautician']); ?></p>
                                    <p class="card-text">Services: <?= htmlspecialchars($row['services']); ?></p>
                                    <p class="card-text">Total Price: $<?= htmlspecialchars($row['total_price']); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-12">
                        <p class="text-center">You have no past appointments.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<?php
include 'footer.php';
?>
