<?php include('partials-frontend/menu.php');?>

<!-- Hero & Food Search Section Starts Here -->
<section class="relative bg-stone-50 text-white overflow-hidden">
  
  <!-- Carousel Slides Container -->
  <div id="heroCarousel" class="relative w-full h-[480px] sm:h-[540px]">
    
    <!-- Slide 1 -->
    <div class="hero-slide active absolute inset-0 w-full h-full transition-all duration-1000 ease-in-out opacity-100 scale-100 z-10 flex items-center justify-center bg-cover bg-center pb-14"
         style="background-image: linear-gradient(180deg, rgba(0,0,0,0.35) 0%, rgba(0,0,0,0.45) 50%, rgba(0,0,0,0.7) 100%), url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1600&q=80'), url('images/bg.jpg');">
      <div class="container mx-auto px-4 text-center max-w-3xl relative z-10 transition-all duration-700">
        <span class="inline-block bg-orange-600/80 backdrop-blur-md text-white text-xs font-extrabold px-4 py-1.5 rounded-full mb-4 uppercase tracking-widest border border-orange-400/40 shadow-lg">
          DELICIOUS FOOD DELIVERED FAST 🍕
        </span>
        <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight mb-4 text-white drop-shadow-[0_4px_12px_rgba(0,0,0,0.9)]">
          Craving Something Tasty?
        </h1>
        <p class="text-white text-base sm:text-xl font-semibold mb-8 max-w-2xl mx-auto drop-shadow-[0_2px_8px_rgba(0,0,0,0.9)] leading-relaxed">
          Explore fresh, mouth-watering dishes from top local kitchens and get them delivered to your doorstep.
        </p>
      </div>
    </div>

    <!-- Slide 2 -->
    <div class="hero-slide absolute inset-0 w-full h-full transition-all duration-1000 ease-in-out opacity-0 scale-105 pointer-events-none z-0 flex items-center justify-center bg-cover bg-center pb-14"
         style="background-image: linear-gradient(180deg, rgba(0,0,0,0.35) 0%, rgba(0,0,0,0.45) 50%, rgba(0,0,0,0.7) 100%), url('https://images.unsplash.com/photo-1513104890138-7c749659a591?auto=format&fit=crop&w=1600&q=80'), url('images/pizza.jpg');">
      <div class="container mx-auto px-4 text-center max-w-3xl relative z-10 transition-all duration-700">
        <span class="inline-block bg-amber-600/80 backdrop-blur-md text-white text-xs font-extrabold px-4 py-1.5 rounded-full mb-4 uppercase tracking-widest border border-amber-400/40 shadow-lg">
          SPECIAL OFFERS & PROMOS 🎁
        </span>
        <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight mb-4 text-white drop-shadow-[0_4px_12px_rgba(0,0,0,0.9)]">
          Up To 30% Off Hot Combos
        </h1>
        <p class="text-white text-base sm:text-xl font-semibold mb-8 max-w-2xl mx-auto drop-shadow-[0_2px_8px_rgba(0,0,0,0.9)] leading-relaxed">
          Treat yourself and family with our weekly discounted meal offers. Prepared fresh to order!
        </p>
      </div>
    </div>

    <!-- Slide 3 -->
    <div class="hero-slide absolute inset-0 w-full h-full transition-all duration-1000 ease-in-out opacity-0 scale-105 pointer-events-none z-0 flex items-center justify-center bg-cover bg-center pb-14"
         style="background-image: linear-gradient(180deg, rgba(0,0,0,0.35) 0%, rgba(0,0,0,0.45) 50%, rgba(0,0,0,0.7) 100%), url('https://images.unsplash.com/photo-1563379091339-03b21ab4a4f8?auto=format&fit=crop&w=1600&q=80'), url('images/burger.jpg');">
      <div class="container mx-auto px-4 text-center max-w-3xl relative z-10 transition-all duration-700">
        <span class="inline-block bg-orange-600/80 backdrop-blur-md text-white text-xs font-extrabold px-4 py-1.5 rounded-full mb-4 uppercase tracking-widest border border-orange-400/40 shadow-lg">
          EXPRESS DELIVERY 🚀
        </span>
        <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight mb-4 text-white drop-shadow-[0_4px_12px_rgba(0,0,0,0.9)]">
          Hot & Fresh At Your Doorstep
        </h1>
        <p class="text-white text-base sm:text-xl font-semibold mb-8 max-w-2xl mx-auto drop-shadow-[0_2px_8px_rgba(0,0,0,0.9)] leading-relaxed">
          Fast cooking and express delivery ensures your meal arrives sizzling and delicious.
        </p>
      </div>
    </div>

    <!-- Search Form (Placed directly ON the Banner) -->
    <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-30 w-full max-w-2xl px-4">
      <form action="<?php echo SITEURL; ?>food-search.php" method="POST" class="flex flex-col sm:flex-row gap-3 bg-white/95 backdrop-blur-md p-2 rounded-2xl sm:rounded-full shadow-2xl border border-white/40">
        <div class="relative flex-grow flex items-center pl-4">
          <svg class="w-5 h-5 text-stone-400 absolute left-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
          <input type="search" name="search" placeholder="Search for burgers, pizza, biryani..." required
                 class="w-full pl-8 pr-4 py-3 bg-transparent text-stone-800 placeholder-stone-400 focus:outline-none font-medium text-sm sm:text-base" />
        </div>
        <button type="submit" name="submit"
                class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-3.5 rounded-xl sm:rounded-full font-bold shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-2">
          <span>Search</span>
        </button>
      </form>
    </div>

    <!-- Carousel Nav Buttons -->
    <button id="prevSlide" aria-label="Previous Slide" class="absolute left-4 sm:left-8 top-1/2 -translate-y-1/2 z-30 w-11 h-11 bg-white/20 hover:bg-white/40 text-white rounded-full backdrop-blur-md flex items-center justify-center transition border border-white/30 shadow-lg active:scale-95">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
    </button>
    <button id="nextSlide" aria-label="Next Slide" class="absolute right-4 sm:right-8 top-1/2 -translate-y-1/2 z-30 w-11 h-11 bg-white/20 hover:bg-white/40 text-white rounded-full backdrop-blur-md flex items-center justify-center transition border border-white/30 shadow-lg active:scale-95">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
    </button>

    <!-- Carousel Indicators -->
    <div class="absolute bottom-3 left-1/2 -translate-x-1/2 z-30 flex gap-2.5">
      <button class="carousel-dot w-8 h-2 bg-white rounded-full transition-all duration-500 shadow-sm" aria-label="Slide 1"></button>
      <button class="carousel-dot w-2 h-2 bg-white/40 hover:bg-white/80 rounded-full transition-all duration-500 shadow-sm" aria-label="Slide 2"></button>
      <button class="carousel-dot w-2 h-2 bg-white/40 hover:bg-white/80 rounded-full transition-all duration-500 shadow-sm" aria-label="Slide 3"></button>
    </div>

  </div>
