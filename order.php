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
<section class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
  <div class="bg-white shadow-lg rounded-lg max-w-md w-full">
    <div class="overflow-hidden rounded-t-lg h-48 bg-gray-200">
      <?php if ($image_name): ?>
        <img src="<?= SITEURL ?>images/food/<?= $image_name ?>" alt="<?= htmlspecialchars($title) ?>" class="object-cover w-full h-full">
      <?php else: ?>
        <div class="flex items-center justify-center h-full text-gray-500">No image available</div>
      <?php endif; ?>
    </div>
    <div class="p-6">
      <h2 class="text-2xl font-semibold mb-2"><?= htmlspecialchars($title) ?></h2>
      <p class="text-lg text-green-600 font-semibold mb-4">৳ <?= number_format($price, 2) ?></p>
      <p class="text-gray-700 mb-6"><?= htmlspecialchars($description) ?></p>

      <form action="" method="post" class="space-y-5">
        <div>
          <label for="qty" class="block text-gray-600 font-medium mb-1">Quantity</label>
          <input id="qty" name="qty" type="number" min="1" value="1"
                 class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-green-500" required>
          <input type="hidden" name="food" value="<?= htmlspecialchars($title) ?>">
          <input type="hidden" name="price" value="<?= htmlspecialchars($price) ?>">
        </div>

        <hr class="my-4">

        <div>
          <h3 class="text-xl font-semibold mb-2">Delivery Details</h3>
          <div class="space-y-4">
            <input name="full-name" type="text" placeholder="Full Name"
                   class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-green-500" required>
            <input name="contact" type="tel" placeholder="Phone Number"
                   class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-green-500" required>
            <input name="email" type="email" placeholder="Email"
                   class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-green-500" required>
            <textarea name="address" rows="3" placeholder="Delivery Address"
                      class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-green-500" required></textarea>
          </div>
        </div>

        <button type="submit" name="submit"
                class="w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition">
          Confirm Order
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