<?php
$user = 'root';
$password = '';
$db = 'rentalsystem';
$con = new mysqli('localhost', $user, $password, $db);
if ($con->connect_error) {
    die("Connection Failed" . $con->connect_error);
}
?>