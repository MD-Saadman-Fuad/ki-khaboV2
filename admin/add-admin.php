    <?php include("partials/menu.php") ?>
    <?php
    if (isset($_POST['submit'])) {
        $full_name = $_POST['full_name'];
        $user_name = $_POST['user_name'];
        $password = md5($_POST['password']); // password encryption

        if (empty($user_name) || empty($full_name)) {
            $_SESSION['add'] = "<div class='text-red-600 font-medium'>Please enter correct information</div>";
            header("location:" . SITEURL . 'admin/add-admin.php');
        } else {
            $sql = "INSERT INTO admin SET 
                    full_name = '$full_name',
                    user_name = '$user_name',
                    password = '$password'";

            $res = mysqli_query($conn, $sql) or die(mysqli_error());

            if ($res == TRUE) {
                $_SESSION['add'] = "Admin added successfully!";
                header("location:" . SITEURL . 'admin/add-admin.php');
                exit();
            } else {
                $_SESSION['add'] = "<div class='text-red-600 font-medium'>Failed to add admin</div>";
                header("location:" . SITEURL . 'admin/add-admin.php');
            }
        }
    }
    ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin - Restaurant Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
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
        
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes pulse-glow {
            0%, 100% {
                box-shadow: 0 0 10px rgba(251, 146, 60, 0.3);
            }
            50% {
                box-shadow: 0 0 25px rgba(251, 146, 60, 0.6), 0 0 40px rgba(251, 146, 60, 0.4);
            }
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }
        
        @keyframes successPulse {
            0%, 100% {
                box-shadow: 0 0 10px rgba(34, 197, 94, 0.3);
            }
            50% {
                box-shadow: 0 0 25px rgba(34, 197, 94, 0.6), 0 0 40px rgba(34, 197, 94, 0.4);
            }
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }
        
        .animate-slide-in-left {
            animation: slideInLeft 0.6s ease-out forwards;
        }
        
        .animate-pulse-glow {
            animation: pulse-glow 3s infinite;
        }
        
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        .animate-success-pulse {
            animation: successPulse 2s infinite;
        }
        
        .form-container {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .form-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }
        
        .input-group {
            position: relative;
            transition: all 0.3s ease;
        }
        
        .input-group:focus-within {
            transform: translateY(-2px);
        }
        
        .input-field {
            transition: all 0.3s ease;
        }
        
        .input-field:focus {
            box-shadow: 0 0 0 3px rgba(251, 146, 60, 0.1), 0 4px 15px rgba(251, 146, 60, 0.2);
            transform: scale(1.02);
        }
        
        .submit-btn {
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(34, 197, 94, 0.3);
        }
        
        .submit-btn:active {
            transform: translateY(0);
        }
        
        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }
        
        .submit-btn:hover::before {
            left: 100%;
        }
        
        .icon-container {
            transition: all 0.3s ease;
        }
        
        .icon-container:hover {
            transform: rotate(10deg) scale(1.1);
        }
        
        .message-box {
            animation: fadeInUp 0.5s ease-out;
        }
        
        /* Background pattern */
        .bg-pattern {
            background-image: 
                radial-gradient(circle at 25px 25px, rgba(251, 146, 60, 0.1) 2px, transparent 2px),
                radial-gradient(circle at 75px 75px, rgba(249, 115, 22, 0.1) 2px, transparent 2px);
            background-size: 100px 100px;
        }
        
        /* Custom scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #fb923c;
            border-radius: 4px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #f97316;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-orange-50 via-white to-red-50 min-h-screen bg-pattern custom-scrollbar">
    <!-- Floating Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-10 left-10 w-20 h-20 bg-gradient-to-r from-orange-200 to-red-200 rounded-full opacity-20 animate-float"></div>
        <div class="absolute top-32 right-20 w-16 h-16 bg-gradient-to-r from-yellow-200 to-orange-200 rounded-full opacity-20 animate-float" style="animation-delay: -2s;"></div>
        <div class="absolute bottom-20 left-20 w-24 h-24 bg-gradient-to-r from-red-200 to-pink-200 rounded-full opacity-20 animate-float" style="animation-delay: -4s;"></div>
        <div class="absolute bottom-32 right-10 w-12 h-12 bg-gradient-to-r from-orange-200 to-yellow-200 rounded-full opacity-20 animate-float" style="animation-delay: -1s;"></div>
    </div>

    <!-- Add Admin Starts -->
    <div class="main-content py-12 px-4 min-h-screen relative z-10">
        <div class="max-w-2xl mx-auto">
            <!-- Header Section -->
            <div class="text-center mb-8 animate-fade-in-up">
                <div class="inline-block bg-gradient-to-r from-orange-500 to-red-500 p-4 rounded-full animate-pulse-glow mb-4">
                    <i class="fas fa-user-plus text-white text-3xl"></i>
                </div>
                <h1 class="text-4xl font-bold bg-gradient-to-r from-orange-600 to-red-600 bg-clip-text text-transparent mb-2">
                    Add New Admin
                </h1>
                <p class="text-gray-600 text-lg">Create a new administrator account for the restaurant management system</p>
                <div class="w-24 h-1 bg-gradient-to-r from-orange-500 to-red-500 mx-auto mt-4 rounded-full"></div>
            </div>

            <!-- Session Message -->
            <?php
            if (isset($_SESSION['add'])) {
                echo "<div class='message-box mb-8 px-6 py-4 rounded-xl bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-800 font-medium shadow-lg animate-success-pulse'>
                        <div class='flex items-center'>
                            <div class='bg-green-100 p-2 rounded-full mr-3'>
                                <i class='fas fa-check-circle text-green-600'></i>
                            </div>
                            <div class='text-lg font-semibold'>Admin added successfully!</div>
                        </div>
                      </div>";
                unset($_SESSION['add']);
            }
            ?>

            <!-- Admin Form -->
            <div class="form-container bg-white shadow-2xl rounded-2xl overflow-hidden animate-slide-in-left">
                <!-- Form Header -->
                <div class="bg-gradient-to-r from-orange-600 to-red-600 p-6">
                    <div class="flex items-center justify-center">
                        <div class="bg-white bg-opacity-20 p-3 rounded-full mr-4">
                            <i class="fas fa-user-cog text-white text-xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-white">Administrator Details</h2>
                    </div>
                </div>

                <!-- Form Body -->
                <form action="" method="POST" class="p-8 space-y-6">
                    <!-- Full Name Field -->
                    <div class="input-group">
                        <label class="block text-gray-700 mb-2 font-semibold flex items-center">
                            <div class="icon-container bg-orange-100 p-2 rounded-full mr-3">
                                <i class="fas fa-user text-orange-600"></i>
                            </div>
                            Full Name
                        </label>
                        <div class="relative">
                            <input type="text" name="full_name" placeholder="Enter administrator's full name"
                                   class="input-field w-full px-4 py-3 pl-12 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-transparent transition-all duration-300" />
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Username Field -->
                    <div class="input-group">
                        <label class="block text-gray-700 mb-2 font-semibold flex items-center">
                            <div class="icon-container bg-blue-100 p-2 rounded-full mr-3">
                                <i class="fas fa-at text-blue-600"></i>
                            </div>
                            Username
                        </label>
                        <div class="relative">
                            <input type="text" name="user_name" placeholder="Enter unique username"
                                   class="input-field w-full px-4 py-3 pl-12 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-transparent transition-all duration-300" />
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class="fas fa-at"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="input-group">
                        <label class="block text-gray-700 mb-2 font-semibold flex items-center">
                            <div class="icon-container bg-purple-100 p-2 rounded-full mr-3">
                                <i class="fas fa-lock text-purple-600"></i>
                            </div>
                            Password
                        </label>
                        <div class="relative">
                            <input type="password" name="password" placeholder="Enter secure password"
                                   class="input-field w-full px-4 py-3 pl-12 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-transparent transition-all duration-300" />
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mt-2 flex items-center">
                            <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                            Password will be encrypted for security
                        </p>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center pt-4">
                        <button type="submit" name="submit" 
                                class="submit-btn bg-gradient-to-r from-green-500 to-emerald-600 text-white px-8 py-4 rounded-xl hover:from-green-600 hover:to-emerald-700 font-semibold text-lg shadow-lg flex items-center justify-center mx-auto group">
                            <div class="bg-white bg-opacity-20 p-2 rounded-full mr-3 group-hover:rotate-12 transition-transform duration-300">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            Add Administrator
                            <div class="ml-3 group-hover:translate-x-1 transition-transform duration-300">
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </button>
                    </div>
                </form>

                <!-- Form Footer -->
                <div class="bg-gray-50 px-8 py-4 border-t">
                    <div class="flex items-center justify-center text-sm text-gray-600">
                        <i class="fas fa-shield-alt mr-2 text-green-500"></i>
                        All admin data is securely encrypted and protected
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Admin Ends -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animate form elements on load
            const inputGroups = document.querySelectorAll('.input-group');
            inputGroups.forEach((group, index) => {
                group.style.opacity = '0';
                group.style.transform = 'translateX(-20px)';
                setTimeout(() => {
                    group.style.transition = 'all 0.6s ease';
                    group.style.opacity = '1';
                    group.style.transform = 'translateX(0)';
                }, index * 200);
            });

            // Add ripple effect to submit button
            const submitBtn = document.querySelector('.submit-btn');
            submitBtn.addEventListener('click', function(e) {
                const ripple = document.createElement('div');
                ripple.className = 'absolute inset-0 bg-white bg-opacity-20 rounded-xl transform scale-0';
                ripple.style.animation = 'ping 0.6s ease-out';
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });

            // Input focus animations
            const inputs = document.querySelectorAll('.input-field');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.querySelector('i').style.color = '#fb923c';
                    this.parentElement.querySelector('i').style.transform = 'scale(1.2)';
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.querySelector('i').style.color = '#9ca3af';
                    this.parentElement.querySelector('i').style.transform = 'scale(1)';
                });
            });

            // Floating elements random movement
            const floatingElements = document.querySelectorAll('.animate-float');
            floatingElements.forEach(element => {
                setInterval(() => {
                    const randomX = Math.random() * 20 - 10;
                    const randomY = Math.random() * 20 - 10;
                    element.style.transform = `translate(${randomX}px, ${randomY}px)`;
                }, 3000);
            });

            // Auto-hide success message after 3 seconds
            const messageBox = document.querySelector('.message-box');
            if (messageBox) {
                setTimeout(() => {
                    messageBox.style.opacity = '0';
                    messageBox.style.transform = 'translateY(-20px)';
                    setTimeout(() => {
                        messageBox.style.display = 'none';
                    }, 300);
                }, 3000);
            }
        });
    </script>





    <?php include("partials/footer.php"); ?>
<?php ob_end_flush(); ?>