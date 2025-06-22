<?php include('partials/menu.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Management Dashboard</title>
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
        
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
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
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }
        
        .animate-slide-in-right {
            animation: slideInRight 0.6s ease-out forwards;
        }
        
        .animate-pulse-glow {
            animation: pulse-glow 3s infinite;
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        .card-hover {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .card-hover:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        
        .table-row {
            transition: all 0.3s ease;
            opacity: 0;
            transform: translateX(-20px);
        }
        
        .table-row.animate-in {
            opacity: 1;
            transform: translateX(0);
        }
        
        .table-row:hover {
            background: linear-gradient(90deg, rgba(251, 146, 60, 0.08) 0%, rgba(249, 115, 22, 0.08) 100%);
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(251, 146, 60, 0.15);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #f97316, #ea580c);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }
        
        .btn-primary:hover::before {
            left: 100%;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(249, 115, 22, 0.4);
        }
        
        .btn-update {
            background: linear-gradient(135deg, #10b981, #059669);
            transition: all 0.3s ease;
        }
        
        .btn-update:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.4);
        }
        
        .btn-delete {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            transition: all 0.3s ease;
        }
        
        .btn-delete:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.4);
        }
        
        .status-badge {
            transition: all 0.2s ease;
            cursor: pointer;
        }
        
        .status-badge:hover {
            transform: scale(1.1);
        }
        
        .food-image {
            transition: all 0.3s ease;
            border-radius: 12px;
        }
        
        .food-image:hover {
            transform: scale(1.1) rotate(2deg);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
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
            background: linear-gradient(90deg, #fb923c, #f97316);
            border-radius: 4px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(90deg, #f97316, #ea580c);
        }
        
        .floating-particles {
            position: fixed;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }
        
        .particle {
            position: absolute;
            background: rgba(251, 146, 60, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-orange-50 via-white to-red-50 min-h-screen">
    <div class="main-content p-6">
        <div class="wrapper max-w-12xl mx-auto">
    <!-- Floating Particles Background -->
    <div class="floating-particles">
        <div class="particle" style="width: 20px; height: 20px; top: 10%; left: 10%; animation-delay: 0s;"></div>
        <div class="particle" style="width: 15px; height: 15px; top: 20%; left: 80%; animation-delay: 1s;"></div>
        <div class="particle" style="width: 25px; height: 25px; top: 60%; left: 20%; animation-delay: 2s;"></div>
        <div class="particle" style="width: 18px; height: 18px; top: 80%; left: 70%; animation-delay: 3s;"></div>
        <div class="particle" style="width: 22px; height: 22px; top: 40%; left: 90%; animation-delay: 4s;"></div>
    </div>

    <!-- Manage Food Starts -->
    <div class="main-content p-2">
  <div class="wrapper max-w-10xl mx-auto">

            <!-- Header Section -->
            <div class="bg-white rounded-3xl shadow-2xl p-6 mb-8 card-hover animate-fade-in-up border-l-4 border-orange-500 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-orange-200 to-red-200 rounded-full -mr-16 -mt-16 opacity-50"></div>
                <div class="flex items-center justify-between relative z-10">
                    <div class="flex items-center space-x-6">
                        <div class="bg-gradient-to-r from-orange-500 to-red-500 p-4 rounded-2xl animate-pulse-glow animate-float">
                            <i class="fas fa-utensils text-white text-3xl"></i>
                        </div>
                        <div>
                            <h1 class="text-5xl font-bold bg-gradient-to-r from-orange-600 to-red-600 bg-clip-text text-transparent">
                                Food Management
                            </h1>
                            <p class="text-gray-600 mt-2 text-lg">Manage your restaurant's delicious offerings</p>
                        </div>
                    </div>
                    <div class="hidden md:flex items-center space-x-6">
                        <div class="text-right">
                            <p class="text-sm text-gray-500">Total Items</p>
                            <?php 
                            $sql = "SELECT * FROM food";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                            ?>
                            <p class="text-3xl font-bold text-orange-600"><?php echo $count ?? 0; ?></p>
                        </div>
                        <div class="bg-orange-100 p-4 rounded-2xl animate-float">
                            <i class="fas fa-chart-bar text-orange-600 text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Session Messages -->
            <?php
            $messages = ['add', 'delete', 'upload', 'unauthorize', 'update'];
            foreach ($messages as $msg) {
                if (isset($_SESSION[$msg])) {
                    echo "<div class='mb-6 px-6 py-4 rounded-2xl bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 font-medium shadow-lg animate-slide-in-right border-l-4 border-green-500'>
                            <div class='flex items-center'>
                                <i class='fas fa-check-circle mr-3 text-lg'></i>
                                <span class='text-lg'>{$_SESSION[$msg]}</span>
                            </div>
                          </div>";
                    unset($_SESSION[$msg]);
                }
            }
            ?>

            <!-- Add Food Button -->
            <div class="mb-8 animate-fade-in-up">
                <a href="<?php echo SITEURL; ?>admin/add-food.php"
                   class="btn-primary inline-flex items-center px-8 py-4 text-white text-lg font-semibold rounded-2xl shadow-lg transform hover:scale-105 transition-all duration-300">
                    <i class="fas fa-plus mr-3 text-xl"></i>
                    Add New Food Item
                </a>
            </div>

            <!-- Food Table -->
            <div class="bg-white rounded-3xl shadow-2xl  animate-fade-in-up">
                <div class="bg-gradient-to-r from-orange-600 to-red-600 p-8">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="bg-white bg-opacity-20 p-3 rounded-xl">
                                <i class="fas fa-hamburger text-white text-2xl"></i>
                            </div>
                            <h2 class="text-3xl font-bold text-white">Food Inventory</h2>
                        </div>
                        <div class="bg-white bg-opacity-20 px-6 py-3 rounded-full">
                            <span class="text-white text-sm font-medium">Live Menu</span>
                            <div class="inline-block w-3 h-3 bg-green-400 rounded-full ml-3 animate-pulse"></div>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto custom-scrollbar">
                    <table class="min-w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-8 py-6 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">
                                    <i class="fas fa-hashtag mr-2 text-orange-500"></i>Serial
                                </th>
                                <th class="px-8 py-6 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">
                                    <i class="fas fa-utensils mr-2 text-blue-500"></i>Food Title
                                </th>
                                <th class="px-8 py-6 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">
                                    <i class="fas fa-dollar-sign mr-2 text-green-500"></i>Price
                                </th>
                                <th class="px-8 py-6 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">
                                    <i class="fas fa-image mr-2 text-purple-500"></i>Image
                                </th>
                                <th class="px-8 py-6 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">
                                    <i class="fas fa-star mr-2 text-yellow-500"></i>Featured
                                </th>
                                <th class="px-8 py-6 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">
                                    <i class="fas fa-toggle-on mr-2 text-indigo-500"></i>Status
                                </th>
                                <th class="px-8 py-6 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">
                                    <i class="fas fa-cogs mr-2 text-gray-500"></i>Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php 
                            $sql = "SELECT * FROM food";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                            $serial = 1;
                            
                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    $price = $row['price'];
                                    $image_name = $row['image_name'];
                                    $featured = $row['featured'];
                                    $active = $row['active'];
                            ?>
                                <tr class="table-row">
                                    <td class="px-8 py-6 whitespace-nowrap">
                                        <div class="flex items-center justify-center w-10 h-10 bg-gradient-to-r from-orange-400 to-red-400 rounded-full shadow-lg">
                                            <span class="text-white font-bold text-lg"><?php echo $serial++; ?></span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-12 h-12 bg-gradient-to-r from-blue-400 to-purple-400 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                                <i class="fas fa-utensils text-white"></i>
                                            </div>
                                            <div>
                                                <div class="text-lg font-bold text-gray-900"><?php echo $title; ?></div>
                                                <div class="text-sm text-gray-500">Menu Item</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 whitespace-nowrap">
                                        <div class="bg-green-100 px-4 py-2 rounded-full text-center">
                                            <span class="text-lg font-bold text-green-600"><?php echo $price; ?> Taka</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 whitespace-nowrap">
                                        <?php if ($image_name == ""): ?>
                                            <div class="flex items-center justify-center w-24 h-16 bg-red-100 rounded-xl border-2 border-dashed border-red-300">
                                                <div class="text-center">
                                                    <i class="fas fa-image text-red-400 text-xl mb-1"></i>
                                                    <div class="text-xs text-red-500">No Image</div>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>"
                                                 class="food-image w-24 h-16 object-cover shadow-lg border-2 border-gray-200" 
                                                 alt="<?php echo $title; ?>" />
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-8 py-6 whitespace-nowrap">
                                        <?php if ($featured == "Yes"): ?>
                                            <span class="status-badge inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-yellow-100 text-yellow-800 shadow-lg">
                                                <i class="fas fa-star mr-2"></i>
                                                Featured
                                            </span>
                                        <?php else: ?>
                                            <span class="status-badge inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-gray-100 text-gray-600">
                                                <i class="fas fa-minus mr-2"></i>
                                                Regular
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-8 py-6 whitespace-nowrap">
                                        <?php if ($active == "Yes"): ?>
                                            <span class="status-badge inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-green-100 text-green-800 shadow-lg">
                                                <div class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></div>
                                                Active
                                            </span>
                                        <?php else: ?>
                                            <span class="status-badge inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-red-100 text-red-600">
                                                <div class="w-2 h-2 bg-red-400 rounded-full mr-2"></div>
                                                Inactive
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-8 py-6 whitespace-nowrap">
                                        <div class="flex items-center space-x-3">
                                            <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>"
                                               class="btn-update inline-flex items-center px-4 py-2 text-white text-sm font-semibold rounded-xl shadow-lg">
                                                <i class="fas fa-edit mr-2"></i>
                                                Update
                                            </a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"
                                               class="btn-delete inline-flex items-center px-4 py-2 text-white text-sm font-semibold rounded-xl shadow-lg">
                                                <i class="fas fa-trash mr-2"></i>
                                                Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                                }
                            } else {
                                echo '<tr>
                                        <td colspan="7" class="px-8 py-16 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <div class="w-32 h-32 bg-gradient-to-r from-orange-100 to-red-100 rounded-full flex items-center justify-center mb-6">
                                                    <i class="fas fa-utensils text-6xl text-orange-400"></i>
                                                </div>
                                                <h3 class="text-2xl font-bold text-gray-900 mb-3">No Food Items Yet</h3>
                                                <p class="text-gray-500 text-lg mb-6">Start building your menu by adding delicious food items.</p>
                                                <a href="' . SITEURL . 'admin/add-food.php" class="btn-primary inline-flex items-center px-6 py-3 text-white font-semibold rounded-xl">
                                                    <i class="fas fa-plus mr-2"></i>
                                                    Add First Food Item
                                                </a>
                                            </div>
                                        </td>
                                      </tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Footer Stats -->
            <div class="mt-10 grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white rounded-2xl p-6 shadow-xl card-hover border-l-4 border-blue-500 animate-fade-in-up">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Total Foods</p>
                            <p class="text-3xl font-bold text-blue-600"><?php echo $count ?? 0; ?></p>
                        </div>
                        <div class="bg-blue-100 p-4 rounded-full animate-float">
                            <i class="fas fa-hamburger text-blue-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl p-6 shadow-xl card-hover border-l-4 border-yellow-500 animate-fade-in-up">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Featured</p>
                            <p class="text-3xl font-bold text-yellow-600">
                                <?php 
                                $featured_sql = "SELECT COUNT(*) as featured FROM food WHERE featured = 'Yes'";
                                $featured_res = mysqli_query($conn, $featured_sql);
                                $featured_count = mysqli_fetch_assoc($featured_res)['featured'] ?? 0;
                                echo $featured_count;
                                ?>
                            </p>
                        </div>
                        <div class="bg-yellow-100 p-4 rounded-full animate-float">
                            <i class="fas fa-star text-yellow-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl p-6 shadow-xl card-hover border-l-4 border-green-500 animate-fade-in-up">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Active</p>
                            <p class="text-3xl font-bold text-green-600">
                                <?php 
                                $active_sql = "SELECT COUNT(*) as active FROM food WHERE active = 'Yes'";
                                $active_res = mysqli_query($conn, $active_sql);
                                $active_count = mysqli_fetch_assoc($active_res)['active'] ?? 0;
                                echo $active_count;
                                ?>
                            </p>
                        </div>
                        <div class="bg-green-100 p-4 rounded-full animate-float">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl p-6 shadow-xl card-hover border-l-4 border-red-500 animate-fade-in-up">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Inactive</p>
                            <p class="text-3xl font-bold text-red-600">
                                <?php 
                                $inactive_sql = "SELECT COUNT(*) as inactive FROM food WHERE active = 'No'";
                                $inactive_res = mysqli_query($conn, $inactive_sql);
                                $inactive_count = mysqli_fetch_assoc($inactive_res)['inactive'] ?? 0;
                                echo $inactive_count;
                                ?>
                            </p>
                        </div>
                        <div class="bg-red-100 p-4 rounded-full animate-float">
                            <i class="fas fa-times-circle text-red-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Manage Food Ends -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animate table rows on load
            const rows = document.querySelectorAll('.table-row');
            rows.forEach((row, index) => {
                setTimeout(() => {
                    row.classList.add('animate-in');
                }, index * 150);
            });

            // Add shimmer effect to buttons
            const buttons = document.querySelectorAll('.btn-primary, .btn-update, .btn-delete');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-3px) scale(1.05)';
                });
                
                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });

            // Add click ripple effect
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const ripple = document.createElement('div');
                    ripple.className = 'absolute inset-0 bg-white bg-opacity-30 rounded-xl transform scale-0';
                    ripple.style.animation = 'ping 0.6s ease-out';
                    this.style.position = 'relative';
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });

            // Add hover effects to food images
            const foodImages = document.querySelectorAll('.food-image');
            foodImages.forEach(img => {
                img.addEventListener('mouseenter', function() {
                    this.style.filter = 'brightness(1.1) saturate(1.2)';
                });
                
                img.addEventListener('mouseleave', function() {
                    this.style.filter = 'brightness(1) saturate(1)';
                });
            });

            // Add dynamic particle movement
            const particles = document.querySelectorAll('.particle');
            particles.forEach(particle => {
                setInterval(() => {
                    const randomX = Math.random() * 100;
                    const randomY = Math.random() * 100;
                    particle.style.left = randomX + '%';
                    particle.style.top = randomY + '%';
                    particle.style.transition = 'all 10s ease-in-out';
                }, Math.random() * 15000 + 10000);
            });

            // Add status badge pulse effect
            const statusBadges = document.querySelectorAll('.status-badge');
            statusBadges.forEach(badge => {
                badge.addEventListener('mouseenter', function() {
                    this.style.boxShadow = '0 0 20px rgba(251, 146, 60, 0.6)';
                });
                
                badge.addEventListener('mouseleave', function() {
                    this.style.boxShadow = 'none';
                });
            });
        });
    </script>
</body>
</html>


<?php include('partials/footer.php'); ?>