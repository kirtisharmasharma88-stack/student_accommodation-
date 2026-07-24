<?php

// Start session
session_start();

// Database connection
include "config/config.php";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {

    header("Location: login.php");
    exit();

}

// Check property ID(supports GET and AJAX POST)
if (isset($_POST['property_id'])) {

    // Get property ID
    $property_id = (int) $_POST['property_id'];

} elseif (isset($_GET['property_id'])) {

    $property_id = (int)$_GET['property_id'];

} else {

    exit("Invalid Property");

}

// Get logged-in user ID
$user_id = $_SESSION['user_id'];

// Check if already interested
$check = mysqli_query($conn,
"SELECT * FROM interested_users
WHERE user_id='$user_id'
AND property_id='$property_id'");

// If already exists
if(mysqli_num_rows($check) > 0){

    if(isset($_POST['property_id'])){

    echo "<div class='alert alert-warning'>
            You have already shown interest.
          </div>";

}else{

    echo "<script>
    alert('You have already shown interest.');
    window.location='details.php?id=$property_id';
    </script>";

}

    exit();

}

// Insert new interest
$query = "INSERT INTO interested_users (user_id, property_id)
VALUES ($user_id, $property_id)";

mysqli_query($conn, $query);

if(isset($_POST['property_id'])){

    echo "<div class='alert alert-success'>
            ✅ Interest added successfully.
          </div>";

}else{

    echo "<script>
    alert('You have shown interest successfully.');
    window.location='my_interests.php';
    </script>";

}
?>