<!-- used to escape special characters in a string before sending it to a MySQL database. 
This is important for preventing SQL injection attacks. -->

<?php
include("connect.php");

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $plateNum = $_POST["plateNum"];
    $plateLetter = $_POST["plateLetter"];

    if (!is_numeric($plateNum) ) {
        echo "<script type='text/javascript'>alert('Error: Plate Number should be numeric');window.location.href='addCar.html'</script>";
        exit; // Stop execution if the price is not numeric
    }

    
    if (!ctype_alpha($plateLetter)) {
        echo "<script type='text/javascript'>alert('Error: Plate Letters should contain only letters');window.location.href='addCar.html'</script>";
        exit; // Stop execution if color contains non-letter characters
    }

    // Check if a car with the same plates already exists
    $checkQuery = "SELECT * FROM car WHERE num_plate = '$plateNum' AND letter_plate = '$plateLetter'";
    $result = $con->query($checkQuery);

    
    if ($result->num_rows > 0) {
        // Car with the same plates already exists
        echo "<script type='text/javascript'>alert('Error: Car with the same plates already exists');window.location.href='addCar.html'</script>";
    } else {
        // Car with the given plates doesn't exist, proceed with insertion
        $model = $_POST["model"];
        $year = $_POST["year"];
        $status = $_POST["status"];
        $imagePath = $_POST["imagePath"];
        $price = $_POST["price"];
        $color = $_POST["color"];
        $office = $_POST["office"];

        

        if (!is_numeric($price) ) {
            echo "<script type='text/javascript'>alert('Error: Price should be numeric');window.location.href='addCar.html'</script>";
            exit; // Stop execution if the price is not numeric
        }

        if (!is_numeric($office)) {
            echo "<script type='text/javascript'>alert('Error: Office Number should be numeric');window.location.href='addCar.html'</script>";
            exit; // Stop execution if the price is not numeric
        }

        if (!is_numeric($year)) {
            echo "<script type='text/javascript'>alert('Error: Year should be numeric');window.location.href='addCar.html'</script>";
            exit; // Stop execution if the price is not numeric
        }

        if (!ctype_alpha($color)) {
            echo "<script type='text/javascript'>alert('Error: Color should contain only letters');window.location.href='addCar.html'</script>";
            exit; // Stop execution if color contains non-letter characters
        }

        if (!ctype_alpha($status)) {
            echo "<script type='text/javascript'>alert('Error: Status should contain only letters');window.location.href='addCar.html'</script>";
            exit; // Stop execution if color contains non-letter characters
        }


        // SQL query to insert data into the database
        $query = "INSERT INTO car (num_plate, letter_plate, model, year, status, image_path, price, office_id, color) VALUES 
        ('$plateNum', '$plateLetter', '$model', '$year', '$status', '$imagePath', '$price', '$office','$color')";

        // Execute the insertion query
        if ($con->query($query) === TRUE) {
            echo "<script type='text/javascript'>alert('Car Added Successfully!!');window.location.href='adminHome.html';</script>";
            exit; // Ensure the script stops execution after redirection
        } else {
            echo "<script type='text/javascript'>alert('Error!!');</script>";
        }
    }

    // Close the database connection
    $con->close();
}
?>