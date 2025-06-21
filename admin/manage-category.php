<?php include("partials/menu.php") ?>
<!-- Manage Category Starts -->
<div class="main-content py-10 px-4 bg-orange-50 min-h-screen">
  <div class="max-w-6xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Manage Categories</h1>

    <!-- Session Messages -->
    <?php
    $messages = ['add', 'remove', 'delete', 'no-category-found', 'update', 'upload', 'failed-remove'];
    foreach ($messages as $msg) {
      if (isset($_SESSION[$msg])) {
        echo "<div class='mb-4 px-4 py-3 rounded bg-green-100 text-green-800 font-medium shadow-sm'>{$_SESSION[$msg]}</div>";
        unset($_SESSION[$msg]);
      }
    }
    ?>

    <!-- Add Category Button -->
    <div class="mb-6">
      <a href="<?php echo SITEURL; ?>admin/add-category.php" 
         class="inline-block bg-orange-500 text-white px-5 py-2 rounded-md hover:bg-orange-600 transition">
        + Add Category
      </a>
    </div>

    <!-- Category Table -->
    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
      <table class="min-w-full text-sm text-left text-gray-700">
        <thead class="bg-orange-500 text-white uppercase text-xs">
          <tr>
            <th class="px-6 py-3">Serial No.</th>
            <th class="px-6 py-3">Title</th>
            <th class="px-6 py-3">Image</th>
            <th class="px-6 py-3">Featured</th>
            <th class="px-6 py-3">Active</th>
            <th class="px-6 py-3">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          <?php
          $sql = "SELECT * FROM category";
          $res = mysqli_query($conn, $sql);
          $count = mysqli_num_rows($res);
          $serial = 1;

          if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
              $id = $row['id'];
              $title = $row['title'];
              $image_name = $row['image_name'];
              $featured = $row['featured'];
              $active = $row['active'];
          ?>
              <tr class="hover:bg-orange-50 transition">
                <td class="px-6 py-4 font-medium"><?php echo $serial++; ?></td>
                <td class="px-6 py-4"><?php echo $title; ?></td>
                <td class="px-6 py-4">
                  <?php if ($image_name != ""): ?>
                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>"
                         class="h-12 w-20 object-cover rounded border border-gray-300" />
                  <?php else: ?>
                    <div class="text-red-500 text-sm">Image Not Added</div>
                  <?php endif; ?>
                </td>
                <td class="px-6 py-4"><?php echo $featured; ?></td>
                <td class="px-6 py-4"><?php echo $active; ?></td>
                <td class="px-6 py-4 space-x-2">
                  <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" 
                     class="inline-block bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition">
                    Update
                  </a>
                  <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" 
                     class="inline-block bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">
                    Delete
                  </a>
                </td>
              </tr>
          <?php
            }
          } else {
            echo "<tr><td colspan='6' class='text-center px-6 py-4 text-red-500'>No Categories Added</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- Manage Category Ends -->

<?php include("partials/footer.php") ?>