</section>
<!-- Hero & Food Search Section Ends Here -->
<!-- Hero & Food Search Section Ends Here -->

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.carousel-dot');
    const prevBtn = document.getElementById('prevSlide');
    const nextBtn = document.getElementById('nextSlide');
    let currentSlide = 0;
    let autoSlideTimer;

    function showSlide(index) {
      slides.forEach((slide, i) => {
        if (i === index) {
          slide.classList.remove('opacity-0', 'scale-105', 'pointer-events-none', 'z-0');
          slide.classList.add('opacity-100', 'scale-100', 'z-10');
        } else {
          slide.classList.remove('opacity-100', 'scale-100', 'z-10');
          slide.classList.add('opacity-0', 'scale-105', 'pointer-events-none', 'z-0');
        }
      });
      dots.forEach((dot, i) => {
        if (i === index) {
          dot.classList.add('bg-white', 'w-8');
          dot.classList.remove('bg-white/40', 'w-2.5');
        } else {
          dot.classList.remove('bg-white', 'w-8');
          dot.classList.add('bg-white/40', 'w-2.5');
        }
      });
      currentSlide = index;
    }

    function nextSlide() {
      let newIndex = (currentSlide + 1) % slides.length;
      showSlide(newIndex);
    }

    function prevSlide() {
      let newIndex = (currentSlide - 1 + slides.length) % slides.length;
      showSlide(newIndex);
    }

    if (nextBtn && prevBtn) {
      nextBtn.addEventListener('click', () => {
        nextSlide();
        resetTimer();
      });
      prevBtn.addEventListener('click', () => {
        prevSlide();
        resetTimer();
      });
    }

    dots.forEach((dot, idx) => {
      dot.addEventListener('click', () => {
        showSlide(idx);
        resetTimer();
      });
    });

    function startTimer() {
      autoSlideTimer = setInterval(nextSlide, 5000);
    }

    function resetTimer() {
      clearInterval(autoSlideTimer);
      startTimer();
    }

    startTimer();
  });
