<?php include("partials/menu.php") ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Orders Dashboard</title>
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
        
        .status-badge {
            transition: all 0.2s ease;
        }
        
        .status-badge:hover {
            transform: scale(1.05);
        }
        
        .table-row {
            transition: all 0.2s ease;
        }
        
        .table-row:hover {
            background: linear-gradient(90deg, rgba(251, 146, 60, 0.05) 0%, rgba(249, 115, 22, 0.05) 100%);
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
    <div class="main-content p-6">
        <div class="wrapper max-w-15xl mx-auto">
            <!-- Header Section -->
            <div class="bg-white rounded-2xl shadow-xl p-8 mb-8 card-hover animate-fade-in-up border-l-4 border-orange-500">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="bg-gradient-to-r from-orange-500 to-red-500 p-3 rounded-full animate-pulse-glow">
                            <i class="fas fa-utensils text-white text-2xl"></i>
                        </div>
                        <div>
                            <h1 class="text-4xl font-bold bg-gradient-to-r from-orange-600 to-red-600 bg-clip-text text-transparent">
                                Order Management
                            </h1>
                            <p class="text-gray-600 mt-1">Manage your restaurant orders efficiently</p>
                        </div>
                    </div>
                    <div class="hidden md:flex items-center space-x-4">
                        <div class="text-right">
                            <p class="text-sm text-gray-500">Total Orders</p>
                            <?php 
                            $sn = 1; // Serial initially set to 1
                            // Get all orders 
                            $sql = "SELECT * FROM order_table ORDER BY id DESC"; // For displaying latest order

                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                            $order_1 = mysqli_num_rows($res);
                            ?>
                            <p class="text-2xl font-bold text-orange-600"><?php echo $count ?? 0; ?></p>
                        </div>
                        <div class="bg-orange-100 p-3 rounded-full">
                            <i class="fas fa-chart-line text-orange-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Message -->
            <?php 
            if(isset($_SESSION['update'])){
                echo '<div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r-lg animate-fade-in-up">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            <span>' . $_SESSION['update'] . '</span>
                        </div>
                      </div>';
                unset($_SESSION['update']);
            }
            ?>

            <!-- order Stats -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-4 gap-6 py-10">
                <div class="bg-white rounded-xl p-6 shadow-lg card-hover border-l-4 border-blue-500 animate-fade-in-up">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Total Orders</p>
                            <p class="text-2xl font-bold text-blue-600"><?php echo $count ?? 0; ?></p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <i class="fas fa-shopping-cart text-blue-600"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl p-6 shadow-lg card-hover border-l-4 border-orange-500 animate-fade-in-up">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Pending</p>
                            <p class="text-2xl font-bold text-orange-600">
                                <?php 
                                $pending_sql = "SELECT COUNT(*) as pending FROM order_table WHERE status != 'Delivered'";
                                $pending_res = mysqli_query($conn, $pending_sql);
                                $pending_count = mysqli_fetch_assoc($pending_res)['pending'] ?? 0;
                                echo $pending_count;
                                ?>
                            </p>
                        </div>
                        <div class="bg-orange-100 p-3 rounded-full">
                            <i class="fas fa-clock text-orange-600"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl p-6 shadow-lg card-hover border-l-4 border-green-500 animate-fade-in-up">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Delivered</p>
                            <p class="text-2xl font-bold text-green-600">
                                <?php 
                                $delivered_sql = "SELECT COUNT(*) as delivered FROM order_table WHERE status = 'Delivered'";
                                $delivered_res = mysqli_query($conn, $delivered_sql);
                                $delivered_count = mysqli_fetch_assoc($delivered_res)['delivered'] ?? 0;
                                echo $delivered_count;
                                ?>
                            </p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                            <i class="fas fa-check-circle text-green-600"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl p-6 shadow-lg card-hover border-l-4 border-red-500 animate-fade-in-up">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Revenue</p>
                            <p class="text-2xl font-bold text-red-600">
                                $<?php 
                                $revenue_sql = "SELECT SUM(total) as revenue FROM order_table WHERE status = 'Delivered'";
                                $revenue_res = mysqli_query($conn, $revenue_sql);
                                $revenue = mysqli_fetch_assoc($revenue_res)['revenue'] ?? 0;
                                echo number_format($revenue, 2);
                                ?>
                            </p>
                        </div>
                        <div class="bg-red-100 p-3 rounded-full">
                            <i class="fas fa-dollar-sign text-red-600"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Orders Table -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-fade-in-up">
                <div class="bg-gradient-to-r from-orange-600 to-red-600 p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="bg-white bg-opacity-20 p-2 rounded-lg">
                                <i class="fas fa-clipboard-list text-white text-xl"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-white">Recent Orders</h2>
                        </div>
                        <div class="bg-white bg-opacity-20 px-4 py-2 rounded-full">
                            <span class="text-white text-sm font-medium">Live Updates</span>
                            <div class="inline-block w-2 h-2 bg-green-400 rounded-full ml-2 animate-pulse"></div>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto custom-scrollbar">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">#</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-hamburger mr-2 text-orange-500"></i>Food
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-dollar-sign mr-2 text-green-500"></i>Price
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-sort-numeric-up mr-2 text-blue-500"></i>Qty
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-calculator mr-2 text-purple-500"></i>Total
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-calendar mr-2 text-indigo-500"></i>Date
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-info-circle mr-2 text-yellow-500"></i>Status
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-user mr-2 text-pink-500"></i>Customer
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-phone mr-2 text-teal-500"></i>Contact
                                </th>
                                <!-- <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-envelope mr-2 text-red-500"></i>Email
                                </th> -->
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-map-marker-alt mr-2 text-green-600"></i>Address
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-cogs mr-2 text-gray-500"></i>Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php 
                            $sn = 1; // Serial initially set to 1
                            // Get all orders 
                            $sql = "SELECT * FROM order_table ORDER BY id DESC"; // For displaying latest order

                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                            
                            if($count > 0){
                                while($row = mysqli_fetch_assoc($res)){
                                    $id = $row['id'];
                                    $food = $row['food'];
                                    $price = $row['price'];
                                    $qty = $row['quantity'];
                                    $total = $row['total'];
                                    $order_date = $row['order_date']; 
                                    $status = $row['status']; 
                                    $customer_name = $row['customer_name'];
                                    $customer_contact = $row['customer_contact'];
                                    $customer_email = $row['customer_email'];
                                    $customer_address = $row['customer_address'];
                                    ?>
                                    <tr class="table-row">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center justify-center w-8 h-8 bg-orange-100 rounded-full">
                                                <span class="text-sm font-semibold text-orange-600"><?php echo $sn++; ?></span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-gradient-to-r from-orange-400 to-red-400 rounded-lg flex items-center justify-center mr-3">
                                                    <i class="fas fa-utensils text-white text-sm"></i>
                                                </div>
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900"><?php echo $food; ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-sm font-semibold text-green-600">৳<?php echo $price; ?></span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="bg-blue-100 px-3 py-1 rounded-full text-center">
                                                <span class="text-sm font-medium text-blue-600"><?php echo $qty; ?></span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-lg font-bold text-purple-600"><?php echo $total; ?></span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            <div class="flex items-center">
                                                <i class="fas fa-clock mr-2 text-gray-400"></i>
                                                <?php echo $order_date; ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?php 
                                            if($status == "Ordered"){
                                                echo '<span class="status-badge inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        <div class="w-2 h-2 bg-blue-400 rounded-full mr-2 animate-pulse"></div>
                                                        ' . $status . '
                                                      </span>';
                                            }
                                            else if ($status == "On Delivery"){
                                                echo '<span class="status-badge inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                                        <div class="w-2 h-2 bg-orange-400 rounded-full mr-2 animate-pulse"></div>
                                                        ' . $status . '
                                                      </span>';
                                            }
                                            else if ($status == "Delivered"){
                                                echo '<span class="status-badge inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        <div class="w-2 h-2 bg-green-400 rounded-full mr-2"></div>
                                                        ' . $status . '
                                                      </span>';
                                            }
                                            else if ($status == "Cancelled"){
                                                echo '<span class="status-badge inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                        <div class="w-2 h-2 bg-red-400 rounded-full mr-2"></div>
                                                        ' . $status . '
                                                      </span>';
                                            }
                                            ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-gradient-to-r from-pink-400 to-purple-400 rounded-full flex items-center justify-center mr-3">
                                                    <i class="fas fa-user text-white text-xs"></i>
                                                </div>
                                                <div class="text-sm font-medium text-gray-900"><?php echo $customer_name; ?></div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-600 flex items-center">
                                                <i class="fas fa-phone mr-2 text-teal-500"></i>
                                                <?php echo $customer_contact; ?>
                                            </div>
                                        </td>
                                        <!-- <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-600 flex items-center">
                                                <i class="fas fa-envelope mr-2 text-red-500"></i>
                                                <?php echo $customer_email; ?>
                                            </div>
                                        </td> -->
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-600 max-w-xs truncate" title="<?php echo $customer_address; ?>">
                                                <i class="fas fa-map-marker-alt mr-2 text-green-600"></i>
                                                <?php echo $customer_address; ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" 
                                               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-orange-500 to-red-500 text-white text-sm font-medium rounded-lg hover:from-orange-600 hover:to-red-600 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                                                <i class="fas fa-edit mr-2"></i>
                                                Update Order
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            else{
                                echo '<tr>
                                        <td colspan="12" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                                    <i class="fas fa-clipboard-list text-4xl text-gray-400"></i>
                                                </div>
                                                <h3 class="text-lg font-medium text-gray-900 mb-2">No Orders Yet</h3>
                                                <p class="text-gray-500">Orders will appear here once customers start placing them.</p>
                                            </div>
                                        </td>
                                      </tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            
        </div>
    </div>

    <script>
        // Add some interactive animations
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
            const buttons = document.querySelectorAll('a[href*="update-order"]');
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

            // Auto-refresh status indicators
            setInterval(() => {
                const statusBadges = document.querySelectorAll('.status-badge');
                statusBadges.forEach(badge => {
                    if (badge.textContent.includes('On Delivery')) {
                        badge.style.animation = 'pulse 2s infinite';
                    }
                });
            }, 1000);
        });
    </script>
</body>
</html>

<?php include("partials/footer.php") ?>