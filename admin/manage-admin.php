<?php include("partials/menu.php") ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Management Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes pulse-glow {
            0%, 100% {
                box-shadow: 0 0 5px rgba(251, 146, 60, 0.5);
            }
            50% {
                box-shadow: 0 0 20px rgba(251, 146, 60, 0.8), 0 0 30px rgba(251, 146, 60, 0.6);
            }
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        
        .animate-pulse-glow {
            animation: pulse-glow 2s infinite;
        }
        
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        
        .table-row {
            transition: all 0.2s ease;
        }
        
        .table-row:hover {
            background: linear-gradient(90deg, rgba(251, 146, 60, 0.05) 0%, rgba(249, 115, 22, 0.05) 100%);
        }
        
        .action-btn {
            transition: all 0.2s ease;
        }
        
        .action-btn:hover {
            transform: scale(1.05);
        }
        
        /* Custom scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            height: 8px;
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
<body class="bg-gradient-to-br from-orange-50 via-white to-red-50 min-h-screen">
    <!-- Main Content Starts -->
    <div class="main-content py-15 px-4 bg-orange-50 min-h-screen">
        <div class="max-w-6xl mx-auto">
            <!-- Header Section -->
            <div class="bg-white rounded-2xl shadow-xl p-8 mb-8 card-hover animate-fade-in-up border-l-4 border-orange-500">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="bg-gradient-to-r from-orange-500 to-red-500 p-3 rounded-full animate-pulse-glow">
                            <i class="fas fa-users-cog text-white text-2xl"></i>
                        </div>
                        <div>
                            <h1 class="text-4xl font-bold bg-gradient-to-r from-orange-600 to-red-600 bg-clip-text text-transparent">
                                Manage Admin
                            </h1>
                            <p class="text-gray-600 mt-1">Manage your admin users efficiently</p>
                        </div>
                    </div>
                    <div class="hidden md:flex items-center space-x-4">
                        <div class="text-right">
                            <p class="text-sm text-gray-500">Total Admins</p>
                            <?php
                            $sql = "SELECT * FROM admin";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                            ?>
                            <p class="text-2xl font-bold text-orange-600"><?php echo $count ?? 0; ?></p>
                        </div>
                        <div class="bg-orange-100 p-3 rounded-full">
                            <i class="fas fa-chart-line text-orange-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Session Messages -->
            <?php
            $messages = ['add', 'delete', 'update', 'user-not-found', 'password-not-match', 'change-password'];
            foreach ($messages as $msg) {
                if (isset($_SESSION[$msg])) {
                    echo "<div class='mb-6 px-6 py-4 rounded-lg bg-green-100 border-l-4 border-green-500 text-green-700 animate-fade-in-up'>
                            <div class='flex items-center'>
                                <i class='fas fa-check-circle mr-3 text-green-500'></i>
                                <span class='font-medium'>{$_SESSION[$msg]}</span>
                            </div>
                          </div>";
                    unset($_SESSION[$msg]);
                }
            }
            ?>

            <!-- Add Admin Button -->
            <div class="mb-8 animate-fade-in-up">
                <a href="add-admin.php" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white font-medium rounded-lg hover:from-orange-600 hover:to-red-600 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                    <i class="fas fa-plus mr-2"></i>
                    Add Admin
                </a>
            </div>

            <!-- Admin Table -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-fade-in-up">
                <div class="bg-gradient-to-r from-orange-600 to-red-600 p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="bg-white bg-opacity-20 p-2 rounded-lg">
                                <i class="fas fa-users text-white text-xl"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-white">Admin Users</h2>
                        </div>
                        <div class="bg-white bg-opacity-20 px-4 py-2 rounded-full">
                            <span class="text-white text-sm font-medium">Management Panel</span>
                            <div class="inline-block w-2 h-2 bg-green-400 rounded-full ml-2 animate-pulse"></div>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto custom-scrollbar">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-hashtag mr-2 text-orange-500"></i>Serial No.
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-user mr-2 text-blue-500"></i>Full Name
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-at mr-2 text-green-500"></i>Username
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-cogs mr-2 text-purple-500"></i>Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php
                            $sql = "SELECT * FROM admin";
                            $res = mysqli_query($conn, $sql);
                            
                            if ($res == TRUE) {
                                $count = mysqli_num_rows($res);
                                $serial = 1;
                                if ($count > 0) {
                                    while ($rows = mysqli_fetch_assoc($res)) {
                                        $id = $rows['id'];
                                        $full_name = $rows['full_name'];
                                        $user_name = $rows['user_name'];
                            ?>
                                        <tr class="table-row">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center justify-center w-8 h-8 bg-orange-100 rounded-full">
                                                    <span class="text-sm font-semibold text-orange-600"><?php echo $serial++; ?></span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="w-10 h-10 bg-gradient-to-r from-blue-400 to-purple-400 rounded-full flex items-center justify-center mr-3">
                                                        <i class="fas fa-user text-white text-sm"></i>
                                                    </div>
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900"><?php echo $full_name; ?></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="bg-green-100 px-3 py-1 rounded-full">
                                                        <span class="text-sm font-medium text-green-600">@<?php echo $user_name; ?></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex space-x-2">
                                                    <a href="<?php echo SITEURL; ?>admin/change-password.php?id=<?php echo $id; ?>"
                                                       class="action-btn inline-flex items-center px-3 py-2 bg-blue-500 text-white text-xs font-medium rounded-lg hover:bg-blue-600 transform hover:scale-105 transition-all duration-200 shadow-md hover:shadow-lg">
                                                        <i class="fas fa-key mr-1"></i>
                                                        Change Password
                                                    </a>
                                                    <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>"
                                                       class="action-btn inline-flex items-center px-3 py-2 bg-green-500 text-white text-xs font-medium rounded-lg hover:bg-green-600 transform hover:scale-105 transition-all duration-200 shadow-md hover:shadow-lg">
                                                        <i class="fas fa-edit mr-1"></i>
                                                        Update
                                                    </a>
                                                    <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>"
                                                       class="action-btn inline-flex items-center px-3 py-2 bg-red-500 text-white text-xs font-medium rounded-lg hover:bg-red-600 transform hover:scale-105 transition-all duration-200 shadow-md hover:shadow-lg"
                                                       onclick="return confirm('Are you sure you want to delete this admin?')">
                                                        <i class="fas fa-trash mr-1"></i>
                                                        Delete
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                            <?php
                                    }
                                } else {
                                    echo "<tr>
                                            <td colspan='4' class='px-6 py-12 text-center'>
                                                <div class='flex flex-col items-center justify-center'>
                                                    <div class='w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4'>
                                                        <i class='fas fa-users text-4xl text-gray-400'></i>
                                                    </div>
                                                    <h3 class='text-lg font-medium text-gray-900 mb-2'>No Admins Found</h3>
                                                    <p class='text-gray-500'>Add your first admin user to get started.</p>
                                                </div>
                                            </td>
                                          </tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Footer Stats -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-xl p-6 shadow-lg card-hover border-l-4 border-blue-500 animate-fade-in-up">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Total Admins</p>
                            <p class="text-2xl font-bold text-blue-600"><?php echo $count ?? 0; ?></p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <i class="fas fa-users text-blue-600"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl p-6 shadow-lg card-hover border-l-4 border-green-500 animate-fade-in-up">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Active Sessions</p>
                            <p class="text-2xl font-bold text-green-600">
                                <?php 
                                // You can add logic to count active sessions here
                                echo $count > 0 ? $count : 0;
                                ?>
                            </p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                            <i class="fas fa-check-circle text-green-600"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl p-6 shadow-lg card-hover border-l-4 border-orange-500 animate-fade-in-up">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">System Status</p>
                            <p class="text-lg font-bold text-orange-600">Online</p>
                        </div>
                        <div class="bg-orange-100 p-3 rounded-full">
                            <i class="fas fa-server text-orange-600"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Content Ends -->

    <script>
        // Add interactive animations
        document.addEventListener('DOMContentLoaded', function() {
            // Animate table rows on load
            const rows = document.querySelectorAll('.table-row');
            rows.forEach((row, index) => {
                row.style.opacity = '0';
                row.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    row.style.transition = 'all 0.6s ease';
                    row.style.opacity = '1';
                    row.style.transform = 'translateY(0)';
                }, index * 100);
            });

            // Add click animation to action buttons
            const buttons = document.querySelectorAll('.action-btn');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    // Create ripple effect
                    const ripple = document.createElement('div');
                    ripple.className = 'absolute inset-0 bg-white bg-opacity-30 rounded-lg transform scale-0';
                    ripple.style.animation = 'ping 0.6s ease-out';
                    this.style.position = 'relative';
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });

            // Animate stats cards
            const statsCards = document.querySelectorAll('.card-hover');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animationDelay = '0.2s';
                        entry.target.classList.add('animate-fade-in-up');
                    }
                });
            });

            statsCards.forEach(card => {
                observer.observe(card);
            });
        });
    </script>
</body>
</html>


<?php include("partials/footer.php") ?>