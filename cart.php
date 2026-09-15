<?php include('partials-frontend/menu.php'); ?>

<section class="py-16 bg-stone-50 min-h-[75vh]">
  <div class="container mx-auto px-4 max-w-5xl">
    <div class="text-center mb-10">
      <span class="text-xs font-extrabold uppercase tracking-widest text-orange-600 bg-orange-100 px-3 py-1 rounded-full">Your Cart</span>
      <h1 class="text-3xl sm:text-4xl font-extrabold text-stone-900 tracking-tight mt-2">Shopping Cart</h1>
    </div>

    <!-- Flash Message -->
    <?php 
    if (isset($_SESSION['cart_msg'])) {
        echo "<div class='max-w-xl mx-auto mb-6'>{$_SESSION['cart_msg']}</div>";
        unset($_SESSION['cart_msg']);
    }
    ?>

    <?php 
    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
    if (!empty($cart)): 
        $subtotal = 0;
    ?>
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        
        <!-- Cart Items List -->
        <div class="lg:col-span-2 space-y-4">
          <div class="bg-white rounded-2xl p-6 shadow-sm border border-stone-200/70">
            <div class="flex justify-between items-center pb-4 mb-4 border-b border-stone-100">
              <h2 class="text-lg font-bold text-stone-900">Cart Items (<?php echo count($cart); ?>)</h2>
              <a href="<?php echo SITEURL; ?>cart-action.php?action=clear" 
                 class="text-xs text-red-500 hover:text-red-700 font-bold transition">
                Clear Entire Cart
              </a>
            </div>

            <div class="divide-y divide-stone-100">
              <?php 
              foreach ($cart as $id => $item): 
                  $item_total = $item['price'] * $item['qty'];
                  $subtotal += $item_total;
                  $image_path = SITEURL . "images/food/" . $item['image_name'];
              ?>
                <div class="py-4 flex flex-col sm:flex-row items-center justify-between gap-4">
                  <div class="flex items-center gap-4 w-full sm:w-auto">
                    <div class="w-20 h-20 rounded-xl overflow-hidden bg-stone-100 flex-shrink-0 border border-stone-200/60">
                      <?php if ($item['image_name']): ?>
                        <img src="<?php echo $image_path; ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" class="w-full h-full object-cover">
                      <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center text-xs text-stone-400 font-medium">No Image</div>
                      <?php endif; ?>
                    </div>
                    <div>
                      <h3 class="font-bold text-stone-900"><?php echo htmlspecialchars($item['title']); ?></h3>
                      <p class="text-xs text-stone-500 mt-0.5">Price: <span class="text-orange-600 font-bold">৳<?php echo number_format($item['price'], 2); ?></span></p>
                    </div>
                  </div>

                  <!-- Quantity Controls & Subtotal -->
                  <div class="flex items-center justify-between sm:justify-end gap-6 w-full sm:w-auto">
                    <div class="flex items-center border border-stone-200 rounded-lg overflow-hidden bg-stone-50">
                      <a href="<?php echo SITEURL; ?>cart-action.php?action=update&food_id=<?php echo $id; ?>&qty=<?php echo $item['qty'] - 1; ?>" 
                         class="px-3 py-1 bg-stone-100 text-stone-700 hover:bg-stone-200 font-bold transition text-sm">-</a>
                      <span class="px-3 py-1 text-sm font-bold text-stone-800"><?php echo $item['qty']; ?></span>
                      <a href="<?php echo SITEURL; ?>cart-action.php?action=update&food_id=<?php echo $id; ?>&qty=<?php echo $item['qty'] + 1; ?>" 
                         class="px-3 py-1 bg-stone-100 text-stone-700 hover:bg-stone-200 font-bold transition text-sm">+</a>
                    </div>

                    <div class="text-right">
                      <span class="font-extrabold text-stone-900 text-base">৳<?php echo number_format($item_total, 2); ?></span>
                    </div>

                    <a href="<?php echo SITEURL; ?>cart-action.php?action=remove&food_id=<?php echo $id; ?>" 
                       class="text-stone-400 hover:text-red-500 transition p-1" title="Remove Item">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </a>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>

          <div class="text-left">
            <a href="<?php echo SITEURL; ?>foods.php" 
               class="inline-flex items-center gap-2 text-stone-600 hover:text-orange-600 font-bold text-sm transition">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
              <span>Continue Shopping</span>
            </a>
          </div>
        </div>

        <!-- Order Summary Card -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-stone-200/70 space-y-5">
          <h2 class="text-lg font-bold text-stone-900 border-b border-stone-100 pb-3">Order Summary</h2>

          <?php 
            $delivery_fee = 50.00;
            $grand_total = $subtotal + $delivery_fee;
          ?>

          <div class="space-y-3 text-sm">
            <div class="flex justify-between text-stone-600">
              <span>Subtotal</span>
              <span class="font-bold text-stone-800">৳<?php echo number_format($subtotal, 2); ?></span>
            </div>
            <div class="flex justify-between text-stone-600">
              <span>Estimated Delivery Fee</span>
              <span class="font-bold text-stone-800">৳<?php echo number_format($delivery_fee, 2); ?></span>
            </div>
            <div class="border-t border-stone-100 pt-3 flex justify-between text-base font-extrabold text-stone-900">
              <span>Grand Total</span>
              <span class="text-orange-600">৳<?php echo number_format($grand_total, 2); ?></span>
            </div>
          </div>

          <a href="<?php echo SITEURL; ?>checkout.php" 
             class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-orange-500/25 transition-all duration-200 transform hover:scale-[1.01] active:scale-[0.99]">
            <span>Proceed to Bulk Checkout</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
          </a>
        </div>

      </div>

    <?php else: ?>
      <div class="bg-white rounded-2xl p-12 text-center max-w-md mx-auto shadow-sm border border-stone-200/70">
        <div class="w-20 h-20 bg-orange-100 text-orange-600 rounded-full flex items-center justify-center mx-auto mb-4">
          <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 0a2 2 0 100 4 2 2 0 000-4z"></path></svg>
        </div>
        <h2 class="text-2xl font-bold text-stone-900 mb-2">Your Cart is Empty</h2>
        <p class="text-stone-500 text-sm mb-6">Looks like you haven't added any delicious food items to your cart yet.</p>
        <a href="<?php echo SITEURL; ?>foods.php" 
           class="inline-flex items-center gap-2 bg-stone-900 hover:bg-stone-800 text-white px-7 py-3 rounded-xl font-bold shadow-md transition transform hover:scale-105">
          <span>Explore Food Menu</span>
        </a>
      </div>
    <?php endif; ?>

  </div>
</section>

<?php include('partials-frontend/footer.php'); ?>
