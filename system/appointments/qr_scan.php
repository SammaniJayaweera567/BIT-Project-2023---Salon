<?php
ob_start();
include_once '../init.php';

//Create header links
$link = "Appointments Management";
$breadcrumb_item = "Appointments";
$breadcrumb_item_active = "Scan QR";

extract($_GET);

if (!empty($appointmentid)) {
    $db = dbConn();
    $sql = "SELECT
    appointments.id                
    , customers.FirstName
    , customers.LastName
    , customers.Email
    , customers.MobileNo
    , appointments.date
    , appointments.start_time
    , appointments.end_time
FROM
    appointments
    INNER JOIN customers 
        ON appointments.customer_id = customers.CustomerId WHERE appointments.id='$appointmentid'";
    $result = $db->query($sql);
}
?> 

<!--Set QR scanner library and link the file (This is a js library)-->
<script src="../../qr_scanner/instascan.min.js" type="text/javascript"></script>
<div class="row">
    <div class="col-4">  

        <!--Open the camera video-->
        <video id="scan_job" height="200" width="285" class="border border-1 border-black"></video>
        <br>

        <!--Camera on and off process-->
        <button type="button" class="btn btn-success" onclick="scanjob()">Start Scan</button>
        <button type="button" class="btn btn-warning" onclick="stopscan()">Stop Scan</button>
    </div>
    <div class="col-md-8">
        <?php
        if (@$result) {
            $row = $result->fetch_assoc();
            ?>
            <table class="table table-striped text-nowrap">
                <thead>
                    <tr>                           
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Mobile No</th>
                        <th>App. Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>

                    </tr>
                </thead>
                <tbody>

                    <tr>                           
                        <td><?= $row['FirstName'] ?></td>
                        <td><?= $row['LastName'] ?></td>
                        <td><?= $row['Email'] ?></td>
                        <td><?= $row['MobileNo'] ?></td>
                        <td><?= $row['date'] ?></td>
                        <td><?= $row['start_time'] ?></td>
                        <td><?= $row['end_time'] ?></td>

                    </tr>


                </tbody>
            </table>
            <?php
        }
        ?>
    </div>
</div>
<?php
$content = ob_get_clean();
include '../layouts.php';
?>
<script src="../../qr_scanner/qr_scanner/instascan.min.js" type="text/javascript"></script>
<script>

    //The function that starts the scanjob...................
    function scanjob() {
        let scanner = new Instascan.Scanner({video: document.getElementById('scan_job')});
        scanner.addListener('scan', function (content) {
            findAppointment(content);
        });
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error('No cameras found.');
            }
        }).catch(function (e) {
            console.error(e);
        });
    }

    //The function that starts the scanjob...................
    function stopscan() {
        const video = document.querySelector('video');
        const mediaStream = video.srcObject;
        const tracks = mediaStream.getTracks();
        tracks[0].stop();
        tracks.forEach(track => track.stop())
    }

    //Add qr contet ....................
    function findAppointment(appointmentid) {
        window.location.href = "http://localhost/sms/system/appointments/qr_scan.php?appointmentid=" + appointmentid
    }
</script>