<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Crop Yield Portal</title>
    <?php include 'partials/head.php'; ?>

    <style>
    <?php include 'public\css\registerstyle.css';
    ?>
    </style>
</head>

<body>
    <?php include 'partials/nav.php'; ?>

    <section class="main-container">
        <div class="text-center mb-12">
            <h1 class="text-4xl md-text-6xl font-bold text-white mb-4 animate-fade-in">Join Us</h1>
            <p class="text-xl md-text-2xl text-white-90 max-w-2xl mx-auto animate-fade-in-delay">Create your Crop Yield
                Portal account to start your agricultural journey</p>
        </div>

        <div class="register-container max-w-md mx-auto">
            <div class="register-form">
                <h2 class="text-3xl md:text-4xl font-semibold text-teal-800 mb-8 text-center">Register</h2>
                <form action="#" method="POST" class="space-y-6">
                    <div>
                        <label class="block text-gray-800 font-medium mb-2" for="fullname">Full Name</label>
                        <input type="text" id="fullname" placeholder="Enter your full name" class="input-focus"
                            required>
                    </div>
                    <div>
                        <label class="block text-gray-800 font-medium mb-2" for="email">Email Address</label>
                        <input type="email" id="email" placeholder="Enter your email" class="input-focus" required>
                    </div>
                    <div>
                        <label class="block text-gray-800 font-medium mb-2" for="password">Password</label>
                        <input type="password" id="password" placeholder="Create a password" class="input-focus"
                            required>
                    </div>
                    <div>
                        <label class="block text-gray-800 font-medium mb-2" for="confirm-password">Confirm
                            Password</label>
                        <input type="password" id="confirm-password" placeholder="Confirm your password"
                            class="input-focus" required>
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