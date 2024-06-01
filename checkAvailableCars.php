<?php

include("connect.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve form data
    $pickupDate = $_POST["pickupDate"];
    $dropoffDate = $_POST["dropoffDate"];
    $city = $_POST["city"];
    $country = $_POST["country"];
    $username = $_POST["username"];

    // Compare dates using timestamps
    $pickupTimestamp = strtotime($pickupDate);
    $dropoffTimestamp = strtotime($dropoffDate);

    if ($pickupTimestamp > $dropoffTimestamp) {
        echo "<script type='text/javascript'>alert('Please Enter Valid Dates');window.location='yourhome.html?username=$username';</script>";
        exit(); // Stop further execution
    }

    $office_verify = mysqli_query($con, "SELECT * FROM office WHERE city='$city' AND country='$country' ");

    if (mysqli_num_rows($office_verify) != 1) {

        echo "<script type='text/javascript'>alert('Please Enter A Valid City And Country From One Of Our Offices');window.location='yourhome.html?username=$username';</script>";
        exit();

    }

    header("Location: reserve.html?username=$username&pickupDate=$pickupDate&dropoffDate=$dropoffDate&city=$city&country=$country");
    mysqli_close($con);
    exit();
}

?>
