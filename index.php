<?php
session_start();
$loggedIn = isset($_SESSION['user']);
?>

<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Wanderlust</title>
    
        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
            }
        </script>
        
    
        <!-- Stylesheets -->
        <link rel="stylesheet" href="style.css">
        <link rel="preload" href="https://unpkg.com/swiper/swiper-bundle.min.css" as="style">
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    
        <!-- FontAwesome for Icons -->
        <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" as="style">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" crossorigin="anonymous">
    
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    
        <!-- JavaScript -->
        <script defer src="dark-mode.js"></script>
        <script defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" crossorigin="anonymous"></script>
        <script defer src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    </head>
    
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    
    <!-- Navbar -->
<!-- Navbar - Desktop Navigation -->
<nav class="bg-white dark:bg-gray-800 shadow-md fixed w-full z-50 transition-all duration-300" id="navbar">
     <div class="container mx-auto px-6 py-3 flex justify-between items-center">
         <div class="flex items-center">
             <i class="fas fa-globe-americas text-blue-600 text-2xl mr-2"></i>
             <h1 class="text-2xl font-bold font-display">Wanderlust</h1>
         </div>
         <div class="md:flex items-center space-x-4 hidden">
             <a href="index.php" class="border-b-2 border-primary">Home</a>
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
             <a href="index.html" class="py-1 border-b border-gray-200 dark:border-gray-700">Home</a>
             <a href="destinations.html" class="py-1 border-b border-gray-200 dark:border-gray-700">Destinations</a>
             <a href="booking.php" class="py-1 border-b border-gray-200 dark:border-gray-700">Booking</a>
             <a href="review.html" class="py-1 border-b border-gray-200 dark:border-gray-700">Testimonials</a>
             
             <?php if ($loggedIn): ?>
                 <div class="py-1 border-b border-gray-200 dark:border-gray-700">
                     Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?>
                 </div>
                 <a href="logout.php" class="py-2 px-4 bg-red-400 hover:bg-red-600 text-white font-semibold rounded-lg shadow text-center">
                     Logout
                 </a>
             <?php else: ?>
                 <a href="login.php" class="py-2 px-4 bg-blue-400 hover:bg-blue-600 text-white font-semibold rounded-lg shadow text-center">
                     Login
                 </a>
             <?php endif; ?>
         </div>
     </div>
</nav>
    
    <!-- Hero Section -->
    <section class="relative w-full h-screen flex items-center justify-center bg-cover bg-center hero-parallax" id="heroSection">
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        <div class="relative text-center text-white p-8 max-w-3xl mx-auto">
            <h2 class="text-5xl md:text-6xl font-extrabold font-display mb-2 text-shadow animate-pulse">Discover The World</h2>
            <p class="text-xl md:text-2xl mt-4 mb-8 text-shadow">Your journey begins with a single click</p>
            <div class="flex flex-col md:flex-row justify-center space-y-4 md:space-y-0 md:space-x-4">
                <a href="destinations.php" class="px-8 py-3 bg-blue-700 hover:bg-blue-600 rounded-lg text-lg font-semibold shadow-lg transition transform hover:scale-105">
                    Explore Destinations
                </a>
                <button id="scroll-to-search" class="px-8 py-3 bg-white text-blue-700 hover:bg-gray-100 rounded-lg text-lg font-semibold shadow-lg transition transform hover:scale-105">
                    <a href="booking.php">
                    Plan Your Trip
                    </a>
                </button>
            </div>
        </div>
        <!-- Down Arrow Animation -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
            <a href="#search-section" class="text-white text-4xl">
                <i class="fas fa-chevron-down"></i>
            </a>
        </div>
    </section>

<section class="bg-gray-100 dark:bg-gray-900 py-16 px-6 flex justify-center">
    <div class="bg-white dark:bg-gray-800 max-w-8xl p-10 rounded-lg shadow-lg text-center">
        <h2 class="text-3xl font-semibold text-gray-900 dark:text-white">Personalised Travel Curation Service</h2>
        <div class="w-16 border-t-2 border-orange-500 mx-auto my-4"></div>
        <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
            We believe great travel experiences are created through passion, knowledge, and an unwavering focus on detail. 
            Based on this philosophy, we created ASW Private as a high-end, personalized travel curation service, where 
            each itinerary is carefully crafted to your needs.
        </p>
        <p class="text-gray-700 dark:text-gray-300 leading-relaxed">We offer this service for travel arrangements with a combined value of EUR 5’000 or higher.</p>
        <a href="booking.php" class="mt-6 inline-block bg-gray-900 dark:bg-gray-600 text-white px-6 py-3 rounded-full text-lg font-semibold hover:bg-gray-700 dark:hover:bg-gray-500 transition">
            BOOK WITH US
        </a>
    </div>
