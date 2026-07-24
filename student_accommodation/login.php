<?php
session_start();
include "config/config.php";

$message = "";

if(isset($_POST['login'])){

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Check if email exists
    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($query) == 1){

        $user = mysqli_fetch_assoc($query);

        // Verify password
        if(password_verify($password, $user['password'])){

            // Store user information in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];

            echo "<script>
            alert('Login Successful!');
            window.location='index.php';
            </script>";
            exit();

        }else{

            $message = "<div class='alert alert-danger'>Invalid Password!</div>";

        }

    }else{

        $message = "<div class='alert alert-danger'>Email not found!</div>";

    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-5">

<div class="card shadow">

<div class="card-header bg-primary text-white text-center">

<h3>User Login</h3>

</div>

<div class="card-body">

<?php echo $message; ?>

<form method="POST">

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<button type="submit" name="login" class="btn btn-success w-100">
Login
</button>

</form>

<br>

<div class="text-center">

Don't have an account?

<a href="register.php">Register</a>

</div>

</div>

</div>

</div>

</div>

</div>

</body>
</html>