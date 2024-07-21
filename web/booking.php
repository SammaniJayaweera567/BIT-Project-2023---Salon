<?php
//
session_start();
ob_start(); // Multiple header error removal
include 'header2.php';
include '../function.php'; // Verify this path is correct and adjust if necessary.
// Fetch services from the database
$conn = dbConn();
$sql = "SELECT ServiceId, ServiceCategoryName, SubServiceName, ServiceName, Description, Duration, Price FROM services";
$result = $conn->query($sql);

$beauticianSql = "SELECT DISTINCT empName FROM timeslot";
$beauticianResult = $conn->query($beauticianSql);

// Fetch all beautician schedules from the database (Add here)
$scheduleSql = "SELECT empName, Date, RemainingTime FROM timeslot";
$scheduleResult = $conn->query($scheduleSql);

$servicesData = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $servicesData[$row['ServiceCategoryName']][$row['SubServiceName']][$row['ServiceId']] = [
            'ServiceName' => $row['ServiceName'],
            'Description' => $row['Description'],
            'Duration' => (int) $row['Duration'], // Explicitly cast to integer
            'Price' => $row['Price']
        ];
    }
}

// For debugging: output the JSON data right before the closing </script> tag
echo '<script>console.log(' . json_encode($servicesData) . ');</script>';

$beauticians = [];
if ($beauticianResult->num_rows > 0) {
    while ($row = $beauticianResult->fetch_assoc()) {
        $beauticians[] = $row['empName'];
    }
}

$beauticianSchedules = [];
if ($scheduleResult->num_rows > 0) {
    while ($row = $scheduleResult->fetch_assoc()) {
        $beauticianSchedules[$row['empName']][$row['Date']] = (int) $row['RemainingTime'];
    }
}

echo "<script>console.log(" . json_encode($beauticianSchedules) . ");</script>";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_id = $_SESSION['customer_id'];
    $services = implode(", ", $_POST['services']);
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
            <form method="post" action="check_availability.php">
                <h3 class="mb-4 text-center text-blue py-3">Salon Booking</h3>
                <div id="bookingSteps">
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
                                            <?php foreach ($servicesData as $category => $subServices): ?>
                                                <option value="<?= $category ?>"><?= $category ?></option>
                                            <?php endforeach; ?>
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
                                        <select class="form-select" id="service" multiple>
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
                                            <?php foreach ($beauticians as $beautician): ?>
                                                <option value="<?= $beautician ?>"><?= $beautician ?></option>
                                            <?php endforeach; ?>
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
                                    Step 3: Select Date & Check Status
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#dateTimeAccordion">
                                <div class="accordion-body">
                                    <div class="mb-3">
                                        <label for="date" class="form-label">Select Date</label>
                                        <input type="date" class="form-control" id="date">
                                    </div>
                                    <label for="beauticianStatus" class="form-label">Beautician Status</label>
                                    <div id="beauticianStatus"></div> 
                                    <div class="mb-3"> 
                                        <button type="button" class="btn btn-primary" id="checkStatusButton">Check Status</button>
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


                                    <button type="button" class="btn btn-primary" id="saveBooking">Save Booking</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </section>
</main>

