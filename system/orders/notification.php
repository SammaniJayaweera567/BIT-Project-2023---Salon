<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>New Order Notification</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
    // Function to play sound
    function playSound(url) {
        var audio = new Audio(url);
        audio.play();
    }

    // Function to check for new orders
    function checkForNewOrder() {
        $.ajax({
            url: 'check_for_new_order.php', // Path to PHP file that checks for new orders
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.new_order_flag) {
                    // Play sound when a new order is detected
                    playSound('../assets/mixkit-access-allowed-tone-2869.wav');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', status, error);
            }
        });
    }

    // Check for new orders periodically (e.g., every 5 seconds)
    setInterval(checkForNewOrder, 5000); // Adjust interval as needed
});
</script>
</head>
<body>
<!-- Your HTML content goes here -->
</body>
</html>
