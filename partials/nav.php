<?php 
// Check if the user is logged in 
$loggedin = false; 
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {     
    $loggedin = true; 
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'User'; // Fallback if username isn't set
} else {     
    $loggedin = false; 
}
?>

<!-- nav.php -->
<header class="bg-gradient-to-r from-teal-700 to-teal-500 text-white shadow-lg sticky top-0 z-50">
    <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center">
            <!-- Logo (Placeholder) -->
            <img src="public\images\logo.jpg" alt="Logo" class="h-10 w-10 mr-3 rounded-full shadow-sm">
            <span class="text-xl font-semibold">Crop Yield Portal</span>
        </div Senior Member>
        <div class="flex items-center space-x-8">
            <ul class="flex space-x-6">
                <li><a href="index.php"
                        class="text-base font-medium hover:text-green-200 transition-colors duration-200">Home</a></li>
                <li><a href="predict.php"
                        class="text-base font-medium hover:text-green-200 transition-colors duration-200">Predict</a>
                </li>
                <li><a href="about.php"
                        class="text-base font-medium hover:text-green-200 transition-colors duration-200">About</a></li>
                <li><a href="contact.php"
                        class="text-base font-medium hover:text-green-200 transition-colors duration-200">Contact</a>
                </li>
            </ul>
            <div class="flex space-x-4 items-center">
                <?php if ($loggedin) { ?>
                <span class="text-white font-medium">Welcome, <?php echo htmlspecialchars($username); ?></span>
                <a href="logout.php"
                    class="bg-red-200 text-teal-700 px-5 py-2 rounded-md font-medium hover:bg-red-300 transition-colors duration-200"
                    onclick="return confirm('Are you sure you want to log out?');">Logout</a>
                <?php } else { ?>
                <a href="login.php"
                    class="bg-white text-teal-700 px-5 py-2 rounded-md font-medium hover:bg-teal-100 transition-colors duration-200">Login</a>
                <a href="register.php"
                    class="border-2 border-white text-white px-5 py-2 rounded-md font-medium hover:bg-white hover:text-teal-700 transition-colors duration-200">Signup</a>
                <?php } ?>
            </div>
        </div>
    </nav>
</header>