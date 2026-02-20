<?php include('partials-front/menu.php'); ?>

<?php 
    // Check whether product_id is set
    if(isset($_GET['product_id']))
    {
        $product_id = $_GET['product_id'];

        // Get Product Details
        $sql = "SELECT * FROM tbl_product WHERE id=$product_id AND active='Yes'";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if($count == 1)
        {
            $row = mysqli_fetch_assoc($res);

            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];
        }
        else
        {
            header('location:'.SITEURL);
            exit();
        }
    }
    else
    {
        header('location:'.SITEURL);
        exit();
    }
?>

<!-- ORDER SECTION STARTS -->
<section class="order-section">
    <div class="container">
        
        <h2 class="text-center text-white">Complete Your Purchase</h2>

        <form action="" method="POST" class="order-form">
            <fieldset>
                <legend>Selected Product</legend>

                <div class="product-img">
                    <?php 
                        if($image_name == "")
                        {
                            echo "<div class='error'>Image not Available.</div>";
                        }
                        else
                        {
                            ?>
                            <img src="<?php echo SITEURL; ?>images/products/<?php echo $image_name; ?>" 
                                 alt="<?php echo $title; ?>" 
                                 class="img-responsive img-curve">
                            <?php
                        }
                    ?>
                </div>
    
                <div class="product-desc">
                    <h3><?php echo $title; ?></h3>
                    <input type="hidden" name="product" value="<?php echo $title; ?>">

                    <p class="product-price">₹<?php echo $price; ?></p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" min="1" required>
                </div>
            </fieldset>
            
            <fieldset>
                <legend>Customer Details</legend>

                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="Enter your full name" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="Enter your phone number" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="Enter your email" class="input-responsive" required>

                <div class="order-label">Delivery Address</div>
                <textarea name="address" rows="5" placeholder="Enter your complete address" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Purchase" class="btn btn-primary">
            </fieldset>
        </form>

        <?php 
            // Check whether form submitted
            if(isset($_POST['submit']))
            {
                $product = $_POST['product'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];

                $total = $price * $qty;

                $order_date = date("Y-m-d H:i:s");

                $status = "Ordered";

                $customer_name = $_POST['full-name'];
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['address'];

                // Save Order
                $sql2 = "INSERT INTO tbl_order SET 
                    product = '$product',
                    price = $price,
                    qty = $qty,
                    total = $total,
                    order_date = '$order_date',
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                ";

                $res2 = mysqli_query($conn, $sql2);

                if($res2 == true)
                {
                    $_SESSION['order'] = "<div class='success text-center'>Product Purchased Successfully.</div>";
                    header('location:'.SITEURL);
                }
                else
                {
                    $_SESSION['order'] = "<div class='error text-center'>Failed to Place Order.</div>";
                    header('location:'.SITEURL);
                }
            }
        ?>

    </div>
</section>
<!-- ORDER SECTION ENDS -->

<?php include('partials-front/footer.php'); ?>
