<?php include("partials/menu.php") ?>

<div class="main-content">
    <div class="wrapper">
        <h1>This is Manage Order</h1>
        
                 <br>
                 <br>

                 <?php 
                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];
                        unset ($_SESSION['update']);
                    }
                 ?>


                <table class="tbl-full">
                    <tr>
                        <th>Serial No.</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Customer Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>

                    <?php 
                    $sn =1; #serial initially set to 1
                    //get all order 
                    $sql = "SELECT * FROM order_table ORDER BY id DESC"; //for displaying latest order

                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);
                    if($count>0){
                        while($row=mysqli_fetch_assoc($res)){
                            $id = $row['id'];
                            $food = $row['food'];
                            $price = $row['price'];
                            $qty = $row['quantity'];
                            $total = $row['total'];

                            $order_date = $row['order_date']; 

                        
                            $status = $row['status']; 


                            $customer_name = $row['customer_name'];
                            $customer_contact = $row['customer_contact'];
                            $customer_email = $row['customer_email'];
                            $customer_address = $row['customer_address'];
                            ?>
                                <tr>
                                <td><?php echo $sn++;?></td>
                                <td><?php echo $food;?></td>
                                <td><?php echo $price;?></td>
                                <td><?php echo $qty;?></td>
                                <td><?php echo $total;?></td>
                                <td><?php echo $order_date;?></td>

                                <td>
                                    <?php 
                                    if($status == "Ordered"){
                                        echo "<label style='color: blue;'>$status</label>";

                                    }
                                    else if ($status == "On Delivery"){
                                        echo "<label style='color: orange;'>$status</label>";
                                    }
                                    else if ($status == "Delivered"){
                                        echo "<label style='color: green;'>$status</label>";
                                    }
                                    else if ($status == "Cancelled"){
                                        echo "<label style='color: red;'>$status</label>";
                                    }
                                ?>
                                </td>

                                
                                <td><?php echo $customer_name;?></td>
                                <td><?php echo $customer_contact;?></td>
                                <td><?php echo $customer_email;?></td>
                                <td><?php echo $customer_address;?></td>
                                
                                <td>
                                    <a href="<?php echo SITEURL;?>admin/update-order.php?id=<?php echo $id;?>"class="btn-secondary">Update Order</a>
                                    
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    else{
                        echo "<tr><td colspan='12' class='error'>Orders Not Available</td></tr>";
                    }
                    ?>

                    
                    
                </table>
    </div>
</div>

<?php include("partials/footer.php") ?>