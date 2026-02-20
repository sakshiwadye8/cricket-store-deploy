<?php include('partials-front/menu.php'); ?>

<!-- PRODUCT SEARCH RESULT SECTION -->
<section class="product-search text-center">
    <div class="container">
        <?php 
            // Get Search Keyword Safely
            $search = mysqli_real_escape_string($conn, $_POST['search']);
        ?>

        <h2>Products matching your search: 
            <a href="#" class="text-white">"<?php echo $search; ?>"</a>
        </h2>
    </div>
</section>
<!-- PRODUCT SEARCH RESULT SECTION ENDS -->


<!-- PRODUCT LIST SECTION -->
<section class="product-menu">
    <div class="container">
        <h2 class="text-center">Search Results</h2>

        <?php 

            // SQL Query to Search Products
            $sql = "SELECT * FROM tbl_product 
                    WHERE (title LIKE '%$search%' 
                    OR description LIKE '%$search%')
                    AND active='Yes'";

            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if($count > 0)
            {
                while($row = mysqli_fetch_assoc($res))
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
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
                echo "<div class='error'>No Products Found.</div>";
            }
        ?>

        <div class="clearfix"></div>

    </div>
</section>
<!-- PRODUCT LIST SECTION ENDS -->

<?php include('partials-front/footer.php'); ?>
