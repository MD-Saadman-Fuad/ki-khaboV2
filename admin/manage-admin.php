<?php include("partials/menu.php") ?>


<!-- Main Content Starts -->
<div class="main-content py-10 px-4 bg-orange-50 min-h-screen">
  <div class="max-w-6xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Manage Admin</h1>

    <!-- Session Messages -->
    <?php
    $messages = ['add', 'delete', 'update', 'user-not-found', 'password-not-match', 'change-password'];
    foreach ($messages as $msg) {
      if (isset($_SESSION[$msg])) {
        echo "<div class='mb-4 px-4 py-3 rounded bg-green-100 text-green-800 font-medium shadow-sm'>{$_SESSION[$msg]}</div>";
        unset($_SESSION[$msg]);
      }
    }
    ?>

    <!-- Add Admin Button -->
    <div class="mb-6">
      <a href="add-admin.php" class="inline-block bg-orange-500 text-white px-5 py-2 rounded-md hover:bg-orange-600 transition">
        + Add Admin
      </a>
    </div>

    <!-- Admin Table -->
    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
      <table class="min-w-full text-sm text-left text-gray-700">
        <thead class="bg-orange-500 text-white uppercase text-xs">
          <tr>
            <th class="px-6 py-3">Serial No.</th>
            <th class="px-6 py-3">Full Name</th>
            <th class="px-6 py-3">Username</th>
            <th class="px-6 py-3">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          <?php
          $sql = "SELECT * FROM admin";
          $res = mysqli_query($conn, $sql);

          if ($res == TRUE) {
            $count = mysqli_num_rows($res);
            $serial = 1;
            if ($count > 0) {
              while ($rows = mysqli_fetch_assoc($res)) {
                $id = $rows['id'];
                $full_name = $rows['full_name'];
                $user_name = $rows['user_name'];
          ?>
                <tr class="hover:bg-orange-50 transition">
                  <td class="px-6 py-4 font-medium"><?php echo $serial++; ?></td>
                  <td class="px-6 py-4"><?php echo $full_name; ?></td>
                  <td class="px-6 py-4"><?php echo $user_name; ?></td>
                  <td class="px-6 py-4 space-x-2">
                    <a href="<?php echo SITEURL; ?>admin/change-password.php?id=<?php echo $id; ?>"
                       class="inline-block bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition">
                      Change Password
                    </a>
                    <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>"
                       class="inline-block bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition">
                      Update
                    </a>
                    <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>"
                       class="inline-block bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">
                      Delete
                    </a>
                  </td>
                </tr>
          <?php
              }
            } else {
              echo "<tr><td colspan='4' class='px-6 py-4 text-center text-red-500'>No Admins Found</td></tr>";
            }
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- Main Content Ends -->


<?php include("partials/footer.php") ?>