</section>



<!-- Featured Destinations Section -->
<section class="my-16 px-6 md:px-12">
    <h2 class="text-center text-4xl font-bold mb-8">Featured Destinations</h2>

    <!-- Swiper Container -->
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">

            <!-- Slide 1 -->
            <div class="swiper-slide">
                <div class="relative">
                    <img src="images/paris2.jpg" alt="Paris" class="w-full h-96 object-cover rounded-lg">
                    <div class="absolute bottom-0 bg-black bg-opacity-50 text-white p-4 w-full rounded-b-lg">
                        <h3 class="text-xl font-semibold">Paris, France</h3>
                        <p class="text-sm">Explore the city of love and its iconic landmarks.</p>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="swiper-slide">
                <div class="relative">
                    <img src="images/maldives2.jpg" alt="Maldives" class="w-full h-96 object-cover rounded-lg">
                    <div class="absolute bottom-0 bg-black bg-opacity-50 text-white p-4 w-full rounded-b-lg">
                        <h3 class="text-xl font-semibold">Maldives</h3>
                        <p class="text-sm">Relax on beautiful white-sand beaches and clear waters.</p>
                    </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="swiper-slide">
                <div class="relative">
                    <img src="images/japan2.jpg" alt="Japan" class="w-full h-96 object-cover rounded-lg">
                    <div class="absolute bottom-0 bg-black bg-opacity-50 text-white p-4 w-full rounded-b-lg">
                        <h3 class="text-xl font-semibold">Tokyo, Japan</h3>
                        <p class="text-sm">Experience the perfect blend of tradition and modernity.</p>
                    </div>
                </div>
            </div>

            <!-- Slide 4 -->
            <div class="swiper-slide">
                <div class="relative">
                    <img src="images/dubai2.jpg" alt="Dubai" class="w-full h-96 object-cover rounded-lg">
                    <div class="absolute bottom-0 bg-black bg-opacity-50 text-white p-4 w-full rounded-b-lg">
                        <h3 class="text-xl font-semibold">Dubai, UAE</h3>
                        <p class="text-sm">Discover luxury, skyscrapers, and desert adventures.</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Swiper Pagination & Navigation -->
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
</section>

 <!-- Why Choose Us Section with Counter Animation -->
 <section class="py-16 px-6 bg-gray-50 dark:bg-gray-800">
        <div class="container mx-auto">
            <h2 class="text-center text-4xl font-bold mb-2 font-display">Why Choose Us?</h2>
            <p class="text-center text-gray-600 dark:text-gray-400 mb-12">We're committed to making your travel experience unforgettable</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="bg-white dark:bg-gray-700 p-6 rounded-xl shadow-lg text-center hover:shadow-xl transition">
                    <div class="animate-float">
                        <i class="fa-solid fa-award text-secondary text-5xl mb-4"></i>
                    </div>
                    <h3 class="text-2xl font-semibold mb-2">Top Quality Service</h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        <span class="counter font-bold text-primary text-2xl">12</span> years of excellence in travel services
                    </p>
                    <p class="mt-2 text-gray-600 dark:text-gray-300">We provide top-notch service, ensuring a hassle-free travel experience for every customer.</p>
                </div>
                
                <!-- Card 2 -->
                <div class="bg-white dark:bg-gray-700 p-6 rounded-xl shadow-lg text-center hover:shadow-xl transition">
                    <div class="animate-float">
                        <i class="fa-solid fa-dollar-sign text-green-500 text-5xl mb-4"></i>
                    </div>
                    <h3 class="text-2xl font-semibold mb-2">Best Price Guarantee</h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        Up to <span class="counter font-bold text-primary text-2xl">30</span>% savings compared to booking elsewhere
                    </p>
                    <p class="mt-2 text-gray-600 dark:text-gray-300">Enjoy competitive pricing without compromising on quality and service excellence.</p>
                </div>
                
                <!-- Card 3 -->
                <div class="bg-white dark:bg-gray-700 p-6 rounded-xl shadow-lg text-center hover:shadow-xl transition">
                    <div class="animate-float">
                        <i class="fa-solid fa-headset text-blue-500 text-5xl mb-4"></i>
                    </div>
                    <h3 class="text-2xl font-semibold mb-2">24/7 Customer Support</h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        <span class="counter font-bold text-primary text-2xl">24</span>/7 dedicated customer service
                    </p>
                    <p class="mt-2 text-gray-600 dark:text-gray-300">Our support team is always available to assist you anytime, anywhere in the world.</p>
                </div>
            </div>
        </div>
    </section>


    <!-- Travel Gallery Section -->
