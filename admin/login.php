<?php include('../config/constants.php');
//session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);


// PHP Login Logic - Preserved from original file
if (isset($_POST['submit'])) {
    // Get form data with proper sanitization
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $password = md5($_POST['password']);

    // Query to check credentials
    $sql = "SELECT * FROM admin WHERE user_name='$user_name' AND password='$password'";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        // Login successful
        $_SESSION['login'] = "<div class='green'> Login Successful! </div>";
        $_SESSION['user'] = $user_name;
        header('location:' . SITEURL . 'admin/');
    } else {
        // Login failed
        $_SESSION['login'] = "<div class='red text-center'> Username and Password Didn't Match! </div>";
        header('location:' . SITEURL . 'admin/login.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Admin Login - Ki Khabo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom animations and styles */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }
        
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        .fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }
        
        .login-container {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }
        
        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(251, 146, 60, 0.3);
            border-color: #fb923c;
        }
        
        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(251, 146, 60, 0.4);
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #fed7aa 0%, #fdba74 25%, #fb923c 50%, #ea580c 75%, #c2410c 100%);
        }
        
        .nav-indicator {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Floating shapes */
        .shape {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(45deg, rgba(251, 146, 60, 0.1), rgba(234, 88, 12, 0.1));
            animation: float 8s ease-in-out infinite;
        }
        
        .shape-1 {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }
        
        .shape-2 {
            width: 120px;
            height: 120px;
            top: 70%;
            right: 10%;
            animation-delay: 2s;
        }
        
        .shape-3 {
            width: 60px;
            height: 60px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        /* Message styles */
        .green {
            background-color: #d4edda;
            color: #155724;
            padding: 12px 16px;
            border-radius: 8px;
            border: 1px solid #c3e6cb;
            margin-bottom: 16px;
            animation: fadeInUp 0.5s ease-out;
        }
        
        .red {
            background-color: #f8d7da;
            color: #721c24;
            padding: 12px 16px;
            border-radius: 8px;
            border: 1px solid #f5c6cb;
            margin-bottom: 16px;
            animation: fadeInUp 0.5s ease-out;
        }
    </style>
</head>
<body class="min-h-screen gradient-bg relative py-6">
    <!-- Floating background shapes -->
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>
    
    <!-- Navigation Bar -->
    <div class="relative z-10 flex justify-center items-center py-4">
        <nav class="w-full max-w-6xl flex justify-between items-center px-4">
            <!-- Logo -->
            <div class="logo float-animation">
                <a href="<?php echo SITEURL; ?>" title="Logo" class="block">
                    <img src="../images/logo.png" alt="Restaurant Logo" class="h-16 w-auto bg-white rounded-full p-2 shadow-lg">
                </a>
            </div>

            <!-- Menu inside rounded background -->
            <div class="relative bg-white/20 backdrop-blur-md rounded-full px-2 py-2 shadow-lg border border-white/30">
                <!-- Moving indicator -->
                <div id="indicator" class="nav-indicator absolute top-2 left-3 h-10 bg-orange-500 rounded-full z-0 shadow-md" style="width: 60px;"></div>

                <!-- Navigation items -->
                <div class="flex relative z-10">
                    <a href="<?php echo SITEURL; ?>" class="nav-item px-6 py-2.5 rounded-full text-sm font-semibold transition-all duration-300 text-white/70 hover:text-white">Home</a>
                    <a href="<?php echo SITEURL; ?>categories.php" class="nav-item px-6 py-2.5 rounded-full text-sm font-semibold transition-all duration-300 text-white/70 hover:text-white">Categories</a>
                    <a href="<?php echo SITEURL; ?>foods.php" class="nav-item px-6 py-2.5 rounded-full text-sm font-semibold transition-all duration-300 text-white/70 hover:text-white">Foods</a>
                    <a href="<?php echo SITEURL; ?>contact.php" class="nav-item px-6 py-2.5 rounded-full text-sm font-semibold transition-all duration-300 text-white/70 hover:text-white">Contact</a>
                    <a href="<?php echo SITEURL; ?>admin/login.php" class="nav-item px-6 py-2.5 rounded-full text-sm font-semibold transition-all duration-300 text-white bg-orange-500/20 backdrop-blur-sm">Admin</a>
                </div>
            </div>
        </nav>
    </div>

    <!-- Login Section -->
    <div class="relative z-10 flex justify-center items-center min-h-[calc(100vh-120px)] px-4">
        <div class="login-container w-full max-w-md p-8 rounded-3xl shadow-2xl border border-white/20 fade-in-up">
            <!-- Login Header -->
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-gradient-to-r from-orange-400 to-orange-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg float-animation">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Admin Login</h1>
                <p class="text-gray-600">Sign in to your admin account</p>
            </div>

            <!-- PHP Messages -->
            <div class="mb-6">
                <?php
                if (isset($_SESSION['login'])) {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if (isset($_SESSION['no-login-msg'])) {
                    echo $_SESSION['no-login-msg'];
                    unset($_SESSION['no-login-msg']);
                }
                ?>
            </div>

            <!-- Login Form -->
            <form action="" method="post" class="space-y-6">
                <!-- Username Field -->
                <div class="relative">
                    <label for="username" class="block text-sm font-semibold text-gray-700 mb-2">Username</label>
                    <div class="relative">
                        <input 
                            type="text" 
                            id="username" 
                            name="user_name" 
                            placeholder="Enter your username" 
                            required 
                            autocomplete="off"
                            class="input-focus w-full px-4 py-3 pl-12 border border-gray-300 rounded-xl focus:outline-none focus:ring-0 transition-all duration-300 bg-white/90 backdrop-blur-sm"
                        >
                        <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Password Field -->
                <div class="relative">
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="Enter your password" 
                            required 
                            autocomplete="off"
                            class="input-focus w-full px-4 py-3 pl-12 pr-12 border border-gray-300 rounded-xl focus:outline-none focus:ring-0 transition-all duration-300 bg-white/90 backdrop-blur-sm"
                        >
                        <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        <button type="button" id="togglePassword" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Login Button -->
                <button 
                    type="submit" 
                    name="submit" 
                    class="btn-hover w-full bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-orange-300"
                >
                    <span class="flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013 3v1"></path>
                        </svg>
                        Sign In
                    </span>
                </button>
            </form>

            <!-- Footer -->
            <div class="mt-8 text-center">
                <p class="text-sm text-gray-600">
                    Secured Admin Access Only
                </p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include('../partials-frontend/footer.php') ?>

    <script>
        // Navigation indicator animation
        const indicator = document.getElementById('indicator');
        const navItems = document.querySelectorAll('.nav-item');

        navItems.forEach((item, index) => {
            item.addEventListener('mouseenter', () => {
                const itemRect = item.getBoundingClientRect();
                const parentRect = item.parentElement.getBoundingClientRect();
                const relativeLeft = itemRect.left - parentRect.left;

                indicator.style.left = relativeLeft + 8 + 'px';
                indicator.style.width = itemRect.width + 'px';

                navItems.forEach(navItem => {
                    navItem.classList.remove('text-white');
                    navItem.classList.add('text-white/70');
                });
                item.classList.remove('text-white/70');
                item.classList.add('text-white');
            });
        });

        // Reset to Admin (current page)
        document.querySelector('.relative.bg-white\\/20').addEventListener('mouseleave', () => {
            const adminItem = navItems[4]; // Admin is the 5th item (index 4)
            const adminRect = adminItem.getBoundingClientRect();
            const parentRect = adminItem.parentElement.getBoundingClientRect();
            const relativeLeft = adminRect.left - parentRect.left;

            indicator.style.left = relativeLeft + 8 + 'px';
            indicator.style.width = adminRect.width + 'px';

            navItems.forEach(navItem => {
                navItem.classList.remove('text-white');
                navItem.classList.add('text-white/70');
            });
            adminItem.classList.remove('text-white/70');
            adminItem.classList.add('text-white');
        });

        // Initialize with Admin active
        window.addEventListener('load', () => {
            const adminItem = navItems[4];
            const adminRect = adminItem.getBoundingClientRect();
            const parentRect = adminItem.parentElement.getBoundingClientRect();
            const relativeLeft = adminRect.left - parentRect.left;

            indicator.style.left = relativeLeft + 8 + 'px';
            indicator.style.width = adminRect.width + 'px';
        });

        // Password toggle functionality
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Toggle icon
            togglePassword.innerHTML = type === 'password' ? 
                `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>` :
                `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                </svg>`;
        });

        // Input animations
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', () => {
                input.parentElement.classList.add('scale-105');
            });
            
            input.addEventListener('blur', () => {
                input.parentElement.classList.remove('scale-105');
            });
        });
    </script>
</body>
</html>

