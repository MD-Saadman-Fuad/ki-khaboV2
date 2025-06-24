<?php include('partials/menu.php'); ?>

<?php
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $total = $price * $qty;
        $status = $_POST['status'];
        $customer_name = $_POST['customer_name'];
        $customer_contact = $_POST['customer_contact'];
        $customer_email = $_POST['customer_email'];
        $customer_address = $_POST['customer_address'];

        // FIX: Use prepared statements to prevent SQL injection
        $sql2 = "UPDATE order_table SET
                quantity = ?,
                total = ?,
                status = ?,
                customer_name = ?,
                customer_contact = ?,
                customer_email = ?,
                customer_address = ?
                WHERE id = ?";

        $stmt = mysqli_prepare($conn, $sql2);
        // FIXED: Correct type definition string with 8 characters for 8 variables
        // i = integer (qty), d = decimal (total), s = string (status, names, contact, email, address), i = integer (id)
        mysqli_stmt_bind_param($stmt, "idsssssi", $qty, $total, $status, $customer_name, $customer_contact, $customer_email, $customer_address, $id);
        $res2 = mysqli_stmt_execute($stmt);

        if ($res2 == true) {
            $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";
            header('location:' . SITEURL . 'admin/manage-order.php');
            exit();
        } else {
            $_SESSION['update'] = "<div class='error'>Failed to Update Order.</div>";
            header('location:' . SITEURL . 'admin/manage-order.php');
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Order - Dashboard</title>
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

        .input-focus {
            transition: all 0.3s ease;
        }

        .input-focus:focus {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(251, 146, 60, 0.15);
        }

        .status-badge {
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .status-ordered {
            background-color: #fef3c7;
            color: #d97706;
        }

        .status-delivery {
            background-color: #bfdbfe;
            color: #1d4ed8;
        }

        .status-delivered {
            background-color: #bbf7d0;
            color: #059669;
        }

        .status-cancelled {
            background-color: #fecaca;
            color: #dc2626;
        }

        .order-summary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 1rem;
            padding: 1.5rem;
            color: white;
            margin-bottom: 2rem;
        }

        .info-card {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border-left: 4px solid #f97316;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-orange-50 via-white to-red-50 min-h-screen">
    <!-- Update Order Starts -->
    <div class="main-content py-10 px-4 min-h-screen">
        <div class="max-w-4xl mx-auto">
            <!-- Header Section -->
            <div class="bg-white rounded-2xl shadow-xl p-8 mb-8 card-hover animate-fade-in-up border-l-4 border-orange-500">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="bg-gradient-to-r from-orange-500 to-red-500 p-3 rounded-full animate-pulse-glow">
                            <i class="fas fa-receipt text-white text-2xl"></i>
                        </div>
                        <div>
                            <h1 class="text-4xl font-bold bg-gradient-to-r from-orange-600 to-red-600 bg-clip-text text-transparent">
                                Update Order
                            </h1>
                            <p class="text-gray-600 mt-1">Modify order details, status, and customer information</p>
                        </div>
                    </div>
                    <div class="hidden md:flex items-center space-x-3">
                        <a href="<?php echo SITEURL; ?>admin/manage-order.php" 
                           class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all duration-200 btn-hover">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Back to Orders
                        </a>
                    </div>
                </div>
            </div>

            <?php
            // Check whether id is set or not 
            if (isset($_GET['id'])) {
                $id = $_GET['id'];

                // FIX: Use prepared statement for SELECT query
                $sql = "SELECT * FROM order_table WHERE id = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "i", $id);
                mysqli_stmt_execute($stmt);
                $res = mysqli_stmt_get_result($stmt);
                $count = mysqli_num_rows($res);

                if ($count == 1) {
                    $row = mysqli_fetch_assoc($res);
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
                } else {
                    $_SESSION['no-order-found'] = "<div class='error'>Order Not Found.</div>";
                    header('location:' . SITEURL . 'admin/manage-order.php');
                    exit();
                }
            } else {
                header('location:' . SITEURL . 'admin/manage-order.php');
                exit();
            }
            ?>

            <!-- Order Summary Card -->
            <div class="order-summary animate-fade-in-up mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-2xl font-bold flex items-center">
                        <i class="fas fa-shopping-cart mr-3"></i>
                        Order Summary
                    </h3>
                    <div class="status-badge <?php 
                        echo $status == 'Ordered' ? 'status-ordered' : 
                            ($status == 'On Delivery' ? 'status-delivery' : 
                            ($status == 'Delivered' ? 'status-delivered' : 'status-cancelled')); 
                    ?>">
                        <i class="fas fa-circle mr-2 text-xs"></i>
                        <?php echo htmlspecialchars($status); ?>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="bg-white bg-opacity-20 rounded-lg p-4">
                        <div class="text-white text-opacity-80 text-sm">Order ID</div>
                        <div class="text-2xl font-bold">#<?php echo htmlspecialchars($id); ?></div>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-lg p-4">
                        <div class="text-white text-opacity-80 text-sm">Food Item</div>
                        <div class="text-lg font-semibold"><?php echo htmlspecialchars($food); ?></div>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-lg p-4">
                        <div class="text-white text-opacity-80 text-sm">Order Date</div>
                        <div class="text-lg font-semibold"><?php echo date('M d, Y', strtotime($order_date)); ?></div>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-lg p-4">
                        <div class="text-white text-opacity-80 text-sm">Total Amount</div>
                        <div class="text-2xl font-bold">$<?php echo number_format($total, 2); ?></div>
                    </div>
                </div>
            </div>

            <!-- Update Form -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-fade-in-up">
                <div class="bg-gradient-to-r from-orange-600 to-red-600 p-6">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white bg-opacity-20 p-2 rounded-lg">
                            <i class="fas fa-edit text-white text-xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-white">Order Information</h2>
                    </div>
                </div>

                <div class="p-8">
                    <form action="" method="POST" class="space-y-8">
                        <!-- Order Details Section -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Food Information -->
                            <div class="info-card">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-utensils text-blue-600 text-sm"></i>
                                    </div>
                                    Food Details
                                </h3>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Food Name</label>
                                        <div class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 font-semibold">
                                            <?php echo htmlspecialchars($food); ?>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Unit Price</label>
                                        <div class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 font-semibold">
                                            $<?php echo number_format($price, 2); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Quantity & Status -->
                            <div class="info-card">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-cog text-green-600 text-sm"></i>
                                    </div>
                                    Order Settings
                                </h3>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Quantity</label>
                                        <input type="number" 
                                               name="qty" 
                                               value="<?php echo htmlspecialchars($qty); ?>"
                                               min="1"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 input-focus transition-all duration-200"
                                               required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Order Status</label>
                                        <select name="status"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 input-focus transition-all duration-200 bg-white">
                                            <option value="Ordered" <?php if($status == 'Ordered') echo "selected"; ?>>
                                                🔄 Ordered
                                            </option>
                                            <option value="On Delivery" <?php if($status == 'On Delivery') echo "selected"; ?>>
                                                🚚 On Delivery
                                            </option>
                                            <option value="Delivered" <?php if($status == 'Delivered') echo "selected"; ?>>
                                                ✅ Delivered
                                            </option>
                                            <option value="Cancelled" <?php if($status == 'Cancelled') echo "selected"; ?>>
                                                ❌ Cancelled
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Customer Information Section -->
                        <div class="border-t border-gray-200 pt-8">
                            <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                                <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center mr-4">
                                    <i class="fas fa-user text-purple-600"></i>
                                </div>
                                Customer Information
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Customer Name -->
                                <div class="space-y-2">
                                    <label class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                                        <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-user text-indigo-600 text-sm"></i>
                                        </div>
                                        Full Name
                                    </label>
                                    <input type="text" 
                                           name="customer_name" 
                                           value="<?php echo htmlspecialchars($customer_name); ?>"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 input-focus transition-all duration-200"
                                           placeholder="Enter customer name"
                                           required>
                                </div>

                                <!-- Customer Contact -->
                                <div class="space-y-2">
                                    <label class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-phone text-green-600 text-sm"></i>
                                        </div>
                                        Phone Number
                                    </label>
                                    <input type="tel" 
                                           name="customer_contact" 
                                           value="<?php echo htmlspecialchars($customer_contact); ?>"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 input-focus transition-all duration-200"
                                           placeholder="Enter phone number"
                                           required>
                                </div>

                                <!-- Customer Email -->
                                <div class="space-y-2 md:col-span-2">
                                    <label class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                                        <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-envelope text-red-600 text-sm"></i>
                                        </div>
                                        Email Address
                                    </label>
                                    <input type="email" 
                                           name="customer_email" 
                                           value="<?php echo htmlspecialchars($customer_email); ?>"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 input-focus transition-all duration-200"
                                           placeholder="Enter email address"
                                           required>
                                </div>

                                <!-- Customer Address -->
                                <div class="space-y-2 md:col-span-2">
                                    <label class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                                        <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-map-marker-alt text-yellow-600 text-sm"></i>
                                        </div>
                                        Delivery Address
                                    </label>
                                    <textarea name="customer_address" 
                                              rows="4" 
                                              class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 input-focus transition-all duration-200 resize-none"
                                              placeholder="Enter complete delivery address"
                                              required><?php echo htmlspecialchars($customer_address); ?></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden Fields and Submit -->
                        <div class="border-t border-gray-200 pt-8">
                            <div class="flex items-center justify-between">
                                <a href="<?php echo SITEURL; ?>admin/manage-order.php"
                                   class="inline-flex items-center px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-all duration-200 btn-hover">
                                    <i class="fas fa-times mr-2"></i>
                                    Cancel
                                </a>
                                
                                <div class="flex space-x-4">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                                    <input type="hidden" name="price" value="<?php echo htmlspecialchars($price); ?>">
                                    <button type="submit" 
                                            name="submit"
                                            class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold rounded-xl hover:from-orange-600 hover:to-red-600 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl btn-hover">
                                        <i class="fas fa-save mr-2"></i>
                                        Update Order
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Update Order Ends -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add ripple effect to buttons
            const buttons = document.querySelectorAll('.btn-hover');
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

            // Animate form elements on load
            const formElements = document.querySelectorAll('.info-card, .space-y-2, .space-y-4');
            formElements.forEach((element, index) => {
                element.style.opacity = '0';
                element.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    element.style.transition = 'all 0.6s ease';
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }, index * 100);
            });

            // Auto-calculate total when quantity changes
            const qtyInput = document.querySelector('input[name="qty"]');
            if (qtyInput) {
                qtyInput.addEventListener('input', function() {
                    const price = <?php echo $price; ?>;
                    const qty = parseInt(this.value) || 0;
                    const total = price * qty;
                    
                    // Update the total display in the summary card
                    const totalDisplay = document.querySelector('.order-summary .text-2xl.font-bold');
                    if (totalDisplay && totalDisplay.textContent.includes('$')) {
                        totalDisplay.textContent = '$' + total.toFixed(2);
                    }
                });
            }

            // Status change animation
            const statusSelect = document.querySelector('select[name="status"]');
            if (statusSelect) {
                statusSelect.addEventListener('change', function() {
                    this.style.transform = 'scale(1.05)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 150);
                });
            }
        });
    </script>
</body>
</html>

<?php include("partials/footer.php") ?>