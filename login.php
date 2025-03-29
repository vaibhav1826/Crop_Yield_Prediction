<?php
session_start(); // Start the session at the top

$showalert = false; // For username not found
$wrongPassword = false; // For incorrect password
$login = false;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include 'partials\db_connect.php';
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Use prepared statement to prevent SQL injection
    $sql = "SELECT * FROM USERS WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $num = mysqli_num_rows($result);

    if($num == 1){
        while($row = mysqli_fetch_assoc($result)){
            if(password_verify($password, $row['password'])){
                $login = true;
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
            } else {
                $wrongPassword = true; // Password is incorrect
            }
        }
    } else {
        $showalert = true; // Username not found
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Crop Yield Portal</title>
    <?php include 'partials/head.php'; ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
    <?php include 'public\css\loginstyle.css';
    ?>
    </style>
</head>

<body>
    <?php include 'partials/nav.php'; ?>

    <section class="main-container">
        <!-- Alerts at the top -->
        <?php
        // Check for redirect alert from predict.php
        if(isset($_GET['alert']) && $_GET['alert'] == 'login_required') {
            echo '<div class="alert-danger alert-dismissible">
                    You must log in to access the Predict page!
                    <span class="close" onclick="this.parentElement.style.display=\'none\'">×</span>
                  </div>';
        }
        if($login){
            echo '<div class="alert-success alert-dismissible">
                    Successfully logged in as ' . htmlspecialchars($username) . '!
                    <span class="close" onclick="this.parentElement.style.display=\'none\'">×</span>
                  </div>';
            echo '<script>setTimeout(() => { window.location.href = "index.php"; }, 2000);</script>';
        }
        if($wrongPassword){
            echo '<div class="alert-danger alert-dismissible">
                    Incorrect password!
                    <span class="close" onclick="this.parentElement.style.display=\'none\'">×</span>
                  </div>';
        }
        if($showalert){
            echo '<div class="alert-danger alert-dismissible">
                    Username not found!
                    <span class="close" onclick="this.parentElement.style.display=\'none\'">×</span>
                  </div>';
        }
        ?>

        <div class="text-center mb-12">
            <h1 class="text-4xl md-text-6xl font-bold text-white mb-4 animate-fade-in">Welcome Back</h1>
            <p class="text-xl md-text-2xl text-white-90 max-w-2xl mx-auto animate-fade-in-delay">Access your Crop Yield
                Portal to optimize your agricultural journey</p>
        </div>

        <div class="login-container max-w-md mx-auto">
            <div class="login-form">
                <h2 class="text-3xl md-text-4xl font-semibold text-teal-800 mb-8 text-center">Sign In</h2>
                <form action="login.php" method="POST" class="space-y-6">
                    <div>
                        <label class="block text-gray-800 font-medium mb-2" for="username">Username </label>
                        <input type="username" id="username" placeholder="Enter your username" class="input-focus"
                            name="username" required>
                    </div>
                    <div>
                        <label class="block text-gray-800 font-medium mb-2" for="password">Password</label>
                        <input type="password" id="password" placeholder="Enter your password" class="input-focus"
                            name="password" required>
                    </div>
                    <div class="flex items-center justify-between">
                        <label class="flex items-center text-gray-700">
                            <input type="checkbox" class="mr-2 accent-teal-600">
                            <span class="text-sm">Remember Me</span>
                        </label>
                        <a href="#" class="text-sm text-teal-600 hover-underline forgot-link">Forgot Password?</a>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn-submit">Login <i class="fas fa-sign-in-alt ml-2"></i></button>
                    </div>
                </form>
                <p class="text-center text-gray-700 mt-6">New to Crop Yield?
                    <a href="register.php" class="text-teal-600 hover-underline font-medium">Create Account</a>
                </p>
            </div>
        </div>
    </section>

    <?php include 'partials/footer.php'; ?>
</body>

</html>