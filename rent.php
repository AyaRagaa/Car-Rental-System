<?php
    include("connect.php");

    // Get parameters from the URL
    $num_plate = $_GET['num_plate'];
    $letter_plate = $_GET['letter_plate'];
    $username = $_GET['username'];
    $pickupDate = $_GET['pickupDate'];
    $dropoffDate = $_GET['dropoffDate'];
    $office_id = $_GET['office_id'];


    // Perform the database query to insert reservation data
    $insertQuery = "INSERT INTO reservation (num_plate, letter_plate, user_id, pickup_date, dropoff_date, office_id)
                    VALUES ('$num_plate', '$letter_plate', '$username', '$pickupDate', '$dropoffDate', '$office_id')";

    $insertResult = mysqli_query($con, $insertQuery);

    if ($insertResult) {
        // Successfully inserted into the reservation table

        // Close the database connection
        mysqli_close($con);

        echo "<script type='text/javascript'>alert('Reservation Successful');window.location='yourhome.html?username=$username';</script>";
        
        exit();
    } else {
        echo 'Error in query: ' . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($con);
?>
