<?php 
include('config/constants.php');

if (isset($_GET['food_id'])) {
  $food_id = (int)$_GET['food_id'];
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
    exit();
  }
} else {
  header("Location: " . SITEURL);
  exit();
}

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
    $_SESSION['order'] = "<div class='text-center text-emerald-700 font-bold'>🎉 Food Ordered Successfully.</div>";
    header("Location: " . SITEURL);
    exit();
  } else {
    $_SESSION['order'] = "<div class='text-center text-red-600 font-bold'>Order Failed. Please try again!</div>";
    header("Location: " . SITEURL);
    exit();
  }
}
?>

<?php include('partials-frontend/menu.php');?>

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

<style>
  .fade-in {
    animation: fadeIn 0.5s cubic-bezier(0.16, 1, 0.3, 1);
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
</style>

<section class="bg-stone-50 py-12 min-h-screen flex items-center justify-center p-4">
  <div class="bg-white shadow-xl rounded-2xl max-w-lg w-full border border-stone-200/70 overflow-hidden fade-in">
    <div class="overflow-hidden h-56 bg-stone-100 relative">
      <?php if ($image_name): ?>
        <img src="<?= SITEURL ?>images/food/<?= $image_name ?>" alt="<?= htmlspecialchars($title) ?>" 
             class="object-cover w-full h-full transition-transform duration-500 hover:scale-105">
      <?php else: ?>
        <div class="flex items-center justify-center h-full text-stone-400 font-medium">
          No image available
        </div>
      <?php endif; ?>
      <div class="absolute inset-0 bg-gradient-to-t from-stone-900/60 to-transparent"></div>
      <div class="absolute bottom-4 left-6 right-6 flex justify-between items-end text-white">
        <h2 class="text-2xl font-extrabold tracking-tight drop-shadow-sm">
          <?= htmlspecialchars($title) ?>
        </h2>
        <span class="bg-white/90 backdrop-blur-md text-orange-600 font-extrabold px-3 py-1 rounded-full text-sm shadow-md">
          ৳ <?= number_format($price, 2) ?>
        </span>
      </div>
    </div>
    
    <div class="p-6 sm:p-8">
      <p class="text-stone-500 text-sm leading-relaxed mb-6 border-b border-stone-100 pb-4">
        <?= htmlspecialchars($description) ?>
      </p>

      <form action="" method="post" class="space-y-6">
        <div>
          <label for="qty" class="block text-stone-700 font-bold text-sm mb-2">
            Quantity
          </label>
          <input id="qty" name="qty" type="number" min="1" value="1"
                 class="w-full p-3 bg-stone-50 border border-stone-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition font-medium" required>
          <input type="hidden" name="food" value="<?= htmlspecialchars($title) ?>">
          <input type="hidden" name="price" value="<?= htmlspecialchars($price) ?>">
        </div>

        <div>
          <h3 class="text-lg font-bold text-stone-900 mb-3 border-b border-stone-100 pb-2">
            Delivery Details
          </h3>
          <div class="space-y-3.5">
            <div>
              <label class="block text-xs font-semibold text-stone-500 mb-1">Full Name</label>
              <input name="full-name" type="text" placeholder="e.g. Saadman Fuad"
                     class="w-full p-3 bg-stone-50 border border-stone-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition font-medium" required>
            </div>
            <div>
              <label class="block text-xs font-semibold text-stone-500 mb-1">Phone Number</label>
              <input name="contact" type="tel" placeholder="e.g. 01712345678"
                     class="w-full p-3 bg-stone-50 border border-stone-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition font-medium" required>
            </div>
            <div>
              <label class="block text-xs font-semibold text-stone-500 mb-1">Email Address</label>
              <input name="email" type="email" placeholder="e.g. name@example.com"
                     class="w-full p-3 bg-stone-50 border border-stone-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition font-medium" required>
            </div>
            <div>
              <label class="block text-xs font-semibold text-stone-500 mb-1">Delivery Address</label>
              <textarea name="address" rows="3" placeholder="House/Street, Area, City"
                        class="w-full p-3 bg-stone-50 border border-stone-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition font-medium resize-none" required></textarea>
            </div>
          </div>
        </div>

        <button type="submit" name="submit"
                class="w-full bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 text-white py-4 rounded-xl font-bold 
                       shadow-lg shadow-orange-500/25 transition-all duration-200 
                       transform hover:scale-[1.01] active:scale-[0.99]
                       focus:ring-4 focus:ring-orange-300 focus:outline-none flex items-center justify-center gap-2">
          <span>Confirm & Order Now</span>
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
        </button>
      </form>
    </div>
  </div>
</section>

<?php include('partials-frontend/footer.php');?>