<script>
    const mainServiceData = <?php echo json_encode($servicesData); ?>;
    const beauticianSchedules = <?php echo json_encode($beauticianSchedules); ?>;
    const beauticianSelect = document.getElementById('beautician'); // Add this line here

    const mainServiceSelect = document.getElementById('mainService');
    const subServiceSelect = document.getElementById('subService');
    const serviceSelect = document.getElementById('service');
    const selectedServicesList = document.getElementById('selectedServicesList');
    const totalPriceElement = document.getElementById('total');
    const dateInput = document.getElementById('date');

    let selectedServices = {};   // Use an object to store selected services

    // Function to calculate total duration (Add this at the beginning of the script)
    function calculateTotalDuration() {
        let totalDuration = 0;
        for (const serviceId in selectedServices) {
            totalDuration += selectedServices[serviceId].duration;
        }

        console.log("Total Duration:", totalDuration);
        return totalDuration;
    }

    function updateBeauticianStatus(available, remainingTime) {
        const beauticianStatus = document.getElementById('beauticianStatus');
        beauticianStatus.innerHTML = ''; // Clear previous status

        const statusSpan = document.createElement('span');
        if (available) {
            statusSpan.textContent = `Beautician Available (${remainingTime} mins remaining for Beautician)`;
            statusSpan.className = 'text-success';
        } else {
            statusSpan.textContent = 'Not Available';
            statusSpan.className = 'text-danger';
        }

        beauticianStatus.appendChild(statusSpan);
    }

    mainServiceSelect.addEventListener('change', () => {
        subServiceSelect.innerHTML = '<option value="">Choose...</option>'; // Clear sub-service options
        serviceSelect.innerHTML = '<option value="">Choose...</option>';   // Clear service options

        const selectedMainServices = Array.from(mainServiceSelect.selectedOptions).map(opt => opt.value);

        for (const mainService of selectedMainServices) {
            const subServices = Object.keys(mainServiceData[mainService]);
            for (const subService of subServices) {
                const option = document.createElement('option');
                option.value = subService;
                option.text = subService;
                subServiceSelect.add(option);
            }
        }
        subServiceSelect.disabled = false;
    });

    subServiceSelect.addEventListener('change', () => {
        serviceSelect.innerHTML = '<option value="">Choose...</option>'; // Clear service options

        const selectedMainServices = Array.from(mainServiceSelect.selectedOptions).map(opt => opt.value);
        const selectedSubServices = Array.from(subServiceSelect.selectedOptions).map(opt => opt.value);

        for (const mainService of selectedMainServices) {
            for (const subService of selectedSubServices) {
                // Access services by ServiceId
                const services = mainServiceData[mainService][subService];
                for (const serviceId in services) { // Iterate over service IDs
                    const service = services[serviceId];
                    const option = document.createElement('option');
                    option.value = serviceId;

                    // Convert price to number and format
                    const price = parseFloat(service.Price).toFixed(2);

                    // Ensure service.Duration is available and is a number
                    const duration = service.Duration; // No need for type check as it's already an int

                    option.text = `${service.ServiceName} (LKR ${price}) - ${duration} mins`;
                    option.dataset.duration = duration;
                    serviceSelect.add(option);
                }
            }
        }
        serviceSelect.disabled = false;
    });

    serviceSelect.addEventListener('change', () => {
        const selectedOptions = Array.from(serviceSelect.selectedOptions);

        // Calculate new service count and total duration
        let newServiceCount = Object.keys(selectedServices).length + selectedOptions.length;
        let newTotalDuration = 0;

        for (const option of selectedOptions) {
            newTotalDuration += parseInt(option.dataset.duration, 10) || 0;
        }

        for (const serviceId in selectedServices) {
            newTotalDuration += selectedServices[serviceId].duration; // Also add existing durations
        }

        // Check for exceeding limits
        if (newServiceCount > 5) {
            alert("Customer can only select only 5 services maximum per an appointment!");
        } else if (newTotalDuration > 320) {
            alert("Customer can only select a maximum of 320 mins per appointment!");
        } else {
            // Update selectedServices, but keep existing entries
            selectedOptions.forEach(option => {
                const serviceId = option.value;
                if (!selectedServices.hasOwnProperty(serviceId)) {
                    for (const mainService in mainServiceData) {
                        for (const subService in mainServiceData[mainService]) {
                            if (mainServiceData[mainService][subService][serviceId]) {
                                const service = mainServiceData[mainService][subService][serviceId];
                                const price = parseFloat(service.Price).toFixed(2);
                                const duration = service.Duration;
                                selectedServices[serviceId] = {
                                    name: `${service.ServiceName} (LKR ${price}) - ${duration} mins`,
                                    price: price,
                                    duration: duration
                                };
                                break;
                            }
                        }
                    }
                }
            });
            updateSelectedServicesList();
        }

        // Deselect exceeding options (based on BOTH service count AND total duration)
        while (newServiceCount > 5 || newTotalDuration > 320) {
            const lastSelectedOption = selectedOptions.pop();
            if (lastSelectedOption) {
                lastSelectedOption.selected = false;
                newServiceCount -= 1;
                newTotalDuration -= parseInt(lastSelectedOption.dataset.duration, 10) || 0;
                delete selectedServices[lastSelectedOption.value]; // Remove from selected services
            }
            updateSelectedServicesList(); // Update the list to reflect changes
        }
    })


    checkStatusButton.addEventListener('click', () => {
        const selectedDate = dateInput.value;
        const selectedBeautician = beauticianSelect.value;
        const totalDuration = calculateTotalDuration();

        if (selectedDate && selectedBeautician && totalDuration) {
            const available = checkAvailability(selectedDate, selectedBeautician, totalDuration);
            let remainingTime = null;
            if (available) {
                remainingTime = beauticianSchedules[selectedBeautician][selectedDate] - totalDuration;
            }

            updateBeauticianStatus(available, remainingTime);
        } else {
            alert("Please select a date, beautician, and services.");
        }
    });


    function checkAvailability(date, beautician, totalDuration) {
        // Check if the beautician has a schedule for the selected date
        if (!beauticianSchedules[beautician] || !beauticianSchedules[beautician][date]) {
            return false; // Beautician not available on this date
        }

        const remainingTime = beauticianSchedules[beautician][date];
        return remainingTime >= totalDuration;
    }

    function updateSelectedServices() {
        selectedServices = {}; // Reset selectedServices

        const selectedOptions = Array.from(serviceSelect.selectedOptions);
        selectedOptions.forEach(option => {
            const serviceId = option.value;

            // Find the service object in mainServiceData
            for (const mainService in mainServiceData) {
                for (const subService in mainServiceData[mainService]) {
                    if (mainServiceData[mainService][subService][serviceId]) {
                        const service = mainServiceData[mainService][subService][serviceId];
                        const price = parseFloat(service.Price).toFixed(2);
                        const duration = service.Duration; // Get duration directly

                        selectedServices[serviceId] = {
                            name: `${service.ServiceName} (LKR ${price}) - ${duration} mins`, // Update name to include duration
                            price: price,
                            duration: duration
                        };
                        break;
                    }
                }
            }
        });
    }
    function updateSelectedServicesList() {
        selectedServicesList.innerHTML = '';
        let totalPrice = 0;
        let totalDuration = 0;

        for (const serviceId in selectedServices) {
            const service = selectedServices[serviceId];
            selectedServicesList.innerHTML += `
            <li class="list-group-item d-flex justify-content-between align-items-center">
                ${service.name}
                <button type="button" class="btn btn-danger btn-sm cancel-service-btn" data-service-id="${serviceId}">Cancel</button>
            </li>`;
            totalPrice += parseFloat(service.price);
            totalDuration += service.duration;
        }

        // Create/Update the total price element dynamically
        let totalPriceElement = selectedServicesList.parentNode.querySelector('div.total-price'); // Find existing
        if (!totalPriceElement) {
            totalPriceElement = document.createElement('div');
            totalPriceElement.className = 'total-price mb-3'; // Add a class for styling
            selectedServicesList.parentNode.insertBefore(totalPriceElement, selectedServicesList.nextSibling);
        }
        totalPriceElement.innerHTML = `<label class="form-label">Total Price: LKR ${totalPrice.toFixed(2)}</label>`;

        // Create/Update the total duration element dynamically
        let durationElement = selectedServicesList.parentNode.querySelector('div.total-duration'); // Find existing
        if (!durationElement) {
            durationElement = document.createElement('div');
            durationElement.className = 'total-duration mb-3'; // Add a class for styling
            selectedServicesList.parentNode.insertBefore(durationElement, totalPriceElement.nextSibling);
        }
        durationElement.innerHTML = `<label class="form-label">Total Duration: ${totalDuration} mins</label>`;

        // Attach event listeners to cancel buttons
        const cancelButtons = document.querySelectorAll('.cancel-service-btn');
        cancelButtons.forEach(button => {
            button.addEventListener('click', cancelSelectedService);
        });
    }


    function cancelSelectedService(event) {
        const serviceId = event.target.dataset.serviceId;
        if (serviceId && selectedServices[serviceId]) {
            delete selectedServices[serviceId];
            updateSelectedServicesList();

            // Find and deselect the corresponding option in the serviceSelect dropdown
            const optionToDeselect = Array.from(serviceSelect.options).find(opt => opt.value === serviceId);
            if (optionToDeselect) {
                optionToDeselect.selected = false;
            }
        }
    }

// Get today's date in YYYY-MM-DD format
    const today = new Date().toISOString().split('T')[0];

// Set the min attribute of the date input
    dateInput.min = today;
</script>
<?php
include 'footer.php';
ob_end_flush();
?>

