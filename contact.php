<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Crop Yield Portal</title>
    <?php include 'partials/head.php'; ?>
    <style>
    <?php include 'public/css/contactstyle.css';
    ?>
    </style>
</head>

<body class="min-h-screen flex flex-col">
    <div class="bg-slider"></div>
    <?php include 'partials/nav.php'; ?>

    <section class="container mx-auto px-6 py-16 md:py-24">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 fade-in">Contact Us</h1>
            <p class="text-lg md:text-xl text-white max-w-2xl mx-auto fade-in">Reach out for support, feedback, or
                collaboration—we’re here to help!</p>
        </div>

        <div class="contact-container fade-in">
            <div class="contact-form section-bg scale-hover">
                <h2 class="text-2xl md:text-3xl font-semibold text-teal-700 mb-6 text-center">Send a Message</h2>
                <form action="#" method="POST" class="space-y-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2" for="name">Name</label>
                        <input type="text" id="name" placeholder="Your Name" class="input-focus" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2" for="email">Email</label>
                        <input type="email" id="email" placeholder="Your Email" class="input-focus" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2" for="message">Message</label>
                        <textarea id="message" rows="4" placeholder="How can we assist?" class="input-focus"
                            required></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn-submit">Send <i class="fas fa-arrow-right ml-2"></i></button>
                    </div>
                </form>
            </div>

            <div class="contact-details section-bg scale-hover">
                <h2 class="text-2xl md:text-3xl font-semibold text-teal-800 mb-6 text-center">Get in Touch</h2>
                <div class="grid grid-cols-1 gap-6 mb-8">
                    <div class="icon-box flex flex-col items-center fade-in">
                        <i class="fas fa-envelope text-teal-600 text-2xl mb-2"></i>
                        <p class="text-gray-700">support@cropportal.com</p>
                    </div>
                    <div class="icon-box flex flex-col items-center fade-in" style="animation-delay: 0.2s;">
                        <i class="fas fa-phone text-teal-600 text-2xl mb-2"></i>
                        <p class="text-gray-700">+91 98765 43210</p>
                    </div>
                    <div class="map-container fade-in" style="animation-delay: 0.4s;">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d109625.14562745612!2d75.70376290000001!3d31.2242098!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391a5f5e8c85a859%3A0x8c3624f90b59f64f!2sPhagwara%2C%20Punjab!5e0!3m2!1sen!2sin!4v1698765432109!5m2!1sen!2sin"
                            allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
                <div class="social-links">
                    <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f text-xl"></i></a>
                    <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter text-xl"></i></a>
                    <a href="https://linkedin.com" target="_blank"><i class="fab fa-linkedin-in text-xl"></i></a>
                    <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram text-xl"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Include the footer partial -->
    <?php include 'partials/footer.php'; ?>

</body>

</html>