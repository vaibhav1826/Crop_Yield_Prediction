<?php
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crop Yield Prediction Portal</title>
    <!-- Include the head partial -->
    <?php include 'partials/head.php'; ?>
    <!-- Custom styles (No navbar or footer CSS) -->
    <style>
    <?php include 'public\css\indexstyle.css';
    ?>
    </style>
</head>

<body>
    <!-- Navigation (No CSS applied here) -->
    <?php include 'partials/nav.php'; ?>

    <!-- Enhanced Slider -->
    <section class="slider-container">
        <div id="slider" class="slider">
            <div class="slide">
                <img src="public/images/slider1.jpg" alt="Precision Farming Solutions" class="slider-image">
                <div class="overlay">
                    <h2>Precision Farming Solutions</h2>
                    <p>Boost efficiency with data-driven insights</p>
                </div>
            </div>
            <div class="slide">
                <img src="public/images/slider2.jpg" alt="Optimize Your Yield" class="slider-image">
                <div class="overlay">
                    <h2>Optimize Your Yield</h2>
                    <p>Maximize productivity with smart predictions</p>
                </div>
            </div>
            <div class="slide">
                <img src="public/images/slider3.jpg" alt="Sustainable Agriculture" class="slider-image">
                <div class="overlay">
                    <h2>Sustainable Agriculture</h2>
                    <p>Farm smarter for a greener future</p>
                </div>
            </div>
        </div>
        <button id="prev" class="slider-btn"><i class="fas fa-chevron-left"></i></button>
        <button id="next" class="slider-btn"><i class="fas fa-chevron-right"></i></button>
        <div class="slider-dots" id="dots"></div>
    </section>

    <!-- Hero Section -->
    <section class="hero container">
        <h1>Data-Driven Farming for a Better Future</h1>
        <p>Harness advanced analytics to predict crop yields, improve efficiency, and cultivate sustainably.</p>
        <div class="cta-buttons">
            <a href="#">Explore Now</a>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="stats-grid container">
            <div class="stat-item">
                <h3 data-count="250000">0+</h3>
                <p>Visitors to Our Platform</p>
            </div>
            <div class="stat-item">
                <h3 data-count="50000">0+</h3>
                <p>Current Active Users</p>
            </div>
            <div class="stat-item">
                <h3 data-count="2500000">0+ Acres</h3>
                <p>Cultivation Area Benefited</p>
            </div>
        </div>
    </section>

    <!-- Enhanced Features Section with Improved Images -->
    <section class="features container">
        <h2>Our Core Strengths</h2>
        <div class="features-grid">
            <div class="feature-item">
                <div class="image-wrapper">
                    <img src="public/images/photo3.jpg" alt="Predictive Analytics">
                </div>
                <h3>Predictive Analytics</h3>
                <p>Accurate yield forecasts powered by data.</p>
            </div>
            <div class="feature-item">
                <div class="image-wrapper">
                    <img src="public/images/photo2.jpg" alt="Sustainability Focus">
                </div>
                <h3>Sustainability Focus</h3>
                <p>Reduce waste and enhance resource use.</p>
            </div>
            <div class="feature-item">
                <div class="image-wrapper">
                    <img src="public/images/photo1.jpg" alt="Farmer-Centric">
                </div>
                <h3>Farmer-Centric</h3>
                <p>Trusted tools for agricultural success.</p>
            </div>
        </div>
    </section>

    <!-- Image Gallery -->
    <section class="gallery container">
        <h2>Explore Farming in Action</h2>
        <div class="gallery-grid">
            <div class="gallery-item">
                <img src="public/images/predictbackground.jpg" alt="Wheat Field">
            </div>
            <div class="gallery-item">
                <img src="public/images/cornfield.jpg" alt="Corn Harvest">
            </div>
            <div class="gallery-item">
                <img src="public/images/suistanable.jpg" alt="Sustainable Farming">
            </div>
            <div class="gallery-item">
                <img src="public/images/farmer.jpg" alt="Farmer at Work">
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="testimonials container">
        <h2>What Farmers Say</h2>
        <div class="testimonial-grid">
            <div class="testimonial-item">
                <img src="public/images/farmer1.jpg" alt="Farmer Avatar">
                <div>
                    <p>"This tool transformed my small farm—yield predictions are spot-on!"</p>
                    <span>Mahadev Singh, Small Farmer</span>
                </div>
            </div>
            <div class="testimonial-item">
                <img src="public/images/farmer2.jpg" alt="Farmer Avatar">
                <div>
                    <p>"Weather integration saved my crops from a sudden drought. Amazing!"</p>
                    <span>Subhash Palekar, Commercial Farmer</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced FAQ Section -->
    <section class="faq container">
        <h2>Unveiling the Power of Crop Prediction</h2>
        <div class="faq-grid">
            <div class="faq-item">
                <h3>How does weather turn farming into a superpower?</h3>
                <p>Imagine knowing exactly how rain, sun, or wind will shape your harvest! We blend real-time weather
                    data—temperature, rainfall, humidity—with cutting-edge analytics to supercharge your yield
                    predictions, giving you the edge to plan like a pro.</p>
            </div>
            <div class="faq-item">
                <h3>Which crops can I master with this tool?</h3>
                <p>From golden wheat fields to lush rice paddies, we’ve got you covered! Predict yields for staples like
                    corn, soybeans, and more—just input your crop and region, and watch tailored insights bloom before
                    your eyes.</p>
            </div>
            <div class="faq-item">
                <h3>Can I really trust these predictions?</h3>
                <p>Think of it like a crystal ball backed by science! Our accuracy shines when you feed us rich
                    data—soil secrets, weather whispers, and your farming flair. Real-world results prove our models are
                    spot-on.</p>
            </div>
            <div class="faq-item">
                <h3>Is this magic just for big farms?</h3>
                <p>Not at all! Whether you’re tending a cozy family plot or a sprawling estate, our platform scales to
                    fit your fields. Precision farming isn’t just for the giants—it’s your ticket to thrive, no matter
                    the size.</p>
            </div>
            <div class="faq-item">
                <h3>How fresh is the weather intel?</h3>
                <p>Fresh as the morning dew! We pull daily updates from top meteorological sources, delivering real-time
                    weather vibes straight to your predictions—so you’re always in sync with nature’s rhythm.</p>
            </div>
            <div class="faq-item">
                <h3>Do I need to be a tech wizard to crack this?</h3>
                <p>Nope, no tech spells required! Our platform’s as easy as a walk in the fields—intuitive design and
                    clear guides mean every farmer, from newbie to veteran, can unlock its power with zero fuss.</p>
            </div>
            <div class="faq-item">
                <h3>What happens when the skies throw a curveball?</h3>
                <p>We’ve got your back! When storms brew or droughts loom, our system pivots fast, tweaking predictions
                    with the latest weather twists—so you’re ready to adapt before the first drop falls.</p>
            </div>
            <div class="faq-item">
                <h3>How does this make my farm a green legend?</h3>
                <p>Picture slashing waste and boosting bounty! By nailing yield forecasts, you’ll use water,
                    fertilizers, and energy just right—turning your farm into a sustainability superstar while keeping
                    the planet smiling.</p>
            </div>
        </div>
    </section>

    <!-- Footer (No CSS applied here) -->
    <?php include 'partials/footer.php'; ?>

    <!-- JavaScript for Interactivity -->
    <script>
    <?php include 'public\js\indexscript.js'; ?>
    </script>
</body>

</html>