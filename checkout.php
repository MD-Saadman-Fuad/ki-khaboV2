<?php 
include('config/constants.php');

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();

if (empty($cart)) {
    header("Location: " . SITEURL . "foods.php");
    exit();
}

$subtotal = 0;
$total_qty = 0;
foreach ($cart as $item) {
    $subtotal += ($item['price'] * $item['qty']);
    $total_qty += $item['qty'];
}
$delivery_fee = 50.00;
$grand_total = $subtotal + $delivery_fee;

if (isset($_POST['submit'])) {
    $customer_name = mysqli_real_escape_string($conn, $_POST['full-name']);
    $customer_contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $customer_email = mysqli_real_escape_string($conn, $_POST['email']);
    $customer_address = mysqli_real_escape_string($conn, $_POST['address']);
    $order_date = date("Y-m-d H:i:s");
    $status = 'Ordered';

    $food_items = array();
    $subtotal = 0;
    $total_qty = 0;

    foreach ($cart as $item) {
        $food_items[] = $item['qty'] . "x " . $item['title'];
        $subtotal += ($item['price'] * $item['qty']);
        $total_qty += (int)$item['qty'];
    }

    $delivery_fee = 50.00;
    $grand_total = $subtotal + $delivery_fee;
    $food_list_str = mysqli_real_escape_string($conn, implode(", ", $food_items));

    $sql = "INSERT INTO order_table SET
        food='$food_list_str',
        price=$subtotal,
        quantity=$total_qty,
        total=$grand_total,
        order_date='$order_date',
        status='$status',
        customer_name='$customer_name',
        customer_contact='$customer_contact',
        customer_email='$customer_email',
        customer_address='$customer_address'
    ";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['cart'] = array();
        $_SESSION['order'] = "<div class='text-center text-emerald-700 font-bold'>🎉 Bulk Order placed successfully! Total: ৳" . number_format($grand_total, 2) . "</div>";
        header("Location: " . SITEURL);
        exit();
    } else {
        $_SESSION['cart_msg'] = "<div class='text-center text-red-600 font-bold'>Order failed. Please try again!</div>";
    }
}
?>

<?php include('partials-frontend/menu.php'); ?>

<section class="py-16 bg-stone-50 min-h-[80vh]">
  <div class="container mx-auto px-4 max-w-4xl">
    <div class="text-center mb-10">
      <span class="text-xs font-extrabold uppercase tracking-widest text-orange-600 bg-orange-100 px-3 py-1 rounded-full">Checkout</span>
      <h1 class="text-3xl sm:text-4xl font-extrabold text-stone-900 tracking-tight mt-2">Bulk Checkout</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 items-start">
      
      <!-- Order Items Preview (2 Cols) -->
      <div class="lg:col-span-2 bg-white rounded-2xl p-6 shadow-sm border border-stone-200/70 space-y-4">
        <h2 class="text-lg font-bold text-stone-900 border-b border-stone-100 pb-3 flex justify-between items-center">
          <span>Order Details</span>
          <span class="text-xs bg-orange-100 text-orange-700 font-bold px-2.5 py-0.5 rounded-full"><?php echo $total_qty; ?> Items</span>
        </h2>

        <div class="divide-y divide-stone-100 max-h-80 overflow-y-auto pr-1">
          <?php foreach ($cart as $item): ?>
            <div class="py-3 flex justify-between items-center text-sm">
              <div>
                <h4 class="font-bold text-stone-900"><?php echo htmlspecialchars($item['title']); ?></h4>
                <p class="text-xs text-stone-500">Qty: <?php echo $item['qty']; ?> × ৳<?php echo number_format($item['price'], 2); ?></p>
              </div>
              <span class="font-extrabold text-stone-900">৳<?php echo number_format($item['price'] * $item['qty'], 2); ?></span>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="border-t border-stone-100 pt-4 space-y-2 text-sm">
          <div class="flex justify-between text-stone-600">
            <span>Subtotal</span>
            <span class="font-bold text-stone-800">৳<?php echo number_format($subtotal, 2); ?></span>
          </div>
          <div class="flex justify-between text-stone-600">
            <span>Delivery Fee</span>
            <span class="font-bold text-stone-800">৳<?php echo number_format($delivery_fee, 2); ?></span>
          </div>
          <div class="border-t border-stone-100 pt-3 flex justify-between text-base font-extrabold text-stone-900">
            <span>Total Payable</span>
            <span class="text-orange-600">৳<?php echo number_format($grand_total, 2); ?></span>
          </div>
        </div>
      </div>

      <!-- Customer Details Form (3 Cols) -->
      <div class="lg:col-span-3 bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-stone-200/70">
        <h2 class="text-xl font-bold text-stone-900 mb-6 border-b border-stone-100 pb-3">Delivery Information</h2>

        <form action="" method="post" class="space-y-5">
          <div>
            <label class="block text-xs font-semibold text-stone-600 mb-1">Full Name</label>
            <input name="full-name" type="text" placeholder="e.g. Saadman Fuad"
                   class="w-full p-3 bg-stone-50 border border-stone-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition font-medium text-sm" required>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-xs font-semibold text-stone-600 mb-1">Phone Number</label>
              <input name="contact" type="tel" placeholder="e.g. 01712345678"
                     class="w-full p-3 bg-stone-50 border border-stone-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition font-medium text-sm" required>
            </div>
            <div>
              <label class="block text-xs font-semibold text-stone-600 mb-1">Email Address</label>
              <input name="email" type="email" placeholder="e.g. name@example.com"
                     class="w-full p-3 bg-stone-50 border border-stone-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition font-medium text-sm" required>
            </div>
          </div>

          <div>
            <label class="block text-xs font-semibold text-stone-600 mb-1">Delivery Address</label>
            <textarea name="address" rows="3" placeholder="House/Apartment, Street Name, Area, City"
                      class="w-full p-3 bg-stone-50 border border-stone-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition font-medium text-sm resize-none" required></textarea>
          </div>

          <button type="submit" name="submit"
                  class="w-full bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 text-white py-4 rounded-xl font-bold 
                         shadow-lg shadow-orange-500/25 transition-all duration-200 
                         transform hover:scale-[1.01] active:scale-[0.99]
                         focus:ring-4 focus:ring-orange-300 focus:outline-none flex items-center justify-center gap-2 mt-4">
            <span>Place Bulk Order (৳<?php echo number_format($grand_total, 2); ?>)</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
          </button>
        </form>
      </div>

    </div>
  </div>
</section>

<?php include('partials-frontend/footer.php'); ?>
