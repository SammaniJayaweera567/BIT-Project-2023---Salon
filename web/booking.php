<?php
session_start();
ob_start(); // Multiple header error removal
include 'header2.php';
include '../function.php'; // Verify this path is correct and adjust if necessary.

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_id = $_SESSION['customer_id'];
    $services = $_POST['services'];
    $beautician = $_POST['beautician'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $total_price = $_POST['total'];

    $conn = dbConn();
    $sql = "INSERT INTO appointments (customer_id, services, beautician, date, time, total_price) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssd", $customer_id, $services, $beautician, $date, $time, $total_price);

    if ($stmt->execute()) {
        $bookingMessage = "Booking successfully made.";
    } else {
        $bookingMessage = "Error making booking.";
    }
    $stmt->close();
}
?>

<main id="main">

    <section class="mt-5 py-5 booking-section">
        <div class="container mt-5 py-5">
            <h3 class="mb-4 text-center text-blue py-3">Salon Booking</h3>
            <div id="bookingSteps">
                <!-- Step 1: Service Selection -->
                <div class="accordion mb-4" id="serviceAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Step 1: Select Services
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#serviceAccordion">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <label for="mainService" class="form-label">Select Main Service</label>
                                    <select class="form-select" id="mainService" multiple>
                                        <option value="skinCare">Skin Care</option>
                                        <option value="hairCare">Hair Care</option>
                                        <option value="nailCare">Nail Care</option>
                                        <option value="footCare">Foot Care</option>
                                        <option value="dressingMakeup">Dressing & Makeup</option>
                                        <option value="bridal">Bridal</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="subService" class="form-label">Select Sub-Service</label>
                                    <select class="form-select" id="subService" multiple disabled>
                                        <option value="">Choose...</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="service" class="form-label">Select Service</label>
                                    <select class="form-select" id="service" multiple disabled>
                                        <option value="">Choose...</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Beautician Selection -->
                <div class="accordion mb-4" id="beauticianAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Step 2: Select Beautician
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#beauticianAccordion">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <label for="beautician" class="form-label">Select Beautician</label>
                                    <select class="form-select" id="beautician">
                                        <option value="">Choose...</option>
                                        <option value="beautician1">Beautician 1</option>
                                        <option value="beautician2">Beautician 2</option>
                                        <option value="beautician3">Beautician 3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Date & Time Selection -->
                <div class="accordion mb-4" id="dateTimeAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Step 3: Select Date & Time
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#dateTimeAccordion">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <label for="date" class="form-label">Select Date</label>
                                    <input type="date" class="form-control" id="date">
                                </div>
                                <div class="mb-3">
                                    <label for="time" class="form-label">Select Time</label>
                                    <input type="time" class="form-control" id="time">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 4: Booking Summary -->
                <div class="accordion mb-4" id="summaryAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Step 4: Booking Summary
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#summaryAccordion">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <label class="form-label">Selected Services:</label>
                                    <ul id="selectedServicesList" class="list-group"></ul>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Total Price: $<span id="total">0</span></label>
                                </div>
                                <button type="button" class="btn btn-primary" id="saveBooking">Save Booking</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('mainService').addEventListener('change', function() {
        // Implement sub-service and service dropdowns logic here
    });

    document.getElementById('service').addEventListener('change', function() {
        // Implement selected services list logic here
    });

    document.getElementById('saveBooking').addEventListener('click', function() {
        // Implement total price calculation logic here
    });
});
</script>

<?php
include 'footer.php';
ob_end_flush();
?>
