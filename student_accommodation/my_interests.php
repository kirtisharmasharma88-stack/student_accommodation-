<?php

// Start the user session
session_start();

// Connect to the database
include "config/config.php";

// Check if the user is logged in
if(!isset($_SESSION['user_id'])){

    // Redirect to login page
    header("Location: login.php");
    exit();
}

// Store logged-in user's ID
$user_id = $_SESSION['user_id'];

// Get all properties that the user marked as interested
$query = "SELECT properties.*
FROM interested_users
INNER JOIN properties
ON interested_users.property_id = properties.id
WHERE interested_users.user_id = $user_id";

// Execute the SQL query
$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Interests</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-dark bg-dark">

    <div class="container">

        <a class="navbar-brand" href="index.php">
            Student Accommodation Finder
        </a>

        <a href="index.php" class="btn btn-light">
            Home
        </a>

    </div>

</nav>

<!-- Page Heading -->
<div class="container mt-5">

    <h2 class="text-center mb-4">
        My Interested Properties
    </h2>

    <div class="row">
<?php
// Check if properties are found
if(mysqli_num_rows($result) > 0){

    // Show all interested properties
    while($row = mysqli_fetch_assoc($result)){
?>

<div class="col-md-4 mb-4">

    <!-- Property Card -->
    <div class="card shadow h-100">

        <!-- Property Image -->
        <img src="assets/image/<?php echo $row['image']; ?>"
             class="card-img-top"
             height="220"
             alt="Property Image">

        <div class="card-body">

            <!-- Property Name -->
            <h5 class="card-title">
                <?php echo $row['name']; ?>
            </h5>

            <!-- Property Details -->
            <p>
                <strong>City:</strong>
                <?php echo $row['city']; ?>
            </p>

            <p>
                <strong>Price:</strong>
                ₹<?php echo $row['price']; ?>
            </p>

            <p>
                <strong>Rating:</strong>
                ⭐ <?php echo $row['rating']; ?>
            </p>

    <!-- View Details Button -->
<a href="details.php?id=<?php echo $row['id']; ?>"
   class="btn btn-primary w-100 mb-2">
   View Details
</a>

<!-- Remove Interest Button -->
<button 
   class="btn btn-danger w-100 remove-btn"
   data-id="<?php echo $row['id']; ?>">
   Remove Interest
</button>



        </div>

    </div>

</div>

<?php

    }

}else{

    // If no interested property found
    echo "<div class='alert alert-warning text-center'>
            You have not added any interested properties yet.
          </div>";

}

?>
</div>

</div>
<script>

document.querySelectorAll(".remove-btn").forEach(button => {

    button.addEventListener("click", function(){

        let property_id = this.getAttribute("data-id");

        let card = this.closest(".col-md-4");


        if(confirm("Are you sure you want to remove this property?")){


            fetch("remove_interest.php", {

                method: "POST",

                headers:{
                    "Content-Type":"application/x-www-form-urlencoded"
                },

                body:"property_id=" + property_id

            })


            .then(response => response.text())

            .then(data => {


                if(data.trim() == "success"){

                    card.remove();

                    alert("Interest removed successfully");

                }

                else{

                    alert("Something went wrong");

                }


            });


        }


    });


});

</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>