<?php
include 'connect.php';

try {
    // Fetch reservation details along with customer, car, and office details
    $sql = "SELECT r.*, c.*, car.*, o.* 
            FROM reservation r
            JOIN customer c ON r.user_id = c.user_id
            JOIN car ON r.num_plate = car.num_plate AND r.letter_plate = car.letter_plate
            JOIN office o ON r.office_id = o.office_id";

    $result = mysqli_query($con, $sql);

    if ($result) {
        // Display reservation details as HTML
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="reservation-details" style="max-width: 300px;
            margin: 10px;
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
            // Calculate and display the price
            $pickupDateTime = new DateTime($row['pickup_date']);
            $dropoffDateTime = new DateTime($row['dropoff_date']);
            $dateDifference = $dropoffDateTime->diff($pickupDateTime)->days;
            $price = $dateDifference * $row['price'];
            
            echo '<p>Price: $' . number_format($price, 2) . '</p>';
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
?>
