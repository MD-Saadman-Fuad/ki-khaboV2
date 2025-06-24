<?php include('partials/menu.php'); ?>

<?php
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $current_image = $_POST['current_image'];
        $category = $_POST['category'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        if (isset($_FILES['image']['name'])) {
            $image_name = $_FILES['image']['name'];

            if ($image_name != "") {
                // FIX 1: Use pathinfo() instead of explode() with end()
                $ext = pathinfo($image_name, PATHINFO_EXTENSION);
                $image_name = "Food_Item_" . rand(000, 999) . '.' . $ext;
                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/food/" . $image_name;

                //Finally Upload the Image
                $upload = move_uploaded_file($source_path, $destination_path);

                if ($upload == false) {
                    $_SESSION['upload'] = "<div class='red'>Failed to Upload Image. </div>";
                    header('location:' . SITEURL . 'admin/manage-food.php');
                    die();
                }

                // FIX 2: Check if current image file actually exists before trying to delete
                if ($current_image != "") {
                    $remove_path = "../images/food/" . $current_image;
                    if (file_exists($remove_path)) {
                        $remove = unlink($remove_path);
                        if ($remove == false) {
                            $_SESSION['failed-remove'] = "<div class='red'>Failed to remove current Image.</div>";
                            header('location:' . SITEURL . 'admin/manage-food.php');
                            die();
                        }
                    }
                    // If file doesn't exist, we just continue without error
                }
            } else {
                $image_name = $current_image;
            }
        } else {
            $image_name = $current_image;
        }

        // FIX 3: Use prepared statements to prevent SQL injection
        $sql3 = "UPDATE food SET 
                title = ?,
                description = ?,
                price = ?,
                image_name = ?,
                category_id = ?,
                featured = ?,
                active = ? 
                WHERE id = ?";

        $stmt = mysqli_prepare($conn, $sql3);
        mysqli_stmt_bind_param($stmt, "ssdsissi", $title, $description, $price, $image_name, $category, $featured, $active, $id);
        $res3 = mysqli_stmt_execute($stmt);

        if ($res3 == true) {
            $_SESSION['update'] = "<div class='green'>Food Item Updated Successfully.</div>";
            header('location:' . SITEURL . 'admin/manage-food.php');
            exit(); // FIX 4: Use exit() instead of just header redirect
        } else {
            $_SESSION['update'] = "<div class='red'>Failed to Update Food Item.</div>";
            header('location:' . SITEURL . 'admin/manage-food.php');
            exit(); // FIX 4: Use exit() instead of just header redirect
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Food Item - Dashboard</title>
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

        .image-preview {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .image-preview:hover {
            transform: scale(1.05);
        }

        .image-preview::after {
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

        .image-preview:hover::after {
            opacity: 1;
        }

        .radio-custom {
            position: relative;
            /* This is crucial! */
        }

        .radio-custom input[type="radio"] {
            appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid #d1d5db;
            border-radius: 50%;
            background: white;
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
            /* Add this for better positioning context */
        }

        .radio-custom input[type="radio"]:checked {
            border-color: #fb923c;
            background: #fb923c;
            box-shadow: 0 0 0 3px rgba(251, 146, 60, 0.2);
        }

        .radio-custom input[type="radio"]:checked::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 8px;
            height: 8px;
            background: white;
            border-radius: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-orange-50 via-white to-red-50 min-h-screen">
    <!-- Update Food Starts -->
    <div class="main-content py-10 px-4 min-h-screen">
        <div class="max-w-4xl mx-auto">
            <!-- Header Section -->
            <div class="bg-white rounded-2xl shadow-xl p-8 mb-8 card-hover animate-fade-in-up border-l-4 border-orange-500">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="bg-gradient-to-r from-orange-500 to-red-500 p-3 rounded-full animate-pulse-glow">
                            <i class="fas fa-utensils text-white text-2xl"></i>
                        </div>
                        <div>
                            <h1 class="text-4xl font-bold bg-gradient-to-r from-orange-600 to-red-600 bg-clip-text text-transparent">
                                Update Food Item
                            </h1>
                            <p class="text-gray-600 mt-1">Modify food details, pricing, and settings</p>
                        </div>
                    </div>
                    <div class="hidden md:flex items-center space-x-3">
                        <a href="<?php echo SITEURL; ?>admin/manage-food.php" 
                           class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all duration-200 btn-hover">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Back to Food Items
                        </a>
                    </div>
                </div>
            </div>

            <?php
            //Check whether id is set or not 
            if (isset($_GET['id'])) {
                //Get all the details
                $id = $_GET['id'];

                // FIX 5: Use prepared statement for SELECT query too
                $sql2 = "SELECT * FROM food WHERE id = ?";
                $stmt = mysqli_prepare($conn, $sql2);
                mysqli_stmt_bind_param($stmt, "i", $id);
                mysqli_stmt_execute($stmt);
                $res2 = mysqli_stmt_get_result($stmt);
                $count = mysqli_num_rows($res2);

                if ($count == 1) {
                    $row2 = mysqli_fetch_assoc($res2);
                    //Get the Individual Values of Selected Food
                    $title = $row2['title'];
                    $description = $row2['description'];
                    $price = $row2['price'];
                    $current_image = $row2['image_name'];
                    $current_category = $row2['category_id'];
                    $featured = $row2['featured'];
                    $active = $row2['active'];
                } else {
                    $_SESSION['no-food-found'] = "<div class='red'>Food Item Not Found.</div>";
                    header('location:' . SITEURL . 'admin/manage-food.php');
                    exit();
                }
            } else {
                //Redirect to Manage Food
                header('location:' . SITEURL . 'admin/manage-food.php');
                exit();
            }
            ?>

            <!-- Update Form -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-fade-in-up">
                <div class="bg-gradient-to-r from-orange-600 to-red-600 p-6">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white bg-opacity-20 p-2 rounded-lg">
                            <i class="fas fa-hamburger text-white text-xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-white">Food Item Information</h2>
                    </div>
                </div>

                <div class="p-8">
                    <form action="" method="POST" enctype="multipart/form-data" class="space-y-8">
                        <!-- Title Field -->
                        <div class="space-y-2">
                            <label class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-tag text-blue-600 text-sm"></i>
                                </div>
                                Food Title
                            </label>
                            <input type="text" 
                                   name="title" 
                                   value="<?php echo htmlspecialchars($title); ?>"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 input-focus transition-all duration-200"
                                   placeholder="Enter food item title"
                                   required>
                        </div>

                        <!-- Description Field -->
                        <div class="space-y-2">
                            <label class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-align-left text-green-600 text-sm"></i>
                                </div>
                                Description
                            </label>
                            <textarea name="description" 
                                      rows="5" 
                                      class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 input-focus transition-all duration-200 resize-none"
                                      placeholder="Enter food item description"><?php echo htmlspecialchars($description); ?></textarea>
                        </div>

                        <!-- Price Field -->
                        <div class="space-y-2">
                            <label class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                                <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-dollar-sign text-yellow-600 text-sm"></i>
                                </div>
                                Price
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 text-lg">$</span>
                                </div>
                                <input type="number" 
                                       name="price" 
                                       value="<?php echo htmlspecialchars($price); ?>"
                                       step="0.01"
                                       min="0"
                                       class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 input-focus transition-all duration-200"
                                       placeholder="0.00"
                                       required>
                            </div>
                        </div>

                        <!-- Current Image -->
                        <div class="space-y-4">
                            <label class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-image text-purple-600 text-sm"></i>
                                </div>
                                Current Image
                            </label>
                            <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 bg-gray-50">
                                <?php if ($current_image != ""): ?>
                                    <div class="flex items-center justify-center">
                                        <div class="image-preview rounded-xl overflow-hidden shadow-lg border-4 border-white">
                                            <img src="<?php echo SITEURL; ?>images/food/<?php echo htmlspecialchars($current_image); ?>" 
                                                 alt="Current food image"
                                                 class="w-48 h-32 object-cover">
                                        </div>
                                    </div>
                                    <p class="text-center text-sm text-gray-500 mt-3">Current: <?php echo htmlspecialchars($current_image); ?></p>
                                <?php else: ?>
                                    <div class="text-center py-8">
                                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                            <i class="fas fa-image-slash text-red-400 text-2xl"></i>
                                        </div>
                                        <p class="text-red-500 font-medium">No Image Currently Added</p>
                                        <p class="text-gray-500 text-sm mt-1">Upload a new image below</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- New Image Upload -->
                        <div class="space-y-4">
                            <label class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-upload text-green-600 text-sm"></i>
                                </div>
                                Upload New Image (Optional)
                            </label>
                            <div class="border-2 border-dashed border-orange-200 rounded-xl p-6 bg-orange-50 hover:bg-orange-100 transition-colors duration-200">
                                <div class="flex items-center justify-center">
                                    <label class="cursor-pointer flex flex-col items-center">
                                        <div class="w-12 h-12 bg-orange-200 rounded-full flex items-center justify-center mb-3">
                                            <i class="fas fa-cloud-upload-alt text-orange-600 text-xl"></i>
                                        </div>
                                        <span class="text-orange-700 font-medium">Choose New Image</span>
                                        <span class="text-orange-500 text-sm mt-1">JPG, PNG, GIF up to 5MB</span>
                                        <input type="file" name="image" id="imageUpload" class="hidden" accept="image/*">
                                    </label>
                                </div>
                            </div>
                            
                            <!-- New Image Preview -->
                            <div id="newImagePreview" class="hidden border-2 border-dashed border-green-200 rounded-xl p-6 bg-green-50">
                                <div class="text-center">
                                    <h4 class="text-green-700 font-semibold mb-3 flex items-center justify-center">
                                        <i class="fas fa-eye mr-2"></i>
                                        New Image Preview
                                    </h4>
                                    <div class="flex items-center justify-center">
                                        <div class="image-preview rounded-xl overflow-hidden shadow-lg border-4 border-white">
                                            <img id="previewImg" src="" alt="New image preview" class="w-48 h-32 object-cover">
                                        </div>
                                    </div>
                                    <p id="fileName" class="text-center text-sm text-green-600 mt-3 font-medium"></p>
                                    <button type="button" 
                                            onclick="clearImagePreview()" 
                                            class="mt-3 inline-flex items-center px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors duration-200">
                                        <i class="fas fa-times mr-2"></i>
                                        Remove New Image
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Category Selection -->
                        <div class="space-y-4">
                            <label class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                                <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-list text-indigo-600 text-sm"></i>
                                </div>
                                Category
                            </label>
                            <select name="category"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 input-focus transition-all duration-200 bg-white">
                                <?php 
                                    //Query to Get Active Categories
                                    $sql = "SELECT * FROM category WHERE active='Yes'";
                                    //Execute the Query
                                    $res = mysqli_query($conn, $sql);
                                    //Count Rows
                                    $count = mysqli_num_rows($res);

                                    //Check whether category available or not
                                    if ($count > 0) {
                                        //Category Available
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $category_title = $row['title'];
                                            $category_id = $row['id'];
                                            ?>
                                            <option <?php if($current_category == $category_id) { echo "selected"; } ?> 
                                                    value="<?php echo $category_id; ?>">
                                                <?php echo htmlspecialchars($category_title); ?>
                                            </option>
                                            <?php
                                        }
                                    } else {
                                        //Category Not Available
                                        echo "<option value='0'>Category Not Available.</option>";
                                    }
                                ?>
                            </select>
                        </div>

                        <!-- Featured Section -->
                        <div class="space-y-4">
                            <label class="flex items-center text-sm font-semibold text-gray-700 mb-4">
                                <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-star text-yellow-600 text-sm"></i>
                                </div>
                                Featured Food Item
                            </label>
                            <div class="flex space-x-6">
                                <label class="radio-custom flex items-center cursor-pointer">
                                    <input type="radio" 
                                           name="featured" 
                                           value="Yes"
                                           <?php if ($featured == 'Yes') echo "checked"; ?>
                                           class="mr-3">
                                    <span class="text-gray-700 font-medium">Yes</span>
                                </label>
                                <label class="radio-custom flex items-center cursor-pointer">
                                    <input type="radio" 
                                           name="featured" 
                                           value="No"
                                           <?php if ($featured == 'No') echo "checked"; ?>
                                           class="mr-3">
                                    <span class="text-gray-700 font-medium">No</span>
                                </label>
                            </div>
                            <p class="text-sm text-gray-500">Featured items appear prominently on the homepage</p>
                        </div>

                        <!-- Active Section -->
                        <div class="space-y-4">
                            <label class="flex items-center text-sm font-semibold text-gray-700 mb-4">
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-toggle-on text-green-600 text-sm"></i>
                                </div>
                                Food Item Status
                            </label>
                            <div class="flex space-x-6">
                                <label class="radio-custom flex items-center cursor-pointer">
                                    <input type="radio" 
                                           name="active" 
                                           value="Yes"
                                           <?php if ($active == 'Yes') echo "checked"; ?>
                                           class="mr-3">
                                    <span class="text-gray-700 font-medium">Active</span>
                                </label>
                                <label class="radio-custom flex items-center cursor-pointer">
                                    <input type="radio" 
                                           name="active" 
                                           value="No"
                                           <?php if ($active == 'No') echo "checked"; ?>
                                           class="mr-3">
                                    <span class="text-gray-700 font-medium">Inactive</span>
                                </label>
                            </div>
                            <p class="text-sm text-gray-500">Only active items are visible to customers</p>
                        </div>

                        <!-- Hidden Fields and Submit -->
                        <div class="border-t border-gray-200 pt-8">
                            <div class="flex items-center justify-between">
                                <a href="<?php echo SITEURL; ?>admin/manage-food.php"
                                   class="inline-flex items-center px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-all duration-200 btn-hover">
                                    <i class="fas fa-times mr-2"></i>
                                    Cancel
                                </a>
                                
                                <div class="flex space-x-4">
                                    <input type="hidden" name="current_image" value="<?php echo htmlspecialchars($current_image); ?>">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                                    <button type="submit" 
                                            name="submit"
                                            class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold rounded-xl hover:from-orange-600 hover:to-red-600 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl btn-hover">
                                        <i class="fas fa-save mr-2"></i>
                                        Update Food Item
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Update Food Ends -->

    <script>
        // Clear image preview function
        function clearImagePreview() {
            const fileInput = document.getElementById('imageUpload');
            const previewDiv = document.getElementById('newImagePreview');
            const previewImg = document.getElementById('previewImg');
            const fileName = document.getElementById('fileName');
            
            // Clear the file input
            fileInput.value = '';
            
            // Hide preview
            previewDiv.classList.add('hidden');
            
            // Clear preview image
            previewImg.src = '';
            fileName.textContent = '';
        }

        // Add interactive animations
        document.addEventListener('DOMContentLoaded', function() {
            // File input preview
            const fileInput = document.getElementById('imageUpload');
            const previewDiv = document.getElementById('newImagePreview');
            const previewImg = document.getElementById('previewImg');
            const fileName = document.getElementById('fileName');
            
            if (fileInput) {
                fileInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        // Check if file is an image
                        if (file.type.startsWith('image/')) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                // Show preview
                                previewImg.src = e.target.result;
                                fileName.textContent = `Selected: ${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)`;
                                previewDiv.classList.remove('hidden');
                                
                                // Add animation
                                previewDiv.style.opacity = '0';
                                previewDiv.style.transform = 'translateY(20px)';
                                setTimeout(() => {
                                    previewDiv.style.transition = 'all 0.5s ease';
                                    previewDiv.style.opacity = '1';
                                    previewDiv.style.transform = 'translateY(0)';
                                }, 10);
                            };
                            reader.readAsDataURL(file);
                        } else {
                            alert('Please select a valid image file (JPG, PNG, GIF)');
                            fileInput.value = '';
                        }
                    } else {
                        // Hide preview if no file selected
                        previewDiv.classList.add('hidden');
                    }
                });
            }

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
            const formElements = document.querySelectorAll('.space-y-2, .space-y-4');
            formElements.forEach((element, index) => {
                element.style.opacity = '0';
                element.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    element.style.transition = 'all 0.6s ease';
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }, index * 100);
            });

            // Radio button animations
            const radioInputs = document.querySelectorAll('input[type="radio"]');
            radioInputs.forEach(radio => {
                radio.addEventListener('change', function() {
                    this.parentElement.style.transform = 'scale(1.05)';
                    setTimeout(() => {
                        this.parentElement.style.transform = 'scale(1)';
                    }, 150);
                });
            });
        });
    </script>
</body>
</html>

<?php include("partials/footer.php") ?>