<section class="py-16 px-6">
    <div class="container mx-auto">
        <h2 class="text-center text-4xl font-bold mb-2 font-display">Travel Gallery</h2>
        <p class="text-center text-gray-600 dark:text-gray-400 mb-12">Explore stunning destinations through our curated collection</p>
        
        <!-- Gallery Filter Buttons -->
        <div class="flex flex-wrap justify-center gap-3 mb-8">
            <button class="gallery-filter px-4 py-2 rounded-full bg-primary text-white hover:bg-blue-700 transition" data-filter="all">All</button>
            <button class="gallery-filter px-4 py-2 rounded-full bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 transition" data-filter="beaches">Beaches</button>
            <button class="gallery-filter px-4 py-2 rounded-full bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 transition" data-filter="mountains">Mountains</button>
            <button class="gallery-filter px-4 py-2 rounded-full bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 transition" data-filter="cities">Cities</button>
            <button class="gallery-filter px-4 py-2 rounded-full bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 transition" data-filter="landmarks">Landmarks</button>
        </div>
        
        <!-- Gallery Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="gallery-grid">
            <!-- Beach Images -->
            <div class="gallery-item beaches overflow-hidden rounded-lg shadow-md group" data-category="beaches">
                <div class="relative aspect-square">
                    <img src="https://images.unsplash.com/photo-1520454974749-611b7248ffdb" alt="Tropical Beach" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                        <h3 class="text-white font-bold text-lg">Maldives Paradise</h3>
                        <p class="text-gray-200 text-sm">Crystal clear waters and white sand beaches</p>
                    </div>
                </div>
            </div>
            
            <div class="gallery-item beaches overflow-hidden rounded-lg shadow-md group" data-category="beaches">
                <div class="relative aspect-square">
                    <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e" alt="Scenic Beach" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                        <h3 class="text-white font-bold text-lg">Tropical Getaway</h3>
                        <p class="text-gray-200 text-sm">Perfect sunset views and palm trees</p>
                    </div>
                </div>
            </div>
            
            <!-- Mountain Images -->
            <div class="gallery-item mountains overflow-hidden rounded-lg shadow-md group" data-category="mountains">
                <div class="relative aspect-square">
                    <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b" alt="Mountain View" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                        <h3 class="text-white font-bold text-lg">Swiss Alps</h3>
                        <p class="text-gray-200 text-sm">Majestic mountain ranges and hiking trails</p>
                    </div>
                </div>
            </div>
            
            <div class="gallery-item mountains overflow-hidden rounded-lg shadow-md group" data-category="mountains">
                <div class="relative aspect-square">
                    <img src="https://images.unsplash.com/photo-1486870591958-9b9d0d1dda99" alt="Mountain Cabin" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                        <h3 class="text-white font-bold text-lg">Mountain Retreat</h3>
                        <p class="text-gray-200 text-sm">Peaceful cabins with breathtaking views</p>
                    </div>
                </div>
            </div>
            
            <!-- City Images -->
            <div class="gallery-item cities overflow-hidden rounded-lg shadow-md group" data-category="cities">
                <div class="relative aspect-square">
                    <img src="https://images.unsplash.com/photo-1496442226666-8d4d0e62e6e9" alt="New York City" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                        <h3 class="text-white font-bold text-lg">New York City</h3>
                        <p class="text-gray-200 text-sm">The city that never sleeps</p>
                    </div>
                </div>
            </div>
            
            <div class="gallery-item cities overflow-hidden rounded-lg shadow-md group" data-category="cities">
                <div class="relative aspect-square">
                    <img src="https://images.unsplash.com/photo-1502602898657-3e91760cbb34" alt="Paris" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                        <h3 class="text-white font-bold text-lg">Paris</h3>
                        <p class="text-gray-200 text-sm">The city of light and romance</p>
                    </div>
                </div>
            </div>
            
            <!-- Landmark Images -->
            <div class="gallery-item landmarks overflow-hidden rounded-lg shadow-md group" data-category="landmarks">
                <div class="relative aspect-square">
                    <img src="https://images.unsplash.com/photo-1564507592333-c60657eea523" alt="Taj Mahal" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                        <h3 class="text-white font-bold text-lg">Taj Mahal</h3>
                        <p class="text-gray-200 text-sm">A monument of eternal love</p>
                    </div>
                </div>
            </div>
            
            <div class="gallery-item landmarks overflow-hidden rounded-lg shadow-md group" data-category="landmarks">
                <div class="relative aspect-square">
                    <img src="images/colosseum.jpg" alt="Colosseum" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                        <h3 class="text-white font-bold text-lg">Colosseum</h3>
                        <p class="text-gray-200 text-sm">The iconic Roman amphitheater</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- View More Button -->
        <div class="text-center mt-12">
            <button id="load-more" class="px-8 py-3 bg-primary text-black rounded-lg font-semibold shadow-lg hover:bg-blue-600 transition transform hover:scale-105">
                Load More Photos
                <i class="fas fa-caret-down ml-2"></i>
            </button>
        </div>
    </div>
    
    <!-- Gallery Modal -->
    <div id="gallery-modal" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden flex items-center justify-center p-6">
        <button id="close-modal" class="absolute top-6 right-6 text-white text-3xl hover:text-gray-300">
            <i class="fas fa-times"></i>
        </button>
        <button id="prev-img" class="absolute left-6 text-white text-5xl hover:text-gray-300">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button id="next-img" class="absolute right-6 text-white text-5xl hover:text-gray-300">
            <i class="fas fa-chevron-right"></i>
        </button>
        <img id="modal-img" class="max-w-full max-h-[80vh] object-contain" src="" alt="Gallery image">
        <div class="absolute bottom-6 text-white text-center w-full">
            <h3 id="modal-title" class="text-xl font-bold"></h3>
            <p id="modal-desc" class="text-gray-300"></p>
        </div>
    </div>
