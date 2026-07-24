<?php

// Start session
session_start();

// Database connection
include "config/config.php";


// Check if user is logged in
if(!isset($_SESSION['user_id'])){

    echo "error";
    exit();

}


// Get logged in user ID
$user_id = $_SESSION['user_id'];


// Get property ID from AJAX POST
if(isset($_POST['property_id'])){

    $property_id = (int)$_POST['property_id'];

}
else{

    echo "error";
    exit();

}


// Delete interest
$query = "DELETE FROM interested_users
          WHERE user_id = $user_id
          AND property_id = $property_id";


$result = mysqli_query($conn, $query);


// Send AJAX response
if($result){

    echo "success";

}
else{

    echo "error";

}

?>