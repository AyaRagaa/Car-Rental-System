<?php
    include("connect.php");

    // Get parameters from the URL
    $pickupDate = $_GET['pickupDate'];
    $dropoffDate = $_GET['dropoffDate'];
    $city = $_GET['city'];
    $country = $_GET['country'];
    $username = $_GET['username'];

    $pickupDateTime = new DateTime($pickupDate);
    $dropoffDateTime = new DateTime($dropoffDate);

    // Calculate the date difference
    $dateDifference = $dropoffDateTime->diff($pickupDateTime)->days;

    // Perform a subquery to get the office_id
    $officeQuery = "SELECT office_id FROM office WHERE city='$city' AND country='$country'";
    $officeResult = mysqli_query($con, $officeQuery);

    if ($officeResult) {
        $officeRow = mysqli_fetch_assoc($officeResult);
        $office_id = $officeRow['office_id'];

        // Perform the database query to get available cars
        $query = "SELECT c.num_plate, c.letter_plate, c.model, c.year, c.status, c.image_path, c.price, c.color
        FROM car c
        LEFT JOIN reservation r ON c.num_plate = r.num_plate AND c.letter_plate = r.letter_plate
        WHERE r.num_plate IS NULL
            OR (r.pickup_date > '$dropoffDate' OR r.dropoff_date < '$pickupDate')
            OR r.office_id != '$office_id'";

        $result = mysqli_query($con, $query);

        if ($result) {
            // Display available cars with images and descriptions
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="car" style="max-width: 300px;
                margin: 10px;
                padding: 10px;
                background-color: white; 
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
                color: black;
                text-align: center;">';
                echo '<img src="' . $row['image_path'] . '" alt="' . $row['model'] . '" style="max-width: 100%;
                height: auto;
                border-radius: 5px;">';

                // Description
                $description = 'Plate Id = ' . $row['num_plate'] . ' ' . $row['letter_plate'] . ', Model: ' . $row['model'] . ', Year: ' . $row['year'] . ', Color: ' . $row['color'] . ', Price: ' .  $dateDifference* $row['price'];
                echo '<p style="margin-top: 10px;">' . $description . '</p>';
                $rentLink = 'rent.php?num_plate=' . $row['num_plate'] . '&letter_plate=' . $row['letter_plate'] . '&username=' . $username . '&pickupDate=' . $pickupDate . '&dropoffDate=' . $dropoffDate . '&office_id=' . $office_id;
                echo '<a href="' . $rentLink . '" class="rent-button">Rent</a>';

                echo '</div>';
            }
        } else {
            echo 'Error in query: ' . mysqli_error($con);
        }
    } else {
        echo 'Error getting office_id: ' . mysqli_error($con);
    }

    mysqli_close($con);
?>
