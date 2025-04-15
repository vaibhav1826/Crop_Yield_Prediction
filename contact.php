<?php
session_start(); 
include("partials/db_connect.php");

// Handle form submission
$show_success_alert = false; // Flag to control alert display
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $contact_name = $_POST['name'];
    $contact_email = $_POST['email'];
    $contact_message = $_POST['message'];
    
    // Prevent SQL injection by escaping inputs
    $contact_name = mysqli_real_escape_string($conn, $contact_name);
    $contact_email = mysqli_real_escape_string($conn, $contact_email);
    $contact_message = mysqli_real_escape_string($conn, $contact_message);

    $sql = "INSERT INTO `contactus` (`username`, `email`, `message`) VALUES ('$contact_name', '$contact_email', '$contact_message');";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $show_success_alert = true; // Set flag to true on success
    }
}
?>

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

    /* Custom styles for beautiful alerts */
    .custom-alert {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1000;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        font-family: 'Arial', sans-serif;
        animation: slideIn 0.5s ease-in-out;
        max-width: 500px;
        width: 90%;
    }

    .custom-alert-success {
        background: linear-gradient(to right, #0d9488, #14b8a6);
        /* Teal-700 to Teal-500 */
        color: white;
        border: none;
    }

    .custom-alert-danger {
        background: linear-gradient(135deg, #dc3545, #e4606d);
        /* Keeping error as red gradient */
        color: white;
        border: none;
    }

    .custom-alert strong {
        font-size: 1.2rem;
        font-weight: 600;
    }

    .custom-alert .btn-close {
        filter: invert(1);
        opacity: 0.8;
        transition: opacity 0.3s;
    }

    .custom-alert .btn-close:hover {
        opacity: 1;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(-50%) translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }
    }
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

        <!-- Display success or error message -->
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($show_success_alert) {
                // Beautiful success message with JavaScript redirect after 4 seconds
                echo '<div id="success-alert" class="custom-alert custom-alert-success alert-dismissible fade show" role="alert">
                    <strong>Thank you for contacting us!</strong> Your query will be solved shortly. 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                echo '<script>
                        setTimeout(function() {
                            document.getElementById("success-alert").style.display = "none";
                            window.location.href = "index.php"; // Replace with your home page
                        }, 4000); // Changed to 4 seconds (4000ms)
                      </script>';
            } elseif (!$result) {
                // Beautiful error message if submission fails
                echo '<div class="custom-alert custom-alert-danger alert-dismissible fade show" role="alert">
                    <strong>Oops!</strong> There was an issue sending your message. Please try again later.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
            }
        }
        ?>

        <div class="contact-container fade-in">
            <div class="contact-form section-bg scale-hover">
                <h2 class="text-2xl md:text-3xl font-semibold text-teal-700 mb-6 text-center">Send a Message</h2>
                <form action="" method="POST" class="space-y-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2" for="name">Name</label>
                        <input type="text" id="name" name="name" placeholder="Your Name" class="input-focus" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2" for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Your Email" class="input-focus"
                            required>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2" for="message">Message</label>
                        <textarea id="message" name="message" rows="4" placeholder="How can we assist?"
                            class="input-focus" required></textarea>
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
                    <a href="https://www.linkedin.com/in/vaibhav-bhatt-382971283/" target="_blank"><i class="fab fa-linkedin-in text-xl"></i></a>
                    <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram text-xl"></i></a>
                </div>
            </div>
        </div>
    </section>

    <?php include 'partials/footer.php'; ?>

</body>

</html>
