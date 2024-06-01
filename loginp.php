<?php
    include("connect.php");

    if (isset($_POST['submit'])) {

        $username = $_POST['username'];
        $password = $_POST['password'];
        $userType = $_POST['userType'];
        $encrypted = md5($password);

        $username_verify = mysqli_query($con, "SELECT * FROM customer WHERE user_id='$username' ");

        if ($userType == 'customer') {

            $login_verify = mysqli_query($con, "SELECT * FROM customer WHERE user_id='$username' AND password='$encrypted' AND isAdmin=0");

            if (mysqli_num_rows($username_verify) == 0) {
                echo "<script type='text/javascript'>alert('This Username Doesnot Exist');window.location='login.html';</script>";

            } elseif (mysqli_num_rows($login_verify) != 1){
                echo "<script type='text/javascript'>alert('Wrong Password');window.location='login.html';</script>";

            } else {

                header("Location: yourhome.html?username=$username");
                mysqli_close($con);
            }

        } else {

            $login_verify = mysqli_query($con, "SELECT * FROM customer WHERE user_id='$username' AND password='$encrypted' AND isAdmin=1");

            if (mysqli_num_rows($username_verify) == 0) {
                echo "<script type='text/javascript'>alert('This Username Doesnot Exist');window.location='login.html';</script>";

            } elseif (mysqli_num_rows($login_verify) != 1){
                echo "<script type='text/javascript'>alert('Wrong Password');window.location='login.html';</script>";

            } else {

                header("Location: adminHome.html");
                mysqli_close($con);
            }

        }
    }


?>
