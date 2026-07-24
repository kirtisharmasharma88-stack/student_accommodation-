<?php
include "config/config.php";

$message = "";

if (isset($_POST['register'])) {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if any field is empty
    if (empty($name) || empty($email) || empty($phone) || empty($password) || empty($confirm_password)) {

        $message = "<div class='alert alert-danger'>All fields are required.</div>";

    }
    // Check if passwords match
    elseif ($password != $confirm_password) {

        $message = "<div class='alert alert-danger'>Passwords do not match.</div>";

    }
    else {

        // Check if email already exists
        $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

        if (mysqli_num_rows($check) > 0) {

            $message = "<div class='alert alert-warning'>Email already registered.</div>";

        } else {

            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert user into database
            $insert = mysqli_query($conn, "INSERT INTO users (name, email, phone, password)
            VALUES ('$name', '$email', '$phone', '$hashedPassword')");

            if ($insert) {

                echo "<script>
                        alert('Registration Successful!');
                        window.location='register.php';              
                      </script>";
                exit();

            } else {

                $message = "<div class='alert alert-danger'>Registration Failed. Please try again.</div>";

            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Register</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-6">

<div class="card shadow">

<div class="card-header bg-primary text-white text-center">

<h3>Student Registration</h3>

</div>

<div class="card-body">

<?php echo $message; ?>

<form method="POST">

<div class="mb-3">
<label>Full Name</label>
<input type="text" name="name" class="form-control">
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control">
</div>

<div class="mb-3">
<label>Phone</label>
<input type="text" name="phone" class="form-control">
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control">
</div>

<div class="mb-3">
<label>Confirm Password</label>
<input type="password" name="confirm_password" class="form-control">
</div>

<button type="submit" name="register" class="btn btn-success w-100">
Register
</button>

</form>

<br>

<div class="text-center">

Already have an account?

<a href="login.php">

Login

</a>

</div>

</div>

</div>

</div>

</div>

</div>

</body>

</html>