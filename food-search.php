<?php include('partials-frontend/menu.php');?>

<!-- Food Search Section Starts Here -->
<section class="bg-orange-100 py-10">
  <div class="container mx-auto px-4 text-center">
    <?php 
        $search = mysqli_real_escape_string($conn, $_POST['search']);
    ?>
    <h2 class="text-2xl sm:text-3xl font-semibold text-gray-800">
      Foods on Your Search 
      <span class="text-orange-600">"<?php echo htmlspecialchars($search); ?>"</span>
    </h2>
  </div>
</section>
<!-- Food Search Section Ends Here -->

<!-- Food Menu Section Starts Here -->
<section class="bg-white py-12">
  <div class="container mx-auto px-4">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Food Menu</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <?php 
    $sql = "SELECT * FROM food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if ($count > 0) {
        while($row = mysqli_fetch_assoc($res)) {
            $id = $row['id'];
            $title = $row['title'];
            $price = $row['price'];
            $description = $row['description'];
            $image_name = $row['image_name'];
            $image_path = SITEURL . "images/food/" . $image_name;
    ?>
      <div class="flex gap-4 bg-gray-50 p-4 rounded-lg shadow hover:shadow-md transition">
        <div class="w-32 h-32 flex-shrink-0">
          <?php if ($image_name == ""): ?>
            <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500 text-sm">
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
               class="inline-block bg-orange-500 text-white px-4 py-2 rounded-md hover:bg-orange-600 transition text-sm font-medium">
              Order Now
            </a>
          </div>
        </div>
      </div>
    <?php
        }
    } else {
        echo "<div class='text-center text-red-600 font-semibold col-span-2'>Food not available for your search.</div>";
    }
    ?>
    </div>
  </div>
</section>
<!-- Food Menu Section Ends Here -->


    <?php include('partials-frontend/footer.php');?>