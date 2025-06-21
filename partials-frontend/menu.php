<?php include('config/constants.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Contact Us - Restaurant</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

<!-- Navbar -->
<nav class="bg-white shadow-md sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-20">

      <!-- Logo -->
      <a href="<?php echo SITEURL; ?>" class="flex items-center">
        <img src="images/logo.png" alt="Restaurant Logo" class="h-20 w-auto">
      </a>

      <!-- Mobile toggle -->
      <button id="nav-toggle" class="lg:hidden text-gray-700 focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
          <path d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>

      <!-- Desktop Menu -->
      <ul id="nav-menu" class="hidden lg:flex items-center space-x-6 font-medium text-gray-700">
        <li><a href="<?php echo SITEURL; ?>" class="hover:text-orange-500 transition duration-300">Home</a></li>
        <li><a href="<?php echo SITEURL; ?>categories.php" class="hover:text-orange-500 transition duration-300">Categories</a></li>
        <li><a href="<?php echo SITEURL; ?>foods.php" class="hover:text-orange-500 transition duration-300">Foods</a></li>
        <li><a href="<?php echo SITEURL; ?>contact.php" class="hover:text-orange-500 transition duration-300">Contact</a></li>
        <li>
          <a href="<?php echo SITEURL; ?>admin/login.php" class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition duration-300">
            Admin
          </a>
        </li>
      </ul>
    </div>

    <!-- Mobile Menu -->
    <div id="nav-mobile" class="lg:hidden hidden flex flex-col mt-4 space-y-2 text-gray-700 font-medium">
      <a href="<?php echo SITEURL; ?>" class="hover:text-orange-500 transition">Home</a>
      <a href="<?php echo SITEURL; ?>categories.php" class="hover:text-orange-500 transition">Categories</a>
      <a href="<?php echo SITEURL; ?>foods.php" class="hover:text-orange-500 transition">Foods</a>
      <a href="<?php echo SITEURL; ?>contact.php" class="hover:text-orange-500 transition">Contact</a>
      <a href="<?php echo SITEURL; ?>admin/login.php" class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition">
        Admin
      </a>
    </div>
  </div>
</nav>

<script>
  const toggleBtn = document.getElementById('nav-toggle');
  const mobileMenu = document.getElementById('nav-mobile');
  toggleBtn.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
  });
</script>
