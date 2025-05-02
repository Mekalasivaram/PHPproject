<?php
session_start();
$loggedIn = isset($_SESSION['user']);
?>

<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maldives - Wanderlust</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>

    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    
    <!-- Navbar -->
    <nav class="bg-white dark:bg-gray-800 shadow-md fixed w-full z-50 transition-all duration-300" id="navbar">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            <div class="flex items-center">
                <i class="fas fa-globe-americas text-blue-600 text-2xl mr-2"></i>
                <h1 class="text-2xl font-bold font-display">Wanderlust</h1>
            </div>
            <div class="md:flex items-center space-x-4 hidden">
                <a href="index.php" class="hover:text-primary transition">Home</a>
                <a href="destinations.php" class="border-b-2 border-primary">Destinations</a>
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
                <a href="contact.php" class="py-1 border-b border-gray-200 dark:border-gray-700">Contact</a>
                <a href="review.php" class="py-1 border-b border-gray-200 dark:border-gray-700">Testimonials</a>
                <a href="login.php" class="py-2 px-4 bg-primary text-white font-semibold rounded-lg shadow text-center">
                    Login
                </a>
            </div>
        </div>
    </nav>
    
    
   <!-- Hero Section -->
<section class="relative w-full h-96 flex items-center justify-center bg-cover bg-center" style="background-image: url('images/maldivepage.jpg')">
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
    <div class="relative text-center text-white p-8 max-w-3xl mx-auto">
        <h2 class="text-5xl md:text-6xl font-extrabold font-display mb-2 text-shadow">Maldives</h2>
        <p class="text-xl md:text-2xl mt-4 mb-8">Tropical bliss of turquoise waters, white sands, and vibrant coral reefs</p>
    </div>
</section>

<!-- Quick Facts -->
<section class="py-8 bg-white dark:bg-gray-800">
    <div class="container mx-auto px-6">
        <div class="flex flex-wrap justify-center gap-6 text-center">
            <div class="flex items-center">
                <i class="fas fa-map-marker-alt text-teal-500 text-xl mr-2"></i>
                <span>Maldives</span>
            </div>
            <div class="flex items-center">
                <i class="fas fa-language text-teal-500 text-xl mr-2"></i>
                <span>Dhivehi</span>
            </div>
            <div class="flex items-center">
                <i class="fas fa-dollar-sign text-teal-500 text-xl mr-2"></i>
                <span>Maldivian Rufiyaa (MVR)</span>
            </div>
            <div class="flex items-center">
                <i class="fas fa-sun text-teal-500 text-xl mr-2"></i>
                <span>Tropical</span>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="py-12 px-6">
    <div class="container mx-auto max-w-4xl">
        <div class="mb-12">
            <h2 class="text-3xl font-bold mb-6 font-display">Experience the Magic of the Maldives</h2>
            <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-6">
                The Maldives is a dream destination of sparkling blue lagoons, private island resorts, and underwater wonders. Whether you're relaxing in an overwater villa, snorkeling with vibrant fish, or enjoying a sunset cruise, the Maldives is the ultimate escape to paradise.
            </p>

            <div class="bg-teal-100 dark:bg-teal-900 rounded-lg p-6 mb-8 relative">
                <div class="absolute -top-4 -left-4 bg-yellow-400 dark:bg-yellow-500 w-10 h-10 rounded-full flex items-center justify-center">
                    <i class="fas fa-lightbulb text-white"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Fun Fact</h3>
                <p>Maldives is the world’s lowest-lying country, with an average ground level of just 1.5 meters above sea level!</p>
            </div>
        </div>

        <!-- Highlights -->
        <h2 class="text-3xl font-bold mb-6 font-display">Top Highlights</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <!-- Card 1 -->
            <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md hover:shadow-lg transition">
                <div class="h-48 bg-gray-300 overflow-hidden">
                    <img src="images/overwater.jpg" alt="Beach Villas" class="w-full h-full object-cover transition duration-300 hover:scale-110">
                </div>
                <div class="p-4">
                    <span class="inline-block px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded-full text-sm font-medium mb-2">Stay</span>
                    <h3 class="text-xl font-semibold mb-2">Overwater Villas</h3>
                    <p class="text-gray-600 dark:text-gray-400">Wake up to the sound of waves and endless ocean views in luxurious overwater retreats.</p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md hover:shadow-lg transition">
                <div class="h-48 bg-gray-300 overflow-hidden">
                    <img src="images/diving.jpg" alt="Snorkeling" class="w-full h-full object-cover transition duration-300 hover:scale-110">
                </div>
                <div class="p-4">
                    <span class="inline-block px-3 py-1 bg-cyan-100 dark:bg-cyan-900 text-cyan-800 dark:text-cyan-200 rounded-full text-sm font-medium mb-2">Adventure</span>
                    <h3 class="text-xl font-semibold mb-2">Snorkeling & Diving</h3>
                    <p class="text-gray-600 dark:text-gray-400">Explore the vibrant coral reefs and swim alongside manta rays, turtles, and tropical fish.</p>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md hover:shadow-lg transition">
                <div class="h-48 bg-gray-300 overflow-hidden">
                    <img src="images/sunset.jpg" alt="Sunset Cruise" class="w-full h-full object-cover transition duration-300 hover:scale-110">
                </div>
                <div class="p-4">
                    <span class="inline-block px-3 py-1 bg-orange-100 dark:bg-orange-900 text-orange-800 dark:text-orange-200 rounded-full text-sm font-medium mb-2">Relax</span>
                    <h3 class="text-xl font-semibold mb-2">Sunset Cruises</h3>
                    <p class="text-gray-600 dark:text-gray-400">End your day with a magical boat ride as the sun paints the ocean sky in hues of gold and crimson.</p>
                </div>
            </div>
        </div>
    </div>
