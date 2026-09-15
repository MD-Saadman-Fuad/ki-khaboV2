<?php include('partials-frontend/menu.php');?>

<!-- Categories Hero Banner Starts Here -->
<section class="relative bg-stone-900 text-white overflow-hidden py-16 sm:py-24 bg-cover bg-center"
         style="background-image: linear-gradient(180deg, rgba(0,0,0,0.55) 0%, rgba(0,0,0,0.65) 50%, rgba(0,0,0,0.85) 100%), url('https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=1600&q=80'), url('images/bg.jpg');">
  <div class="container mx-auto px-4 text-center max-w-4xl relative z-10">
    <span class="inline-block bg-orange-600/90 backdrop-blur-md text-white text-xs font-extrabold px-4 py-1.5 rounded-full mb-4 uppercase tracking-widest border border-orange-400/40 shadow-lg animate-bounce">
      EXPLORE CUISINES 🍕
    </span>
    <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight mb-4 text-white drop-shadow-md">
      What Are You In The Mood For?
    </h1>
    <p class="text-stone-200 text-base sm:text-xl font-medium max-w-2xl mx-auto drop-shadow-sm leading-relaxed">
      Browse our top food categories from sizzling burgers & cheesy pizzas to authentic kacchi & local street food.
    </p>
  </div>
</section>
<!-- Categories Hero Banner Ends Here -->

<!-- Categories Grid Section Starts Here -->
<section class="py-16 bg-stone-50 min-h-[60vh]">
  <div class="container mx-auto px-4 max-w-6xl">
    <div class="text-center mb-12">
      <span class="text-xs font-extrabold uppercase tracking-widest text-orange-600 bg-orange-100 px-3.5 py-1.5 rounded-full">Selected Categories</span>
      <h2 class="text-3xl sm:text-4xl font-extrabold text-stone-900 tracking-tight mt-3">All Food Categories</h2>
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
          $delay = $index * 100;

          // Count items in category
          $count_sql = "SELECT COUNT(*) as total FROM food WHERE category_id=$id AND active='Yes'";
          $count_res = mysqli_query($conn, $count_sql);
          $total_items = 0;
          if ($count_res && $count_row = mysqli_fetch_assoc($count_res)) {
            $total_items = $count_row['total'];
          }
      ?>
        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>" 
           class="group relative block rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 bg-white border border-stone-200/70 hover:-translate-y-2 opacity-0 translate-y-8 animate-slide-up" 
           style="animation-delay: <?php echo $delay; ?>ms;">
          <div class="h-64 overflow-hidden relative">
            <?php if ($image_name == "" || !file_exists("images/category/" . $image_name)): ?>
              <div class="bg-stone-100 h-full flex flex-col items-center justify-center text-stone-400 font-semibold p-4 text-center">
                <svg class="w-10 h-10 text-stone-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <span><?php echo htmlspecialchars($title); ?></span>
              </div>
            <?php else: ?>
              <img src="<?php echo $image_path; ?>" alt="<?php echo htmlspecialchars($title); ?>" class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-110">
            <?php endif; ?>
            
            <!-- Dark Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-stone-950/90 via-stone-900/30 to-transparent transition-opacity duration-300 group-hover:opacity-90"></div>
            
            <!-- Badge & Info -->
            <div class="absolute top-4 right-4">
              <span class="bg-white/90 backdrop-blur-md text-stone-800 text-xs font-extrabold px-3 py-1 rounded-full shadow-md border border-white/40">
                <?php echo $total_items; ?> <?php echo $total_items == 1 ? 'Dish' : 'Dishes'; ?>
              </span>
            </div>

            <div class="absolute bottom-6 left-6 right-6 flex justify-between items-end text-white">
              <div>
                <h3 class="text-2xl font-extrabold tracking-tight drop-shadow-sm group-hover:text-orange-300 transition-colors"><?php echo htmlspecialchars($title); ?></h3>
                <p class="text-xs text-stone-300 font-semibold group-hover:translate-x-1.5 transition-transform duration-300 flex items-center gap-1.5 mt-1.5">
                  <span>Browse Category</span>
                  <svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </p>
              </div>
            </div>
          </div>
        </a>
      <?php
          $index++;
        }
      } else {
        echo "<div class='text-center text-stone-400 font-semibold col-span-3 py-16 bg-white rounded-3xl border border-stone-200/60 shadow-xs'>No categories found.</div>";
      }
      ?>
    </div>
  </div>
</section>
<!-- Categories Grid Section Ends Here -->

<style>
@keyframes slide-up {
  from { opacity: 0; transform: translateY(24px); }
  to { opacity: 1; transform: translateY(0); }
}
.animate-slide-up {
  animation: slide-up 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}
</style>

<?php include('partials-frontend/footer.php');?>