</script>

<!-- Order Flash Notification Message -->
<?php 
if (isset($_SESSION['order'])){
    echo "<div class='container mx-auto px-4 mt-6'><div class='max-w-md mx-auto bg-emerald-50 border border-emerald-200 text-emerald-700 text-center font-semibold py-3 px-6 rounded-2xl shadow-sm'>{$_SESSION['order']}</div></div>";
    unset($_SESSION['order']);
}
?>

<!-- Categories Section Starts Here -->
<section class="py-16 bg-stone-50">
  <div class="container mx-auto px-4 max-w-6xl">
    <div class="text-center mb-12">
      <span class="text-xs font-extrabold uppercase tracking-widest text-orange-600 bg-orange-100 px-3 py-1 rounded-full">Top Categories</span>
      <h2 class="text-3xl sm:text-4xl font-extrabold text-stone-900 tracking-tight mt-2">Explore By Category</h2>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
    <?php 
    $sql = "SELECT * FROM category WHERE active='Yes' AND featured = 'Yes' LIMIT 3";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if($count > 0) {
        $index = 0;
        while ($row = mysqli_fetch_assoc($res)) {
            $id = $row['id'];
            $title = $row['title'];
            $image_name = $row['image_name'];
            $image_path = SITEURL . "images/category/" . $image_name;
            $delay = $index * 150;
    ?>
      <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>" 
         class="group relative block rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 bg-white border border-stone-200/60 opacity-0 translate-y-8 animate-slide-up" 
         style="animation-delay: <?php echo $delay; ?>ms;">
        <div class="h-60 overflow-hidden relative">
          <?php if ($image_name == ""): ?>
            <div class="bg-stone-100 h-full flex items-center justify-center text-stone-400 font-medium">Image Not Available</div>
          <?php else: ?>
            <img src="<?php echo $image_path; ?>" alt="<?php echo $title; ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
          <?php endif; ?>
          
          <!-- Gradient Overlay -->
          <div class="absolute inset-0 bg-gradient-to-t from-stone-900/80 via-stone-900/20 to-transparent"></div>
          
          <div class="absolute bottom-5 left-5 right-5 flex justify-between items-end text-white">
            <div>
              <h3 class="text-2xl font-bold tracking-tight drop-shadow-sm"><?php echo $title; ?></h3>
              <p class="text-xs text-orange-300 font-semibold group-hover:translate-x-1 transition-transform flex items-center gap-1 mt-1">
                <span>Browse Category</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
              </p>
            </div>
          </div>
        </div>
      </a>
    <?php
            $index++;
        }
    } else {
        echo "<div class='text-stone-400 text-center col-span-3 py-8 font-medium'>No featured categories found.</div>";
    }
    ?>
    </div>
  </div>
</section>
<!-- Categories Section Ends Here -->

