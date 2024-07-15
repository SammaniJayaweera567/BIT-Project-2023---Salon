<?php
session_start();
include 'header2.php';
include '../function.php';

// Fetch customer appointments
$customer_id = $_SESSION['customer_id'];
$conn = dbConn();
$sql = "SELECT * FROM appointments WHERE customer_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();

//Cancel Appointment 
if (isset($_GET['id'])) {
    $appointment_id = $_GET['id'];
    $conn = dbConn();
    $sql = "DELETE FROM appointments WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $appointment_id);

    if ($stmt->execute()) {
        header("Location: manage_appointments.php");
        exit();
    } else {
        echo "Error cancelling appointment.";
    }
}
?>

<main id="main">
    <section class="mt-5 py-5 booking-section">
        <div class="container mt-5 py-5">
            <div class="card card-profile-manage mb-3 my-5 border mx-auto">
                <div class="card-header card-header bg-dark-black text-light-yellow">
                    Manage Appointments
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">Appointment on <?= htmlspecialchars($row['date']); ?> at <?= htmlspecialchars($row['time']); ?></h5>
                                        <p class="card-text">Beautician: <?= htmlspecialchars($row['beautician']); ?></p>
                                        <p class="card-text">Services: <?= htmlspecialchars($row['services']); ?></p>
                                        <p class="card-text">Total Price: $<?= htmlspecialchars($row['total_price']); ?></p>
                                        <a href="cancel_appointment.php?id=<?= $row['id']; ?>" class="btn btn-danger">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
include 'footer.php';
ob_end_flush();
?>

