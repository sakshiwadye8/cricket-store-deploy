<?php include('partials-front/menu.php'); ?>

<!-- PRODUCT SEARCH SECTION -->
<section class="product-search text-center">
    <div class="container">
        <form action="<?php echo SITEURL; ?>product-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Cricket Products..." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>
    </div>
</section>
<!-- PRODUCT SEARCH SECTION ENDS -->


<!-- ALL PRODUCTS SECTION -->
<section class="product-menu">
    <div class="container">
        <h2 class="text-center">All Cricket Products</h2>

        <?php 
            // Display Active Products
            $sql = "SELECT * FROM tbl_product WHERE active='Yes'";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if($count > 0)
            {
                while($row = mysqli_fetch_assoc($res))
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
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
                echo "<div class='error'>No Products Available.</div>";
            }
        ?>

        <div class="clearfix"></div>

    </div>
</section>
<!-- ALL PRODUCTS SECTION ENDS -->

<?php include('partials-front/footer.php'); ?>
