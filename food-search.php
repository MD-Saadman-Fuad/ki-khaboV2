<?php include('partials-frontend/menu.php');?>

<!-- Food Search Section Starts Here -->
<section class="bg-orange-100 py-10">
  <div class="container mx-auto px-4 text-center">
    <?php 
        $search = mysqli_real_escape_string($conn, $_POST['search']);
    ?>
    <h2 class="text-2xl sm:text-3xl font-semibold text-gray-800 opacity-0 animate-fade-in">
      Foods on Your Search 
      <span class="text-orange-600">"<?php echo htmlspecialchars($search); ?>"</span>
    </h2>
    <p class="text-gray-600 mt-2 opacity-0 animate-fade-in" style="animation-delay: 200ms;">
      Here are the delicious results for your search
    </p>
  </div>
</section>
<!-- Food Search Section Ends Here -->

<!-- Food Menu Section Starts Here -->
<section class="bg-white py-12">
  <div class="container mx-auto px-4">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-8 opacity-0 animate-fade-in" style="animation-delay: 400ms;">Food Menu</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <?php 
    $sql = "SELECT * FROM food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if ($count > 0) {
        $index = 0;
        while($row = mysqli_fetch_assoc($res)) {
            $id = $row['id'];
            $title = $row['title'];
            $price = $row['price'];
            $description = $row['description'];
            $image_name = $row['image_name'];
            $image_path = SITEURL . "images/food/" . $image_name;
            $delay = 600 + ($index * 150); // Start after heading + 150ms delay between each item
    ?>
      <div class="flex gap-4 bg-gray-50 p-4 rounded-lg shadow hover:shadow-md transition-shadow duration-300 opacity-0 translate-y-[50px] animate-slide-in-up" 
           style="animation-delay: <?php echo $delay; ?>ms;">
        <div class="w-32 h-32 flex-shrink-0">
          <?php if ($image_name == ""): ?>
            <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500 text-sm rounded-md">
              Image Not Available
            </div>
          <?php else: ?>
            <img src="<?php echo $image_path; ?>" alt="<?php echo $title; ?>" class="w-full h-full object-cover rounded-md">
          <?php endif; ?>
        </div>

        <div class="flex flex-col justify-between">
          <div>
            <h4 class="text-xl font-semibold text-gray-800"><?php echo $title; ?></h4>
            <p class="text-orange-500 font-medium mb-1"><?php echo $price; ?> Taka</p>
            <p class="text-gray-600 text-sm"><?php echo $description; ?></p>
          </div>
          <div class="mt-2">
            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id;?>" 
               class="inline-block bg-orange-500 text-white px-4 py-2 rounded-md hover:bg-orange-600 transition-colors duration-300 text-sm font-medium">
              Order Now
            </a>
          </div>
        </div>
      </div>
    <?php
            $index++;
        }
    } else {
    ?>
        <div class="col-span-2 text-center py-12 opacity-0 animate-fade-in" style="animation-delay: 600ms;">
            <div class="bg-red-50 border border-red-200 rounded-lg p-8 max-w-md mx-auto">
                <svg class="mx-auto h-16 w-16 text-red-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="text-lg font-semibold text-red-800 mb-2">No Food Found</h3>
                <p class="text-red-600 mb-4">
                    Sorry, no food items match your search for 
                    <strong>"<?php echo htmlspecialchars($search); ?>"</strong>
                </p>
                <a href="<?php echo SITEURL; ?>" 
                   class="inline-block bg-orange-500 text-white px-6 py-2 rounded-md hover:bg-orange-600 transition-colors duration-300 text-sm font-medium">
                    Browse All Foods
                </a>
            </div>
        </div>
    <?php
    }
    ?>
    </div>

    
</section>
<!-- Food Menu Section Ends Here -->

<style>
@keyframes slide-in-up {
  from {
    opacity: 0;
    transform: translateY(50px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes fade-in {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-slide-in-up {
  animation: slide-in-up 0.6s ease-out forwards;
}

.animate-fade-in {
  animation: fade-in 0.8s ease-out forwards;
}
</style>

    <?php include('partials-frontend/footer.php');?>