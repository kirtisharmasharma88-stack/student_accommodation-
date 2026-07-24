<?php
session_start();
include "config/config.php";

// Search Filters
$search = isset($_GET['search']) ? $_GET['search'] : "";
$budget = isset($_GET['budget']) ? $_GET['budget'] : "";
$gender = isset($_GET['gender']) ? $_GET['gender'] : "";

// Secure search input
$search = mysqli_real_escape_string($conn, $search);

// Build Query
$query = "SELECT * FROM properties WHERE 1";

if($search != ""){
    $query .= " AND city LIKE '%$search%'";
}

if($budget != ""){
    $query .= " AND price <= $budget";
}

if($gender != ""){
    $query .= " AND gender='$gender'";
}

// Execute Query
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Accommodation</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">

<div class="container">

<a class="navbar-brand" href="index.php">
Student Accommodation Finder
</a>

<div class="d-flex align-items-center">

<?php if(isset($_SESSION['user_id'])) { ?>

<span class="text-white me-3">
Welcome, <?php echo $_SESSION['user_name']; ?>
</span>

<a href="my_interests.php" class="btn btn-warning me-2">
My Interests
</a>

<a href="logout.php" class="btn btn-danger">
Logout
</a>

<?php } else { ?>

<a href="login.php" class="btn btn-light me-2">
Login
</a>

<a href="register.php" class="btn btn-success">
Register
</a>

<?php } ?>

</div>

</div>

</nav>

<!-- Hero -->
 <div class="container text-center mt-5">


<h1>Find Your Perfect PG & Hostel</h1>

<p class="lead">
Search affordable accommodation for students.
</p>

</div>



<!-- Search Form -->

<div class="container mt-4">

<form method="GET">

<div class="row justify-content-center g-2">

    <div class="col-lg-4 col-md-6">
        <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Search by City"
            value="<?php echo $search; ?>">
    </div>

    <div class="col-lg-2 col-md-6">
        <select name="budget" class="form-select">
            <option value="">Select Budget</option>
            <option value="6000" <?php if($budget=="6000") echo "selected"; ?>>Below ₹6000</option>
            <option value="7000" <?php if($budget=="7000") echo "selected"; ?>>Below ₹7000</option>
            <option value="8000" <?php if($budget=="8000") echo "selected"; ?>>Below ₹8000</option>
            <option value="9000" <?php if($budget=="9000") echo "selected"; ?>>Below ₹9000</option>
        </select>
    </div>

    <div class="col-lg-2 col-md-6">
        <select name="gender" class="form-select">
            <option value="">Select Gender</option>
            <option value="Boys" <?php if($gender=="Boys") echo "selected"; ?>>Boys</option>
            <option value="Girls" <?php if($gender=="Girls") echo "selected"; ?>>Girls</option>
            <option value="Both" <?php if($gender=="Both") echo "selected"; ?>>Both</option>
        </select>
    </div>

    <div class="col-lg-2 col-md-6">
        <button type="submit" class="btn btn-primary w-100">
            Search
        </button>
    </div>

</div>

</form>

</div>

<!-- Property Cards -->

<div class="container mt-5">

<div class="row">

<?php

if(mysqli_num_rows($result)>0){

while($row=mysqli_fetch_assoc($result)){

?>

<div class="col-lg-3 col-md-4 col-sm-6 mb-4">

<div class="card h-100 shadow">

<img src="assets/image/<?php echo $row['image']; ?>"
class="card-img-top"
style="height:200px; object-fit:cover;">

<div class="card-body">

<h5><?php echo $row['name']; ?></h5>

<p>

<strong>City:</strong>
<?php echo $row['city']; ?>

<br>

<strong>Price:</strong>
₹<?php echo $row['price']; ?>

<br>

<strong>Gender:</strong>
<?php echo $row['gender']; ?>

<br>

<strong>Rating:</strong>
⭐ <?php echo $row['rating']; ?>

</p>

<a href="details.php?id=<?php echo $row['id']; ?>"
class="btn btn-primary w-100">

View Details

</a>

</div>

</div>

</div>

<?php

}

}else{

?>

<div class="col-12">

<div class="alert alert-danger text-center">

No Property Found

</div>

</div>

<?php

}

?>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>