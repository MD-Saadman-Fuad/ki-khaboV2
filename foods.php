<?php include('partials-frontend/menu.php');?>

<!-- Food Search Header Starts Here -->
<section class="relative bg-gradient-to-r from-orange-500 via-amber-500 to-orange-600 py-12 text-white">
  <div class="container mx-auto px-4 text-center max-w-4xl">
    <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight mb-4">
      Explore Our Full Menu 🍕
    </h1>
    <p class="text-orange-100 font-medium mb-6">
      Find your favorite meals and order instantly with fast delivery.
    </p>

    <form action="<?php echo SITEURL; ?>food-search.php" method="POST" class="max-w-xl mx-auto flex flex-col sm:flex-row gap-3 bg-white/95 backdrop-blur-md p-2 rounded-2xl sm:rounded-full shadow-lg border border-white/20">
      <div class="relative flex-grow flex items-center pl-4">
        <svg class="w-5 h-5 text-stone-400 absolute left-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
        <input type="search" name="search" placeholder="Search for food items..." required
               class="w-full pl-8 pr-4 py-2.5 bg-transparent text-stone-800 placeholder-stone-400 focus:outline-none font-medium" />
      </div>
      <button type="submit" name="submit"
              class="bg-stone-900 hover:bg-stone-800 text-white px-7 py-3 rounded-xl sm:rounded-full font-bold shadow-md hover:shadow-lg transition-all duration-200">
        Search
      </button>
    </form>
  </div>
</section>
<!-- Food Search Header Ends Here -->

<!-- Food Menu Section Starts Here -->
<section class="py-16 bg-stone-50 min-h-[60vh]">
  <div class="container mx-auto px-4 max-w-6xl">
    <div class="text-center mb-12">
      <span class="text-xs font-extrabold uppercase tracking-widest text-orange-600 bg-orange-100 px-3 py-1 rounded-full">All Items</span>
      <h2 class="text-3xl sm:text-4xl font-extrabold text-stone-900 tracking-tight mt-2">Complete Food Menu</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      <?php 
        $sql = "SELECT * FROM food WHERE active='Yes'";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if ($count > 0) {
          $index = 0;
          while ($row = mysqli_fetch_assoc($res)) {
            $id = $row['id'];
            $title = $row['title'];
            $price = $row['price'];
            $description = $row['description'];
            $image_name = $row['image_name'];
            $image_path = SITEURL . "images/food/" . $image_name;
            $delay = $index * 100;
      ?>
      <div class="bg-white p-4 sm:p-5 rounded-2xl shadow-xs hover:shadow-xl border border-stone-200/70 transition-all duration-300 flex flex-col sm:flex-row gap-5 items-center group opacity-0 translate-y-8 animate-slide-up" 
           style="animation-delay: <?php echo $delay; ?>ms;">
        <div class="w-full sm:w-36 h-36 flex-shrink-0 rounded-xl overflow-hidden bg-stone-100 relative">
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
          echo "<div class='text-center text-stone-400 font-medium col-span-2 py-12'>No food items available.</div>";
        }
      ?>
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