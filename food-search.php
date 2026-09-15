<?php include('partials-frontend/menu.php');?>

<?php 
  $search = isset($_POST['search']) ? mysqli_real_escape_string($conn, $_POST['search']) : '';
?>

<!-- Food Search Section Starts Here -->
<section class="relative bg-gradient-to-r from-orange-500 via-amber-500 to-orange-600 py-12 text-white">
  <div class="container mx-auto px-4 text-center max-w-4xl">
    <span class="text-xs font-extrabold uppercase tracking-widest bg-white/20 px-3 py-1 rounded-full mb-3 inline-block">Search Results</span>
    <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight mb-3">
      Results for <span class="text-amber-200">"<?php echo htmlspecialchars($search); ?>"</span>
    </h1>
    <p class="text-orange-100 font-medium">
      Showing food items matching your search query.
    </p>
  </div>
</section>
<!-- Food Search Section Ends Here -->

<!-- Food Menu Section Starts Here -->
<section class="py-16 bg-stone-50 min-h-[60vh]">
  <div class="container mx-auto px-4 max-w-6xl">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <?php 
    if ($search != '') {
        $sql = "SELECT food.*, category.title AS category_title 
                FROM food 
                LEFT JOIN category ON food.category_id = category.id 
                WHERE (food.title LIKE '%$search%' OR food.description LIKE '%$search%' OR category.title LIKE '%$search%') 
                  AND food.active='Yes'";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
    } else {
        $count = 0;
    }

    if ($count > 0) {
        $index = 0;
        while($row = mysqli_fetch_assoc($res)) {
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
          <?php if ($image_name == "" || !file_exists("images/food/" . $image_name)): ?>
            <div class="w-full h-full flex items-center justify-center text-stone-400 text-xs font-medium">Image Not Available</div>
          <?php else: ?>
            <img src="<?php echo $image_path; ?>" alt="<?php echo htmlspecialchars($title); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
          <?php endif; ?>
        </div>

        <div class="flex flex-col justify-between w-full h-full py-0.5">
          <div>
            <div class="flex justify-between items-start mb-1 gap-2">
              <h4 class="text-lg font-bold text-stone-900 group-hover:text-orange-600 transition-colors"><?php echo htmlspecialchars($title); ?></h4>
              <span class="bg-orange-100 text-orange-700 font-extrabold px-3 py-1 rounded-full text-sm border border-orange-200/60 whitespace-nowrap">৳<?php echo number_format($price, 0); ?></span>
            </div>
            <p class="text-stone-500 text-sm line-clamp-2 leading-relaxed mb-4"><?php echo htmlspecialchars($description); ?></p>
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
    ?>
        <div class="col-span-2 text-center py-12">
            <div class="bg-white border border-stone-200/70 rounded-2xl p-8 max-w-md mx-auto shadow-sm">
                <svg class="mx-auto h-12 w-12 text-stone-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="text-lg font-bold text-stone-900 mb-1">No Matching Food Found</h3>
                <p class="text-stone-500 text-sm mb-4">
                    Sorry, no food items matched <strong>"<?php echo htmlspecialchars($search); ?>"</strong>
                </p>
                <a href="<?php echo SITEURL; ?>foods.php" 
                   class="inline-flex items-center gap-2 bg-stone-900 text-white px-6 py-2.5 rounded-xl font-bold text-sm hover:bg-stone-800 transition">
                    Browse All Foods
                </a>
            </div>
        </div>
    <?php
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