<?php
// Start session
session_start();
// Include the database connection file
include "config/config.php";

// Get the property ID from the URL
// Example: details.php?id=1
// Check if id is available in URL
if (isset($_GET['id'])) {

    // Convert id to integer for security
    $id = (int)$_GET['id'];

} else {

    // Redirect to homepage if no id is provided
    header("Location: index.php");
    exit();
}

// SQL query to fetch the property with the given ID
$query = "SELECT * FROM properties WHERE id = $id";

// Execute the query
$result = mysqli_query($conn, $query);

// Check if the property exists
if (mysqli_num_rows($result) > 0) {

    // Fetch the property details
    $row = mysqli_fetch_assoc($result);
    // Fetch amenities for this property
$amenity_query = "
SELECT amenities.name
FROM amenities
INNER JOIN property_amenities
ON amenities.id = property_amenities.amenity_id
WHERE property_amenities.property_id = $id
";

$amenity_result = mysqli_query($conn, $amenity_query);

} else {

    echo "<div class='container mt-5'>";
    echo "<div class='alert alert-danger'>";
    echo "<h4>Property Not Found!</h4>";
    echo "<a href='index.php' class='btn btn-primary mt-2'>Go Back</a>";
    echo "</div>";
    echo "</div>";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Character encoding -->
    <meta charset="UTF-8">

    <!-- Responsive design for mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Show the property name in the browser tab -->
    <title><?php echo $row['name']; ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container">

        <a class="navbar-brand" href="index.php">
            Student Accommodation Finder
        </a>

    </div>
</nav>  
<!-- Main container -->
<div class="container mt-5">

    <!-- Bootstrap Card -->
    <div class="card shadow">

        <div class="row">

            <!-- Left Side: Property Image -->
            <div class="col-md-6">

                <!-- Property Image -->
<img src="assets/image/<?php echo $row['image']; ?>"
     class="img-fluid rounded shadow"
     alt="Property Image">

            </div>

            <!-- Right Side: Property Details -->
            <div class="col-md-6">

                <div class="card-body">

                  <!-- Property Name -->
<h2 class="text-primary fw-bold">
    <?php echo $row['name']; ?>
</h2>

                    <!-- City -->
                    <p>
                        <strong>City:</strong>
                        <?php echo $row['city']; ?>
                    </p>

                    <!-- Address -->
                    <p>
                        <strong>Address:</strong>
                        <?php echo $row['address']; ?>
                    </p>

                    <!-- Price -->
                    <p>
                        <strong>Price:</strong>
                        ₹<?php echo $row['price']; ?>
                    </p>

                    <!-- Gender -->
                    <p>
                        <strong>Gender:</strong>
                        <?php echo $row['gender']; ?>
                    </p>

                    <!-- Rating -->
                    <p>
                        <strong>Rating:</strong>
                        ⭐ <?php echo $row['rating']; ?>
                    </p>
                        <h5 class="mt-3">
    Amenities:
</h5>

<ul>

<?php

if(mysqli_num_rows($amenity_result) > 0){

    while($amenity = mysqli_fetch_assoc($amenity_result)){

        echo "<li>✅ ".$amenity['name']."</li>";

    }

}else{

    echo "<li>No amenities available</li>";

}

?>

</ul>
                    <!-- Description -->
                    <p>
                        <strong>Description:</strong>
                    </p>

                    <p>
                        <?php echo $row['description']; ?>
                    </p>

                   <!-- Interested Button -->

<button
    id="interestBtn"
    class="btn btn-success"
    data-id="<?php echo $row['id']; ?>">
    I'm Interested
</button>

<div id="msg" class="mt-3"></div>

<!-- Back Button -->
<a href="index.php" class="btn btn-info">
    ← Back
</a>
                </div>

            </div>

        </div>

    </div>

</div>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>

document.getElementById("interestBtn").addEventListener("click", function(){

    let propertyId = this.getAttribute("data-id");

    fetch("interested.php", {

        method: "POST",

        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },

        body: "property_id=" + propertyId

    })

    .then(response => response.text())
        .then(data => {

    document.getElementById("msg").innerHTML = data;

    document.getElementById("interestBtn").disabled = true;

    document.getElementById("interestBtn").innerHTML = "Interested ✓";

});

});

</script>
</body>
</html>