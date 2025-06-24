<?php include('partials-frontend/menu.php');?>
    
    <?php 
        if (isset($_GET['category_id'])){
            $category_id = $_GET['category_id'];
            //get data of category
            $sql="SELECT title from category where id=$category_id";
            //execute
            $res = mysqli_query($conn, $sql);

            $row = mysqli_fetch_assoc($res);
            $category_title = $row['title'];
        }
        else{
            header('location:'.SITEURL);
        }
    ?>

    <!-- Category Header Section Starts Here -->
    <section class="bg-gradient-to-r from-orange-500 to-amber-500 py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold text-white mb-4 opacity-0 animate-fade-in">
                Foods in <span class="text-yellow-200">"<?php echo $category_title; ?>"</span>
            </h2>
            <p class="text-orange-100 text-lg opacity-0 animate-fade-in" style="animation-delay: 200ms;">
                Discover delicious dishes from this category
            </p>
        </div>
    </section>
    <!-- Category Header Section Ends Here -->

    <!-- Food Menu Section Starts Here -->
    <section class="main main-content bg-gradient-to-br from-orange-200 via-amber-50 to-yellow-50 py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8 opacity-0 animate-fade-in" style="animation-delay: 400ms;">Food Menu</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <?php 
                $sql2 = "SELECT * FROM food where category_id=$category_id";
                $res = mysqli_query($conn, $sql2);
                $count = mysqli_num_rows($res);

                if($count > 0) {
                    $index = 0;
                    while ($row2=mysqli_fetch_assoc($res)){
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name=$row2['image_name'];
                        $delay = 600 + ($index * 150); // Start after heading + 150ms delay between each item
                ?>
                <div class="flex gap-4 bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 opacity-0 translate-y-[50px] animate-slide-in-up" 
                     style="animation-delay: <?php echo $delay; ?>ms;">
                    <div class="w-32 h-32 flex-shrink-0">
                        <?php 
                        //checking if img available or not
                        if ($image_name=="") {
                        ?>
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500 text-sm rounded-md">
                                Image Not Available
                            </div>
                        <?php
                        } else {
                        ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" 
                                 alt="<?php echo $title; ?>" 
                                 class="w-full h-full object-cover rounded-md">
                        <?php
                        }
                        ?>
                    </div>

                    <div class="flex flex-col justify-between flex-1">
                        <div>
                            <h4 class="text-xl font-semibold text-gray-800 mb-2"><?php echo $title; ?></h4>
                            <p class="text-orange-500 font-bold text-lg mb-2"><?php echo $price; ?> Taka</p>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                <?php echo $description; ?>
                            </p>
                        </div>
                        <div class="mt-4">
                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id;?>" 
                               class="inline-block bg-orange-500 text-white px-6 py-2 rounded-md hover:bg-orange-600 transition-colors duration-300 text-sm font-medium">
                                Order Now
                            </a>
                        </div>
                    </div>
                </div>
                <?php
                        $index++;
                    }
                } else {
                    // Category not available
                ?>
                <div class="col-span-2 text-center py-12 opacity-0 animate-fade-in" style="animation-delay: 600ms;">
                    <div class="bg-red-50 border border-red-200 rounded-lg p-8">
                        <svg class="mx-auto h-16 w-16 text-red-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 18.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                        <h3 class="text-lg font-semibold text-red-800 mb-2">No Food Available</h3>
                        <p class="text-red-600">Sorry, there are no food items available in this category at the moment.</p>
                        <a href="<?php echo SITEURL; ?>" 
                           class="inline-block mt-4 bg-orange-500 text-white px-6 py-2 rounded-md hover:bg-orange-600 transition-colors duration-300 text-sm font-medium">
                            Browse All Categories
                        </a>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>

            <!-- Back to Categories Link -->
            <div class="text-center mt-12 opacity-0 animate-fade-in" style="animation-delay: 800ms;">
                <a href="<?php echo SITEURL; ?>categories.php" 
                   class="inline-flex items-center text-orange-500 hover:text-orange-600 font-medium transition-colors duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to All Categories
                </a>
            </div>
        </div>
    </section>
    <!-- Food Menu Section Ends Here -->

<style>
@keyframes slide-in-up {
  from {
    opacity: 0;
    transform: translateY(50px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes fade-in {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-slide-in-up {
  animation: slide-in-up 0.6s ease-out forwards;
}

.animate-fade-in {
  animation: fade-in 0.8s ease-out forwards;
}
</style>

    <?php include('partials-frontend/footer.php');?>