<?php
session_start();
ob_start(); // Multiple header error removal
include 'header2.php';
include '../function.php'; // Verify this path is correct and adjust if necessary.

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
                                        <option value="skinCare">Skin Care ($50-$80)</option>
                                        <option value="hairCare">Hair Care ($25-$40)</option>
                                        <option value="nailCare">Nail Care ($20-$40)</option>
                                        <option value="footCare">Foot Care ($20-$35)</option>
                                        <option value="dressingMakeup">Dressing & Makeup ($40-$70)</option>
                                        <option value="bridal">Bridal ($80-$200)</option>
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
                                <div class="mb-3">
                                    <button type="button" class="btn btn-danger" id="cancelService">Cancel Selected Service</button>
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
        updateSubServiceOptions();
    });

    document.getElementById('subService').addEventListener('change', function() {
        updateServiceOptions();
    });

    document.getElementById('service').addEventListener('change', function() {
        addSelectedServices();
    });

    document.getElementById('cancelService').addEventListener('click', function() {
        cancelSelectedService();
    });

    document.getElementById('saveBooking').addEventListener('click', function() {
        saveBooking();
    });
});

const mainServiceData = {
    skinCare: {
        subServices: {
            facial: ['Basic Facial ($50)', 'Advanced Facial ($70)'],
            treatment: ['Acne Treatment ($60)', 'Anti-Aging Treatment ($80)']
        }
    },
    hairCare: {
        subServices: {
            cut: ['Trim ($30)', 'Layer Cut ($40)'],
            style: ['Blow Dry ($25)', 'Curling ($35)']
        }
    },
    nailCare: {
        subServices: {
            manicure: ['Basic Manicure ($20)', 'Gel Manicure ($30)'],
            pedicure: ['Basic Pedicure ($25)', 'Spa Pedicure ($40)']
        }
    },
    footCare: {
        subServices: {
            massage: ['Foot Massage ($20)', 'Foot Reflexology ($30)'],
            treatment: ['Callus Treatment ($35)', 'Moisturizing Treatment ($25)']
        }
    },
    dressingMakeup: {
        subServices: {
            makeup: ['Day Makeup ($50)', 'Evening Makeup ($70)'],
            dressing: ['Casual Dressing ($40)', 'Formal Dressing ($60)']
        }
    },
    bridal: {
        subServices: {
            Kandiyan: ['Package 1 ($200)', 'Package 2 ($200)', 'Package 3 ($200)', 'Package 4 ($200)'],
            Western: ['Package 1 ($200)', 'Package 2 ($200)', 'Package 3 ($200)', 'Package 4 ($200)'],
            Indian: ['Package 1 ($200)', 'Package 2 ($200)', 'Package 3 ($200)', 'Package 4 ($200)'],
            Hindu: ['Package 1 ($200)', 'Package 2 ($200)', 'Package 3 ($200)', 'Package 4 ($200)']
        }
    }
};

let selectedServices = [];
const servicePrices = {
    'Basic Facial ($50)': 50,
    'Advanced Facial ($70)': 70,
    'Acne Treatment ($60)': 60,
    'Anti-Aging Treatment ($80)': 80,
    'Trim ($30)': 30,
    'Layer Cut ($40)': 40,
    'Blow Dry ($25)': 25,
    'Curling ($35)': 35,
    'Basic Manicure ($20)': 20,
    'Gel Manicure ($30)': 30,
    'Basic Pedicure ($25)': 25,
    'Spa Pedicure ($40)': 40,
    'Foot Massage ($20)': 20,
    'Foot Reflexology ($30)': 30,
    'Callus Treatment ($35)': 35,
    'Moisturizing Treatment ($25)': 25,
    'Day Makeup ($50)': 50,
    'Evening Makeup ($70)': 70,
    'Casual Dressing ($40)': 40,
    'Formal Dressing ($60)': 60,
    'Bridal Makeup ($200)': 200,
    'Bridal Hair Styling ($150)': 150,
    'Makeup Trial ($100)': 100,
    'Hair Trial ($80)': 80
};

function updateSubServiceOptions() {
    const selectedMainServices = Array.from(document.getElementById('mainService').selectedOptions).map(option => option.value);
    const subServiceSelect = document.getElementById('subService');
    const serviceSelect = document.getElementById('service');

    subServiceSelect.innerHTML = '<option value="">Choose...</option>';
    serviceSelect.innerHTML = '<option value="">Choose...</option>';
    subServiceSelect.disabled = true;
    serviceSelect.disabled = true;

    if (selectedMainServices.length > 0) {
        selectedMainServices.forEach(mainService => {
            const subServices = mainServiceData[mainService].subServices;
            for (const subService in subServices) {
                subServiceSelect.innerHTML += `<option value="${subService}" data-main-service="${mainService}">${subService}</option>`;
            }
        });
        subServiceSelect.disabled = false;
    }
}

function updateServiceOptions() {
    const selectedSubServices = Array.from(document.getElementById('subService').selectedOptions).map(option => option.value);
    const serviceSelect = document.getElementById('service');
    serviceSelect.innerHTML = '<option value="">Choose...</option>';
    serviceSelect.disabled = true;

    if (selectedSubServices.length > 0) {
        selectedSubServices.forEach(subService => {
            const mainService = document.getElementById('subService').querySelector(`option[value="${subService}"]`).dataset.mainService;
            const services = mainServiceData[mainService].subServices[subService];
            services.forEach(service => {
                serviceSelect.innerHTML += `<option value="${service}" data-main-service="${mainService}" data-sub-service="${subService}">${service}</option>`;
            });
        });
        serviceSelect.disabled = false;
    }
}

function addSelectedServices() {
    const selectedOptions = Array.from(document.getElementById('service').selectedOptions);
    selectedOptions.forEach(option => {
        const service = option.value;
        if (service && !selectedServices.includes(service) && selectedServices.length < 5) {
            selectedServices.push(service);
        }
    });
    updateSelectedServicesList();
    updateTotalPrice();
}

function cancelSelectedService() {
    if (selectedServices.length > 0) {
        selectedServices.pop();
        updateSelectedServicesList();
        updateTotalPrice();
    } else {
        alert('No services to cancel.');
    }
}

function updateSelectedServicesList() {
    const selectedServicesList = document.getElementById('selectedServicesList');
    selectedServicesList.innerHTML = '';
    selectedServices.forEach(service => {
        selectedServicesList.innerHTML += `<li class="list-group-item">${service}</li>`;
    });
}

function updateTotalPrice() {
    const totalPrice = selectedServices.reduce((total, service) => total + servicePrices[service], 0);
    document.getElementById('total').innerText = totalPrice;
}

function saveBooking() {
    if (selectedServices.length === 0) {
        alert('Please select at least one service.');
        return;
    }
    const beautician = document.getElementById('beautician').value;
    const date = document.getElementById('date').value;
    const time = document.getElementById('time').value;

    if (!beautician || !date || !time) {
        alert('Please select beautician, date, and time.');
        return;
    }

    // Here you can add the code to save the booking data via AJAX or a form submission.
    alert('Booking saved successfully!');
}
</script>
<?php
include 'footer.php';
ob_end_flush();
?>

