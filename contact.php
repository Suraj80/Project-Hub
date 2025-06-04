<?php
// Database configuration
$servername = "localhost";
$username = "suraj";
$password = "Suraj@123";
$dbname = "project_hub";

$message = "";
$messageType = "";

// Handle form submission
if ($_POST) {
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Validate and sanitize input
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $subject = trim($_POST['subject']);
        $user_message = trim($_POST['message']);
        
        // Basic validation
        if (empty($name) || empty($email) || empty($subject) || empty($user_message)) {
            throw new Exception("All fields are required.");
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Please enter a valid email address.");
        }
        
        // Insert into database
        $stmt = $conn->prepare("INSERT INTO feedback (name, email, subject, message, created_at) VALUES (?, ?, ?, ?, NOW())");
        $stmt->execute([$name, $email, $subject, $user_message]);
        
        $message = "Thank you! Your message has been sent successfully.";
        $messageType = "success";
        
        // Clear form data after successful submission
        $_POST = array();
        
    } catch(Exception $e) {
        $message = "Error: " . $e->getMessage();
        $messageType = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="" />
    <link
      rel="stylesheet"
      as="style"
      onload="this.rel='stylesheet'"
      href="https://fonts.googleapis.com/css2?display=swap&amp;family=Noto+Sans%3Awght%40400%3B500%3B700%3B900&amp;family=Space+Grotesk%3Awght%40400%3B500%3B700"
    />
    <title>Contact Us - Stitch Design</title>
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64," />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <style>
        .success-message {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }
        .error-message {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="relative flex size-full min-h-screen flex-col bg-slate-50 group/design-root overflow-x-hidden" style='font-family: "Space Grotesk", "Noto Sans", sans-serif;'>
        <div class="layout-container flex h-full grow flex-col">
            
            <?php include 'header.php'; ?>

            <!-- Main Content -->
            <div class="flex-1 px-4 sm:px-6 lg:px-8 py-6 lg:py-10">
                <div class="max-w-4xl mx-auto">
                    <!-- Header Section -->
                    <div class="text-center mb-8 lg:mb-12">
                        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-[#0d141c] mb-4">Get in Touch</h1>
                        <p class="text-[#49739c] text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">
                            We're here to help! Whether you have questions about our projects, need assistance, or just want to chat about coding, feel free to reach out. We'll get back to you as soon as possible.
                        </p>
                    </div>

                    <!-- Success/Error Message -->
                    <?php if ($message): ?>
                    <div class="mb-6 p-4 rounded-lg border <?php echo $messageType === 'success' ? 'success-message' : 'error-message'; ?>">
                        <?php echo htmlspecialchars($message); ?>
                    </div>
                    <?php endif; ?>

                    <div class="grid lg:grid-cols-2 gap-8 lg:gap-12">
                        <!-- Contact Form -->
                        <div class="order-2 lg:order-1">
                            <form method="POST" class="space-y-6">
                                <div>
                                    <label for="name" class="block text-[#0d141c] text-sm sm:text-base font-medium mb-2">
                                        Name *
                                    </label>
                                    <input
                                        type="text"
                                        id="name"
                                        name="name"
                                        required
                                        placeholder="Your Name"
                                        value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>"
                                        class="w-full h-12 sm:h-14 px-4 rounded-lg border border-[#cedbe8] bg-slate-50 text-[#0d141c] placeholder:text-[#49739c] focus:outline-none focus:ring-2 focus:ring-[#0c7ff2] focus:border-transparent text-sm sm:text-base"
                                    />
                                </div>

                                <div>
                                    <label for="email" class="block text-[#0d141c] text-sm sm:text-base font-medium mb-2">
                                        Email *
                                    </label>
                                    <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        required
                                        placeholder="Your Email"
                                        value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
                                        class="w-full h-12 sm:h-14 px-4 rounded-lg border border-[#cedbe8] bg-slate-50 text-[#0d141c] placeholder:text-[#49739c] focus:outline-none focus:ring-2 focus:ring-[#0c7ff2] focus:border-transparent text-sm sm:text-base"
                                    />
                                </div>

                                <div>
                                    <label for="subject" class="block text-[#0d141c] text-sm sm:text-base font-medium mb-2">
                                        Subject *
                                    </label>
                                    <input
                                        type="text"
                                        id="subject"
                                        name="subject"
                                        required
                                        placeholder="Subject"
                                        value="<?php echo isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : ''; ?>"
                                        class="w-full h-12 sm:h-14 px-4 rounded-lg border border-[#cedbe8] bg-slate-50 text-[#0d141c] placeholder:text-[#49739c] focus:outline-none focus:ring-2 focus:ring-[#0c7ff2] focus:border-transparent text-sm sm:text-base"
                                    />
                                </div>

                                <div>
                                    <label for="message" class="block text-[#0d141c] text-sm sm:text-base font-medium mb-2">
                                        Message *
                                    </label>
                                    <textarea
                                        id="message"
                                        name="message"
                                        required
                                        rows="6"
                                        placeholder="Your Message"
                                        class="w-full px-4 py-3 rounded-lg border border-[#cedbe8] bg-slate-50 text-[#0d141c] placeholder:text-[#49739c] focus:outline-none focus:ring-2 focus:ring-[#0c7ff2] focus:border-transparent resize-vertical min-h-[120px] text-sm sm:text-base"
                                    ><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
                                </div>

                                <button
                                    type="submit"
                                    class="w-full sm:w-auto px-8 py-3 bg-[#0c7ff2] text-white font-bold text-sm sm:text-base rounded-lg hover:bg-[#0b6fd1] transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#0c7ff2] focus:ring-offset-2"
                                >
                                    Send Message
                                </button>
                            </form>
                        </div>

                        <!-- Contact Information -->
                        <div class="order-1 lg:order-2">
                            <div class="bg-white rounded-lg p-6 sm:p-8 shadow-sm border border-[#e7edf4]">
                                <h2 class="text-xl sm:text-2xl font-bold text-[#0d141c] mb-6">Contact Information</h2>
                                
                                <div class="space-y-4 mb-8">
                                    <div class="flex items-center gap-3">
                                        <div class="w-5 h-5 text-[#0c7ff2]">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <span class="text-[#0d141c] text-sm sm:text-base">support@codecraft.com</span>
                                    </div>
                                    
                                    <div class="flex items-center gap-3">
                                        <div class="w-5 h-5 text-[#0c7ff2]">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                            </svg>
                                        </div>
                                        <span class="text-[#0d141c] text-sm sm:text-base">(555) 123-4567</span>
                                    </div>
                                </div>

                                <div class="mb-6">
                                    <h3 class="text-[#0d141c] font-semibold mb-4 text-sm sm:text-base">Follow us on social media:</h3>
                                    <div class="flex gap-4">
                                        <a href="#" class="flex flex-col items-center gap-2 p-3 rounded-lg bg-[#e7edf4] hover:bg-[#cedbe8] transition-colors duration-200">
                                            <div class="text-[#0d141c] w-5 h-5">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                                    <path d="M247.39,68.94A8,8,0,0,0,240,64H209.57A48.66,48.66,0,0,0,168.1,40a46.91,46.91,0,0,0-33.75,13.7A47.9,47.9,0,0,0,120,88v6.09C79.74,83.47,46.81,50.72,46.46,50.37a8,8,0,0,0-13.65,4.92c-4.31,47.79,9.57,79.77,22,98.18a110.93,110.93,0,0,0,21.88,24.2c-15.23,17.53-39.21,26.74-39.47,26.84a8,8,0,0,0-3.85,11.93c.75,1.12,3.75,5.05,11.08,8.72C53.51,229.7,65.48,232,80,232c70.67,0,129.72-54.42,135.75-124.44l29.91-29.9A8,8,0,0,0,247.39,68.94Zm-45,29.41a8,8,0,0,0-2.32,5.14C196,166.58,143.28,216,80,216c-10.56,0-18-1.4-23.22-3.08,11.51-6.25,27.56-17,37.88-32.48A8,8,0,0,0,92,169.08c-.47-.27-43.91-26.34-44-96,16,13,45.25,33.17,78.67,38.79A8,8,0,0,0,136,104V88a32,32,0,0,1,9.6-22.92A30.94,30.94,0,0,1,167.9,56c12.66.16,24.49,7.88,29.44,19.21A8,8,0,0,0,204.67,80h16Z"></path>
                                                </svg>
                                            </div>
                                            <span class="text-[#0d141c] text-xs font-medium">Twitter</span>
                                        </a>
                                        
                                        <a href="#" class="flex flex-col items-center gap-2 p-3 rounded-lg bg-[#e7edf4] hover:bg-[#cedbe8] transition-colors duration-200">
                                            <div class="text-[#0d141c] w-5 h-5">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                                    <path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm8,191.63V152h24a8,8,0,0,0,0-16H136V112a16,16,0,0,1,16-16h16a8,8,0,0,0,0-16H152a32,32,0,0,0-32,32v24H96a8,8,0,0,0,0,16h24v63.63a88,88,0,1,1,16,0Z"></path>
                                                </svg>
                                            </div>
                                            <span class="text-[#0d141c] text-xs font-medium">Facebook</span>
                                        </a>
                                        
                                        <a href="#" class="flex flex-col items-center gap-2 p-3 rounded-lg bg-[#e7edf4] hover:bg-[#cedbe8] transition-colors duration-200">
                                            <div class="text-[#0d141c] w-5 h-5">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                                    <path d="M128,80a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160ZM176,24H80A56.06,56.06,0,0,0,24,80v96a56.06,56.06,0,0,0,56,56h96a56.06,56.06,0,0,0,56-56V80A56.06,56.06,0,0,0,176,24Zm40,152a40,40,0,0,1-40,40H80a40,40,0,0,1-40-40V80A40,40,0,0,1,80,40h96a40,40,0,0,1,40,40ZM192,76a12,12,0,1,1-12-12A12,12,0,0,1,192,76Z"></path>
                                                </svg>
                                            </div>
                                            <span class="text-[#0d141c] text-xs font-medium">Instagram</span>
                                        </a>
                                    </div>
                                </div>

                                <!-- Map Section -->
                                <!-- <div class="mt-6">
                                    <h3 class="text-[#0d141c] font-semibold mb-3 text-sm sm:text-base">Our Location</h3>
                                    <div class="w-full h-48 sm:h-56 bg-center bg-no-repeat bg-cover rounded-lg" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuA7KZ0qFgKIRUBsiu4gkcWFgAB5slK_po8Sno9-HZC3sezThLk71Lm5yvP-AwmlF4Rv_r0knuvQ6ac5qyDf3U03Bg6w1shyDumYVOBUHPLq9U6GeUdVRS9JoHTsbscuIZmDoEsKT33oDug-sV-EDXnOJQ75nYsmRoMTQMISvZP0r1qzMKaW3NonJlalHmgRItxM8gxI9WT3pm_fllmH3jtUtS1TKF8M3uXl10pBrvc7j6Om42qqKW46Af_5m4hZUCLqi2-hxLtnNTY");'></div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include 'footer.php'; ?>
        </div>
    </div>

    <script>
        // Add some interactivity for better UX
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const inputs = form.querySelectorAll('input, textarea');
            
            // Add focus effects
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('focused');
                });
            });
            
            // Auto-hide success/error messages after 5 seconds
            const message = document.querySelector('.success-message, .error-message');
            if (message) {
                setTimeout(() => {
                    message.style.opacity = '0';
                    setTimeout(() => {
                        message.remove();
                    }, 300);
                }, 5000);
            }
        });
    </script>
</body>
</html>

<?php
/*
SQL to create the feedback table:

CREATE TABLE feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(500) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('new', 'read', 'replied') DEFAULT 'new'
);
*/
?>