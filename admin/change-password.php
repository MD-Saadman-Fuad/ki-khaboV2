<?php include("partials/menu.php") ?>

<!-- End Form -->

    <?php 
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        $sql = "SELECT * FROM admin WHERE id = $id AND password = '$current_password'";
        $res = mysqli_query($conn, $sql);

        if ($res && mysqli_num_rows($res) == 1) {
            if ($new_password == $confirm_password) {
                $sql1 = "UPDATE admin SET password = '$new_password' WHERE id = $id";
                $res1 = mysqli_query($conn, $sql1);

                if ($res1) {
                    $_SESSION['change-password'] = "<div class='text-green-600 font-medium text-center py-4'>Password Changed Successfully</div>";
                } else {
                    $_SESSION['change-password'] = "<div class='text-red-600 font-medium text-center py-4'>Failed to Change Password</div>";
                }
            } else {
                $_SESSION['password-not-match'] = "<div class='text-red-600 font-medium text-center py-4'>Passwords Did Not Match</div>";
            }
        } else {
            $_SESSION['user-not-found'] = "<div class='text-red-600 font-medium text-center py-4'>User Not Found</div>";
        }

        header('location:' . SITEURL . 'admin/manage-admin.php');
    }
    ?>
  </div>
</div>
<!-- Change Password Ends -->

<!-- Change Password Starts -->
<div class="main-content py-10 px-4 bg-orange-50 min-h-screen">
  <div class="max-w-xl mx-auto">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Change Password</h1>

    <?php 
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    ?>

    <!-- Change Password Form -->
    <form action="" method="POST" class="bg-white shadow-md rounded-lg p-6 space-y-5">

      <div>
        <label class="block text-gray-700 font-medium mb-1">Current Password</label>
        <input type="password" name="current_password" placeholder="Enter current password"
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400" />
      </div>

      <div>
        <label class="block text-gray-700 font-medium mb-1">New Password</label>
        <input type="password" name="new_password" placeholder="Enter new password"
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400" />
      </div>

      <div>
        <label class="block text-gray-700 font-medium mb-1">Confirm Password</label>
        <input type="password" name="confirm_password" placeholder="Confirm new password"
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400" />
      </div>

      <input type="hidden" name="id" value="<?php echo $id; ?>">

      <div class="text-center pt-4">
        <input type="submit" name="submit" value="Change Password"
               class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-md transition font-medium cursor-pointer" />
      </div>
    </form>
    

<?php include("partials/footer.php"); ?>
