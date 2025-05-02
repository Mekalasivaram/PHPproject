<?php
session_start();
$loggedIn = isset($_SESSION['user']);
?>

<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Italy - Wanderlust</title>

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
<section class="relative w-full h-96 flex items-center justify-center bg-cover bg-center" style="background-image: url('images/italypage.jpg')">
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
    <div class="relative text-center text-white p-8 max-w-3xl mx-auto">
        <h2 class="text-5xl md:text-6xl font-extrabold font-display mb-2 text-shadow">Italy</h2>
        <p class="text-xl md:text-2xl mt-4 mb-8">Where every corner whispers history, art, and dolce vita</p>
    </div>
</section>

<!-- Quick Facts -->
<section class="py-8 bg-white dark:bg-gray-800">
    <div class="container mx-auto px-6">
        <div class="flex flex-wrap justify-center gap-6 text-center">
            <div class="flex items-center">
                <i class="fas fa-map-marker-alt text-green-600 text-xl mr-2"></i>
                <span>Italy</span>
            </div>
            <div class="flex items-center">
                <i class="fas fa-language text-green-600 text-xl mr-2"></i>
                <span>Italian</span>
            </div>
            <div class="flex items-center">
                <i class="fas fa-euro-sign text-green-600 text-xl mr-2"></i>
                <span>Euro (EUR)</span>
            </div>
            <div class="flex items-center">
                <i class="fas fa-leaf text-green-600 text-xl mr-2"></i>
                <span>Mediterranean</span>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="py-12 px-6">
    <div class="container mx-auto max-w-4xl">
        <div class="mb-12">
            <h2 class="text-3xl font-bold mb-6 font-display">Experience Italy’s Charm</h2>
            <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-6">
                Italy is a vibrant mosaic of Renaissance art, ancient ruins, stunning coastlines, and culinary masterpieces. Whether you’re wandering through Rome’s Colosseum, cruising the canals of Venice, or savoring gelato in Florence, every experience is a feast for the senses.
            </p>

            <div class="bg-green-100 dark:bg-green-900 rounded-lg p-6 mb-8 relative">
                <div class="absolute -top-4 -left-4 bg-yellow-400 dark:bg-yellow-500 w-10 h-10 rounded-full flex items-center justify-center">
                    <i class="fas fa-lightbulb text-white"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Fun Fact</h3>
                <p>Italy is home to the most UNESCO World Heritage Sites in the world—including the historic centers of Rome, Florence, and Venice!</p>
            </div>
        </div>

        <!-- Highlights -->
        <h2 class="text-3xl font-bold mb-6 font-display">Top Highlights</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <!-- Card 1 -->
            <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md hover:shadow-lg transition">
                <div class="h-48 bg-gray-300 overflow-hidden">
                    <img src="images/Colosseum.jpg" alt="Colosseum" class="w-full h-full object-cover transition duration-300 hover:scale-110">
                </div>
                <div class="p-4">
                    <span class="inline-block px-3 py-1 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 rounded-full text-sm font-medium mb-2">History</span>
                    <h3 class="text-xl font-semibold mb-2">Colosseum</h3>
                    <p class="text-gray-600 dark:text-gray-400">Explore the grandeur of ancient Rome through its iconic gladiatorial arena—still standing after nearly two millennia.</p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md hover:shadow-lg transition">
                <div class="h-48 bg-gray-300 overflow-hidden">
                    <img src="images/vanice.jpg" alt="Venice" class="w-full h-full object-cover transition duration-300 hover:scale-110">
                </div>
                <div class="p-4">
                    <span class="inline-block px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded-full text-sm font-medium mb-2">Romance</span>
                    <h3 class="text-xl font-semibold mb-2">Venice</h3>
                    <p class="text-gray-600 dark:text-gray-400">Float through this dreamy city on a gondola and experience the beauty of its canals, bridges, and timeless architecture.</p>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md hover:shadow-lg transition">
                <div class="h-48 bg-gray-300 overflow-hidden">
                    <img src="images/italyfood.jpg" alt="Italian Cuisine" class="w-full h-full object-cover transition duration-300 hover:scale-110">
                </div>
                <div class="p-4">
                    <span class="inline-block px-3 py-1 bg-orange-100 dark:bg-orange-900 text-orange-800 dark:text-orange-200 rounded-full text-sm font-medium mb-2">Food</span>
                    <h3 class="text-xl font-semibold mb-2">Italian Cuisine</h3>
                    <p class="text-gray-600 dark:text-gray-400">Taste the heart of Italy in every bite—from handmade pasta and wood-fired pizza to fine wines and creamy tiramisu.</p>
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
                <h3 class="text-xl font-semibold mb-2 text-green-600 dark:text-green-400">Spring & Fall (April - June, September - October)</h3>
                <ul class="list-disc list-inside space-y-2 text-gray-700 dark:text-gray-300">
                    <li>Pleasant weather and fewer crowds</li>
                    <li>Perfect for sightseeing and outdoor cafes</li>
                    <li>Ideal for exploring historic cities and countryside</li>
                    <li>Beautiful blooming gardens and harvest festivals</li>
                </ul>
            </div>
            <div class="flex-1">
                <h3 class="text-xl font-semibold mb-2 text-blue-600 dark:text-blue-400">Summer & Winter (July - August, November - March)</h3>
                <ul class="list-disc list-inside space-y-2 text-gray-700 dark:text-gray-300">
                    <li>Hot summers with lively festivals</li>
                    <li>Great for beach lovers and coastal regions</li>
                    <li>Winters bring magical Christmas markets</li>
                    <li>Ideal time for skiing in the Italian Alps</li>
                </ul>
            </div>
        </div>
    </div>
