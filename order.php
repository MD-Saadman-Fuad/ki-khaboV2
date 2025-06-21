<?php include('partials-frontend/menu.php');?>

    <?php 
        if (isset($_GET['food_id'])){
            $food_id = $_GET['food_id'];
            //get data of category
            $sql="SELECT * from food where id=$food_id";
            //execute
            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);
            if ($count==1){
                $row = mysqli_fetch_array($res);

                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name=$row['image_name'];
            }
            else{
                header('location:'.SITEURL);
            }
        }
        else{
            header('location:'.SITEURL);
        }
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="post" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

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
                        <h3><?php echo $title ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title;?>">
                        <p class="food-price"><?php echo $price ?></p>
                        <input type="hidden" name="price" value="<?php echo $price;?>">
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Saadman Fuad" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. xyz.smf@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
            <?php 

            If(isset($_POST['submit'])){
                $food = $_POST['food'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $price * $qty;

                $order_date = date("Y-m-d h:i:sa"); 
                $status = 'Ordered'; //ordered, on delivery, delivered, cancelled

                $customer_name = $_POST['full-name'];
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['address'];
                //$food = $_POST['food'];

                //now save

                $sql2 = "INSERT INTO order_table SET
                    food = '$food',
                    price = $price,
                    quantity=$qty ,
                    total=$total,
                    order_date='$order_date',
                    status = '$status',
                    customer_name='$customer_name',
                    customer_contact='$customer_contact',
                    customer_email='$customer_email',
                    customer_address='$customer_address'
                ";

                $res2 = mysqli_query($conn, $sql2);

                if($res2==true){
                    //order saved
                    $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
                    header('location:'.SITEURL);
                }
                else{
                    //failed to saved
                    $_SESSION['order'] = "<div class='error text-center'>Food Ordering Failed.</div>";
                    header('location:'.SITEURL);
                }
            }
            
            
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-frontend/footer.php');?>