<?php include('partials-frontend/menu.php');?>

<!-- Categories Section Starts Here -->
<section class="py-16 bg-stone-50 min-h-[70vh]">
  <div class="container mx-auto px-4 max-w-6xl">
    <div class="text-center mb-12">
      <span class="text-xs font-extrabold uppercase tracking-widest text-orange-600 bg-orange-100 px-3 py-1 rounded-full">Menu Categories</span>
      <h2 class="text-3xl sm:text-4xl font-extrabold text-stone-900 tracking-tight mt-2">Explore All Categories</h2>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
      <?php 
      $sql = "SELECT * FROM category WHERE active='Yes'";
      $res = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($res);

      if ($count > 0) {
        $index = 0;
        while ($row = mysqli_fetch_assoc($res)) {
          $id = $row['id'];
          $title = $row['title'];
          $image_name = $row['image_name'];
          $image_path = SITEURL . "images/category/" . $image_name;
          $delay = $index * 120;
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
                  <span>Explore Items</span>
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
        echo "<div class='text-center text-stone-400 font-medium col-span-3 py-12'>No categories available.</div>";
      }
      ?>
    </div>
  </div>
</section>
<!-- Categories Section Ends Here -->

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