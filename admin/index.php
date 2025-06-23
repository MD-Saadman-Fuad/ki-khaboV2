<?php include("partials/menu.php") ?>

<style>
  /* Advanced animations and transitions */
  .stagger-animation > * {
    animation: staggerFadeIn 0.8s ease-out forwards;
    opacity: 0;
    transform: translateY(30px);
  }
  
  .stagger-animation > *:nth-child(1) { animation-delay: 0.1s; }
  .stagger-animation > *:nth-child(2) { animation-delay: 0.2s; }
  .stagger-animation > *:nth-child(3) { animation-delay: 0.3s; }
  .stagger-animation > *:nth-child(4) { animation-delay: 0.4s; }
  
  @keyframes staggerFadeIn {
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  
  .header-float {
    animation: floatHeader 1s ease-out forwards;
    opacity: 0;
    transform: translateY(-20px);
  }
  
  @keyframes floatHeader {
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  
  .background-animate {
    animation: backgroundPulse 8s ease-in-out infinite;
  }
  
  @keyframes backgroundPulse {
    0%, 100% { transform: scale(1) rotate(0deg); opacity: 0.3; }
    50% { transform: scale(1.1) rotate(2deg); opacity: 0.5; }
  }
  
  .progress-animate {
    animation: progressFill 2s ease-out forwards;
    transform: scaleX(0);
    transform-origin: left;
  }
  
  @keyframes progressFill {
    to {
      transform: scaleX(1);
    }
  }
  
  .number-counter {
    animation: countUp 1.5s ease-out forwards;
  }
  
  .card-glow {
    position: relative;
    overflow: hidden;
  }
  
  .card-glow::before {
    content: '';
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    background: linear-gradient(45deg, transparent, rgba(255,255,255,0.3), transparent);
    border-radius: inherit;
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: -1;
  }
  
  .card-glow:hover::before {
    opacity: 1;
  }
  
  .shimmer {
    position: relative;
    overflow: hidden;
  }
  
  .shimmer::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s ease;
  }
  
  .shimmer:hover::after {
    left: 100%;
  }
  
  .icon-bounce {
    animation: iconBounce 2s ease-in-out infinite;
  }
  
  @keyframes iconBounce {
    0%, 20%, 50%, 80%, 100% { transform: translateY(0) rotate(0deg); }
    40% { transform: translateY(-10px) rotate(5deg); }
    60% { transform: translateY(-5px) rotate(-3deg); }
  }
  
  .text-gradient-animate {
    background-size: 200% 200%;
    animation: gradientShift 3s ease-in-out infinite;
  }
  
  @keyframes gradientShift {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
  }
  
  .success-bounce {
    animation: successBounce 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
  }
  
  @keyframes successBounce {
    0% { transform: scale(0.8) translateY(20px); opacity: 0; }
    100% { transform: scale(1) translateY(0); opacity: 1; }
  }
  
  .live-indicator {
    animation: livePulse 2s ease-in-out infinite;
  }
  
  @keyframes livePulse {
    0%, 100% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.2); opacity: 0.7; }
  }
</style>