<!-- Food Menu Section Starts Here -->
<section class="py-16 bg-white border-t border-stone-100">
  <div class="container mx-auto px-4 max-w-6xl">
    <div class="text-center mb-12">
      <span class="text-xs font-extrabold uppercase tracking-widest text-orange-600 bg-orange-100 px-3 py-1 rounded-full">Curated Menu</span>
      <h2 class="text-3xl sm:text-4xl font-extrabold text-stone-900 tracking-tight mt-2">Popular Dishes</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <?php 
    $sql2 = "SELECT * FROM food WHERE active='Yes' AND featured = 'Yes' LIMIT 6";
    $res2 = mysqli_query($conn, $sql2);
    $count2 = mysqli_num_rows($res2);

    if($count2 > 0) {
        $index = 0;
        while ($row = mysqli_fetch_assoc($res2)) {
            $id = $row['id'];
            $title = $row['title'];
            $price = $row['price'];
            $description = $row['description'];
            $image_name = $row['image_name'];
            $image_path = SITEURL . "images/food/" . $image_name;
            $delay = $index * 120;
    ?>
      <div class="bg-stone-50/80 p-4 sm:p-5 rounded-2xl shadow-xs hover:shadow-xl border border-stone-200/70 transition-all duration-300 flex flex-col sm:flex-row gap-5 items-center group opacity-0 translate-y-8 animate-slide-up" 
           style="animation-delay: <?php echo $delay; ?>ms;">
        <div class="w-full sm:w-36 h-36 flex-shrink-0 rounded-xl overflow-hidden bg-stone-200 relative">
          <?php if ($image_name == ""): ?>
            <div class="w-full h-full flex items-center justify-center text-stone-400 text-xs font-medium">Image Not Available</div>
          <?php else: ?>
            <img src="<?php echo $image_path; ?>" alt="<?php echo $title; ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
          <?php endif; ?>
        </div>
        <div class="flex flex-col justify-between w-full h-full py-0.5">
          <div>
            <div class="flex justify-between items-start mb-1 gap-2">
              <h4 class="text-lg font-bold text-stone-900 group-hover:text-orange-600 transition-colors"><?php echo $title; ?></h4>
              <span class="bg-orange-100 text-orange-700 font-extrabold px-3 py-1 rounded-full text-sm border border-orange-200/60 whitespace-nowrap">৳<?php echo number_format($price, 0); ?></span>
            </div>
            <p class="text-stone-500 text-sm line-clamp-2 leading-relaxed mb-4"><?php echo $description; ?></p>
          </div>
          <div class="flex items-center gap-2">
            <a href="<?php echo SITEURL; ?>cart-action.php?action=add&food_id=<?php echo $id;?>" 
               class="inline-flex items-center justify-center gap-1.5 bg-stone-100 hover:bg-stone-200 text-stone-800 font-bold px-3.5 py-2 rounded-xl border border-stone-200/80 transition-all duration-200 text-xs transform hover:scale-[1.02] active:scale-95" title="Add to Cart">
              <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 0a2 2 0 100 4 2 2 0 000-4z"></path></svg>
              <span>+ Cart</span>
            </a>
            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id;?>" 
               class="inline-flex items-center justify-center gap-1.5 bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 text-white font-bold px-4 py-2 rounded-xl shadow-md shadow-orange-500/20 hover:shadow-lg transition-all duration-200 text-xs transform hover:scale-[1.02] active:scale-95">
              <span>Order Now</span>
            </a>
          </div>
        </div>
      </div>
    <?php
            $index++;
        }
    } else {
        echo "<div class='text-stone-400 text-center col-span-2 py-8 font-medium'>No featured foods found.</div>";
    }
    ?>
    </div>

    <div class="text-center mt-12">
      <a href="<?php echo SITEURL; ?>foods.php" 
         class="inline-flex items-center gap-2 bg-stone-900 hover:bg-stone-800 text-white px-8 py-3.5 rounded-full font-bold shadow-md hover:shadow-xl transition-all duration-200 transform hover:scale-105">
        <span>See Full Menu</span>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
      </a>
    </div>
  </div>
</section>
<!-- Food Menu Section Ends Here -->

<style>
@keyframes slide-up {
  from {
    opacity: 0;
    transform: translateY(24px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-slide-up {
  animation: slide-up 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}
</style>

<?php include('partials-frontend/footer.php');?>