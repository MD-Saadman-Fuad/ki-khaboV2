<?php include('config/constants.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ki Khabo — Delicious Food Delivered</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            fontFamily: {
              sans: ['Plus Jakarta Sans', 'sans-serif'],
            },
          }
        }
      }
    </script>
    <link rel="icon" type="image/x-icon" href="images/logo.png">
</head>
<body class="bg-stone-50 text-stone-800 font-sans antialiased min-h-screen flex flex-col justify-between selection:bg-orange-500 selection:text-white">
  
  <!-- Sticky Header Bar -->
  <header class="sticky top-0 z-50 backdrop-blur-md bg-white/90 border-b border-stone-200/70 shadow-xs">
    <div class="container mx-auto px-4 max-w-6xl flex justify-between items-center py-2.5">
      
      <!-- Brand Logo -->
      <a href="<?php echo SITEURL; ?>" class="flex items-center gap-2 group transition transform hover:scale-105">
        <img src="images/logo.png" alt="Ki Khabo Logo" class="h-12 w-auto object-contain">
      </a>

      <!-- Navigation Capsule (Center) -->
      <div class="relative bg-stone-100/90 p-1 rounded-full border border-stone-200/70 shadow-inner hidden md:block">
        <!-- Moving background indicator -->
        <div id="indicator" class="absolute top-1 left-1 h-9 bg-gradient-to-r from-orange-500 to-amber-500 rounded-full transition-all duration-300 ease-out shadow-md shadow-orange-500/25 z-0" style="width: 72px;"></div>

        <!-- Navigation items -->
        <div class="flex relative z-10 items-center">
          <a href="<?php echo SITEURL; ?>" class="nav-item px-5 py-2 rounded-full text-sm font-bold transition-colors duration-300 text-white">Home</a>
          <a href="<?php echo SITEURL; ?>categories.php" class="nav-item px-5 py-2 rounded-full text-sm font-semibold transition-colors duration-300 text-stone-600 hover:text-stone-900">Categories</a>
          <a href="<?php echo SITEURL; ?>foods.php" class="nav-item px-5 py-2 rounded-full text-sm font-semibold transition-colors duration-300 text-stone-600 hover:text-stone-900">Foods</a>
          <a href="<?php echo SITEURL; ?>contact.php" class="nav-item px-5 py-2 rounded-full text-sm font-semibold transition-colors duration-300 text-stone-600 hover:text-stone-900">Contact</a>
          <a href="<?php echo SITEURL; ?>admin/login.php" class="nav-item px-5 py-2 rounded-full text-sm font-semibold transition-colors duration-300 text-stone-600 hover:text-stone-900">Admin</a>
        </div>
      </div>

      <!-- Right Header Actions (Cart Widget) -->
      <?php 
        $cart_count = 0;
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
          foreach($_SESSION['cart'] as $item) {
            $cart_count += (int)$item['qty'];
          }
        }
      ?>
      <div class="flex items-center gap-3">
        <!-- Standalone Shopping Cart Button with Notification Badge -->
        <a href="<?php echo SITEURL; ?>cart.php" 
           class="relative flex items-center justify-center w-11 h-11 bg-white hover:bg-orange-50 border border-stone-200/80 rounded-full shadow-sm hover:shadow-md transition-all duration-300 group"
           title="View Shopping Cart">
          <svg class="w-5 h-5 text-stone-700 group-hover:text-orange-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 0a2 2 0 100 4 2 2 0 000-4z"></path>
          </svg>
          
          <?php if ($cart_count > 0): ?>
            <span class="absolute -top-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full bg-gradient-to-r from-orange-600 to-amber-600 text-[11px] font-extrabold text-white shadow-md ring-2 ring-white animate-bounce">
              <?php echo $cart_count; ?>
            </span>
          <?php else: ?>
            <span class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-stone-200 text-[9px] font-bold text-stone-500 ring-2 ring-white">
              0
            </span>
          <?php endif; ?>
        </a>
      </div>

    </div>
  </header>

  <main class="flex-grow">

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const indicator = document.getElementById('indicator');
      const navItems = document.querySelectorAll('.nav-item');
      const navContainer = indicator.parentElement;

      function moveIndicatorTo(item) {
        if (!item) return;
        const itemRect = item.getBoundingClientRect();
        const parentRect = navContainer.getBoundingClientRect();
        const relativeLeft = itemRect.left - parentRect.left;

        indicator.style.left = relativeLeft + 'px';
        indicator.style.width = itemRect.width + 'px';

        navItems.forEach(navItem => {
          navItem.classList.remove('text-white', 'font-bold');
          navItem.classList.add('text-stone-600', 'font-semibold');
        });
        item.classList.remove('text-stone-600', 'font-semibold');
        item.classList.add('text-white', 'font-bold');
      }

      // Initialize indicator on page load matching current URL
      let activeItem = navItems[0];
      const currentPath = window.location.pathname;
      navItems.forEach(item => {
        const href = item.getAttribute('href');
        if (href && currentPath.endsWith(href.replace('<?php echo SITEURL; ?>', ''))) {
          activeItem = item;
        }
      });
      moveIndicatorTo(activeItem);

      navItems.forEach(item => {
        item.addEventListener('mouseenter', () => moveIndicatorTo(item));
      });

      navContainer.addEventListener('mouseleave', () => moveIndicatorTo(activeItem));
    });
  </script>