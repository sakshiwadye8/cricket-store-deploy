<?php include('partials-front/menu.php'); ?>

<?php 
    // Check whether category_id is passed
    if(isset($_GET['category_id']))
    {
        $category_id = $_GET['category_id'];

        // Get Category Title
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id AND active='Yes'";
        $res = mysqli_query($conn, $sql);

        if($res && mysqli_num_rows($res) > 0)
        {
            $row = mysqli_fetch_assoc($res);
            $category_title = $row['title'];
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

<!-- CATEGORY HEADER SECTION -->
<section class="category-header text-center">
    <div class="container">
        <h2>Cricket Products in "<?php echo $category_title; ?>"</h2>
    </div>
</section>
<!-- CATEGORY HEADER ENDS -->

<!-- PRODUCTS SECTION -->
<section class="product-menu">
    <div class="container">
        <h2 class="text-center">Available Products</h2>

        <?php 
            // Get Products for Selected Category
            $sql2 = "SELECT * FROM tbl_product 
                     WHERE category_id=$category_id 
                     AND active='Yes'";

            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);

            if($count2 > 0)
            {
                while($row2 = mysqli_fetch_assoc($res2))
                {
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $price = $row2['price'];
                    $description = $row2['description'];
                    $image_name = $row2['image_name'];
                    ?>
                    
                    <div class="product-box">
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
                            <h4><?php echo $title; ?></h4>
                            <p class="product-price">₹<?php echo $price; ?></p>
                            <p class="product-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL; ?>order.php?product_id=<?php echo $id; ?>" 
                               class="btn btn-primary">
                               Buy Now
                            </a>
                        </div>
                    </div>

                    <?php
                }
            }
            else
            {
                echo "<div class='error'>No Products Available in this Category.</div>";
            }
        ?>

        <div class="clearfix"></div>

    </div>
</section>
<!-- PRODUCTS SECTION ENDS -->

<?php include('partials-front/footer.php'); ?>