</div>

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
                        <p class="text-gray-700 dark:text-gray-300">Pack stylish yet comfortable clothes, walking shoes, and modest attire for churches and cathedrals.</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow">
                <div class="flex items-start">
                    <i class="fas fa-utensils text-blue-500 text-2xl mr-4 mt-1"></i>
                    <div>
                        <h3 class="text-xl font-semibold mb-2">Must-Try Foods</h3>
                        <p class="text-gray-700 dark:text-gray-300">Don’t miss authentic pasta, pizza, gelato, espresso, and regional dishes like risotto and tiramisu.</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow">
                <div class="flex items-start">
                    <i class="fas fa-train text-blue-500 text-2xl mr-4 mt-1"></i>
                    <div>
                        <h3 class="text-xl font-semibold mb-2">Getting Around</h3>
                        <p class="text-gray-700 dark:text-gray-300">Use Italy’s efficient train system to travel between cities, or rent a car to explore Tuscany and the Amalfi Coast.</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow">
                <div class="flex items-start">
                    <i class="fas fa-hands-praying text-blue-500 text-2xl mr-4 mt-1"></i>
                    <div>
                        <h3 class="text-xl font-semibold mb-2">Cultural Etiquette</h3>
                        <p class="text-gray-700 dark:text-gray-300">Greetings with a cheek kiss are common, dress modestly in churches, and always say "Buongiorno" when entering shops.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-16 px-6 bg-cover bg-center relative" style="background-image: url('images/italy-cta.jpg')">
    <div class="absolute inset-0 bg-blue-900 bg-opacity-80"></div>
    <div class="container mx-auto relative z-10">
        <div class="max-w-2xl mx-auto text-center text-white">
            <h2 class="text-4xl font-bold mb-4 font-display">Ready for your Italy adventure?</h2>
            <p class="text-xl mb-8">From ancient ruins to romantic canals—Italy is calling!</p>
            <a href="booking.php" class="inline-block px-8 py-4 bg-yellow-400 hover:bg-yellow-500 text-gray-900 rounded-lg text-lg font-semibold shadow-lg transition transform hover:scale-105">
                Plan Your Trip
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

            <!-- Destination 2 -->
            <a href="maldives.php" class="group">
                <div class="relative rounded-lg overflow-hidden shadow-md">
                    <img src="images/maldives2.jpg" alt="Maldives" class="w-full h-64 object-cover transition duration-300 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-60"></div>
                    <div class="absolute bottom-0 left-0 p-4 text-white">
                        <h3 class="text-xl font-bold">Maldives</h3>
                        <p class="text-sm">Paradise on Earth</p>
                    </div>
                </div>
            </a>

            <!-- Destination 3 -->
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
        </div>
    </div>
</section>

<!-- Quirky Travel Quote -->
<section class="py-12 px-6 bg-yellow-100 dark:bg-yellow-900">
    <div class="container mx-auto max-w-4xl text-center">
        <i class="fas fa-quote-left text-yellow-500 dark:text-yellow-400 text-4xl mb-4"></i>
        <blockquote class="text-2xl italic font-display mb-4">"Italy isn’t just a destination—it’s a living museum where every corner tells a story of art, love, and passion."</blockquote>
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