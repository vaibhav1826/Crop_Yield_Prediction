<?php
session_start(); // Start the session at the top

$showalert = false; // For successful registration
$showerror = false; // For general errors
$emailExists = false; // For duplicate email
$passwordMismatch = false; // For password mismatch

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include 'partials\db_connect.php';
    $username = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["confirm-password"];

    // Check for existing username
    $sql = "SELECT * FROM `users` WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row_num = mysqli_num_rows($result);
    mysqli_stmt_close($stmt);

    // Check for existing email
    $sql = "SELECT * FROM `users` WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $email_num = mysqli_num_rows($result);
    mysqli_stmt_close($stmt);

    if($row_num > 0){
        $showerror = "Username already exists, try with another username";
    }
    elseif($email_num > 0){
        $emailExists = true; // Email already exists
    }
    else{
        if($password == $cpassword){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`username`, `email`, `password`) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hash);
            $result = mysqli_stmt_execute($stmt);
            if($result){
                $showalert = true;
            }
            else{
                $showerror = "Registration failed. Please try again.";
            }
            mysqli_stmt_close($stmt);
        }
        else{
            $passwordMismatch = true; // Passwords don't match
        }
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Crop Yield Portal</title>
    <?php include 'partials/head.php'; ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
    <?php include 'public\css\registerstyle.css';
    ?>
    </style>
</head>

<body>
    <?php include 'partials/nav.php'; ?>

    <section class="main-container">
        <!-- Alerts at the top -->
        <?php
        if($showalert){
            echo '<div class="alert-success alert-dismissible">
                    Registration successful! Redirecting to login...
                    <span class="close" onclick="this.parentElement.style.display=\'none\'">×</span>
                  </div>';
            echo '<script>setTimeout(() => { window.location.href = "login.php"; }, 2000);</script>';
        }
        if($showerror){
            echo '<div class="alert-danger alert-dismissible">
                    Error: ' . htmlspecialchars($showerror) . '
                    <span class="close" onclick="this.parentElement.style.display=\'none\'">×</span>
                  </div>';
        }
        if($emailExists){
            echo '<div class="alert-danger alert-dismissible">
                    Try with another email ID!
                    <span class="close" onclick="this.parentElement.style.display=\'none\'">×</span>
                  </div>';
        }
        if($passwordMismatch){
            echo '<div class="alert-danger alert-dismissible">
                    Password and Confirm Password do not match!
                    <span class="close" onclick="this.parentElement.style.display=\'none\'">×</span>
                  </div>';
        }
        ?>

        <div class="text-center mb-12">
            <h1 class="text-4xl md-text-6xl font-bold text-white mb-4 animate-fade-in">Join Us</h1>
            <p class="text-xl md-text-2xl text-white-90 max-w-2xl mx-auto animate-fade-in-delay">Create your Crop Yield
                Portal account to start your agricultural journey</p>
        </div>

        <div class="register-container max-w-md mx-auto">
            <div class="register-form">
                <h2 class="text-3xl md:text-4xl font-semibold text-teal-800 mb-8 text-center">Register</h2>
                <form action="register.php" method="POST" class="space-y-6">
                    <div>
                        <label class="block text-gray-800 font-medium mb-2" for="fullname">Full Name</label>
                        <input type="text" id="fullname" placeholder="Enter your full name" class="input-focus"
                            name="fullname" required>
                    </div>
                    <div>
                        <label class="block text-gray-800 font-medium mb-2" for="email">Email Address</label>
                        <input type="email" id="email" placeholder="Enter your email" class="input-focus" name="email"
                            required>
                    </div>
                    <div>
                        <label class="block text-gray-800 font-medium mb-2" for="password">Password</label>
                        <input type="password" id="password" placeholder="Create a password" class="input-focus"
                            name="password" required>
                    </div>
                    <div>
                        <label class="block text-gray-800 font-medium mb-2" for="confirm-password">Confirm
                            Password</label>
                        <input type="password" id="confirm-password" placeholder="Confirm your password"
                            name="confirm-password" class="input-focus" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn-submit">Create Account <i
                                class="fas fa-user-plus ml-2"></i></button>
                    </div>
                </form>
                <p class="text-center text-gray-700 mt-6">Already have an account?
                    <a href="login.php" class="text-teal-600 hover:underline font-medium login-link">Sign In</a>
                </p>
            </div>
        </div>
    </section>

    <?php include 'partials/footer.php'; ?>
</body>

</html>