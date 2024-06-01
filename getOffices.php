<?php

// Include the file with the database connection details
include 'connect.php';

try {
    // Fetch office data from the database
    $sql = "SELECT city, country FROM office";
    $result = mysqli_query($con, $sql);

    // Check if there are results
    if ($result) {
        // Fetch the data and store it in an array
        $offices = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $offices[] = $row;
        }

        // Close the database connection
        mysqli_close($con);

        // Return the office data as JSON
        header('Content-Type: application/json');
        echo json_encode($offices);
    } else {
        // No offices found
        echo json_encode(array());
    }
} catch (Exception $e) {
    // Return an error message in case of an exception
    echo json_encode(array('error' => $e->getMessage()));
} finally {

    // Close the result set
    if ($result) {
        mysqli_free_result($result);
    }
}
?>
