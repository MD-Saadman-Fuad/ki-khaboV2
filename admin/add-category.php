<?php
include("partials/menu.php");
ob_start();

// Process form submission FIRST, before any HTML output
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
    $active = isset($_POST['active']) ? $_POST['active'] : "No";
    $image_name = "";

    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
        $original_name = $_FILES['image']['name'];
        // FIX 1: Use pathinfo() instead of explode() with end()
        $ext = pathinfo($original_name, PATHINFO_EXTENSION);
        $image_name = "Food_Category_" . rand(100, 999) . "." . $ext;

        $source_path = $_FILES['image']['tmp_name'];
        $destination_path = "../images/category/" . $image_name;

        $upload = move_uploaded_file($source_path, $destination_path);

        if (!$upload) {
            $_SESSION['upload'] = "<div class='text-red-600 font-medium'>Failed to Upload Image.</div>";
            ob_end_clean(); // Clear buffer before redirect
            header('location:' . SITEURL . 'admin/add-category.php');
            exit();
        }
    }

    // FIX 2: Use prepared statements to prevent SQL injection
    $sql = "INSERT INTO category SET title=?, image_name=?, featured=?, active=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $title, $image_name, $featured, $active);
    $res = mysqli_stmt_execute($stmt);

    if ($res == true) {
        $_SESSION['add'] = "<div class='text-green-600 font-medium'>Category Added Successfully.</div>";
        ob_end_clean(); // Clear buffer before redirect
        header('location:' . SITEURL . 'admin/manage-category.php');
        exit();
    } else {
        $_SESSION['add'] = "<div class='text-red-600 font-medium'>Failed to Add Category.</div>";
        ob_end_clean(); // Clear buffer before redirect
        header('location:' . SITEURL . 'admin/add-category.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category - Dashboard</title>
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
    <!-- Add Category Starts -->
    <div class="main-content py-10 px-4 min-h-screen">
        <div class="max-w-4xl mx-auto">
            <!-- Header Section -->
            <div class="bg-white rounded-2xl shadow-xl p-8 mb-8 card-hover animate-fade-in-up border-l-4 border-orange-500">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="bg-gradient-to-r from-orange-500 to-red-500 p-3 rounded-full animate-pulse-glow">
                            <i class="fas fa-plus-circle text-white text-2xl"></i>
                        </div>
                        <div>
                            <h1 class="text-4xl font-bold bg-gradient-to-r from-orange-600 to-red-600 bg-clip-text text-transparent">
                                Add Category
                            </h1>
                            <p class="text-gray-600 mt-1">Create a new food category for your restaurant</p>
                        </div>
                    </div>
                    <div class="hidden md:flex items-center space-x-3">
                        <a href="<?php echo SITEURL; ?>admin/manage-category.php" 
                           class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all duration-200 btn-hover">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Back to Categories
                        </a>
                    </div>
                </div>
            </div>

            <!-- Session Messages -->
            <?php
            $messages = ['add', 'upload'];
            foreach ($messages as $msg) {
                if (isset($_SESSION[$msg])) {
                    $isError = strpos($_SESSION[$msg], 'Failed') !== false || strpos($_SESSION[$msg], 'red') !== false;
                    $bgColor = $isError ? 'bg-red-100 border-red-200' : 'bg-green-100 border-green-200';
                    $textColor = $isError ? 'text-red-800' : 'text-green-800';
                    $iconColor = $isError ? 'text-red-500' : 'text-green-500';
                    $icon = $isError ? 'fas fa-exclamation-triangle' : 'fas fa-check-circle';
                    
                    echo "<div class='mb-6 p-4 rounded-xl {$bgColor} border-l-4 {$textColor} shadow-sm animate-fade-in-up'>
                            <div class='flex items-center'>
                                <i class='{$icon} {$iconColor} mr-3'></i>
                                <div class='font-medium'>{$_SESSION[$msg]}</div>
                            </div>
                          </div>";
                    unset($_SESSION[$msg]);
                }
            }
            ?>

            <!-- Add Form -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-fade-in-up">
                <div class="bg-gradient-to-r from-orange-600 to-red-600 p-6">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white bg-opacity-20 p-2 rounded-lg">
                            <i class="fas fa-tags text-white text-xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-white">Category Information</h2>
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
                                Category Title
                            </label>
                            <input type="text" 
                                   name="title" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 input-focus transition-all duration-200"
                                   placeholder="Enter category title (e.g., Pizza, Burgers, Desserts)"
                                   required>
                        </div>

                        <!-- Image Upload -->
                        <div class="space-y-4">
                            <label class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-image text-green-600 text-sm"></i>
                                </div>
                                Category Image
                            </label>
                            <div class="border-2 border-dashed border-orange-200 rounded-xl p-6 bg-orange-50 hover:bg-orange-100 transition-colors duration-200">
                                <div class="flex items-center justify-center">
                                    <label class="cursor-pointer flex flex-col items-center">
                                        <div class="w-12 h-12 bg-orange-200 rounded-full flex items-center justify-center mb-3">
                                            <i class="fas fa-cloud-upload-alt text-orange-600 text-xl"></i>
                                        </div>
                                        <span class="text-orange-700 font-medium">Choose Category Image</span>
                                        <span class="text-orange-500 text-sm mt-1">JPG, PNG, GIF up to 5MB</span>
                                        <input type="file" name="image" id="imageUpload" class="hidden" accept="image/*">
                                    </label>
                                </div>
                            </div>
                            
                            <!-- Image Preview -->
                            <div id="imagePreview" class="hidden border-2 border-dashed border-green-200 rounded-xl p-6 bg-green-50">
                                <div class="text-center">
                                    <h4 class="text-green-700 font-semibold mb-3 flex items-center justify-center">
                                        <i class="fas fa-eye mr-2"></i>
                                        Image Preview
                                    </h4>
                                    <div class="flex items-center justify-center">
                                        <div class="image-preview rounded-xl overflow-hidden shadow-lg border-4 border-white">
                                            <img id="previewImg" src="" alt="Image preview" class="w-48 h-32 object-cover">
                                        </div>
                                    </div>
                                    <p id="fileName" class="text-center text-sm text-green-600 mt-3 font-medium"></p>
                                    <button type="button" 
                                            onclick="clearImagePreview()" 
                                            class="mt-3 inline-flex items-center px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors duration-200">
                                        <i class="fas fa-times mr-2"></i>
                                        Remove Image
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Featured Section -->
                        <div class="space-y-4">
                            <label class="flex items-center text-sm font-semibold text-gray-700 mb-4">
                                <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-star text-yellow-600 text-sm"></i>
                                </div>
                                Featured Category
                            </label>
                            <div class="flex space-x-6">
                                <label class="radio-custom flex items-center cursor-pointer">
                                    <input type="radio" 
                                           name="featured" 
                                           value="Yes"
                                           class="mr-3">
                                    <span class="text-gray-700 font-medium">Yes</span>
                                </label>
                                <label class="radio-custom flex items-center cursor-pointer">
                                    <input type="radio" 
                                           name="featured" 
                                           value="No"
                                           checked
                                           class="mr-3">
                                    <span class="text-gray-700 font-medium">No</span>
                                </label>
                            </div>
                            <p class="text-sm text-gray-500">Featured categories appear prominently on the homepage</p>
                        </div>

                        <!-- Active Section -->
                        <div class="space-y-4">
                            <label class="flex items-center text-sm font-semibold text-gray-700 mb-4">
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-toggle-on text-green-600 text-sm"></i>
                                </div>
                                Category Status
                            </label>
                            <div class="flex space-x-6">
                                <label class="radio-custom flex items-center cursor-pointer">
                                    <input type="radio" 
                                           name="active" 
                                           value="Yes"
                                           checked
                                           class="mr-3">
                                    <span class="text-gray-700 font-medium">Active</span>
                                </label>
                                <label class="radio-custom flex items-center cursor-pointer">
                                    <input type="radio" 
                                           name="active" 
                                           value="No"
                                           class="mr-3">
                                    <span class="text-gray-700 font-medium">Inactive</span>
                                </label>
                            </div>
                            <p class="text-sm text-gray-500">Only active categories are visible to customers</p>
                        </div>

                        <!-- Submit Section -->
                        <div class="border-t border-gray-200 pt-8">
                            <div class="flex items-center justify-between">
                                <a href="<?php echo SITEURL; ?>admin/manage-category.php"
                                   class="inline-flex items-center px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-all duration-200 btn-hover">
                                    <i class="fas fa-times mr-2"></i>
                                    Cancel
                                </a>
                                
                                <button type="submit" 
                                        name="submit"
                                        class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-green-500 to-emerald-500 text-white font-semibold rounded-xl hover:from-green-600 hover:to-emerald-600 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl btn-hover">
                                    <i class="fas fa-plus mr-2"></i>
                                    Add Category
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Category Ends -->

    <script>
        // Clear image preview function
        function clearImagePreview() {
            const fileInput = document.getElementById('imageUpload');
            const previewDiv = document.getElementById('imagePreview');
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
            const previewDiv = document.getElementById('imagePreview');
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

            // Form validation with visual feedback
            const form = document.querySelector('form');
            const titleInput = document.querySelector('input[name="title"]');
            
            form.addEventListener('submit', function(e) {
                if (titleInput.value.trim() === '') {
                    e.preventDefault();
                    titleInput.focus();
                    titleInput.style.borderColor = '#ef4444';
                    titleInput.style.boxShadow = '0 0 0 3px rgba(239, 68, 68, 0.2)';
                    
                    setTimeout(() => {
                        titleInput.style.borderColor = '';
                        titleInput.style.boxShadow = '';
                    }, 3000);
                }
            });

            // Input field enhancements
            const inputs = document.querySelectorAll('input[type="text"]');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.querySelector('label').style.color = '#fb923c';
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.querySelector('label').style.color = '';
                });
            });
        });
    </script>
</body>
</html>

<?php include("partials/footer.php"); ?>
<?php ob_end_flush(); ?>