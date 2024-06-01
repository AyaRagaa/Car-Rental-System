<?php
include("connect.php");

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $encrypted = md5($password);
    $phoneNumber = $_POST['phoneNumber'];
    $gender = $_POST['gender'];
    $bdate = $_POST['bdate'];


    $email_verify = mysqli_query($con, "SELECT * FROM customer WHERE email='$email' ");
    $username_verify = mysqli_query($con, "SELECT * FROM customer WHERE user_id='$username' ");
    $phoneNumber_verify = mysqli_query($con, "SELECT * FROM customer WHERE phone_number='$phoneNumber' ");

    if (mysqli_num_rows($email_verify) != 0) {
        echo "<script type='text/javascript'>alert('Email Already Exists');window.location='reg.html';</script>";

    } elseif (mysqli_num_rows($username_verify) != 0) {
        echo "<script type='text/javascript'>alert('Username Already Exists');window.location='reg.html';</script>";

    } elseif (mysqli_num_rows($phoneNumber_verify) != 0) {
        echo "<script type='text/javascript'>alert('Phone Number Already Exists');window.location='reg.html';</script>";

    } else {

        $sql = "INSERT INTO customer (user_id, first_name, last_name, phone_number, email, password, isAdmin, gender, Bdate) VALUES ('$username', '$firstName', '$lastName','$phoneNumber', '$email', '$encrypted', '1', '$gender', '$bdate')";

        if (mysqli_query($con, $sql)) {
            echo "<script type='text/javascript'>alert('Admin Added Successfully!!');window.location.href='adminHome.html';</script>";
            exit();
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }

    mysqli_close($con);
}
?>