</section>


           <!-- Best Time to Visit -->
<div class="mb-12">
    <h2 class="text-3xl font-bold mb-6 font-display">Best Time to Visit</h2>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <div class="flex flex-col md:flex-row gap-6">
            <div class="flex-1">
                <h3 class="text-xl font-semibold mb-2 text-green-600 dark:text-green-400">Dry Season (November - April)</h3>
                <ul class="list-disc list-inside space-y-2 text-gray-700 dark:text-gray-300">
                    <li>Sunny skies and calm seas</li>
                    <li>Perfect for snorkeling and diving</li>
                    <li>Peak tourist season</li>
                    <li>Higher prices and limited availability</li>
                </ul>
            </div>
            <div class="flex-1">
                <h3 class="text-xl font-semibold mb-2 text-blue-600 dark:text-blue-400">Wet Season (May - October)</h3>
                <ul class="list-disc list-inside space-y-2 text-gray-700 dark:text-gray-300">
                    <li>Occasional showers and thunderstorms</li>
                    <li>Lush greenery and vibrant marine life</li>
                    <li>Less crowded beaches</li>
                    <li>Better rates on resorts</li>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
</section>

<!-- Travel Tips -->
<section class="py-12 px-6 bg-blue-50 dark:bg-gray-800">
    <div class="container mx-auto max-w-4xl">
        <h2 class="text-3xl font-bold mb-6 font-display text-center">Quick Travel Tips</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow">
                <div class="flex items-start">
                    <i class="fas fa-tshirt text-blue-500 text-2xl mr-4 mt-1"></i>
                    <div>
                        <h3 class="text-xl font-semibold mb-2">What to Pack</h3>
                        <p class="text-gray-700 dark:text-gray-300">Pack light beachwear, swimsuits, reef-safe sunscreen, sunglasses, and flip-flops. Don’t forget a waterproof bag for boat rides.</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow">
                <div class="flex items-start">
                    <i class="fas fa-utensils text-blue-500 text-2xl mr-4 mt-1"></i>
                    <div>
                        <h3 class="text-xl font-semibold mb-2">Must-Try Foods</h3>
                        <p class="text-gray-700 dark:text-gray-300">Taste Maldivian curry, mas huni (smoked tuna and coconut), and fresh seafood straight from the ocean.</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow">
                <div class="flex items-start">
                    <i class="fas fa-ship text-blue-500 text-2xl mr-4 mt-1"></i>
                    <div>
                        <h3 class="text-xl font-semibold mb-2">Getting Around</h3>
                        <p class="text-gray-700 dark:text-gray-300">Use speedboats, seaplanes, or ferries to hop between islands. Walking and bicycles are great for exploring local islands.</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow">
                <div class="flex items-start">
                    <i class="fas fa-heart text-blue-500 text-2xl mr-4 mt-1"></i>
                    <div>
                        <h3 class="text-xl font-semibold mb-2">Local Etiquette</h3>
                        <p class="text-gray-700 dark:text-gray-300">Respect local customs—dress modestly on inhabited islands, avoid public displays of affection, and ask before taking photos.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-16 px-6 bg-cover bg-center relative" style="background-image: url('images/maldives-cta.jpg')">
    <div class="absolute inset-0 bg-blue-900 bg-opacity-80"></div>
    <div class="container mx-auto relative z-10">
        <div class="max-w-2xl mx-auto text-center text-white">
            <h2 class="text-4xl font-bold mb-4 font-display">Dreaming of the Maldives?</h2>
            <p class="text-xl mb-8">Crystal-clear waters, private villas, and unforgettable sunsets await you!</p>
            <a href="booking.php" class="inline-block px-8 py-4 bg-yellow-400 hover:bg-yellow-500 text-gray-900 rounded-lg text-lg font-semibold shadow-lg transition transform hover:scale-105">
                Plan Your Escape
            </a>
        </div>
    </div>
</section>


