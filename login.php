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
        <div class="text-center mb-12">
            <h1 class="text-4xl md-text-6xl font-bold text-white mb-4 animate-fade-in">Welcome Back</h1>
            <p class="text-xl md-text-2xl text-white-90 max-w-2xl mx-auto animate-fade-in-delay">Access your Crop Yield
                Portal to optimize your agricultural journey</p>
        </div>

        <div class="login-container max-w-md mx-auto">
            <div class="login-form">
                <h2 class="text-3xl md-text-4xl font-semibold text-teal-800 mb-8 text-center">Sign In</h2>
                <form action="#" method="POST" class="space-y-6">
                    <div>
                        <label class="block text-gray-800 font-medium mb-2" for="email">Email Address</label>
                        <input type="email" id="email" placeholder="Enter your email" class="input-focus" required>
                    </div>
                    <div>
                        <label class="block text-gray-800 font-medium mb-2" for="password">Password</label>
                        <input type="password" id="password" placeholder="Enter your password" class="input-focus"
                            required>
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