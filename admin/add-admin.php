<?php include("partials/menu.php") ?>

<!-- Add Admin Starts -->
<div class="main-content py-10 px-4 bg-orange-50 min-h-screen">
  <div class="max-w-xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Add Admin</h1>

    <!-- Session Message -->
    <?php
    if (isset($_SESSION['add'])) {
      echo "<div class='mb-6 px-4 py-3 rounded bg-green-100 text-green-800 font-medium shadow-sm text-center'>{$_SESSION['add']}</div>";
      unset($_SESSION['add']);
    }
    ?>

    <!-- Admin Form -->
    <form action="" method="POST" class="bg-white shadow-md rounded-lg p-6 space-y-5">
      <div>
        <label class="block text-gray-700 mb-1 font-medium">Full Name</label>
        <input type="text" name="full_name" placeholder="Enter your name"
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400" />
      </div>
      <div>
        <label class="block text-gray-700 mb-1 font-medium">Username</label>
        <input type="text" name="user_name" placeholder="Enter your username"
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400" />
      </div>
      <div>
        <label class="block text-gray-700 mb-1 font-medium">Password</label>
        <input type="password" name="password" placeholder="Enter your password"
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400" />
      </div>
      <div class="text-center">
        <input type="submit" name="submit" value="Add Admin"
               class="bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-600 transition font-medium cursor-pointer" />
      </div>
    </form>
  </div>
</div>
<!-- Add Admin Ends -->

<?php include("partials/footer.php"); ?>

<?php
if (isset($_POST['submit'])) {
  $full_name = $_POST['full_name'];
  $user_name = $_POST['user_name'];
  $password = md5($_POST['password']); // password encryption

  if (empty($user_name) || empty($full_name)) {
    $_SESSION['add'] = "<div class='text-red-600 font-medium'>Please enter correct information</div>";
    header("location:" . SITEURL . 'admin/add-admin.php');
  } else {
    $sql = "INSERT INTO admin SET
            full_name = '$full_name',
            user_name = '$user_name',
            password = '$password'";

    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    if ($res == TRUE) {
      $_SESSION['add'] = "<div class='text-green-600 font-medium'>Admin added successfully</div>";
      header("location:" . SITEURL . 'admin/manage-admin.php');
    } else {
      $_SESSION['add'] = "<div class='text-red-600 font-medium'>Failed to add admin</div>";
      header("location:" . SITEURL . 'admin/add-admin.php');
    }
  }
}
?>
