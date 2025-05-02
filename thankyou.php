<?php
session_start();
// Check if user is logged in
$loggedIn = isset($_SESSION['user']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You - Wanderlust</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        };
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" crossorigin="anonymous" />
    <script defer src="dark-mode.js"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 relative">
    <!-- Background -->
    <div class="absolute inset-0 bg-[url('images/booking_bg3.jpg')] bg-cover bg-center bg-no-repeat opacity-80"></div>

    <!-- Navbar -->
    <nav class="bg-white dark:bg-gray-800 shadow-md fixed w-full z-50 transition-all duration-300" id="navbar">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            <div class="flex items-center">
                <i class="fas fa-globe-americas text-blue-600 text-2xl mr-2"></i>
                <h1 class="text-2xl font-bold font-display">Wanderlust</h1>
            </div>
            <div class="md:flex items-center space-x-4 hidden">
                <a href="index.php" class="hover:text-primary transition">Home</a>
                <a href="destinations.php" class="hover:text-primary transition">Destinations</a>
                <a href="booking.php" class="hover:text-primary transition">Booking</a>
                <a href="review.php" class="hover:text-primary transition">Testimonials</a>
                <a href="contact.php" class="hover:text-primary transition">Contact us</a>
                
                <?php if ($loggedIn): ?>
                    <div class="flex items-center">
                        <span class="mr-2">Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?></span>
                        <a href="logout.php" class="ml-4 px-4 py-2 bg-red-400 hover:bg-red-600 text-white font-semibold rounded-lg shadow transition">
                            Logout
                        </a>
                    </div>
                <?php else: ?>
                    <a href="login.php" class="ml-4 px-4 py-2 bg-blue-400 hover:bg-blue-600 text-white font-semibold rounded-lg shadow transition">
                        Login
                    </a>
                <?php endif; ?>
                
                <button id="theme-toggle" class="p-2 bg-gray-200 dark:bg-gray-700 rounded-full">
                    <i class="fas fa-moon dark:hidden"></i>
                    <i class="fas fa-sun hidden dark:block"></i>
                </button>
            </div>
            <button class="md:hidden text-2xl" id="mobile-menu-button">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white dark:bg-gray-800 w-full">
            <div class="container mx-auto px-6 py-3 flex flex-col space-y-3">
                <a href="index.php" class="py-1 border-b border-gray-200 dark:border-gray-700">Home</a>
                <a href="destinations.php" class="py-1 border-b border-gray-200 dark:border-gray-700">Destinations</a>
                <a href="booking.php" class="py-1 border-b border-gray-200 dark:border-gray-700">Booking</a>
                <a href="review.php" class="py-1 border-b border-gray-200 dark:border-gray-700">Testimonials</a>
                
                <?php if ($loggedIn): ?>
                    <span class="py-1 border-b border-gray-200 dark:border-gray-700">Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?></span>
                    <a href="logout.php" class="py-2 px-4 bg-red-500 text-white font-semibold rounded-lg shadow text-center">
                        Logout
                    </a>
                <?php else: ?>
                    <a href="login.php" class="py-2 px-4 bg-blue-500 text-white font-semibold rounded-lg shadow text-center">
                        Login
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Thank You Content -->
    <section class="py-24 px-6 flex justify-center items-center min-h-screen relative z-10">
        <div class="bg-white dark:bg-gray-800 max-w-2xl p-10 rounded-lg shadow-lg w-full bg-opacity-90 text-center">
            <div class="mb-6 text-center">
                <i class="fas fa-check-circle text-green-500 text-6xl"></i>
            </div>
            <h2 class="text-3xl font-semibold text-gray-900 dark:text-white mb-6">Thank You!</h2>
            <p class="text-gray-700 dark:text-gray-300 mb-6">Your travel booking has been successfully submitted. We'll get back to you shortly with confirmation details.</p>
            <div class="mt-8">
                <a href="index.php" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-3 rounded-lg shadow-lg transition inline-block">
                    Return to Home
                </a>
            </div>
        </div>
    </section>

    <!-- JavaScript -->
    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });

        // Sticky navbar
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('py-2');
                navbar.classList.add('shadow-lg');
            } else {
                navbar.classList.remove('py-2');
                navbar.classList.remove('shadow-lg');
            }
        });

        // Auto redirect to home page after 5 seconds
        setTimeout(function() {
            window.location.href = 'index.php';
        }, 5000);
    </script>
</body>
</html>