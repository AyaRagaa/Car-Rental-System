<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Retrieve start and end dates from the GET parameters
    $startDate = $_GET['startDate'];
    $endDate = $_GET['endDate'];

    try {
        // Fetch reservation details within the specified date range
        $sql = "SELECT r.*, c.*, car.*, o.* 
                FROM reservation r
                JOIN customer c ON r.user_id = c.user_id
                JOIN car ON r.num_plate = car.num_plate AND r.letter_plate = car.letter_plate
                JOIN office o ON r.office_id = o.office_id
                WHERE r.pickup_date >= '$startDate' AND r.dropoff_date <= '$endDate'";

        $result = mysqli_query($con, $sql);

        if ($result) {
            // Display reservation details as HTML
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="reservation-details"style="max-width: 300px;
                margin: 100px;
                padding: 10px;
                background-color: white; 
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
                color: black;
                text-align: center;">';
                echo '<p>Customer: ' . $row['first_name'] . ' ' . $row['last_name'] . '</p>';
                echo '<p>Car: ' . $row['model'] . ', ' . $row['year'] . ', Color: ' . $row['color'] . '</p>';
                echo '<p>Office: ' . $row['city'] . ', ' . $row['country'] . '</p>';
                echo '<p>Pickup Date: ' . $row['pickup_date'] . '</p>';
                echo '<p>Dropoff Date: ' . $row['dropoff_date'] . '</p>';
                echo '<img src="' . $row['image_path'] . '" alt="Car Image" style="max-width: 100%; height: auto;" style="max-width: 100%;
                height: auto;
                border-radius: 5px;">';
                echo '</div>';
            }
        } else {
            echo '<p>Error fetching reservations.</p>';
        }
    } catch (Exception $e) {
        echo '<p>Error: ' . $e->getMessage() . '</p>';
    } finally {
        if ($result) {
            mysqli_free_result($result);
        }
        mysqli_close($con);
    }
} else {
    // Invalid request method
    http_response_code(405);
    echo 'Invalid request method.';
}
?>
