<?php
session_start();
$loggedIn = isset($_SESSION['user']);
?>

<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinations-wanderlust</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" crossorigin="anonymous" />
<script defer src="dark-mode.js"></script>

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
             <a href="contact.html" class="hover:text-primary transition">Contact us</a>
             
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
             <!-- <a href="contact.html" class="py-1 border-b border-gray-200 dark:border-gray-700">Contact</a> -->
             <a href="review.php" class="py-1 border-b border-gray-200 dark:border-gray-700">Testimonials</a>
             
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
    <!-- Filters and Search -->
    <div class="p-6 text-center">
        <input type="text" id="search" placeholder="Search destinations..." class="p-2 border rounded-md w-1/3">
        <select id="filter" class="p-2 border rounded-md">
            <option value="all">All</option>
            <option value="beach">Beach</option>
            <option value="mountain">Mountain</option>
            <option value="city">City</option>
        </select>
    </div>

    <!-- Destination Cards -->
    <div id="destinations" class="grid grid-cols-1 md:grid-cols-3 gap-8 p-6">
        <!-- Cards will be added dynamically here -->
    </div>

    <div class="text-center mt-4">
        <button id="show-more" class="bg-blue-500 text-white px-4 py-2 rounded-md">Show More</button>
        <button id="show-less" class="bg-gray-500 text-white px-4 py-2 rounded-md hidden">Show Less</button>
    </div>

    <script>
        const destinations = [
    {
        name: "Japan",
        category: "city", // could also be culture or mixed
        description: "Discover a blend of tradition and modernity in Tokyo, Kyoto, and beyond.",
        img: "images/japan.jpg",
        link: "japan.php"
    },
    {
        name: "Italy",
        category: "city",
        description: "Explore historic cities, Renaissance art, and delicious cuisine in Rome, Venice, and Florence.",
        img: "images/italy.jpg",
        link: "italy.php"
    },
    {
        name: "Bali",
        category: "beach",
        description: "A paradise island with serene beaches, lush rice terraces, and vibrant culture.",
        img: "images/bali.jpg",
        link: "bali.php"
    },
    {
        name: "Maldives",
        category: "beach",
        description: "Unwind on stunning overwater villas surrounded by turquoise waters.",
        img: "images/maldives2.jpg",
        link: "maldives.php"
    },
    {
        name: "Thailand",
        category: "beach",
        description: "From bustling Bangkok to the calm beaches of Phuket and Krabi, experience it all.",
        img: "images/thailand.jpg",
        link: "thailand.php"
    }
];


        const destinationContainer = document.getElementById("destinations");
        const searchInput = document.getElementById("search");
        const filterSelect = document.getElementById("filter");
        const showMoreBtn = document.getElementById("show-more");
        const showLessBtn = document.getElementById("show-less");

        let visibleDestinations = 3; // Show only 3 initially

        function renderDestinations() {
            destinationContainer.innerHTML = ""; // Clear previous tiles
            const searchText = searchInput.value.toLowerCase();
            const selectedCategory = filterSelect.value;
            
            const filteredDestinations = destinations.filter(dest => 
                (selectedCategory === "all" || dest.category === selectedCategory) &&
                (dest.name.toLowerCase().includes(searchText) || dest.description.toLowerCase().includes(searchText))
            );

            filteredDestinations.slice(0, visibleDestinations).forEach(dest => {
                const card = document.createElement("div");
                card.classList.add("p-4", "rounded-lg", "shadow-lg", "transition", "hover:shadow-xl", "dark:bg-gray-800");
                card.style.backgroundColor = "rgba(255, 255, 255, 0.8)"; // Subtle color variation

                card.innerHTML = `
                    <img src="${dest.img}" class="w-full h-48 object-cover rounded-md" alt="${dest.name}">
                    <h2 class="text-xl font-bold mt-2">${dest.name}</h2>
                    <p class="text-gray-600 dark:text-gray-300">${dest.description}</p>
                    <a href="${dest.link}" target="_blank" class="block mt-4 bg-green-500 text-white py-2 text-center rounded-lg hover:bg-green-600">Show More</a>
                `;
                destinationContainer.appendChild(card);
            });

            // Toggle Show More / Show Less Buttons
            showMoreBtn.style.display = (filteredDestinations.length > visibleDestinations) ? "inline-block" : "none";
            showLessBtn.style.display = (visibleDestinations > 3) ? "inline-block" : "none";
        }

        searchInput.addEventListener("input", renderDestinations);
        filterSelect.addEventListener("change", renderDestinations);

        showMoreBtn.addEventListener("click", () => {
            visibleDestinations = destinations.length;
            renderDestinations();
        });

        showLessBtn.addEventListener("click", () => {
            visibleDestinations = 3;
            renderDestinations();
        });

        document.getElementById("theme-toggle").addEventListener("click", function() {
            document.documentElement.classList.toggle("light");
        });

        renderDestinations(); // Initial rendering
    </script>

</body>
</html>
