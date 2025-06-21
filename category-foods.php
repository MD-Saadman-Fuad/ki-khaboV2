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


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
            $sql2 = "SELECT * FROM food where category_id=$category_id";

            $res = mysqli_query($conn, $sql2);


            $count = mysqli_num_rows($res);

            if($count > 0)
            {
                while ($row2=mysqli_fetch_assoc($res)){
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $price = $row2['price'];
                    $description = $row2['description'];
                    $image_name=$row2['image_name'];
                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                        <?php 
                            //checking if img available or not
                            if ($image_name=="")
                            {
                                echo "<div class='error'>Image Not Available. </div>";
                            }
                            else
                            {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                            ?>
                            
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price"><?php echo $price; ?></p>
                            <p class="food-detail">
                            <?php echo $description; ?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                    <?php

                }
            }
            else
            {
                //?cat not availabe
                echo "<div class='error'>Food Not Available</div>";
            }


            ?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-frontend/footer.php');?>