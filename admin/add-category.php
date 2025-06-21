<?php include("partials/menu.php") ?>


<!-- Add Category Starts -->
<div class="main-content py-10 px-4 bg-orange-50 min-h-screen">
  <div class="max-w-xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Add Category</h1>

    <!-- Session Messages -->
    <?php
    $messages = ['add', 'upload'];
    foreach ($messages as $msg) {
      if (isset($_SESSION[$msg])) {
        echo "<div class='mb-6 px-4 py-3 rounded bg-green-100 text-green-800 font-medium shadow-sm text-center'>{$_SESSION[$msg]}</div>";
        unset($_SESSION[$msg]);
      }
    }
    ?>

    <!-- Form Starts -->
    <form action="" method="POST" enctype="multipart/form-data"
          class="bg-white shadow-md rounded-lg p-6 space-y-5">

      <div>
        <label class="block text-gray-700 mb-1 font-medium">Title</label>
        <input type="text" name="title" placeholder="Category Title"
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400" />
      </div>

      <div>
        <label class="block text-gray-700 mb-1 font-medium">Select Image</label>
        <input type="file" name="image"
               class="w-full text-gray-700 file:mr-4 file:py-2 file:px-4
                      file:rounded-md file:border-0 file:text-sm file:font-semibold
                      file:bg-orange-500 file:text-white hover:file:bg-orange-600" />
      </div>

      <div>
        <label class="block text-gray-700 mb-1 font-medium">Featured</label>
        <div class="flex items-center gap-4">
          <label class="flex items-center">
            <input type="radio" name="featured" value="Yes" class="mr-2"> Yes
          </label>
          <label class="flex items-center">
            <input type="radio" name="featured" value="No" class="mr-2"> No
          </label>
        </div>
      </div>

      <div>
        <label class="block text-gray-700 mb-1 font-medium">Active</label>
        <div class="flex items-center gap-4">
          <label class="flex items-center">
            <input type="radio" name="active" value="Yes" class="mr-2"> Yes
          </label>
          <label class="flex items-center">
            <input type="radio" name="active" value="No" class="mr-2"> No
          </label>
        </div>
      </div>

      <div class="text-center">
        <input type="submit" name="submit" value="Add Category"
               class="bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-600 transition font-medium cursor-pointer" />
      </div>
    </form>
    <!-- Form Ends -->

    <?php 
    if (isset($_POST['submit'])) {
      $title = $_POST['title'];
      $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
      $active = isset($_POST['active']) ? $_POST['active'] : "No";
      $image_name = "";

      if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
        $original_name = $_FILES['image']['name'];
        $ext = pathinfo($original_name, PATHINFO_EXTENSION);
        $image_name = "Food_Category_" . rand(100, 999) . "." . $ext;

        $source_path = $_FILES['image']['tmp_name'];
        $destination_path = "../images/category/" . $image_name;

        $upload = move_uploaded_file($source_path, $destination_path);

        if (!$upload) {
          $_SESSION['upload'] = "<div class='text-red-600 font-medium'>Failed to Upload Image.</div>";
          header('location:' . SITEURL . 'admin/add-category.php');
          die();
        }
      }

      $sql = "INSERT INTO category SET 
              title='$title',
              image_name='$image_name',
              featured='$featured',
              active='$active'";

      $res = mysqli_query($conn, $sql);

      if ($res == true) {
        $_SESSION['add'] = "<div class='text-green-600 font-medium'>Category Added Successfully.</div>";
        header('location:' . SITEURL . 'admin/manage-category.php');
      } else {
        $_SESSION['add'] = "<div class='text-red-600 font-medium'>Failed to Add Category.</div>";
        header('location:' . SITEURL . 'admin/add-category.php');
      }
    }
    ?>
  </div>
</div>
<!-- Add Category Ends -->

<?php include("partials/footer.php"); ?>
