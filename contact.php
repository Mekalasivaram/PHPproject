<?php
session_start();
include 'connection.php';

$loggedIn = isset($_SESSION['user']);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Make sure path is correct if using Composer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $message = htmlspecialchars($_POST['message'] ?? '');

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'mekalasivaram19@gmail.com'; // Your Gmail ID
        $mail->Password = 'nnwa hhfj tovv eodn'; // ⚠️ Use App Password, not your Gmail password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        //Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('mekalasivaram19@gmail.com'); // Your own email where you want to receive the message

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Us Message';
        $mail->Body    = "
            <h3>Contact Form Submission</h3>
            <p><b>Name:</b> {$name}</p>
            <p><b>Email:</b> {$email}</p>
            <p><b>Message:</b><br>{$message}</p>
        ";

        $mail->send();
        echo "<script>alert('We have received your message. We will connect with you soon!'); window.location.href='contact.php';</script>";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>



<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - wanderlust</title>
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
<div class="fixed inset-0 bg-cover bg-center bg-no-repeat -z-10" style="background-image: url('images/contactus.jpg');"></div>
<div class="fixed inset-0 bg-black bg-opacity-40 -z-10"></div>

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
             <a href="contact.php" class="border-b-2 border-primary">Contact us</a>

             
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
        <h2 class="text-center text-4xl font-bold mb-8" style="font-family: 'Playfair Display', serif;">Contact Us</h2>

        <div class="max-w-3xl mx-auto grid grid-cols-1 gap-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h3 class="text-2xl font-semibold mb-4" style="font-family: 'Playfair Display', serif;">Send us a Message</h3>
                <form id="contact-form" method="post" action="contact.php">
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Name:</label>
                        <input type="text" id="name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:bg-gray-700 dark:text-white leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Email:</label>
                        <input type="email" id="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:bg-gray-700 dark:text-white leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                        <label for="message" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Message:</label>
                        <textarea id="message" rows="5" name="message" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:bg-gray-700 dark:text-white leading-tight focus:outline-none focus:shadow-outline" required></textarea>
                    </div>
                    <input type="submit" value="submit" name="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                </form>
            </div>

           

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

    <script>
    document.getElementById("theme-toggle").addEventListener("click", function() {
        document.documentElement.classList.toggle("light");
    });
    
    // Remove the preventDefault() to allow the form to submit
    document.getElementById("mobile-menu-button").addEventListener("click", function() {
        document.getElementById("mobile-menu").classList.toggle("hidden");
    });
</script>
    

</body>
</html>