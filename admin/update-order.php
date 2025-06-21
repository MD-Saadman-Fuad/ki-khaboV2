<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="'wrapper" style="padding-left: 20%;">
        <h1>Update Order</h1>
        <br><br>
        <?php

        //check id passing

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            //query
            $sql = "SELECT * FROM order_table where id=$id";

            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                $row = mysqli_fetch_array($res);

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
            } else {
                header('location:' . SITEURL . 'admin/manage-order.php');
            }
        } else {
            header('location:' . SITEURL . 'admin/manage-order.php');
        }

        ?>
        <form action="" method="post">
            <table class="tbl-50" ;>
                <tr>
                    <td>Food Name</td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><b><?php echo $price; ?></b></td>
                </tr>
                <tr>
                    <td>Quantity</td>
                    <td><input type="number" name="qty" value="<?php echo $qty; ?>"></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status" id="">
                            <option <?php if ($status == 'Ordered') {
                                        echo "selected";
                                    } ?> value="Ordered">Ordered</option>
                            <option <?php if ($status == 'On Delivery') {
                                        echo "selected";
                                    } ?>value="On Delivery">On Delivery</option>
                            <option <?php if ($status == 'Delivered') {
                                        echo "selected";
                                    } ?>value="Delivered">Delivered</option>
                            <option <?php if ($status == 'Cancelled') {
                                        echo "selected";
                                    } ?>value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Contact</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Email</td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Address</td>
                    <td>

                        <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>

        <?php
        //check if button clicked 
        //echo 'done1';
        if (isset($_POST['submit'])) {
            //clicked
            echo 'done2';
            $id = $_POST['id'];
            $food = $_POST['food'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty;

            $status = $_POST['status'];
            //$order_date = $row['order_date'];  
            $customer_name = $_POST['customer_name'];
            $customer_contact = $_POST['customer_contact'];
            $customer_email = $_POST['customer_email'];
            $customer_address = $_POST['customer_address'];
            echo 'done2';

            $sql2 = "UPDATE order_table SET
                quantity=$qty ,
                total=$total,
                status = '$status',
                customer_name='$customer_name',
                customer_contact='$customer_contact',
                customer_email='$customer_email',
                customer_address='$customer_address'
                where id = $id
            ";
            
            $res2  = mysqli_query($conn, $sql2);
            //echo 'done2';
            if ($res2 == true) {
                //updated
                $_SESSION['update'] = "<div class='success'>Order updated Successfully.</div>";
                echo 'done';
                header('location:' . SITEURL . 'admin/manage-order.php');
                
            } else {
                //failed
                $_SESSION['update'] = "<div class='error'>Failed to Update Order.</div>";
                header('location:' . SITEURL . 'admin/manage-order.php');
            }
        }else{
            //echo 'no';
        }
        //
        ?>

    </div>
</div>


<?php include('partials/footer.php') ?>