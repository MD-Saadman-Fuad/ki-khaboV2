<?php include('partials-frontend/menu.php');?>

<!-- Food Search Section Starts Here -->
<section class="bg-orange-100 py-10">
  <div class="container mx-auto px-4 text-center">
    <form action="<?php echo SITEURL; ?>food-search.php" method="POST" class="flex flex-col sm:flex-row justify-center gap-4">
      <input type="search" name="search" placeholder="Search for Food.." required
             class="px-4 py-2 w-full sm:w-96 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400" />
      <input type="submit" name="submit" value="Search"
             class="bg-orange-500 text-white px-6 py-2 rounded-md hover:bg-orange-600 transition duration-300" />
    </form>
  </div>
</section>
<!-- Food Search Section Ends Here -->

<!-- Order Message -->
<?php 
if (isset($_SESSION['order'])){
    echo "<div class='text-center text-green-600 font-semibold py-4'>{$_SESSION['order']}</div>";
    unset($_SESSION['order']);
}
?>

<!-- Categories Section Starts Here -->
<section class="main main-content bg-gradient-to-br from-orange-200 via-amber-50 to-yellow-50 py-12">
  <div class="container mx-auto px-4">
    <h2 class="text-3xl font-bold text-center mb-8 text-gray-800 opacity-0 animate-fade-in">Explore Foods</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

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
            $delay = $index * 200; // 200ms delay between each card
    ?>
      <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>" 
         class="group block rounded-lg overflow-hidden shadow-md hover:shadow-xl transition opacity-0 translate-x-[-100px] animate-slide-in-left" 
         style="animation-delay: <?php echo $delay; ?>ms;">
        <?php if ($image_name == ""): ?>
          <div class="bg-gray-200 h-48 flex items-center justify-center text-gray-500">Image Not Available</div>
        <?php else: ?>
          <img src="<?php echo $image_path; ?>" alt="<?php echo $title; ?>" class="w-full h-48 object-cover transition duration-300 group-hover:scale-105">
        <?php endif; ?>
        <div class="bg-orange-500 text-white text-center py-3 text-lg font-semibold">
          <?php echo $title; ?>
        </div>
      </a>
    <?php
            $index++;
        }
    } else {
        echo "<div class='text-red-500 text-center'>Category Not Available</div>";
    }
    ?>

    </div>
  </div>
</section>
<!-- Categories Section Ends Here -->

<!-- Food Menu Section Starts Here -->
<section class="main main-content bg-gradient-to-br from-orange-200 via-amber-50 to-yellow-50 py-12">
  <div class="container mx-auto px-4">
    <h2 class="text-3xl font-bold text-center mb-8 text-gray-800 opacity-0 animate-fade-in" style="animation-delay: 600ms;">Food Menu</h2>

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
            $delay = 800 + ($index * 150); // Start after category animation + 150ms delay between each item
    ?>
      <div class="flex gap-4 bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition opacity-0 translate-y-[50px] animate-slide-in-up" 
           style="animation-delay: <?php echo $delay; ?>ms;">
        <div class="w-32 h-32 flex-shrink-0">
          <?php if ($image_name == ""): ?>
            <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500 text-sm">Image Not Available</div>
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
               class="inline-block bg-orange-500 text-white px-4 py-2 rounded-md hover:bg-orange-600 transition text-sm font-medium">
              Order Now
            </a>
          </div>
        </div>
      </div>
    <?php
            $index++;
        }
    } else {
        echo "<div class='text-red-500 text-center'>Food Not Available</div>";
    }
    ?>
    </div>

    <p class="text-center mt-10 opacity-0 animate-fade-in" style="animation-delay: 1400ms;">
      <a href="<?php echo SITEURL; ?>foods.php" class="text-orange-500 hover:underline font-medium">See All Foods</a>
    </p>
  </div>
</section>
<!-- Food Menu Section Ends Here -->

<style>
@keyframes slide-in-left {
  from {
    opacity: 0;
    transform: translateX(-100px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

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

.animate-slide-in-left {
  animation: slide-in-left 0.8s ease-out forwards;
}

.animate-slide-in-up {
  animation: slide-in-up 0.6s ease-out forwards;
}

.animate-fade-in {
  animation: fade-in 0.8s ease-out forwards;
}
</style>

    <?php include('partials-frontend/footer.php');?>