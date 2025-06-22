<?php include('partials-frontend/menu.php');?>

<!-- Categories Section Starts Here -->
<section class="main main-content bg-gradient-to-br from-orange-200 via-amber-50 to-yellow-50 py-12">
  <div class="container mx-auto px-4">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">Explore Foods</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
      <?php 
      $sql = "SELECT * FROM category WHERE active='Yes'";
      $res = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($res);

      if ($count > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
          $id = $row['id'];
          $title = $row['title'];
          $image_name = $row['image_name'];
          $image_path = SITEURL . "images/category/" . $image_name;
      ?>
        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>" class="group block relative overflow-hidden rounded-xl shadow hover:shadow-lg transition-transform transform hover:scale-105 duration-300">
          <?php if ($image_name == ""): ?>
            <div class="h-48 flex items-center justify-center bg-orange-100 text-orange-600 font-semibold">
              Image Not Available
            </div>
          <?php else: ?>
            <img src="<?php echo $image_path; ?>" alt="<?php echo $title; ?>" class="h-48 w-full object-cover transition-transform duration-300 group-hover:scale-110">
          <?php endif; ?>
          
          <!-- Orange-tinted overlay -->
          <div class="absolute bottom-0 left-0 right-0 bg-orange-600 bg-opacity-80 text-white text-center py-2">
            <h3 class="text-lg font-semibold"><?php echo $title; ?></h3>
          </div>
        </a>
      <?php
        }
      } else {
        echo "<div class='text-center text-red-600 font-semibold col-span-3'>Category Not Available</div>";
      }
      ?>
    </div>
  </div>
</section>
<!-- Categories Section Ends Here -->




    <?php include('partials-frontend/footer.php');?>