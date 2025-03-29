<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Crop Yield Portal</title>
    <!-- Include the head partial -->
    <?php include 'partials/head.php'; ?>

    <style>
    <?php include 'public\css\aboutstyle.css';
    ?>
    </style>
</head>

<body>
    <div class="bg-slider"></div> <!-- Enhanced Background Slider -->

    <!-- Include the navigation bar partial -->
    <?php include 'partials/nav.php'; ?>

    <section class="main-container hero-section">
        <h1 class="text-5xl md-text-6xl font-bold mb-8 fade-in tracking-wide drop-shadow-lg">About Us</h1>
        <p class="text-xl max-w-3xl mx-auto fade-in leading-relaxed">
            At Crop Yield Portal, we empower farmers and agricultural experts with cutting-edge, data-driven solutions
            to maximize crop productivity and promote sustainable farming.
        </p>
        <a href="#mission"
            class="inline-block mt-6 px-6 py-3 text-lg font-semibold text-white btn-gradient rounded-full shadow-lg fade-in">Learn
            More</a>
    </section>

    <section id="mission" class="main-container mission-section fade-in">
        <h2 class="text-4xl font-bold text-teal-700 mb-6">Our Mission</h2>
        <p class="text-gray-700 text-lg max-w-3xl mx-auto leading-relaxed">
            We aim to transform agriculture by integrating advanced AI analytics, real-time climate data, and predictive
            insights, enabling farmers to make smarter, sustainable decisions.
        </p>
    </section>

    <section class="main-container features-section">
        <h2 class="text-4xl font-bold text-white mb-10 fade-in">Key Features</h2>
        <div class="grid">
            <div class="p-8 bg-white shadow-xl rounded-xl feature-card">
                <i class="fas fa-chart-line text-teal-600 text-5xl mb-6"></i>
                <h3 class="text-2xl font-semibold text-gray-800">AI-Based Predictions</h3>
                <p class="text-gray-600 mt-2">Harness machine learning to forecast crop yields using soil, weather, and
                    historical data.</p>
            </div>
            <div class="p-8 bg-white shadow-xl rounded-xl feature-card">
                <i class="fas fa-cloud-sun text-teal-600 text-5xl mb-6"></i>
                <h3 class="text-2xl font-semibold text-gray-800">Real-Time Weather Updates</h3>
                <p class="text-gray-600 mt-2">Stay ahead with live weather data and forecasts tailored for farming
                    success.</p>
            </div>
            <div class="p-8 bg-white shadow-xl rounded-xl feature-card">
                <i class="fas fa-seedling text-teal-600 text-5xl mb-6"></i>
                <h3 class="text-2xl font-semibold text-gray-800">Sustainable Farming Tips</h3>
                <p class="text-gray-600 mt-2">Adopt innovative, eco-friendly techniques to enhance productivity
                    sustainably.</p>
            </div>
        </div>
    </section>

    <!-- Include the footer partial -->
    <?php include 'partials/footer.php'; ?>

</body>

</html>