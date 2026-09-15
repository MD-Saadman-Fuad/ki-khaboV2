<?php include('partials-frontend/menu.php');?>

<?php 
  $search = isset($_POST['search']) ? mysqli_real_escape_string($conn, $_POST['search']) : '';
?>

<!-- Food Search Hero Banner Starts Here -->
<section class="relative bg-stone-900 text-white overflow-hidden py-16 sm:py-24 bg-cover bg-center"
         style="background-image: linear-gradient(180deg, rgba(0,0,0,0.55) 0%, rgba(0,0,0,0.65) 50%, rgba(0,0,0,0.85) 100%), url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1600&q=80'), url('images/bg.jpg');">
  <div class="container mx-auto px-4 text-center max-w-4xl relative z-10">
    <span class="inline-block bg-orange-600/90 backdrop-blur-md text-white text-xs font-extrabold px-4 py-1.5 rounded-full mb-4 uppercase tracking-widest border border-orange-400/40 shadow-lg">
      SEARCH RESULTS 🔍
    </span>
    <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight mb-4 text-white drop-shadow-md">
      Results for <span class="text-orange-400">"<?php echo htmlspecialchars($search); ?>"</span>
    </h1>
    <p class="text-stone-200 text-base sm:text-xl font-medium max-w-2xl mx-auto drop-shadow-sm leading-relaxed mb-8">
      Showing all delicious meals matching your query.
    </p>

    <!-- Embedded Search Bar for Re-querying -->
    <form action="<?php echo SITEURL; ?>food-search.php" method="POST" class="max-w-2xl mx-auto flex flex-col sm:flex-row gap-3 bg-white/95 backdrop-blur-md p-2 rounded-2xl sm:rounded-full shadow-2xl border border-white/40">
      <div class="relative flex-grow flex items-center pl-4">
        <svg class="w-5 h-5 text-stone-400 absolute left-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
        <input type="search" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search burgers, pizza, biryani, sandwich..." required
               class="w-full pl-8 pr-4 py-3 bg-transparent text-stone-800 placeholder-stone-400 focus:outline-none font-medium text-sm sm:text-base" />
      </div>
      <button type="submit" name="submit"
              class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-3.5 rounded-xl sm:rounded-full font-bold shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-2">
        <span>Search</span>
      </button>
    </form>
  </div>
</section>
<!-- Food Search Hero Banner Ends Here -->

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
      <div class="bg-white p-4 sm:p-5 rounded-3xl shadow-xs hover:shadow-2xl border border-stone-200/70 hover:-translate-y-1.5 transition-all duration-500 flex flex-col sm:flex-row gap-5 items-center group opacity-0 translate-y-8 animate-slide-up" 
           style="animation-delay: <?php echo $delay; ?>ms;">
        <div class="w-full sm:w-40 h-40 flex-shrink-0 rounded-2xl overflow-hidden bg-stone-100 relative">
          <?php if ($image_name == "" || !file_exists("images/food/" . $image_name)): ?>
            <div class="w-full h-full flex flex-col items-center justify-center text-stone-400 text-xs font-semibold p-2 text-center">
              <svg class="w-8 h-8 text-stone-300 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
              <span>No Image</span>
            </div>
          <?php else: ?>
            <img src="<?php echo $image_path; ?>" alt="<?php echo htmlspecialchars($title); ?>" class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-110">
          <?php endif; ?>
        </div>

        <div class="flex flex-col justify-between w-full h-full py-0.5">
          <div>
            <div class="flex justify-between items-start mb-1.5 gap-2">
              <h4 class="text-lg font-extrabold text-stone-900 group-hover:text-orange-600 transition-colors"><?php echo htmlspecialchars($title); ?></h4>
              <span class="bg-orange-100 text-orange-700 font-extrabold px-3 py-1 rounded-full text-sm border border-orange-200/60 whitespace-nowrap shadow-xs">৳<?php echo number_format($price, 0); ?></span>
            </div>
            <p class="text-stone-500 text-sm line-clamp-2 leading-relaxed mb-4 font-medium"><?php echo htmlspecialchars($description); ?></p>
          </div>
          <div class="flex items-center gap-2.5">
            <a href="<?php echo SITEURL; ?>cart-action.php?action=add&food_id=<?php echo $id;?>" 
               class="inline-flex items-center justify-center gap-1.5 bg-stone-100 hover:bg-stone-200 text-stone-800 font-bold px-4 py-2.5 rounded-xl border border-stone-200/80 transition-all duration-200 text-xs transform hover:scale-[1.02] active:scale-95" title="Add to Cart">
              <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 0a2 2 0 100 4 2 2 0 000-4z"></path></svg>
              <span>+ Cart</span>
            </a>
            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id;?>" 
               class="inline-flex items-center justify-center gap-1.5 bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 text-white font-extrabold px-5 py-2.5 rounded-xl shadow-md shadow-orange-500/20 hover:shadow-lg transition-all duration-200 text-xs transform hover:scale-[1.02] active:scale-95">
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
        <div class="col-span-2 text-center py-16">
            <div class="bg-white border border-stone-200/70 rounded-3xl p-8 max-w-md mx-auto shadow-xs">
                <svg class="mx-auto h-12 w-12 text-stone-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="text-lg font-bold text-stone-900 mb-1">No Matching Food Found</h3>
                <p class="text-stone-500 text-sm mb-4">
                    Sorry, no food items matched <strong>"<?php echo htmlspecialchars($search); ?>"</strong>
                </p>
                <a href="<?php echo SITEURL; ?>foods.php" 
                   class="inline-flex items-center gap-2 bg-stone-900 text-white px-6 py-2.5 rounded-xl font-bold text-sm hover:bg-stone-800 transition shadow-md">
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
  from { opacity: 0; transform: translateY(24px); }
  to { opacity: 1; transform: translateY(0); }
}
.animate-slide-up {
  animation: slide-up 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}
</style>

<?php include('partials-frontend/footer.php');?>