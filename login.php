<?php
ob_start(); 
session_start();
require_once 'connection.php';

// Add PHPMailer imports
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// PHPMailer autoload file
require 'vendor/autoload.php';

// Initialize variables to store messages
$message = "";
$messageType = "";

// Check if it's a password reset request
if (isset($_GET['action']) && $_GET['action'] === 'reset' && isset($_GET['token'])) {
    $token = $_GET['token'];
    // Show password reset form
    $resetForm = true;
    $loginForm = false;
} else {
    $resetForm = false;
    $loginForm = true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? ''; 
    
    if ($action === 'forgot_password') {
        $email = $_POST['email'] ?? '';
        
        if (empty($email)) {
            $message = "Please enter your email";
            $messageType = "error";
        } else {
            // Check if email exists
            $stmt = $con->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                // Generate token
                $token = bin2hex(random_bytes(32));
                $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
                
                // Store token in database
                $updateStmt = $con->prepare("UPDATE users SET reset_token = ?, reset_token_expiry = ? WHERE email = ?");
                if (!$updateStmt) {
                    die("Prepare failed: (" . $con->errno . ") " . $con->error);
                }
                $updateStmt->bind_param("sss", $token, $expiry, $email);
                 
                if ($updateStmt->execute()) {
                    // Send email with PHPMailer
                    $mail = new PHPMailer(true);
                    
                    try {
                        // Server settings
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'mekalasivaram19@gmail.com';
                        $mail->Password = 'nnwa hhfj tovv eodn'; // Use App Password, not your regular password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port = 587;
                        
                        // Recipients
                        $mail->setFrom('mekalasivaram19@gmail.com', 'Travel Website');
                        $mail->addAddress($email);
                        
                        // Content
                        $mail->isHTML(true);
                        $mail->Subject = 'Password Reset Request';
                        
                        // Create reset link with full URL
                        $resetLink = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') 
                                    . "://$_SERVER[HTTP_HOST]" 
                                    . dirname($_SERVER['PHP_SELF']) 
                                    . "/login.php?action=reset&token=$token";
                        
                        $mail->Body = '
                            <html>
                            <head>
                                <style>
                                    body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                                    .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                                    .header { background-color: #f8f9fa; padding: 20px; text-align: center; }
                                    .content { padding: 20px; }
                                    .button { display: inline-block; background-color: #ff6b00; color: white; 
                                             padding: 10px 20px; text-decoration: none; border-radius: 5px; }
                                    .footer { margin-top: 20px; font-size: 12px; color: #777; }
                                </style>
                            </head>
                            <body>
                                <div class="container">
                                    <div class="header">
                                        <h2>Password Reset Request</h2>
                                    </div>
                                    <div class="content">
                                        <p>Hello,</p>
                                        <p>We received a request to reset your password. Click the button below to reset it:</p>
                                        <p style="text-align: center;">
                                            <a href="' . $resetLink . '" class="button">Reset Your Password</a>
                                        </p>
                                        <p>If you did not request a password reset, please ignore this email or contact support.</p>
                                        <p>This link will expire in 1 hour.</p>
                                    </div>
                                    <div class="footer">
                                        <p>This is an automated message, please do not reply to this email.</p>
                                    </div>
                                </div>
                            </body>
                            </html>
                        ';
                        
                        // Plain text version for non-HTML mail clients
                        $mail->AltBody = "Hello,\n\nWe received a request to reset your password. Please click the link below to reset it:\n\n$resetLink\n\nIf you did not request a password reset, please ignore this email or contact support.\n\nThis link will expire in 1 hour.";
                        
                        $mail->send();
                        $message = "Password reset link has been sent to your email.";
                        $messageType = "success";
                    } catch (Exception $e) {
                        $message = "Error sending email: {$mail->ErrorInfo}";
                        $messageType = "error";
                    }
                } else {
                    $message = "Error generating reset token. Please try again.";
                    $messageType = "error";
                }
            } else {
                // Don't reveal if email exists or not for security
                $message = "If your email is registered, you will receive a password reset link.";
                $messageType = "success";
            }
        }
    } else if ($action === 'reset_password') {
        $token = $_POST['token'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';
        
        if (empty($password) || empty($confirm_password)) {
            $message = "All fields are required";
            $messageType = "error";
            $resetForm = true;
        } else if ($password !== $confirm_password) {
            $message = "Passwords do not match";
            $messageType = "error";
            $resetForm = true;
        } else {
            // Verify token is valid and not expired
            $now = date('Y-m-d H:i:s');
            $stmt = $con->prepare("SELECT * FROM users WHERE reset_token = ? AND reset_token_expiry > ?");
            $stmt->bind_param("ss", $token, $now);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($user = $result->fetch_assoc()) {
                // Update password
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $updateStmt = $con->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_token_expiry = NULL WHERE id = ?");
                $updateStmt->bind_param("si", $hashedPassword, $user['id']);
                
                if ($updateStmt->execute()) {
                    // Send confirmation email that password was reset
                    $mail = new PHPMailer(true);
                    try {
                        // Server settings
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'tanvi2004.14@gmail.com';
                        $mail->Password = 'your_app_password'; // Use App Password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port = 587;
                        
                        // Recipients
                        $mail->setFrom('tanvi2004.14@gmail.com', 'Travel Website');
                        $mail->addAddress($user['email']);
                        
                        // Content
                        $mail->isHTML(true);
                        $mail->Subject = 'Password Reset Successful';
                        $mail->Body = '
                            <html>
                            <head>
                                <style>
                                    body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                                    .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                                    .header { background-color: #f8f9fa; padding: 20px; text-align: center; }
                                    .content { padding: 20px; }
                                    .footer { margin-top: 20px; font-size: 12px; color: #777; }
                                </style>
                            </head>
                            <body>
                                <div class="container">
                                    <div class="header">
                                        <h2>Password Reset Successful</h2>
                                    </div>
                                    <div class="content">
                                        <p>Hello,</p>
                                        <p>Your password has been successfully reset.</p>
                                        <p>If you did not request this change, please contact us immediately as your account may be compromised.</p>
                                    </div>
                                    <div class="footer">
                                        <p>This is an automated message, please do not reply to this email.</p>
                                    </div>
                                </div>
                            </body>
                            </html>
                        ';
                        $mail->AltBody = "Hello,\n\nYour password has been successfully reset.\n\nIf you did not request this change, please contact us immediately as your account may be compromised.";
                        
                        $mail->send();
                    } catch (Exception $e) {
                        // Just log the error, don't show to user since password reset was successful
                        error_log("Error sending confirmation email: {$mail->ErrorInfo}");
                    }
                    
                    $message = "Password has been updated successfully. You can now login.";
                    $messageType = "success";
                    $resetForm = false;
                } else {
                    $message = "Error updating password. Please try again.";
                    $messageType = "error";
                    $resetForm = true;
                }
            } else {
                $message = "Invalid or expired reset token. Please request a new password reset.";
                $messageType = "error";
                $resetForm = false;
            }
        }
    } else if ($action === 'login') {
        // Your existing login code
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        if (empty($email) || empty($password)) {
            $message = "All fields are required";
            $messageType = "error";
        } else {
            $stmt = $con->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($user = $result->fetch_assoc()) {
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user'] = $user['full_name'];
                    $_SESSION['user_id'] = $user['id'];
                    header("Location: index.php");
                    exit;
                } else {
                    $message = "Invalid password.";
                    $messageType = "error";
                }
            } else {
                $message = "User not found. Please sign up first.";
                $messageType = "error";
            }
        }
    } else if ($action === 'signup') {
        // Your existing signup code
        $full_name = $_POST['full_name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        if (empty($full_name) || empty($email) || empty($password)) {
            $message = "All fields are required";
            $messageType = "error";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Check if email already exists
            $check = $con->prepare("SELECT * FROM users WHERE email = ?");
            $check->bind_param("s", $email);
            $check->execute();
            $check->store_result();

            if ($check->num_rows > 0) {
                $message = "Email already registered.";
                $messageType = "error";
            } else {
                $stmt = $con->prepare("INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $full_name, $email, $hashedPassword);
                if ($stmt->execute()) {
                    $message = "Signup successful. Please login.";
                    $messageType = "success";
                } else {
                    $message = "Signup failed. Please try again.";
                    $messageType = "error";
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Login & Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            font-size: 1.5em;
            color: #888;
        }
        .close-button:hover {
            color: #333;
        }
        .message {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .error {
            background-color: #FECACA;
            color: #991B1B;
        }
        .success {
            background-color: #D1FAE5;
            color: #065F46;
        }
    </style>
    <script defer src="dark-mode.js"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-4xl bg-white dark:bg-gray-800 rounded-lg shadow-lg flex overflow-hidden relative">
        <div class="hidden md:flex w-1/2 bg-gray-200 dark:bg-gray-700 relative">
            <div class="absolute inset-0 flex items-center justify-center">
                <h2 class="text-white text-2xl font-semibold text-center px-6" style="font-family: 'Playfair Display', serif;">
                    Discover New Places 🌍 <br> Travel Beyond Limits!
                </h2>
            </div>
            <img src="images/log1.jpg" id="carousel-img" class="w-full h-full object-cover opacity-70">
        </div>

        <div class="w-full md:w-1/2 p-8 text-center">
            <a href="index.php" class="close-button">&times;</a>
            
            <?php if ($resetForm): ?>
                <!-- Password Reset Form -->
                <h2 class="text-3xl font-semibold text-gray-900 dark:text-white" style="font-family: 'Playfair Display', serif;">
                    Reset Password
                </h2>
                <div class="w-16 border-t-2 border-orange-500 mx-auto my-4"></div>
                
                <?php if (!empty($message)): ?>
                    <div class="message <?php echo $messageType; ?>">
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="login.php">
                    <input type="hidden" name="action" value="reset_password">
                    <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
                    
                    <input type="password" name="password" placeholder="New Password" required class="w-full p-3 mt-3 bg-gray-200 dark:bg-gray-700 rounded-lg text-gray-900 dark:text-white focus:outline-none">
                    <input type="password" name="confirm_password" placeholder="Confirm New Password" required class="w-full p-3 mt-3 bg-gray-200 dark:bg-gray-700 rounded-lg text-gray-900 dark:text-white focus:outline-none">
                    
                    <button type="submit" class="mt-6 w-full bg-gray-900 dark:bg-gray-600 text-white py-3 rounded-lg font-semibold hover:bg-gray-700 dark:hover:bg-gray-500 transition">
                        Reset Password
                    </button>
                </form>
                
                <p class="text-gray-600 dark:text-gray-300 mt-4">
                    Remember your password? <a href="login.php" class="text-orange-500 font-semibold hover:underline">Back to Login</a>
                </p>
                
            <?php elseif (isset($_GET['action']) && $_GET['action'] === 'forgot'): ?>
                <!-- Forgot Password Form -->
                <h2 class="text-3xl font-semibold text-gray-900 dark:text-white" style="font-family: 'Playfair Display', serif;">
                    Forgot Password
                </h2>
                <div class="w-16 border-t-2 border-orange-500 mx-auto my-4"></div>
                
                <?php if (!empty($message)): ?>
                    <div class="message <?php echo $messageType; ?>">
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="login.php?action=forgot">
                    <input type="hidden" name="action" value="forgot_password">
                    
                    <input type="email" name="email" placeholder="Your Email" required class="w-full p-3 mt-3 bg-gray-200 dark:bg-gray-700 rounded-lg text-gray-900 dark:text-white focus:outline-none">
                    
                    <button type="submit" class="mt-6 w-full bg-gray-900 dark:bg-gray-600 text-white py-3 rounded-lg font-semibold hover:bg-gray-700 dark:hover:bg-gray-500 transition">
                        Send Reset Link
                    </button>
                </form>
                
                <p class="text-gray-600 dark:text-gray-300 mt-4">
                    Remember your password? <a href="login.php" class="text-orange-500 font-semibold hover:underline">Back to Login</a>
                </p>
                
            <?php else: ?>
                <!-- Login / Signup Form -->
                <h2 class="text-3xl font-semibold text-gray-900 dark:text-white" style="font-family: 'Playfair Display', serif;" id="form-title">
                    Login
                </h2>
                <div class="w-16 border-t-2 border-orange-500 mx-auto my-4"></div>
                
                <?php if (!empty($message)): ?>
                    <div class="message <?php echo $messageType; ?>">
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>

                <form id="auth-form" method="POST" action="login.php">
                    <input type="hidden" name="action" id="form-action" value="login">
                    
                    <div id="full-name-field" class="hidden">
                        <input type="text" name="full_name" placeholder="Full Name" class="w-full p-3 mt-3 bg-gray-200 dark:bg-gray-700 rounded-lg text-gray-900 dark:text-white focus:outline-none">
                    </div>
                    
                    <input type="email" name="email" placeholder="Email" required class="w-full p-3 mt-3 bg-gray-200 dark:bg-gray-700 rounded-lg text-gray-900 dark:text-white focus:outline-none">
                    <input type="password" name="password" placeholder="Password" required class="w-full p-3 mt-3 bg-gray-200 dark:bg-gray-700 rounded-lg text-gray-900 dark:text-white focus:outline-none">
                    
                    <!-- Added Forgot Password Link -->
                    <div class="text-right mt-2">
                        <a href="login.php?action=forgot" class="text-sm text-gray-600 dark:text-gray-400 hover:text-orange-500">
                            Forgot Password?
                        </a>
                    </div>
                    
                    <button type="submit" class="mt-4 w-full bg-gray-900 dark:bg-gray-600 text-white py-3 rounded-lg font-semibold hover:bg-gray-700 dark:hover:bg-gray-500 transition">
                        Login
                    </button>
                </form>

                <p class="text-gray-600 dark:text-gray-300 mt-4">
                    <span id="toggle-text">Don't have an account?</span> 
                    <button onclick="toggleForm()" class="text-orange-500 font-semibold hover:underline" id="toggle-button">
                        Sign up
                    </button>
                </p>
            <?php endif; ?>
        </div>
    </div>
    
    <script>
        let isLogin = true;
        let images = ["images/log.jpg", "images/log2.jpg", "images/paris2.jpg"];
        let currentIndex = 0;
        
        function toggleForm() { 
            isLogin = !isLogin;
            document.getElementById("form-title").textContent = isLogin ? "Login" : "Sign Up";
            document.getElementById("form-action").value = isLogin ? "login" : "signup";
            document.getElementById("toggle-text").textContent = isLogin ? "Don't have an account?" : "Already have an account?";
            document.getElementById("toggle-button").textContent = isLogin ? "Sign up" : "Log in";
            
            // Toggle full name field visibility
            const fullNameField = document.getElementById("full-name-field");
            if (isLogin) {
                fullNameField.classList.add("hidden");
                fullNameField.querySelector("input").removeAttribute("required");
            } else {
                fullNameField.classList.remove("hidden");
                fullNameField.querySelector("input").setAttribute("required", "");
            }
            
            // Update submit button text
            const submitButton = document.querySelector("button[type=submit]");
            submitButton.textContent = isLogin ? "Login" : "Sign Up";
        }
        
        function changeImage() {
            currentIndex = (currentIndex + 1) % images.length;
            document.getElementById("carousel-img").src = images[currentIndex];
        }
        
        setInterval(changeImage, 3000);
        
        // If there's a theme toggle button
        const themeToggle = document.getElementById("theme-toggle");
        if (themeToggle) {
            themeToggle.addEventListener("click", function() {
                document.documentElement.classList.toggle("dark");
            });
        }
    </script>
</body>
</html>