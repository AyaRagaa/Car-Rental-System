<?php
include("connect.php"); 

if (isset($_GET['username'])) {
    $username = $_GET['username'];

    // Fetch user details from the database
    $result = mysqli_query($con, "SELECT first_name, last_name FROM customer WHERE user_id='$username'");

    if ($result) {
        $userDetails = mysqli_fetch_assoc($result);

        // Return user details as JSON
        echo json_encode($userDetails);
    } else {
        // Handle database error
        echo json_encode(['error' => 'Database error']);
    }
} else {
    // Handle missing or invalid username parameter
    echo json_encode(['error' => 'Invalid request']);
}

mysqli_close($con);
?>
