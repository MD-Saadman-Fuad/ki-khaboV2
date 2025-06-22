<?php 
include("../config/constants.php");
include("login-check.php") ;

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animated Navigation Bar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="main main-content bg-gradient-to-br from-orange-200 via-amber-50 to-yellow-50 min-h-screen py- lg:py- relative overflow-hidden"">
  <div class="flex justify-center items-center py-2">
    <nav class="w-full max-w-5xl flex justify-between items-center">
      
      <!-- Logo (separate from rounded menu background) -->
      <div class="logo">
        <a href="<?php echo SITEURL; ?>" title="Logo">
          <img src="../images/logo.png" alt="Restaurant Logo" class="h-20 w-auto">
        </a>
      </div>

      <!-- Menu inside rounded background -->
      <div class="relative bg-gray-100 rounded-full px-1 py-1.2">
        <!-- Moving indicator -->
        <div id="indicator" class="absolute top-1 left-2 h-8 bg-orange-500 rounded-full transition-all duration-300 ease-in-out z-0" style="width: 100spx;"></div>

        <!-- Navigation items -->
        <div class="flex relative z-11">
          <a href="index.php" class="nav-item px-5 py-2.5 rounded-full text-sm font-medium transition-colors duration-300 text-white">Home</a>
                    <a href="manage-admin.php" class="nav-item px-5 py-2.5 rounded-full text-sm font-medium transition-colors duration-300 text-gray-600 hover:text-gray-800">Admin</a>
                    <a href="manage-category.php" class="nav-item px-5 py-2.5 rounded-full text-sm font-medium transition-colors duration-300 text-gray-600 hover:text-gray-800">Category</a>
                    <a href="manage-food.php" class="nav-item px-5 py-2.5 rounded-full text-sm font-medium transition-colors duration-300 text-gray-600 hover:text-gray-800">Food</a>
                    <a href="manage-order.php" class="nav-item px-5 py-2.5 rounded-full text-sm font-medium transition-colors duration-300 text-gray-600 hover:text-gray-800">Order</a>
                    <a href="logout.php" class="nav-item px-5 py-2.5 rounded-full text-sm font-medium transition-colors duration-300 text-gray-600 hover:text-gray-800">LogOut</a>
        </div>
      </div>

    </nav>
  </div>

  <script>
    const indicator = document.getElementById('indicator');
    const navItems = document.querySelectorAll('.nav-item');

    navItems.forEach(item => {
      item.addEventListener('mouseenter', () => {
        const itemRect = item.getBoundingClientRect();
        const parentRect = item.parentElement.getBoundingClientRect();
        const relativeLeft = itemRect.left - parentRect.left;

        indicator.style.left = relativeLeft + 4  + 'px';
        indicator.style.width = itemRect.width + 'px';

        navItems.forEach(navItem => {
          navItem.classList.remove('text-white');
          navItem.classList.add('text-gray-600');
        });
        item.classList.remove('text-gray-600');
        item.classList.add('text-white');
      });
    });

    // Reset to Home
    document.querySelector('.relative').addEventListener('mouseleave', () => {
      const homeItem = navItems[0];
      const homeRect = homeItem.getBoundingClientRect();
      const parentRect = homeItem.parentElement.getBoundingClientRect();
      const relativeLeft = homeRect.left - parentRect.left;

      indicator.style.left = relativeLeft + 'px';
      indicator.style.width = homeRect.width + 'px';

      navItems.forEach(navItem => {
        navItem.classList.remove('text-white');
        navItem.classList.add('text-gray-600');
      });
      homeItem.classList.remove('text-gray-600');
      homeItem.classList.add('text-white');
    });
  </script>