<!-- More Destinations -->
<section class="py-12 px-6">
    <div class="container mx-auto">
        <h2 class="text-3xl font-bold mb-8 font-display text-center">You Might Also Like</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Destination 1 -->
            <a href="bali.php" class="group">
                <div class="relative rounded-lg overflow-hidden shadow-md">
                    <img src="images/bali.jpg" alt="Bali" class="w-full h-64 object-cover transition duration-300 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-60"></div>
                    <div class="absolute bottom-0 left-0 p-4 text-white">
                        <h3 class="text-xl font-bold">Bali</h3>
                        <p class="text-sm">Island of the Gods</p>
                    </div>
                </div>
            </a>
            
            <!-- Destination 2 -->
            <a href="thailand.php" class="group">
                <div class="relative rounded-lg overflow-hidden shadow-md">
                    <img src="images/thailand.jpg" alt="Thailand" class="w-full h-64 object-cover transition duration-300 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-60"></div>
                    <div class="absolute bottom-0 left-0 p-4 text-white">
                        <h3 class="text-xl font-bold">Thailand</h3>
                        <p class="text-sm">The Land of Smiles</p>
                    </div>
                </div>
            </a>
            
            <!-- Destination 3 -->
            <a href="japan.php" class="group">
                <div class="relative rounded-lg overflow-hidden shadow-md">
                    <img src="images/japan.jpg" alt="Japan" class="w-full h-64 object-cover transition duration-300 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-60"></div>
                    <div class="absolute bottom-0 left-0 p-4 text-white">
                        <h3 class="text-xl font-bold">Japan</h3>
                        <p class="text-sm">Land of the Rising Sun</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- Quirky Travel Quote -->
<section class="py-12 px-6 bg-yellow-100 dark:bg-yellow-900">
    <div class="container mx-auto max-w-4xl text-center">
        <i class="fas fa-quote-left text-yellow-500 dark:text-yellow-400 text-4xl mb-4"></i>
        <blockquote class="text-2xl italic font-display mb-4">"The Maldives isn’t just a place—it’s a feeling of barefoot luxury and ocean whispers."</blockquote>
        <div class="w-16 border-t-2 border-yellow-500 mx-auto"></div>
    </div>
</section>



    <!-- Footer -->
    <footer class="bg-gray-800 text-white pt-12 pb-6">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="flex items-center mb-4">
                        <i class="fas fa-globe-americas text-blue-400 text-2xl mr-2"></i>
                        <h3 class="text-xl font-bold font-display">Wanderlust</h3>
                    </div>
                    <p class="text-gray-400">Your trusted partner for unforgettable travel experiences around the globe.</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="index.php" class="text-gray-400 hover:text-white transition">Home</a></li>
                        <li><a href="destinations.php" class="text-gray-400 hover:text-white transition">Destinations</a></li>
                        <li><a href="booking.php" class="text-gray-400 hover:text-white transition">Booking</a></li>
                        <li><a href="contact.php" class="text-gray-400 hover:text-white transition">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Connect With Us</h4>
                    <div class="flex space-x-4">
                        <a href="https://www.facebook.com/groups/603358390022463/" target="_blank" class="text-gray-400 hover:text-primary transition text-xl"><i class="fab fa-facebook"></i></a>
                        <a href="https://x.com/travelmagazine" target="_blank" class="text-gray-400 hover:text-primary transition text-xl"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.instagram.com/travelandleisure/?hl=en" target="_blank" class="text-gray-400 hover:text-primary transition text-xl"><i class="fab fa-instagram"></i></a>
                        <a href="https://in.pinterest.com/ideas/travel/908182459161/" target="_blank" class="text-gray-400 hover:text-primary transition text-xl"><i class="fab fa-pinterest"></i></a>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact Info</h4>
                    <address class="text-gray-400 not-italic">
                        <p><i class="fas fa-map-marker-alt mr-2"></i> 123 Travel Street, Cityville</p>
                        <p><i class="fas fa-phone mr-2"></i> +1 (555) 123-4567</p>
                        <p><i class="fas fa-envelope mr-2"></i> info@wanderlust.com</p>
                    </address>
                </div>
            </div>
            <div class="border-t border-gray-700 pt-6 text-center">
                <p>&copy; 2025 Wanderlust Travel & Tourism. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Floating Quirky Element -->
    <div class="fixed bottom-6 right-6 bg-yellow-400 dark:bg-yellow-500 w-16 h-16 rounded-full shadow-lg flex items-center justify-center text-2xl animate-bounce cursor-pointer z-50">
        <a href="https://www.makemytrip.com/" target="_blank">
            <i class="fas fa-plane"></i>
        </a>
        
    </div>

    <!-- JavaScript -->
    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });

        // Dark mode toggle
        document.getElementById('theme-toggle').addEventListener('click', function() {
            document.documentElement.classList.toggle('dark');
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
    </script>
</body>
</html>