<!-- Main Dashboard Section Start -->
<div class="main main-content bg-gradient-to-br from-orange-200 via-amber-50 to-yellow-50 min-h-screen py-8 lg:py-16 relative overflow-hidden">
  <!-- Background Decorative Elements -->
  <div class="absolute inset-0 overflow-hidden pointer-events-none">
    <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-orange-200/30 to-amber-200/30 rounded-full blur-3xl background-animate"></div>
    <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-br from-yellow-200/30 to-orange-200/30 rounded-full blur-3xl background-animate" style="animation-delay: -2s;"></div>
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-gradient-to-br from-amber-100/20 to-orange-100/20 rounded-full blur-3xl background-animate" style="animation-delay: -4s;"></div>
  </div>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
    <!-- Header Section -->
    <div class="text-center mb-12 lg:mb-16 header-float">
      <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-orange-500 to-amber-600 rounded-2xl shadow-xl mb-6 transform hover:rotate-12 transition-all duration-500 hover:scale-110 icon-bounce">
        <svg class="w-10 h-10 text-white transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
        </svg>
      </div>
      <h1 class="text-5xl lg:text-6xl font-black bg-gradient-to-r from-orange-600 via-amber-600 to-yellow-600 bg-clip-text text-transparent mb-4 tracking-tight text-gradient-animate">
        Dashboard
      </h1>
      <p class="text-lg text-gray-600 font-medium max-w-2xl mx-auto leading-relaxed transition-all duration-300 hover:text-gray-700 hover:scale-105">
        Monitor your business performance with real-time insights and analytics
      </p>
    </div>

    <!-- Success Message -->
    <?php if (isset($_SESSION['login'])): ?>
    <div class="mb-8 mx-auto max-w-md success-bounce">
      <div class="bg-gradient-to-r from-emerald-500 to-green-600 text-white px-6 py-4 rounded-2xl shadow-xl border border-green-200 transform hover:scale-105 transition-all duration-300 shimmer">
        <div class="flex items-center space-x-3">
          <svg class="w-6 h-6 flex-shrink-0 transition-transform duration-300 hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
          </svg>
          <span class="font-semibold text-center flex-1">
            <?php
              echo $_SESSION['login'];
              unset($_SESSION['login']);
            ?>
          </span>
        </div>
      </div>
    </div>
    <?php endif; ?>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 lg:gap-8 stagger-animation">
      
      <!-- Categories Card -->
      <div class="group relative overflow-hidden card-glow">
        <div class="absolute inset-0 bg-gradient-to-br from-orange-400 via-orange-500 to-orange-600 rounded-3xl transform group-hover:scale-105 transition-all duration-500 shadow-2xl group-hover:shadow-orange-500/25"></div>
        <div class="relative bg-gradient-to-br from-orange-400 via-orange-500 to-orange-600 text-white rounded-3xl shadow-2xl p-8 transform group-hover:scale-105 transition-all duration-500 group-hover:shadow-orange-500/25 shimmer">
          <!-- Icon -->
          <div class="absolute top-6 right-6 w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center group-hover:rotate-12 transition-all duration-500 group-hover:bg-white/30">
            <svg class="w-6 h-6 transition-all duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
            </svg>
          </div>
          
          <?php
            $sql = "SELECT * FROM category";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
          ?>
          
          <div class="space-y-4">
            <h3 class="text-sm font-semibold text-orange-100 uppercase tracking-wider transition-all duration-300 group-hover:text-white">Categories</h3>
            <div class="flex items-baseline space-x-2">
              <h2 class="text-4xl lg:text-5xl font-black tracking-tight number-counter"><?php echo $count; ?></h2>
              <span class="text-orange-200 font-medium transition-all duration-300 group-hover:text-orange-100">items</span>
            </div>
            <div class="w-full bg-white/20 rounded-full h-2 overflow-hidden">
              <div class="bg-white h-2 rounded-full w-3/4 shadow-sm progress-animate" style="animation-delay: 0.5s;"></div>
            </div>
          </div>
          
          <!-- Hover Effect Overlay -->
          <div class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-all duration-500 rounded-3xl"></div>
        </div>
      </div>

      <!-- Foods Card -->
      <div class="group relative overflow-hidden card-glow">
        <div class="absolute inset-0 bg-gradient-to-br from-amber-500 via-orange-500 to-red-500 rounded-3xl transform group-hover:scale-105 transition-all duration-500 shadow-2xl group-hover:shadow-amber-500/25"></div>
        <div class="relative bg-gradient-to-br from-amber-500 via-orange-500 to-red-500 text-white rounded-3xl shadow-2xl p-8 transform group-hover:scale-105 transition-all duration-500 group-hover:shadow-amber-500/25 shimmer">
          <!-- Icon -->
          <div class="absolute top-6 right-6 w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center group-hover:rotate-12 transition-all duration-500 group-hover:bg-white/30">
            <svg class="w-6 h-6 transition-all duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
          </div>
          
          <?php
            $sql2 = "SELECT * FROM food";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);
          ?>
          
          <div class="space-y-4">
            <h3 class="text-sm font-semibold text-amber-100 uppercase tracking-wider transition-all duration-300 group-hover:text-white">Foods</h3>
            <div class="flex items-baseline space-x-2">
              <h2 class="text-4xl lg:text-5xl font-black tracking-tight number-counter"><?php echo $count2; ?></h2>
              <span class="text-amber-200 font-medium transition-all duration-300 group-hover:text-amber-100">dishes</span>
            </div>
            <div class="w-full bg-white/20 rounded-full h-2 overflow-hidden">
              <div class="bg-white h-2 rounded-full w-4/5 shadow-sm progress-animate" style="animation-delay: 0.7s;"></div>
            </div>
          </div>
          
          <!-- Hover Effect Overlay -->
          <div class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-all duration-500 rounded-3xl"></div>
        </div>
      </div>

      <!-- Orders Card -->
      <div class="group relative overflow-hidden card-glow">
        <div class="absolute inset-0 bg-gradient-to-br from-red-500 via-pink-500 to-purple-600 rounded-3xl transform group-hover:scale-105 transition-all duration-500 shadow-2xl group-hover:shadow-red-500/25"></div>
        <div class="relative bg-gradient-to-br from-red-500 via-pink-500 to-purple-600 text-white rounded-3xl shadow-2xl p-8 transform group-hover:scale-105 transition-all duration-500 group-hover:shadow-red-500/25 shimmer">
          <!-- Icon -->
          <div class="absolute top-6 right-6 w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center group-hover:rotate-12 transition-all duration-500 group-hover:bg-white/30">
            <svg class="w-6 h-6 transition-all duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
          </div>
          
          <?php
            $sql3 = "SELECT * FROM order_table";
            $res3 = mysqli_query($conn, $sql3);
            $count3 = mysqli_num_rows($res3);
          ?>
          
          <div class="space-y-4">
            <h3 class="text-sm font-semibold text-red-100 uppercase tracking-wider transition-all duration-300 group-hover:text-white">Total Orders</h3>
            <div class="flex items-baseline space-x-2">
              <h2 class="text-4xl lg:text-5xl font-black tracking-tight number-counter"><?php echo $count3; ?></h2>
              <span class="text-red-200 font-medium transition-all duration-300 group-hover:text-red-100">orders</span>
            </div>
            <div class="w-full bg-white/20 rounded-full h-2 overflow-hidden">
              <div class="bg-white h-2 rounded-full w-2/3 shadow-sm progress-animate" style="animation-delay: 0.9s;"></div>
            </div>
          </div>
          
          <!-- Hover Effect Overlay -->
          <div class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-all duration-500 rounded-3xl"></div>
        </div>
      </div>

      <!-- Revenue Card -->
      <div class="group relative overflow-hidden card-glow">
        <div class="absolute inset-0 bg-gradient-to-br from-purple-600 via-indigo-600 to-blue-700 rounded-3xl transform group-hover:scale-105 transition-all duration-500 shadow-2xl group-hover:shadow-purple-500/25"></div>
        <div class="relative bg-gradient-to-br from-purple-600 via-indigo-600 to-blue-700 text-white rounded-3xl shadow-2xl p-8 transform group-hover:scale-105 transition-all duration-500 group-hover:shadow-purple-500/25 shimmer">
          <!-- Icon -->
          <div class="absolute top-6 right-6 w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center group-hover:rotate-12 transition-all duration-500 group-hover:bg-white/30">
            <svg class="w-6 h-6 transition-all duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
            </svg>
          </div>
          
          <?php
            $sql4 = "SELECT SUM(total) as Total FROM order_table WHERE status='Delivered'";
            $res4 = mysqli_query($conn, $sql4);
            $row4 = mysqli_fetch_assoc($res4);
            $total_revenue = $row4['Total'] ?? 0;
          ?>
          
          <div class="space-y-4">
            <h3 class="text-sm font-semibold text-purple-100 uppercase tracking-wider transition-all duration-300 group-hover:text-white">Revenue Generated</h3>
            <div class="flex items-baseline space-x-1">
              <h2 class="text-3xl lg:text-4xl font-black tracking-tight number-counter"><?php echo number_format($total_revenue); ?></h2>
              <span class="text-2xl lg:text-3xl font-bold text-purple-200 transition-all duration-300 group-hover:text-purple-100">৳</span>
            </div>
            <div class="w-full bg-white/20 rounded-full h-2 overflow-hidden">
              <div class="bg-gradient-to-r from-green-400 to-emerald-500 h-2 rounded-full w-full shadow-sm progress-animate" style="animation-delay: 1.1s;"></div>
            </div>
          </div>
          
          <!-- Hover Effect Overlay -->
          <div class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-all duration-500 rounded-3xl"></div>
        </div>
      </div>

    </div>

    <!-- Additional Info Section -->
    <div class="mt-16 text-center">
      <div class="inline-flex items-center space-x-2 bg-white/60 backdrop-blur-sm px-6 py-3 rounded-full shadow-lg border border-white/20 hover:bg-white/80 hover:shadow-xl transition-all duration-300 hover:scale-105">
        <div class="w-2 h-2 bg-green-500 rounded-full live-indicator"></div>
        <span class="text-gray-700 font-medium transition-colors duration-300">Live data updated in real-time</span>
      </div>
    </div>

  </div>
</div>
<!-- Main Dashboard Section End -->

<?php include("partials/footer.php") ?>