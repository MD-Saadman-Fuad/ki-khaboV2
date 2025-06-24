<?php include("partials/menu.php") ?>
    <?php 
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        $sql = "SELECT * FROM admin WHERE id = $id AND password = '$current_password'";
        $res = mysqli_query($conn, $sql);

        if ($res && mysqli_num_rows($res) == 1) {
            if ($new_password == $confirm_password) {
                $sql1 = "UPDATE admin SET password = '$new_password' WHERE id = $id";
                $res1 = mysqli_query($conn, $sql1);

                if ($res1) {
                    $_SESSION['change-password'] = "<div class='text-green-600 font-medium text-center py-4'>Password Changed Successfully</div>";
                } else {
                    $_SESSION['change-password'] = "<div class='text-red-600 font-medium text-center py-4'>Failed to Change Password</div>";
                }
            } else {
                $_SESSION['password-not-match'] = "<div class='text-red-600 font-medium text-center py-4'>Passwords Did Not Match</div>";
            }
        } else {
            $_SESSION['user-not-found'] = "<div class='text-red-600 font-medium text-center py-4'>User Not Found</div>";
        }

        header('location:' . SITEURL . 'admin/manage-admin.php');
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password - Restaurant Management</title>
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
                box-shadow: 0 0 10px rgba(59, 130, 246, 0.3);
            }
            50% {
                box-shadow: 0 0 25px rgba(59, 130, 246, 0.6), 0 0 40px rgba(59, 130, 246, 0.4);
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
        
        @keyframes errorPulse {
            0%, 100% {
                box-shadow: 0 0 10px rgba(239, 68, 68, 0.3);
            }
            50% {
                box-shadow: 0 0 25px rgba(239, 68, 68, 0.6), 0 0 40px rgba(239, 68, 68, 0.4);
            }
        }
        
        @keyframes lockRotate {
            0% { transform: rotate(0deg); }
            25% { transform: rotate(-5deg); }
            75% { transform: rotate(5deg); }
            100% { transform: rotate(0deg); }
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
        
        .animate-error-pulse {
            animation: errorPulse 2s infinite;
        }
        
        .animate-lock-rotate {
            animation: lockRotate 0.5s ease-in-out;
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
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1), 0 4px 15px rgba(59, 130, 246, 0.2);
            transform: scale(1.02);
        }
        
        .submit-btn {
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(4, 201, 86, 0.3);
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
                radial-gradient(circle at 25px 25px, rgba(59, 130, 246, 0.1) 2px, transparent 2px),
                radial-gradient(circle at 75px 75px, rgba(37, 99, 235, 0.1) 2px, transparent 2px);
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
            background: #3b82f6;
            border-radius: 4px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #2563eb;
        }

        .password-strength {
            transition: all 0.3s ease;
        }

        .strength-weak { color: #ef4444; }
        .strength-medium { color: #f59e0b; }
        .strength-strong { color: #10b981; }
    </style>
</head>
<body class="bg-gradient-to-br from-orange-50 via-white to-indigo-50 min-h-screen bg-pattern custom-scrollbar">
    <!-- Floating Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-10 left-10 w-20 h-20 bg-gradient-to-r from-blue-200 to-indigo-200 rounded-full opacity-20 animate-float"></div>
        <div class="absolute top-32 right-20 w-16 h-16 bg-gradient-to-r from-cyan-200 to-blue-200 rounded-full opacity-20 animate-float" style="animation-delay: -2s;"></div>
        <div class="absolute bottom-20 left-20 w-24 h-24 bg-gradient-to-r from-indigo-200 to-purple-200 rounded-full opacity-20 animate-float" style="animation-delay: -4s;"></div>
        <div class="absolute bottom-32 right-10 w-12 h-12 bg-gradient-to-r from-blue-200 to-cyan-200 rounded-full opacity-20 animate-float" style="animation-delay: -1s;"></div>
    </div>

    <!-- Change Password Starts -->
    <div class="main-content py-12 px-4 min-h-screen relative z-10">
        <div class="max-w-2xl mx-auto">
            <!-- Header Section -->
            <div class="text-center mb-8 animate-fade-in-up">
                <div class="inline-block bg-gradient-to-r from-orange-600 to-red-600 p-4 rounded-full animate-pulse-glow mb-4">
                    <i class="fas fa-key text-white text-3xl"></i>
                </div>
                <h1 class="text-4xl font-bold bg-gradient-to-r from-orange-600 to-red-600 bg-clip-text text-transparent mb-2">
                    Change Password
                </h1>
                <p class="text-gray-600 text-lg">Update your account password for enhanced security</p>
                <div class="w-24 h-1 bg-gradient-to-r from-orange-600 to-red-600 mx-auto mt-4 rounded-full"></div>
            </div>

            <?php 
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
            }
            ?>

            <!-- Session Messages -->
            <?php
            if (isset($_SESSION['change-password'])) {
                echo "<div class='message-box mb-8 px-6 py-4 rounded-xl bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-800 font-medium shadow-lg animate-success-pulse'>
                        <div class='flex items-center'>
                            <div class='bg-green-100 p-2 rounded-full mr-3'>
                                <i class='fas fa-check-circle text-green-600'></i>
                            </div>
                            <div class='text-lg font-semibold'>Password Changed Successfully!</div>
                        </div>
                      </div>";
                unset($_SESSION['change-password']);
            }
            if (isset($_SESSION['password-not-match'])) {
                echo "<div class='message-box mb-8 px-6 py-4 rounded-xl bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-500 text-red-800 font-medium shadow-lg animate-error-pulse'>
                        <div class='flex items-center'>
                            <div class='bg-red-100 p-2 rounded-full mr-3'>
                                <i class='fas fa-exclamation-triangle text-red-600'></i>
                            </div>
                            <div class='text-lg font-semibold'>Passwords Did Not Match</div>
                        </div>
                      </div>";
                unset($_SESSION['password-not-match']);
            }
            if (isset($_SESSION['user-not-found'])) {
                echo "<div class='message-box mb-8 px-6 py-4 rounded-xl bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-500 text-red-800 font-medium shadow-lg animate-error-pulse'>
                        <div class='flex items-center'>
                            <div class='bg-red-100 p-2 rounded-full mr-3'>
                                <i class='fas fa-user-times text-red-600'></i>
                            </div>
                            <div class='text-lg font-semibold'>User Not Found</div>
                        </div>
                      </div>";
                unset($_SESSION['user-not-found']);
            }
            ?>

            <!-- Password Change Form -->
            <div class="form-container bg-white shadow-2xl rounded-2xl overflow-hidden animate-slide-in-left">
                <!-- Form Header -->
                <div class="bg-gradient-to-r from-orange-600 to-red-600 p-6">
                    <div class="flex items-center justify-center">
                        <div class="bg-white bg-opacity-20 p-3 rounded-full mr-4">
                            <i class="fas fa-shield-alt text-white text-xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-white">Security Update</h2>
                    </div>
                </div>

                <!-- Form Body -->
                <form action="" method="POST" class="p-8 space-y-6">
                    <!-- Current Password Field -->
                    <div class="input-group">
                        <label class="block text-gray-700 mb-2 font-semibold flex items-center">
                            <div class="icon-container bg-red-100 p-2 rounded-full mr-3">
                                <i class="fas fa-lock text-red-600"></i>
                            </div>
                            Current Password
                        </label>
                        <div class="relative">
                            <input type="password" name="current_password" placeholder="Enter your current password"
                                   class="input-field w-full px-4 py-3 pl-12 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300" />
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class="fas fa-lock"></i>
                            </div>
                            <button type="button" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors toggle-password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- New Password Field -->
                    <div class="input-group">
                        <label class="block text-gray-700 mb-2 font-semibold flex items-center">
                            <div class="icon-container bg-green-100 p-2 rounded-full mr-3">
                                <i class="fas fa-key text-green-600"></i>
                            </div>
                            New Password
                        </label>
                        <div class="relative">
                            <input type="password" name="new_password" placeholder="Enter your new password" id="newPassword"
                                   class="input-field w-full px-4 py-3 pl-12 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300" />
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class="fas fa-key"></i>
                            </div>
                            <button type="button" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors toggle-password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="mt-2 flex items-center">
                            <div class="flex-1 bg-gray-200 rounded-full h-2 mr-3">
                                <div id="strengthBar" class="h-2 rounded-full transition-all duration-300 bg-gray-300"></div>
                            </div>
                            <span id="strengthText" class="text-sm font-medium">Weak</span>
                        </div>
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="input-group">
                        <label class="block text-gray-700 mb-2 font-semibold flex items-center">
                            <div class="icon-container bg-purple-100 p-2 rounded-full mr-3">
                                <i class="fas fa-check-double text-purple-600"></i>
                            </div>
                            Confirm New Password
                        </label>
                        <div class="relative">
                            <input type="password" name="confirm_password" placeholder="Confirm your new password" id="confirmPassword"
                                   class="input-field w-full px-4 py-3 pl-12 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300" />
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class="fas fa-check-double"></i>
                            </div>
                            <button type="button" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors toggle-password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div id="matchIndicator" class="mt-2 text-sm flex items-center opacity-0 transition-opacity duration-300">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span>Passwords match</span>
                        </div>
                    </div>

                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <!-- Submit Button -->
                    <div class="text-center pt-4">
                        <button type="submit" name="submit" 
                                class="submit-btn bg-gradient-to-r from-orange-600 to-red-600 text-white px-8 py-4 rounded-xl hover:from-green-500 hover:to-green-600 font-semibold text-lg shadow-lg flex items-center justify-center mx-auto group">
                            <div class="bg-white bg-opacity-20 p-2 rounded-full mr-3 group-hover:animate-lock-rotate transition-transform duration-300">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            Update Password
                            <div class="ml-3 group-hover:translate-x-1 transition-transform duration-300">
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </button>
                    </div>
                </form>

                <!-- Form Footer -->
                <div class="bg-gray-50 px-8 py-4 border-t">
                    <div class="flex items-center justify-center text-sm text-gray-600">
                        <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                        Your password will be securely encrypted using MD5 hashing
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Change Password Ends -->


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

            // Password strength checker
            const newPasswordInput = document.getElementById('newPassword');
            const confirmPasswordInput = document.getElementById('confirmPassword');
            const strengthBar = document.getElementById('strengthBar');
            const strengthText = document.getElementById('strengthText');
            const matchIndicator = document.getElementById('matchIndicator');

            newPasswordInput.addEventListener('input', function() {
                const password = this.value;
                const strength = checkPasswordStrength(password);
                updateStrengthIndicator(strength);
                checkPasswordMatch();
            });

            confirmPasswordInput.addEventListener('input', function() {
                checkPasswordMatch();
            });

            function checkPasswordStrength(password) {
                let strength = 0;
                if (password.length >= 8) strength++;
                if (/[a-z]/.test(password)) strength++;
                if (/[A-Z]/.test(password)) strength++;
                if (/[0-9]/.test(password)) strength++;
                if (/[^A-Za-z0-9]/.test(password)) strength++;
                return Math.min(strength, 3);
            }

            function updateStrengthIndicator(strength) {
                const strengthTexts = ['Weak', 'Fair', 'Good', 'Strong'];
                const strengthColors = ['bg-red-400', 'bg-yellow-400', 'bg-blue-400', 'bg-green-400'];
                const strengthWidths = ['25%', '50%', '75%', '100%'];
                
                strengthBar.className = `h-2 rounded-full transition-all duration-300 ${strengthColors[strength]}`;
                strengthBar.style.width = strengthWidths[strength];
                strengthText.textContent = strengthTexts[strength];
                strengthText.className = `text-sm font-medium strength-${strengthTexts[strength].toLowerCase()}`;
            }

            function checkPasswordMatch() {
                const newPassword = newPasswordInput.value;
                const confirmPassword = confirmPasswordInput.value;
                
                if (confirmPassword && newPassword === confirmPassword) {
                    matchIndicator.style.opacity = '1';
                    matchIndicator.innerHTML = '<i class="fas fa-check-circle text-green-500 mr-2"></i><span>Passwords match</span>';
                } else if (confirmPassword) {
                    matchIndicator.style.opacity = '1';
                    matchIndicator.innerHTML = '<i class="fas fa-times-circle text-red-500 mr-2"></i><span>Passwords do not match</span>';
                } else {
                    matchIndicator.style.opacity = '0';
                }
            }

            // Toggle password visibility
            const toggleButtons = document.querySelectorAll('.toggle-password');
            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const input = this.parentElement.querySelector('input');
                    const icon = this.querySelector('i');
                    
                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.className = 'fas fa-eye-slash';
                    } else {
                        input.type = 'password';
                        icon.className = 'fas fa-eye';
                    }
                });
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
                    const icon = this.parentElement.querySelector('.fa-lock, .fa-key, .fa-check-double');
                    if (icon) {
                        icon.style.color = '#3b82f6';
                        icon.style.transform = 'scale(1.2)';
                    }
                });
                
                input.addEventListener('blur', function() {
                    const icon = this.parentElement.querySelector('.fa-lock, .fa-key, .fa-check-double');
                    if (icon) {
                        icon.style.color = '#9ca3af';
                        icon.style.transform = 'scale(1)';
                    }
                });
            });

            // Auto-hide success/error messages after 5 seconds
            const messageBoxes = document.querySelectorAll('.message-box');
            messageBoxes.forEach(messageBox => {
                setTimeout(() => {
                    messageBox.style.opacity = '0';
                    messageBox.style.transform = 'translateY(-20px)';
                    setTimeout(() => {
                        messageBox.style.display = 'none';
                    }, 300);
                }, 5000);
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
        });
    </script>

<?php include("partials/footer.php"); ?>