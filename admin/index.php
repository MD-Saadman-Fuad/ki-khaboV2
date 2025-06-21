<?php include("partials/menu.php") ?>

<!-- Main Dashboard Section Start -->
<div class="main main-content bg-gradient-to-br from-orange-100 to-orange-50 min-h-screen py-12">
  <div class="max-w-7xl mx-auto px-4">
    
    <h1 class="text-4xl font-bold text-center text-orange-700 mb-10">Dashboard</h1>

    <?php if (isset($_SESSION['login'])): ?>
      <div class="mb-6 text-center text-green-700 font-semibold bg-green-100 px-4 py-2 rounded shadow">
        <?php 
          echo $_SESSION['login'];
          unset($_SESSION['login']);
        ?>
      </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      
      <!-- Categories -->
      <div class="bg-gradient-to-br from-orange-400 to-orange-600 text-white rounded-xl shadow-lg p-6 text-center transform hover:scale-105 transition duration-300">
        <?php 
          $sql = "SELECT * FROM category";
          $res = mysqli_query($conn, $sql);
          $count = mysqli_num_rows($res);
        ?>
        <h2 class="text-3xl font-extrabold"><?php echo $count; ?></h2>
        <p class="mt-2 text-lg font-medium">Categories</p>
      </div>

      <!-- Foods -->
      <div class="bg-gradient-to-br from-orange-500 to-orange-700 text-white rounded-xl shadow-lg p-6 text-center transform hover:scale-105 transition duration-300">
        <?php 
          $sql2 = "SELECT * FROM food";
          $res2 = mysqli_query($conn, $sql2);
          $count2 = mysqli_num_rows($res2);
        ?>
        <h2 class="text-3xl font-extrabold"><?php echo $count2; ?></h2>
        <p class="mt-2 text-lg font-medium">Foods</p>
      </div>

      <!-- Orders -->
      <div class="bg-gradient-to-br from-orange-600 to-orange-800 text-white rounded-xl shadow-lg p-6 text-center transform hover:scale-105 transition duration-300">
        <?php 
          $sql3 = "SELECT * FROM order_table";
          $res3 = mysqli_query($conn, $sql3);
          $count3 = mysqli_num_rows($res3);
        ?>
        <h2 class="text-3xl font-extrabold"><?php echo $count3; ?></h2>
        <p class="mt-2 text-lg font-medium">Total Orders</p>
      </div>

      <!-- Revenue -->
      <div class="bg-gradient-to-br from-orange-700 to-orange-900 text-white rounded-xl shadow-lg p-6 text-center transform hover:scale-105 transition duration-300">
        <?php 
          $sql4 = "SELECT SUM(total) as Total FROM order_table WHERE status='Delivered'";
          $res4 = mysqli_query($conn, $sql4);
          $row4 = mysqli_fetch_assoc($res4);
          $total_revenue = $row4['Total'] ?? 0;
        ?>
        <h2 class="text-3xl font-extrabold"><?php echo number_format($total_revenue); ?>৳</h2>
        <p class="mt-2 text-lg font-medium">Revenue Generated</p>
      </div>
    </div>
  </div>
</div>
<!-- Main Dashboard Section End -->



<?php include("partials/footer.php") ?>