</section>

<!-- Add this script to your existing JavaScript section -->
<script>
    // Gallery functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Gallery filtering
        const filterButtons = document.querySelectorAll('.gallery-filter');
        const galleryItems = document.querySelectorAll('.gallery-item');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Update active button styling
                filterButtons.forEach(btn => {
                    btn.classList.remove('bg-primary', 'text-white');
                    btn.classList.add('bg-gray-200', 'text-gray-800', 'dark:bg-gray-700', 'dark:text-gray-200');
                });
                this.classList.remove('bg-gray-200', 'text-gray-800', 'dark:bg-gray-700', 'dark:text-gray-200');
                this.classList.add('bg-primary', 'text-white');
                
                // Filter gallery items
                const filter = this.getAttribute('data-filter');
                
                galleryItems.forEach(item => {
                    if (filter === 'all' || item.getAttribute('data-category') === filter) {
                        item.style.display = 'block';
                        // Add animation
                        item.classList.add('animate-fadeIn');
                        setTimeout(() => {
                            item.classList.remove('animate-fadeIn');
                        }, 500);
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
        
        // Gallery modal functionality
        const modal = document.getElementById('gallery-modal');
        const modalImg = document.getElementById('modal-img');
        const modalTitle = document.getElementById('modal-title');
        const modalDesc = document.getElementById('modal-desc');
        const closeModal = document.getElementById('close-modal');
        const prevImg = document.getElementById('prev-img');
        const nextImg = document.getElementById('next-img');
        let currentIndex = 0;
        let visibleItems = [];
        
        // Open modal when clicking on an image
        galleryItems.forEach((item, index) => {
            const img = item.querySelector('img');
            const title = item.querySelector('h3').textContent;
            const desc = item.querySelector('p').textContent;
            
            img.addEventListener('click', function() {
                // Get only visible items
                visibleItems = Array.from(galleryItems).filter(
                    item => item.style.display !== 'none'
                );
                currentIndex = visibleItems.indexOf(item);
                
                modalImg.src = this.src;
                modalTitle.textContent = title;
                modalDesc.textContent = desc;
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden'; // Prevent scrolling
            });
        });
        
        // Close modal
        closeModal.addEventListener('click', function() {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto'; // Enable scrolling
        });
        
        // Navigate images
        prevImg.addEventListener('click', function() {
            if (currentIndex > 0) {
                currentIndex--;
            } else {
                currentIndex = visibleItems.length - 1;
            }
            updateModal(visibleItems[currentIndex]);
        });
        
        nextImg.addEventListener('click', function() {
            if (currentIndex < visibleItems.length - 1) {
                currentIndex++;
            } else {
                currentIndex = 0;
            }
            updateModal(visibleItems[currentIndex]);
        });
        
        function updateModal(item) {
            const img = item.querySelector('img');
            const title = item.querySelector('h3').textContent;
            const desc = item.querySelector('p').textContent;
            
            modalImg.src = img.src;
            modalTitle.textContent = title;
            modalDesc.textContent = desc;
        }
        
        // Load more button (demonstration only - would connect to backend in real implementation)
        document.getElementById('load-more').addEventListener('click', function() {
            this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Loading...';
            setTimeout(() => {
                this.innerHTML = 'No More Photos';
                this.disabled = true;
                this.classList.add('opacity-50', 'cursor-not-allowed');
            }, 1500);
        });
        
        // Close modal when clicking outside the image
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        });
        
        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (modal.classList.contains('hidden')) return;
            
            if (e.key === 'Escape') {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            } else if (e.key === 'ArrowLeft') {
                prevImg.click();
            } else if (e.key === 'ArrowRight') {
                nextImg.click();
            }
        });
    });
    
    // Add this to your CSS styles section
    document.head.insertAdjacentHTML('beforeend', `
        <style>
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .animate-fadeIn {
                animation: fadeIn 0.5s ease forwards;
            }
        </style>
    `);
