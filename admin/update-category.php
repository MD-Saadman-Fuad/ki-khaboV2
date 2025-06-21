<?php include("partials/menu.php") ?>


<!-- Update Category Section -->
<div class="main-content py-10 px-4 bg-orange-50 min-h-screen">
  <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">

    <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Update Category</h1>

    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM category WHERE id = $id";
        $res = mysqli_query($conn, $sql);
        if (mysqli_num_rows($res) == 1) {
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $current_image = $row['image_name'];
            $featured = $row['featured'];
            $active = $row['active'];
        } else {
            $_SESSION['no-category-found'] = "<div class='text-red-500 text-center font-medium py-2'>Category Not Found.</div>";
            header('location:' . SITEURL . 'admin/manage-category.php');
        }
    } else {
        header('location:' . SITEURL . 'admin/manage-category.php');
    }
    ?>

    <form action="" method="POST" enctype="multipart/form-data" class="space-y-6 mt-6">
      <div>
        <label class="block text-gray-700 font-medium mb-1">Title</label>
        <input type="text" name="title" value="<?php echo $title; ?>"
               class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-orange-400" />
      </div>

      <div>
        <label class="block text-gray-700 font-medium mb-1">Current Image</label>
        <?php if ($current_image != ""): ?>
          <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150" class="rounded-md shadow">
        <?php else: ?>
          <p class="text-sm text-red-500">Image Not Added</p>
        <?php endif; ?>
      </div>

      <div>
        <label class="block text-gray-700 font-medium mb-1">New Image</label>
        <input type="file" name="image" class="text-sm text-gray-600">
      </div>

      <div>
        <label class="block text-gray-700 font-medium mb-1">Featured</label>
        <div class="space-x-4">
          <label><input type="radio" name="featured" value="Yes" <?php if ($featured == 'Yes') echo "checked"; ?>> Yes</label>
          <label><input type="radio" name="featured" value="No" <?php if ($featured == 'No') echo "checked"; ?>> No</label>
        </div>
      </div>

      <div>
        <label class="block text-gray-700 font-medium mb-1">Active</label>
        <div class="space-x-4">
          <label><input type="radio" name="active" value="Yes" <?php if ($active == 'Yes') echo "checked"; ?>> Yes</label>
          <label><input type="radio" name="active" value="No" <?php if ($active == 'No') echo "checked"; ?>> No</label>
        </div>
      </div>

      <div class="pt-4 text-center">
        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" name="submit" value="Update Category"
               class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-md font-medium transition" />
      </div>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $current_image = $_POST['current_image'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        $image_name = $current_image;

        if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
            $image_name = "Food_Category_" . rand(000, 999) . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/category/" . $image_name;

            $upload = move_uploaded_file($source_path, $destination_path);
            if (!$upload) {
                $_SESSION['upload'] = "<div class='text-red-600 text-center'>Failed to Upload Image.</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
                exit();
            }

            if ($current_image != "") {
                $remove_path = "../images/category/" . $current_image;
                if (!unlink($remove_path)) {
                    $_SESSION['failed-remove'] = "<div class='text-red-600 text-center'>Failed to remove current Image.</div>";
                    header('location:' . SITEURL . 'admin/manage-category.php');
                    exit();
                }
            }
        }

        $sql2 = "UPDATE category SET 
                title = '$title',
                image_name = '$image_name',
                featured = '$featured',
                active = '$active' 
                WHERE id = $id";

        $res2 = mysqli_query($conn, $sql2);

        if ($res2) {
            $_SESSION['update'] = "<div class='text-green-600 text-center py-4 font-medium'>Category Updated Successfully.</div>";
        } else {
            $_SESSION['update'] = "<div class='text-red-600 text-center py-4 font-medium'>Failed to Update Category.</div>";
        }

        header('location:' . SITEURL . 'admin/manage-category.php');
    }
    ?>
  </div>
</div>
<!-- Update Category Section Ends -->

<?php include("partials/footer.php"); ?>




<?php include("partials/footer.php") ?>