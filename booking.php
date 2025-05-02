<?php
session_start();
include 'connection.php';

// Check if user is logged in at the beginning of the script
$loggedIn = isset($_SESSION['user']);

// Process form submission
if (isset($_POST['btn'])) {
    // Check login status before processing form
    if (!$loggedIn) {
        echo "<script>alert('Please log in before submitting the form.'); window.location.href='login.php';</script>";
        exit();
    }

    function clean_input($data) {
        return htmlspecialchars(strip_tags(trim($data)));
    }

    $name = clean_input($_POST['full_name']);
    $email = clean_input($_POST['email']);
    $mobile = clean_input($_POST['mob_num']);
    $destination = clean_input($_POST['destination']);
    $adult = intval($_POST['adult_no']);
    $child = intval($_POST['child_no']);
    $departure = clean_input($_POST['dep_date']);
    $arrival = clean_input($_POST['arr_date']);
    $hotel = clean_input($_POST['hotel']);
    $spreq = clean_input($_POST['req']);

    // Basic validations
    if (empty($name) || empty($email) || empty($mobile) || empty($destination) || empty($departure) || empty($arrival)) {
        echo "<script>alert('Please fill in all the required fields.');</script>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format.');</script>";
    } elseif (!preg_match('/^[0-9]{10}$/', $mobile)) {
        echo "<script>alert('Mobile number must be 10 digits');</script>";
    } elseif (strtotime($arrival) < strtotime($departure)) {
        echo "<script>alert('Arrival date cannot be before departure date.');</script>";
    } else {
        // Prepared statement to prevent SQL injection
        $stmt = $con->prepare("INSERT INTO travelbooking (fullname, email, mobile, destination, adults, child, departure, arrival, hotel, req) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssiissss", $name, $email, $mobile, $destination, $adult, $child, $departure, $arrival, $hotel, $spreq);

        if ($stmt->execute()) {
            echo "<script>alert('Data inserted successfully'); window.location.href='thankyou.php';</script>";
        } else {
            echo "<script>alert('Data not inserted: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking - Wanderlust</title>
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
                <a href="booking.php" class="border-b-2 border-primary">Booking</a>
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

    <section class="py-24 px-6 flex justify-center relative z-10">
        <?php if (!$loggedIn): ?>
            <div class="bg-white dark:bg-gray-800 max-w-4xl p-10 rounded-lg shadow-lg w-full bg-opacity-90 text-center">
                <h2 class="text-3xl font-semibold text-gray-900 dark:text-white mb-6">Please Login to Book Your Trip</h2>
                <p class="text-gray-700 dark:text-gray-300 mb-6">You need to be logged in to access our booking services.</p>
                <a href="login.php" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-3 rounded-lg shadow-lg transition inline-block">
                    Login Now
                </a>
            </div>
        <?php else: ?>
            <div class="bg-white dark:bg-gray-800 max-w-4xl p-10 rounded-lg shadow-lg w-full bg-opacity-90">
                <h2 class="text-3xl font-semibold text-gray-900 dark:text-white text-center">Travel Registration Form</h2>

                <!-- form  -->
                <form class="mt-6 space-y-4" method="post" action="booking.php">
                    
                    <!-- Name -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300" for="full_name">Full Name</label>
                        <input type="text" name="full_name" required placeholder="Enter your full name" class="w-full px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white">
                    </div>
                    
                    <!-- Email -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300" for="email">Email</label>
                        <input type="email" name="email" required placeholder="Enter your email" class="w-full px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white">
                    </div>
                    
                    <!-- Phone Number -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300" for="mob_num">Phone Number</label>
                        <input type="tel" name="mob_num" required placeholder="Enter your phone number" class="w-full px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white">
                    </div>
                    
                    <!-- Destination Selection -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300" for="destination">Destination</label>
                        <select class="w-full px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white" required name="destination">
                            <option>Paris, France</option>
                            <option>Maldives</option>
                            <option>Tokyo, Japan</option>
                            <option>Dubai, UAE</option>
                            <option>New York, USA</option>
                            <option>London, UK</option>
                            <option>Sydney, Australia</option>
                            <option>Bali, Indonesia</option>
                        </select>
                    </div>

                    <!-- number of adults  -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300"  for="adult_no">Number of Adults</label>
                        <input type="number" name="adult_no" required min="1" value="1" class="w-full px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white">
                    </div>
                    
                    <!-- Number of Children -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300" for="child_no">Number of Children</label>
                        <input type="number" name="child_no" min="0" value="0" class="w-full px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white">
                    </div>
                    
                    <!-- Date Selection -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300" for="dep_date">Departure Date</label>
                            <input type="date" name="dep_date" required class="w-full px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white">
                        </div>
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300" for="arr_date">Arrival Date</label>
                            <input type="date" name="arr_date" required class="w-full px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white">
                        </div>
                    </div>
                    <!-- hotel preference -->
                    <div>
  <label for="hotel" class="block text-gray-700 dark:text-gray-300 mb-2">
    Hotel Preference
  </label>
  <select
    id="hotel"
    name="hotel"
    required
    class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
  >
    <option value="" disabled selected>Select your accommodation</option>

    <optgroup label="Hotels">
      <option value="luxury">Luxury Hotel</option>
      <option value="budget">Budget Hotel</option>
      <option value="boutique">Boutique Hotel</option>
    </optgroup>

    <optgroup label="Other Accommodations">
      <option value="dormitory">Dormitory</option>
      <option value="hostel">Hostel</option>
    </optgroup>
  </select>
</div>

                    
                    <!-- Special Requests -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300" for="req">Special Requests</label>
                        <textarea placeholder="Any special requests?" name="req" class="w-full px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white h-24"></textarea>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" name="btn" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-3 rounded-lg shadow-lg transition">
                            Submit Registration
                        </button>
                    </div>
                </form>
            </div>
        <?php endif; ?>
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
    </script>
</body>
</html>