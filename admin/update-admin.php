
<?php include("partials/menu.php") ?>

    <?php 
      if (isset($_POST['submit'])) {
          $id = $_POST['id'];
          $full_name = $_POST['full_name'];
          $user_name = $_POST['user_name'];

          $sql = "UPDATE admin SET 
                  full_name = '$full_name',
                  user_name = '$user_name'
                  WHERE id = '$id'";

          $res = mysqli_query($conn, $sql);

          if ($res) {
              $_SESSION['update'] = "<div class='text-green-600 font-medium text-center py-4'>Admin Updated Successfully</div>";
          } else {
              $_SESSION['update'] = "<div class='text-red-600 font-medium text-center py-4'>Failed to Update Admin. Try Again!</div>";
          }

          header('location:' . SITEURL . 'admin/manage-admin.php');
      }
    ?>
<!-- Update Admin Starts -->
<div class="main-content py-10 px-4 bg-orange-50 min-h-screen">
  <div class="max-w-xl mx-auto">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Update Admin</h1>

    <?php 
      $id = $_GET['id'];

      $sql = "SELECT * FROM admin WHERE id = $id";
      $res = mysqli_query($conn, $sql);

      if ($res && mysqli_num_rows($res) == 1) {
          $row = mysqli_fetch_assoc($res);
          $full_name = $row['full_name'];
          $user_name = $row['user_name'];
      } else {
          header('location:' . SITEURL . 'admin/manage-admin.php');
      }
    ?>

    <!-- Update Form -->
    <form action="" method="POST" class="bg-white shadow-md rounded-lg p-6 space-y-5">
      <div>
        <label class="block text-gray-700 font-medium mb-1">Full Name</label>
        <input type="text" name="full_name" value="<?php echo $full_name; ?>" 
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400" />
      </div>

      <div>
        <label class="block text-gray-700 font-medium mb-1">Username</label>
        <input type="text" name="user_name" value="<?php echo $user_name; ?>"
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400" />
      </div>

      <input type="hidden" name="id" value="<?php echo $id; ?>">

      <div class="text-center pt-4">
        <input type="submit" name="submit" value="Update Admin"
               class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-md transition font-medium cursor-pointer" />
      </div>
    </form>
    <!-- End Form -->


  </div>
</div>
<!-- Update Admin Ends -->

<?php include("partials/footer.php"); ?>