</script>

    <!-- Call to Action -->
    <section class="py-16 px-6 bg-cover bg-center relative" style="background-image: url('https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1')">
        <div class="absolute inset-0 bg-blue-900 bg-opacity-80"></div>
        <div class="container mx-auto relative z-10">
            <div class="max-w-2xl mx-auto text-center text-white">
                <h2 class="text-4xl font-bold mb-4 font-display">Ready for the trip of a lifetime?</h2>
                <p class="text-xl mb-8">Let our expert travel designers plan your dream vacation today!</p>
                <a href="destinations.php" class="inline-block px-8 py-4 bg-white text-blue-600 hover:bg-gray-100 rounded-lg text-lg font-semibold shadow-lg transition transform hover:scale-105">
                    Start Planning Now
                </a>
            </div>
        </div>
    </section>

    <!-- Newsletter Signup -->
    <section class="py-12 px-6">
        <div class="container mx-auto max-w-4xl">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-8">
                <div class="text-center mb-6">
                    <h3 class="text-2xl font-bold font-display">Join Our Travel Community</h3>
                    <p class="text-gray-600 dark:text-gray-300 mt-2">Subscribe to receive exclusive deals and travel inspiration</p>
                </div>
                <form class="flex flex-col md:flex-row gap-4">
                    <input type="email" placeholder="Your email address" class="flex-grow p-3 border rounded-lg dark:bg-gray-700 dark:border-gray-600">
                    <button type="submit" class="px-6 py-3 bg-secondary hover:bg-yellow-500 text-blue-600 rounded-lg font-semibold shadow transition">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
    </section>
<!-- FontAwesome for Icons -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" crossorigin="anonymous"></script>





<!-- footer -->
<footer class="bg-gray-800 text-white pt-12 pb-6">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="flex items-center mb-4">
                        <i class="fas fa-globe-americas text-primary text-2xl mr-2"></i>
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

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script>


        // Hero Image Parallax Effect
        const heroSection = document.getElementById('heroSection');
        heroSection.style.backgroundImage = "url('https://images.unsplash.com/photo-1469854523086-cc02fe5d8800')";
        
        window.addEventListener('scroll', function() {
            const offset = window.pageYOffset;
            heroSection.style.backgroundPositionY = offset * 0.5 + 'px';
        });


    var swiper = new Swiper(".swiper", {
        loop: true, // Enables infinite loop
        autoplay: { 
            delay: 2500, // Adjust the delay for sliding (2.5 seconds)
            disableOnInteraction: false, // Keeps autoplay running even if user interacts
        },
        slidesPerView: 1,  // Shows one image at a time
        spaceBetween: 20,  // Adds spacing
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: { // Adds next & previous buttons
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });

    // Dark Mode Toggle
    document.getElementById("theme-toggle").addEventListener("click", function() {
        document.documentElement.classList.toggle("light");
    });
</script>

</body>
</html>