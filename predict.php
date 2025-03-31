<?php
session_start(); // Start the session

// Check if the user is logged in
$loggedin = false;
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $loggedin = true;
} else {
    $loggedin = false;
}

// If not logged in, redirect to login with a message
if (!$loggedin) {
    header("Location: login.php?alert=login_required");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Crop Yield Prediction Portal</title>
    <meta name="description"
        content="Crop Yield Prediction Portal provides data-driven insights to help farmers maximize yield through advanced analytics and sustainable practices." />
    <?php include 'partials/head.php'; ?>
    <style>
    <?php include 'public\css\predictstyle.css';
    ?>
    </style>
</head>

<body>
    <?php include 'partials/nav.php'; ?>

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="hero-slider">
            <div class="hero-slide"></div>
            <div class="hero-slide"></div>
            <div class="hero-slide"></div>
        </div>
        <div class="hero-overlay"></div>
        <div class="hero-content container">
            <h1 class="hero-title">PredictYield</h1>
            <p class="hero-subtitle">Empowering Farmers with Accurate Crop Yield Predictions Using Real-Time Weather
                Data</p>
            <a href="predictform.php" class="cta-btn">Try Now</a>
        </div>
    </section>

    <!-- Problem Statement Section -->
    <section id="problem" class="problem-section">
        <div class="container">
            <article class="problem-card">
                <h2 class="section-title">The Challenge in Farming</h2>
                <p class="problem-text">"Predicting crop yields is often inaccurate due to lack of reliable data and
                    sophisticated analysis tools. Crop Yield Portal addresses this challenge by analyzing real-time
                    weather and regional data to provide accurate yield predictions, helping farmers plan effectively
                    and maximize productivity."</p>
                <a href="#how-it-works" class="text-link">Learn how we solve this →</a>
            </article>
        </div>
    </section>

    <!-- Feature Cards Section -->
    <section class="features-section">
        <div class="container">
            <header class="section-header">
                <h2 class="section-title">Our Core Strengths</h2>
                <p class="section-subtitle">We innovate agriculture through technology and data-driven insights.</p>
            </header>
            <div class="feature-cards">
                <article class="feature-card">
                    <img src="https://news.mit.edu/sites/default/files/images/201905/smart-agriculture-plant-farming-data-reduced.jpeg"
                        alt="Predictive Analytics" />
                    <div class="p-6">
                        <h3 class="feature-title">Predictive Analytics</h3>
                        <p class="feature-text">Accurate yield forecasts powered by data.</p>
                    </div>
                </article>
                <article class="feature-card">
                    <img src="https://tse2.mm.bing.net/th?id=OIP.KKrFCeoXQo22QV01YWP6eAHaE8&pid=Api&P=0&h=180"
                        alt="Sustainability Focus" />
                    <div class="p-6">
                        <h3 class="feature-title">Sustainability Focus</h3>
                        <p class="feature-text">Reduce waste and enhance resource use.</p>
                    </div>
                </article>
                <article class="feature-card">
                    <img src="https://pearlpay.com/wp-content/uploads/2020/03/Helping-Farmers-in-the-Philippines-with-Accessible-Financial-Help.jpg"
                        alt="Farmer-Centric" />
                    <div class="p-6">
                        <h3 class="feature-title">Farmer-Centric</h3>
                        <p class="feature-text">Trusted tools for agricultural success.</p>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- Why Choose PredictYield Section -->
    <section id="predict" class="fade-in">
        <div class="container">
            <h2 class="section-title text-center">Why Choose PredictYield?</h2>
            <div class="grid">
                <article class="relative group h-64 rounded-lg shadow-lg overflow-hidden">
                    <img src="https://images.hdqwalls.com/wallpapers/crop-field-sunset-5x.jpg" alt="Weather Predictions"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                    <div
                        class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        <div class="text-center px-4">
                            <h4 class="text-white text-2xl font-bold">Weather-Based Predictions</h4>
                            <p class="text-white mt-2">Reliable yield estimates using real-time weather data.</p>
                        </div>
                    </div>
                </article>
                <article class="relative group h-64 rounded-lg shadow-lg overflow-hidden">
                    <img src="https://rajasthanrevealed.com/wp-content/uploads/2022/03/shutterstock_1116673238.jpg"
                        alt="Farmer-Friendly"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                    <div
                        class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        <div class="text-center px-4">
                            <h4 class="text-white text-2xl font-bold">Farmer-Friendly</h4>
                            <p class="text-white mt-2">A portal designed with farmers in mind.</p>
                        </div>
                    </div>
                </article>
                <article class="relative group h-64 rounded-lg shadow-lg overflow-hidden">
                    <img src="https://i.ytimg.com/vi/zfzP9Q-N_jg/maxresdefault.jpg" alt="Actionable Insights"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                    <div
                        class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        <div class="text-center px-4">
                            <h4 class="text-white text-2xl font-bold">Actionable Insights</h4>
                            <p class="text-white mt-2">Practical tips to boost your yield and optimize resources.</p>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="how-it-works">
        <div class="container">
            <header class="section-header">
                <h2 class="section-title">How It Works</h2>
                <p class="section-subtitle">Get accurate predictions in just three simple steps</p>
            </header>
            <div class="steps-container">
                <article class="step">
                    <div class="step-number">1</div>
                    <h3 class="step-title">Enter Your Location</h3>
                    <p class="step-text">Simply provide your farm's location to start receiving tailored weather data.
                    </p>
                </article>
                <article class="step">
                    <div class="step-number">2</div>
                    <h3 class="step-title">Select Your Crops</h3>
                    <p class="step-text">Tell us what you're growing, and we'll calibrate our models accordingly.</p>
                </article>
                <article class="step">
                    <div class="step-number">3</div>
                    <h3 class="step-title">Get Predictions</h3>
                    <p class="step-text">Receive detailed yield predictions and actionable insights to optimize your
                        farm.</p>
                </article>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="testimonial-section fade-in">
        <div class="container">
            <h2 class="section-title text-center">What Farmers Say</h2>
            <div class="grid">
                <article class="testimonial-card">
                    <p class="testimonial-text">"PredictYield helped me plan my irrigation better during a dry season.
                        My yield improved!"</p>
                    <p class="testimonial-author">- John, Wheat Farmer</p>
                </article>
                <article class="testimonial-card">
                    <p class="testimonial-text">"The weather predictions were spot on, and the tips saved my corn crop."
                    </p>
                    <p class="testimonial-author">- Maria, Corn Farmer</p>
                </article>
                <article class="testimonial-card">
                    <p class="testimonial-text">"Easy to use and very helpful. I check it every week!"</p>
                    <p class="testimonial-author">- Ahmed, Rice Farmer</p>
                </article>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section id="get-started" class="cta-section">
        <div class="container">
            <h2 class="cta-title">Ready to Transform Your Farm?</h2>
            <p class="cta-text">Join thousands of farmers making smarter decisions with our data-driven insights and
                advanced yield predictions.</p>
            <a href="predictform.php" class="cta-btn-large">Start Predicting Now</a>
        </div>
    </section>

    <?php include 'partials/footer.php'; ?>

    <script>
    <?php include 'public\js\predictcript.js'; ?>
    </script>
</body>

</html>