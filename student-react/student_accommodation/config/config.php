<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "student_accommodation";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection Failed");
}
?>