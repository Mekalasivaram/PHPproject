<?php
session_start();
include 'connection.php';

$loggedIn = isset($_SESSION['user']);

if (isset($_POST['btn'])) {
    if (!$loggedIn) {
        echo "<script>alert('Please log in before submitting the form.'); window.location.href='login.php';</script>";
        exit();
    }

    function clean_input($data) {
        global $con;
        return mysqli_real_escape_string($con, htmlspecialchars(strip_tags(trim($data))));
    }

    $name = clean_input($_POST['name']);
    $destination = clean_input($_POST['destination-visited']);
    $review = clean_input($_POST['review-text']);
    $rating = intval($_POST['rating']);

    if ($name && $review && $rating > 0) {
        $stmt = $con->prepare("INSERT INTO reviews (name, destination, review, rating, created_at) VALUES (?, ?, ?, ?, NOW())");
        $stmt->bind_param("sssi", $name, $destination, $review, $rating);

        if ($stmt->execute()) {
            echo "<script>alert('Review submitted successfully!');</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Invalid input. All required fields must be filled.');</script>";
    }
}

// Don't close the connection here - leave it open for the page
?>

<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimonials - Travel & Tourism</title>
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
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100" style="font-family: 'Inter', sans-serif;">
    
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
             <a href="review.php" class="border-b-2 border-primary">Testimonials</a>
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

    <section class="py-16 px-6 md:px-12">
        <h2 class="text-center text-4xl font-bold mb-8" style="font-family: 'Playfair Display', serif;">What Our Customers Say</h2>

        <div class="max-w-3xl mx-auto mb-12 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
            <h3 class="text-2xl font-semibold mb-4 text-center" style="font-family: 'Playfair Display', serif;">Leave Your Review</h3>
            <form id="review-form" action="review.php" method="post">

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Your Name:</label>
                    <input type="text" id="name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:bg-gray-700 dark:text-white leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label for="destination-visited" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Destination Visited:</label>
                    <input type="text" id="destination-visited" name="destination-visited" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:bg-gray-700 dark:text-white leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="review-text" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Your Review:</label>
                    <textarea id="review-text" name="review-text" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:bg-gray-700 dark:text-white leading-tight focus:outline-none focus:shadow-outline" required></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Rating:</label>
                    <div class="flex space-x-2">
  <input type="radio" name="rating" value="1" id="rating-1" class="hidden" />
  <label for="rating-1" class="text-4xl text-gray-400 cursor-pointer hover:text-yellow-400 transition-colors duration-200">★</label>

  <input type="radio" name="rating" value="2" id="rating-2" class="hidden" />
  <label for="rating-2" class="text-4xl text-gray-400 cursor-pointer hover:text-yellow-400 transition-colors duration-200">★</label>

  <input type="radio" name="rating" value="3" id="rating-3" class="hidden" />
  <label for="rating-3" class="text-4xl text-gray-400 cursor-pointer hover:text-yellow-400 transition-colors duration-200">★</label>

  <input type="radio" name="rating" value="4" id="rating-4" class="hidden" />
  <label for="rating-4" class="text-4xl text-gray-400 cursor-pointer hover:text-yellow-400 transition-colors duration-200">★</label>

  <input type="radio" name="rating" value="5" id="rating-5" class="hidden" />
  <label for="rating-5" class="text-4xl text-gray-400 cursor-pointer hover:text-yellow-400 transition-colors duration-200">★</label>
</div>

<script>
  const starInputs = document.querySelectorAll('input[name="rating"]');

  function paint(rating) {
    starInputs.forEach(s => {
      const lbl = document.querySelector(`label[for="${s.id}"]`);
      if (+s.value <= rating) {
        lbl.classList.add('text-yellow-400');
        lbl.classList.remove('text-gray-400');
      } else {
        lbl.classList.add('text-gray-400');
        lbl.classList.remove('text-yellow-400');
      }
    });
  }

  // on click/change
  starInputs.forEach(input => {
    input.addEventListener('change', () => {
      paint(+input.value);
    });
  });

  // initialize in case you have a default checked
  document.addEventListener('DOMContentLoaded', () => {
    const checked = document.querySelector('input[name="rating"]:checked');
    if (checked) paint(+checked.value);
  });
</script>


                </div>
                <button type="submit" name="btn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Submit Review
                </button>
            </form>
        </div>

        <h2 class="text-center text-3xl font-bold mb-8" style="font-family: 'Playfair Display', serif;">Customer Reviews</h2>
        <div id="customer-reviews" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <?php
            // Display actual reviews from the database
            $query = "SELECT * FROM reviews ORDER BY created_at DESC LIMIT 9";
            $result = mysqli_query($con, $query);
            
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">';
                    echo '<div class="flex items-center mb-4">';
                    echo '<div class="w-12 h-12 rounded-full bg-gray-300 dark:bg-gray-700 flex items-center justify-center">';
                    echo '<i class="fas fa-user text-gray-500 dark:text-gray-400 text-xl"></i>';
                    echo '</div>';
                    echo '<div class="ml-3">';
                    echo '<h4 class="text-lg font-semibold">' . htmlspecialchars($row['name']) . '</h4>';
                    if (!empty($row['destination'])) {
                        echo '<p class="text-sm text-gray-500 dark:text-gray-400">Visited ' . htmlspecialchars($row['destination']) . '</p>';
                    }
                    echo '</div>';
                    echo '</div>';
                    echo '<p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">' . htmlspecialchars($row['review']) . '</p>';
                    echo '<div class="text-yellow-500">';
                    for ($i = 0; $i < $row['rating']; $i++) {
                        echo '<i class="fas fa-star"></i>';
                    }
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                // If no reviews in database, show sample reviews
                $initialReviews = [
                    ['name' => "Alice Johnson", 'destination' => "Paris", 'review' => "The Paris trip was fantastic!", 'rating' => 5],
                    ['name' => "Bob Williams", 'destination' => "Maldives", 'review' => "Maldives was a dream!", 'rating' => 4],
                    ['name' => "Charlie Brown", 'destination' => "Tokyo", 'review' => "Enjoyed exploring Tokyo.", 'rating' => 3],
                ];
                
                foreach ($initialReviews as $review) {
                    echo '<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">';
                    echo '<div class="flex items-center mb-4">';
                    echo '<div class="w-12 h-12 rounded-full bg-gray-300 dark:bg-gray-700 flex items-center justify-center">';
                    echo '<i class="fas fa-user text-gray-500 dark:text-gray-400 text-xl"></i>';
                    echo '</div>';
                    echo '<div class="ml-3">';
                    echo '<h4 class="text-lg font-semibold">' . htmlspecialchars($review['name']) . '</h4>';
                    echo '<p class="text-sm text-gray-500 dark:text-gray-400">Visited ' . htmlspecialchars($review['destination']) . '</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '<p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">' . htmlspecialchars($review['review']) . '</p>';
                    echo '<div class="text-yellow-500">';
                    for ($i = 0; $i < $review['rating']; $i++) {
                        echo '<i class="fas fa-star"></i>';
                    }
                    echo '</div>';
                    echo '</div>';
                }
            }
            
            // Now we can close the connection
            mysqli_close($con);
            ?>
        </div>
    </section>

    <footer class="bg-gray-800 text-white p-4 text-center">
        <p>&copy; 2025 Travel & Tourism. All rights reserved.</p>
    </footer>

    <script>
        document.getElementById("theme-toggle").addEventListener("click", function() {
            document.documentElement.classList.toggle("light");
        });
        
        document.getElementById("mobile-menu-button").addEventListener("click", function() {
            document.getElementById("mobile-menu").classList.toggle("hidden");
        });
        
        // Remove the JavaScript event listener that prevents form submission
        // as we're already handling the form with PHP
    </script>
</body>
</html>