<?php include("partials/menu.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Management Dashboard</title>
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

        @keyframes shimmer {
            0% {
                background-position: -468px 0;
            }
            100% {
                background-position: 468px 0;
            }
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        
        .animate-pulse-glow {
            animation: pulse-glow 2s infinite;
        }

        .shimmer {
            background: linear-gradient(to right, #f6f7f8 0%, #edeef1 20%, #f6f7f8 40%, #f6f7f8 100%);
            background-size: 800px 104px;
            animation: shimmer 1.5s linear infinite;
        }
        
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        
        .btn-hover {
            transition: all 0.2s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-hover:hover {
            transform: translateY(-1px);
        }

        .btn-hover::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn-hover:hover::before {
            left: 100%;
        }
        
        .table-row {
            transition: all 0.3s ease;
        }
        
        .table-row:hover {
            background: linear-gradient(90deg, rgba(251, 146, 60, 0.05) 0%, rgba(249, 115, 22, 0.05) 100%);
            transform: translateX(4px);
        }

        .status-badge {
            transition: all 0.2s ease;
        }

        .status-badge:hover {
            transform: scale(1.05);
        }

        .image-container {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .image-container:hover {
            transform: scale(1.05);
        }

        .image-container::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(251, 146, 60, 0.2), rgba(249, 115, 22, 0.2));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .image-container:hover::after {
            opacity: 1;
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
    <!-- Manage Category Starts -->
    <div class="main-content py-10 px-4 min-h-screen">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="bg-white rounded-2xl shadow-xl p-8 mb-8 card-hover animate-fade-in-up border-l-4 border-orange-500">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="bg-gradient-to-r from-orange-500 to-red-500 p-3 rounded-full animate-pulse-glow">
                            <i class="fas fa-layer-group text-white text-2xl"></i>
                        </div>
                        <div>
                            <h1 class="text-4xl font-bold bg-gradient-to-r from-orange-600 to-red-600 bg-clip-text text-transparent">
                                Manage Categories
                            </h1>
                            <p class="text-gray-600 mt-1">Organize and manage your food categories</p>
                        </div>
                    </div>
                    <div class="hidden md:flex items-center space-x-4">
                        <div class="text-right">
                            <p class="text-sm text-gray-500">Total Categories</p>
                            <?php 
                            $sql = "SELECT * FROM category";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                            ?>
                            <p class="text-2xl font-bold text-orange-600"><?php echo $count ?? 0; ?></p>
                        </div>
                        <div class="bg-orange-100 p-3 rounded-full">
                            <i class="fas fa-chart-pie text-orange-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Session Messages -->
            <?php
            $messages = ['add', 'remove', 'delete', 'no-category-found', 'update', 'upload', 'failed-remove'];
            foreach ($messages as $msg) {
                if (isset($_SESSION[$msg])) {
                    echo "<div class='mb-6 px-6 py-4 rounded-xl bg-gradient-to-r from-green-100 to-emerald-100 border-l-4 border-green-500 text-green-800 font-medium shadow-lg animate-fade-in-up'>
                            <div class='flex items-center'>
                                <i class='fas fa-check-circle mr-3 text-green-600'></i>
                                <span>{$_SESSION[$msg]}</span>
                            </div>
                          </div>";
                    unset($_SESSION[$msg]);
                }
            }
            ?>

            <!-- Add Category Button -->
            <div class="mb-8 animate-fade-in-up">
                <a href="<?php echo SITEURL; ?>admin/add-category.php"
                   class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold rounded-xl hover:from-orange-600 hover:to-red-600 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl btn-hover">
                    <i class="fas fa-plus mr-2"></i>
                    Add New Category
                </a>
            </div>

            <!-- Category Table -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-fade-in-up">
                <div class="bg-gradient-to-r from-orange-600 to-red-600 p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="bg-white bg-opacity-20 p-2 rounded-lg">
                                <i class="fas fa-table text-white text-xl"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-white">Categories Overview</h2>
                        </div>
                        <div class="bg-white bg-opacity-20 px-4 py-2 rounded-full">
                            <span class="text-white text-sm font-medium">Live Data</span>
                            <div class="inline-block w-2 h-2 bg-green-400 rounded-full ml-2 animate-pulse"></div>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto custom-scrollbar">
                    <table class="min-w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-hashtag mr-2 text-orange-500"></i>Serial No.
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-tag mr-2 text-blue-500"></i>Title
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-image mr-2 text-purple-500"></i>Image
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-star mr-2 text-yellow-500"></i>Featured
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-toggle-on mr-2 text-green-500"></i>Active
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-cogs mr-2 text-gray-500"></i>Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php
                            $sql = "SELECT * FROM category";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                            $serial = 1;

                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    $image_name = $row['image_name'];
                                    $featured = $row['featured'];
                                    $active = $row['active'];
                            ?>
                                <tr class="table-row">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-center w-10 h-10 bg-orange-100 rounded-full">
                                            <span class="text-sm font-bold text-orange-600"><?php echo $serial++; ?></span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-gradient-to-r from-blue-400 to-purple-400 rounded-lg flex items-center justify-center mr-3">
                                                <i class="fas fa-tag text-white text-sm"></i>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900"><?php echo $title; ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php if ($image_name != ""): ?>
                                            <div class="image-container w-20 h-12 rounded-lg overflow-hidden border-2 border-gray-200 shadow-sm">
                                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" 
                                                     alt="<?php echo $title; ?>"
                                                     class="w-full h-full object-cover" />
                                            </div>
                                        <?php else: ?>
                                            <div class="flex items-center justify-center w-20 h-12 bg-red-100 rounded-lg border-2 border-red-200">
                                                <div class="text-center">
                                                    <i class="fas fa-image-slash text-red-400 text-xs"></i>
                                                    <div class="text-red-500 text-xs mt-1">No Image</div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php if ($featured == "Yes"): ?>
                                            <span class="status-badge inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <div class="w-2 h-2 bg-yellow-400 rounded-full mr-2 animate-pulse"></div>
                                                <?php echo $featured; ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="status-badge inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                <div class="w-2 h-2 bg-gray-400 rounded-full mr-2"></div>
                                                <?php echo $featured; ?>
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php if ($active == "Yes"): ?>
                                            <span class="status-badge inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <div class="w-2 h-2 bg-green-400 rounded-full mr-2"></div>
                                                <?php echo $active; ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="status-badge inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <div class="w-2 h-2 bg-red-400 rounded-full mr-2"></div>
                                                <?php echo $active; ?>
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                        <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>"
                                           class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-green-500 to-emerald-500 text-white text-xs font-medium rounded-lg hover:from-green-600 hover:to-emerald-600 transform hover:scale-105 transition-all duration-200 shadow-md hover:shadow-lg btn-hover">
                                            <i class="fas fa-edit mr-1"></i>
                                            Update
                                        </a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"
                                           class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-red-500 to-pink-500 text-white text-xs font-medium rounded-lg hover:from-red-600 hover:to-pink-600 transform hover:scale-105 transition-all duration-200 shadow-md hover:shadow-lg btn-hover"
                                           onclick="return confirm('Are you sure you want to delete this category?')">
                                            <i class="fas fa-trash mr-1"></i>
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php
                                }
                            } else {
                                echo "<tr>
                                        <td colspan='6' class='px-6 py-12 text-center'>
                                            <div class='flex flex-col items-center justify-center'>
                                                <div class='w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4'>
                                                    <i class='fas fa-layer-group text-4xl text-gray-400'></i>
                                                </div>
                                                <h3 class='text-lg font-medium text-gray-900 mb-2'>No Categories Found</h3>
                                                <p class='text-gray-500 mb-4'>Start building your menu by adding categories.</p>
                                                <a href='" . SITEURL . "admin/add-category.php' class='inline-flex items-center px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition'>
                                                    <i class='fas fa-plus mr-2'></i>
                                                    Add First Category
                                                </a>
                                            </div>
                                        </td>
                                      </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white rounded-xl p-6 shadow-lg card-hover border-l-4 border-blue-500 animate-fade-in-up">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Total Categories</p>
                            <p class="text-2xl font-bold text-blue-600"><?php echo $count ?? 0; ?></p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <i class="fas fa-layer-group text-blue-600"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl p-6 shadow-lg card-hover border-l-4 border-yellow-500 animate-fade-in-up">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Featured</p>
                            <p class="text-2xl font-bold text-yellow-600">
                                <?php 
                                $featured_sql = "SELECT COUNT(*) as featured FROM category WHERE featured = 'Yes'";
                                $featured_res = mysqli_query($conn, $featured_sql);
                                $featured_count = mysqli_fetch_assoc($featured_res)['featured'] ?? 0;
                                echo $featured_count;
                                ?>
                            </p>
                        </div>
                        <div class="bg-yellow-100 p-3 rounded-full">
                            <i class="fas fa-star text-yellow-600"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl p-6 shadow-lg card-hover border-l-4 border-green-500 animate-fade-in-up">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Active</p>
                            <p class="text-2xl font-bold text-green-600">
                                <?php 
                                $active_sql = "SELECT COUNT(*) as active FROM category WHERE active = 'Yes'";
                                $active_res = mysqli_query($conn, $active_sql);
                                $active_count = mysqli_fetch_assoc($active_res)['active'] ?? 0;
                                echo $active_count;
                                ?>
                            </p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                            <i class="fas fa-toggle-on text-green-600"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl p-6 shadow-lg card-hover border-l-4 border-purple-500 animate-fade-in-up">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">With Images</p>
                            <p class="text-2xl font-bold text-purple-600">
                                <?php 
                                $images_sql = "SELECT COUNT(*) as with_images FROM category WHERE image_name != ''";
                                $images_res = mysqli_query($conn, $images_sql);
                                $images_count = mysqli_fetch_assoc($images_res)['with_images'] ?? 0;
                                echo $images_count;
                                ?>
                            </p>
                        </div>
                        <div class="bg-purple-100 p-3 rounded-full">
                            <i class="fas fa-image text-purple-600"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Manage Category Ends -->

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

            // Add click animation to buttons
            const buttons = document.querySelectorAll('.btn-hover');
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

            // Auto-pulse featured badges
            setInterval(() => {
                const featuredBadges = document.querySelectorAll('.status-badge');
                featuredBadges.forEach(badge => {
                    if (badge.textContent.includes('Yes') && badge.classList.contains('bg-yellow-100')) {
                        badge.style.animation = 'pulse 2s infinite';
                    }
                });
            }, 1000);

            // Image hover effects
            const imageContainers = document.querySelectorAll('.image-container');
            imageContainers.forEach(container => {
                container.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.1) rotate(2deg)';
                });
                
                container.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1) rotate(0deg)';
                });
            });
        });
    </script>
</body>
</html>

<?php include("partials/footer.php") ?>