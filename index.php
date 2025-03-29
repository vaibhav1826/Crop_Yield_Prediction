<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crop Yield Prediction Portal</title>
    <!-- Include the head partial -->
    <?php include 'partials/head.php'; ?>
    <!-- Custom styles for the slider images and other enhancements -->
    <style>
    <?php include 'public\css\indexstyle.css';
    ?>
    </style>
</head>

<body class="min-h-screen flex flex-col font-sans">
    <!-- Include the navigation bar partial -->
    <?php include 'partials/nav.php'; ?>

    <!-- Enhanced Static Image Slider with <img> tags -->
    <section class="relative h-[60vh] overflow-hidden bg-gray-200">
        <div id="slider" class="flex transition-transform duration-700 ease-in-out h-full">
            <!-- Slide 1 -->
            <div class="min-w-full h-full relative slider-container">
                <img src="public/images/slider1.jpg" alt="Precision Farming Solutions"
                    class="slider-image transition-transform duration-1000 ease-in-out">
                <div
                    class="absolute inset-0 bg-gradient-to-t from-gray-900/70 to-transparent flex items-center justify-center transition-opacity duration-500">
                    <h2
                        class="text-white text-3xl md:text-4xl font-bold drop-shadow-lg transform transition-transform duration-500">
                        Precision Farming Solutions
                    </h2>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="min-w-full h-full relative slider-container">
                <img src="public/images/slider2.jpg" alt="Optimize Your Yield"
                    class="slider-image transition-transform duration-1000 ease-in-out">
                <div
                    class="absolute inset-0 bg-gradient-to-t from-gray-900/70 to-transparent flex items-center justify-center transition-opacity duration-500">
                    <h2
                        class="text-white text-3xl md:text-4xl font-bold drop-shadow-lg transform transition-transform duration-500">
                        Optimize Your Yield
                    </h2>
                </div>
            </div>
            <!-- Slide 3 -->
            <div class="min-w-full h-full relative slider-container">
                <img src="public/images/slider3.jpg" alt="Sustainable Agriculture"
                    class="slider-image transition-transform duration-1000 ease-in-out">
                <div
                    class="absolute inset-0 bg-gradient-to-t from-gray-900/70 to-transparent flex items-center justify-center transition-opacity duration-500">
                    <h2
                        class="text-white text-3xl md:text-4xl font-bold drop-shadow-lg transform transition-transform duration-500">
                        Sustainable Agriculture
                    </h2>
                </div>
            </div>
        </div>
        <button id="prev"
            class="absolute left-6 top-1/2 transform -translate-y-1/2 bg-teal-600 text-white p-3 rounded-full hover:bg-teal-700 transition-all duration-200 hover:scale-110">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button id="next"
            class="absolute right-6 top-1/2 transform -translate-y-1/2 bg-teal-600 text-white p-3 rounded-full hover:bg-teal-700 transition-all duration-200 hover:scale-110">
            <i class="fas fa-chevron-right"></i>
        </button>
    </section>

    <!-- Hero Section -->
    <section class="container mx-auto px-6 py-16 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-teal-800 mb-6">Data-Driven Farming for a Better Future</h1>
        <p class="text-lg md:text-xl text-gray-600 mb-8 max-w-3xl mx-auto">Harness advanced analytics to predict crop
            yields, improve efficiency, and cultivate sustainably with confidence.</p>
        <a href="#"
            class="inline-block bg-teal-600 text-white px-8 py-3 rounded-md font-medium hover:bg-teal-700 transition-colors duration-200">Explore
            Now</a>
    </section>

    <!-- Stats Section -->
    <section class="bg-gradient-to-r from-teal-100 to-green-100 py-12">
        <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div class="p-6 bg-white rounded-lg shadow-md">
                <h3 class="text-4xl font-semibold text-teal-600 mb-2">250,000+</h3>
                <p class="text-lg text-gray-600">Visitors to Our Platform</p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-md">
                <h3 class="text-4xl font-semibold text-teal-600 mb-2">50,000+</h3>
                <p class="text-lg text-gray-600">Current Active Users</p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-md">
                <h3 class="text-4xl font-semibold text-teal-600 mb-2">2.5M+ Acres</h3>
                <p class="text-lg text-gray-600">Cultivation Area Benefited</p>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="container mx-auto px-6 py-16">
        <h2 class="text-3xl font-semibold text-teal-800 text-center mb-12">Our Core Strengths</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-6 bg-white rounded-lg shadow-md text-center">
                <i class="fas fa-chart-line text-teal-600 text-3xl mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Predictive Analytics</h3>
                <p class="text-gray-600">Accurate yield forecasts powered by data.</p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-md text-center">
                <i class="fas fa-leaf text-teal-600 text-3xl mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Sustainability Focus</h3>
                <p class="text-gray-600">Reduce waste and enhance resource use.</p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-md text-center">
                <i class="fas fa-users text-teal-600 text-3xl mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Farmer-Centric</h3>
                <p class="text-gray-600">Trusted tools for agricultural success.</p>
            </div>
        </div>
    </section>

    <!-- Include the footer partial -->
    <?php include 'partials/footer.php'; ?>

    <!-- Slider JavaScript -->
    <script>
    const slider = document.getElementById('slider');
    const prevBtn = document.getElementById('prev');
    const nextBtn = document.getElementById('next');
    const slides = slider.children;
    let currentIndex = 0;

    function updateSlider() {
        slider.style.transform = `translateX(-${currentIndex * 100}%)`;

        // Remove active class from all slides
        for (let i = 0; i < slides.length; i++) {
            slides[i].classList.remove('active');
            slides[i].querySelector('img').classList.remove('active');
            slides[i].querySelector('h2').parentElement.classList.remove('active');
        }

        // Add active class to current slide
        slides[currentIndex].classList.add('active');
        slides[currentIndex].querySelector('img').classList.add('active');
        slides[currentIndex].querySelector('h2').parentElement.classList.add('active');
    }

    // Initial setup
    updateSlider();

    prevBtn.addEventListener('click', () => {
        currentIndex = currentIndex > 0 ? currentIndex - 1 : slides.length - 1;
        updateSlider();
    });

    nextBtn.addEventListener('click', () => {
        currentIndex = currentIndex < slides.length - 1 ? currentIndex + 1 : 0;
        updateSlider();
    });

    // Auto-slide every 5 seconds
    setInterval(() => {
        currentIndex = currentIndex < slides.length - 1 ? currentIndex + 1 : 0;
        updateSlider();
    }, 5000);
    </script>
</body>

</html>