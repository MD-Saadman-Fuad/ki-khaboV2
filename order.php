<?php include('partials-frontend/menu.php');?>

    <?php 
  if (isset($_GET['food_id'])) {
    $food_id = $_GET['food_id'];
    $sql = "SELECT * FROM food WHERE id=$food_id";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) === 1) {
      $row = mysqli_fetch_assoc($res);
      $title = $row['title'];
      $price = $row['price'];
      $description = $row['description'];
      $image_name = $row['image_name'];
    } else {
      header("Location: " . SITEURL);
    }
  } else {
    header("Location: " . SITEURL);
  }
?>

<style>
  /* Custom animations and transitions */
  .fade-in {
    animation: fadeIn 0.6s ease-out;
  }
  
  @keyframes fadeIn {
    from {
      opacity: 0;
      transform: translateY(20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  
  .hover-lift {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  
  .hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
  }
  
  .image-zoom {
    transition: transform 0.4s ease;
  }
  
  .image-zoom:hover {
    transform: scale(1.05);
  }
  
  .input-focus {
    transition: all 0.3s ease;
  }
  
  .input-focus:focus {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(34, 197, 94, 0.15);
  }
  
  .button-press {
    transition: all 0.2s ease;
  }
  
  .button-press:active {
    transform: translateY(1px);
  }
  
  .section-slide {
    animation: slideUp 0.8s ease-out;
  }
  
  @keyframes slideUp {
    from {
      opacity: 0;
      transform: translateY(30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
</style>

<section class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
  <div class="bg-white shadow-lg rounded-lg max-w-md w-full hover-lift fade-in">
    <div class="overflow-hidden rounded-t-lg h-48 bg-gray-200">
      <?php if ($image_name): ?>
        <img src="<?= SITEURL ?>images/food/<?= $image_name ?>" alt="<?= htmlspecialchars($title) ?>" 
             class="object-cover w-full h-full image-zoom">
      <?php else: ?>
        <div class="flex items-center justify-center h-full text-gray-500 transition-colors duration-300 hover:text-gray-700">
          No image available
        </div>
      <?php endif; ?>
    </div>
    
    <div class="p-6 section-slide">
      <h2 class="text-2xl font-semibold mb-2 transition-colors duration-300 hover:text-green-600">
        <?= htmlspecialchars($title) ?>
      </h2>
      <p class="text-lg text-green-600 font-semibold mb-4 transition-all duration-300 hover:text-green-700 hover:scale-105">
        ৳ <?= number_format($price, 2) ?>
      </p>
      <p class="text-gray-700 mb-6 transition-colors duration-300 hover:text-gray-800">
        <?= htmlspecialchars($description) ?>
      </p>

      <form action="" method="post" class="space-y-5">
        <div class="transition-all duration-300 hover:bg-gray-50 hover:rounded-lg hover:p-3 hover:-m-3">
          <label for="qty" class="block text-gray-600 font-medium mb-1 transition-colors duration-300">
            Quantity
          </label>
          <input id="qty" name="qty" type="number" min="1" value="1"
                 class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-green-500 input-focus" required>
          <input type="hidden" name="food" value="<?= htmlspecialchars($title) ?>">
          <input type="hidden" name="price" value="<?= htmlspecialchars($price) ?>">
        </div>

        <hr class="my-4 transition-all duration-500 hover:border-green-300">

        <div class="transition-all duration-300 hover:bg-gray-50 hover:rounded-lg hover:p-4 hover:-m-4">
          <h3 class="text-xl font-semibold mb-2 transition-colors duration-300 hover:text-green-600">
            Delivery Details
          </h3>
          <div class="space-y-4">
            <input name="full-name" type="text" placeholder="Full Name"
                   class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-green-500 input-focus 
                          transition-all duration-300 hover:border-green-300" required>
            <input name="contact" type="tel" placeholder="Phone Number"
                   class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-green-500 input-focus 
                          transition-all duration-300 hover:border-green-300" required>
            <input name="email" type="email" placeholder="Email"
                   class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-green-500 input-focus 
                          transition-all duration-300 hover:border-green-300" required>
            <textarea name="address" rows="3" placeholder="Delivery Address"
                      class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-green-500 input-focus 
                             transition-all duration-300 hover:border-green-300 resize-none" required></textarea>
          </div>
        </div>

        <button type="submit" name="submit"
                class="w-full bg-orange-600 text-white py-3 rounded-lg font-semibold 
                       hover:bg-green-700 transition-all duration-300 button-press
                       hover:shadow-lg hover:shadow-green-500/25 
                       transform hover:scale-[1.02] active:scale-[0.98]
                       focus:ring-4 focus:ring-green-500/50 focus:outline-none">
          <span class="transition-all duration-200">Confirm Order</span>
        </button>
      </form>
    </div>
  </div>
</section>

<?php
  if (isset($_POST['submit'])) {
    $food = mysqli_real_escape_string($conn, $_POST['food']);
    $price = (float)$_POST['price'];
    $qty = (int)$_POST['qty'];
    $total = $price * $qty;
    $order_date = date("Y-m-d H:i:s");
    $status = 'Ordered';
    $customer_name = mysqli_real_escape_string($conn, $_POST['full-name']);
    $customer_contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $customer_email = mysqli_real_escape_string($conn, $_POST['email']);
    $customer_address = mysqli_real_escape_string($conn, $_POST['address']);

    $sql2 = "
      INSERT INTO order_table SET
        food='$food', price=$price, quantity=$qty, total=$total, order_date='$order_date',
        status='$status', customer_name='$customer_name',
        customer_contact='$customer_contact', customer_email='$customer_email',
        customer_address='$customer_address'
    ";
    if (mysqli_query($conn, $sql2)) {
      $_SESSION['order'] = "<div class='text-center text-green-600 font-semibold'>Food Ordered Successfully.</div>";
      header("Location: " . SITEURL);
    } else {
      $_SESSION['order'] = "<div class='text-center text-red-600 font-semibold'>Order Failed. Please try again!</div>";
      header("Location: " . SITEURL);
    }
  }
?>

<?php include('partials-frontend/footer.php');?>