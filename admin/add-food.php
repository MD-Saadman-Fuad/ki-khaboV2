<?php include('partials/menu.php'); ?>

<!-- Add Food Starts -->
<div class="main-content py-10 px-4 bg-orange-50 min-h-screen">
  <div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Add Food</h1>

    <!-- Upload Status Message -->
    <?php 
    if (isset($_SESSION['upload'])) {
        echo "<div class='mb-6 px-4 py-3 rounded bg-red-100 text-red-800 font-medium shadow-sm text-center'>{$_SESSION['upload']}</div>";
        unset($_SESSION['upload']);
    }
    ?>

    <!-- Form Starts -->
    <form action="" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6 space-y-5">

      <div>
        <label class="block text-gray-700 mb-1 font-medium">Title</label>
        <input type="text" name="title" placeholder="Title of the Food"
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400" />
      </div>

      <div>
        <label class="block text-gray-700 mb-1 font-medium">Description</label>
        <textarea name="description" rows="4" placeholder="Description of the Food"
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400"></textarea>
      </div>

      <div>
        <label class="block text-gray-700 mb-1 font-medium">Price (Taka)</label>
        <input type="number" name="price"
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
        <label class="block text-gray-700 mb-1 font-medium">Category</label>
        <select name="category" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400">
          <?php 
          $sql = "SELECT * FROM category WHERE active='Yes'";
          $res = mysqli_query($conn, $sql);
          $count = mysqli_num_rows($res);

          if ($count > 0) {
              while ($row = mysqli_fetch_assoc($res)) {
                  $id = $row['id'];
                  $title = $row['title'];
                  echo "<option value='{$id}'>{$title}</option>";
              }
          } else {
              echo "<option value='0'>No Category Found</option>";
          }
          ?>
        </select>
      </div>

      <div>
        <label class="block text-gray-700 mb-1 font-medium">Featured</label>
        <div class="flex gap-4">
          <label><input type="radio" name="featured" value="Yes" class="mr-2">Yes</label>
          <label><input type="radio" name="featured" value="No" class="mr-2">No</label>
        </div>
      </div>

      <div>
        <label class="block text-gray-700 mb-1 font-medium">Active</label>
        <div class="flex gap-4">
          <label><input type="radio" name="active" value="Yes" class="mr-2">Yes</label>
          <label><input type="radio" name="active" value="No" class="mr-2">No</label>
        </div>
      </div>

      <div class="text-center">
        <input type="submit" name="submit" value="Add Food"
               class="bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-600 transition font-medium cursor-pointer" />
      </div>
    </form>
    <!-- Form Ends -->

    <?php 
    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
        $active = isset($_POST['active']) ? $_POST['active'] : "No";
        $image_name = "";

        if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
            $image_name = $_FILES['image']['name'];
            $ext = pathinfo($image_name, PATHINFO_EXTENSION);
            $image_name = "Food_Category_" . rand(100, 999) . '.' . $ext;

            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/food/" . $image_name;

            $upload = move_uploaded_file($source_path, $destination_path);
            if (!$upload) {
                $_SESSION['upload'] = "<div class='text-red-600 font-medium'>Failed to Upload Image.</div>";
                header('location:' . SITEURL . 'admin/add-category.php');
                die();
            }
        }

        $sql2 = "INSERT INTO food SET 
                 title = '$title',
                 description = '$description',
                 price = $price,
                 image_name = '$image_name',
                 category_id = $category,
                 featured = '$featured',
                 active = '$active'";

        $res2 = mysqli_query($conn, $sql2);

        if ($res2 == true) {
            $_SESSION['add'] = "<div class='text-green-600 font-medium'>Food Added Successfully.</div>";
            header('location:' . SITEURL . 'admin/manage-food.php');
        } else {
            $_SESSION['add'] = "<div class='text-red-600 font-medium'>Failed to Add Food.</div>";
            header('location:' . SITEURL . 'admin/manage-food.php');
        }
    }
    ?>
  </div>
</div>
<!-- Add Food Ends -->


<?php include('partials/footer.php'); ?>