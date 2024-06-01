<?php
include("connect.php");

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $plateNum = $_POST["plateNum"];
    $plateLetter = $_POST["plateLetter"];
    $status = $_POST["status"];

    // Check if the plate number and letter exist in the database
    $checkPlateQuery = "SELECT * FROM car WHERE num_plate='$plateNum' AND letter_plate='$plateLetter'";
    $result = $con->query($checkPlateQuery);

    if ($result->num_rows == 0) {
        echo "<script type='text/javascript'>alert('Car with Plate Number: $plateNum and Plate Letter: $plateLetter does not exist.'); window.location.href = 'adminHome.html';</script>";
        exit;
    }

    // Update the car status in the database
    $updateQuery = "UPDATE car SET status='$status' WHERE num_plate='$plateNum' AND letter_plate='$plateLetter'";

    if ($con->query($updateQuery) === TRUE) {
        echo "<script type='text/javascript'>alert('Car status updated successfully'); window.location.href='adminHome.html';</script>";
    } else {
        echo "<script type='text/javascript'>alert('Error updating car status: " . $conn->error . "');</script>";
    }

    $conn->close();
}
?>
