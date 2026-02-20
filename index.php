<?php include('partials-front/menu.php'); ?>

<!-- PRODUCT SEARCH Section Starts Here -->
<div class="search-box">
    <input type="text" placeholder="Search for cricket products..." />
    <button>Search</button>
</div>

<!-- PRODUCT SEARCH Section Ends Here -->

<?php 
    if(isset($_SESSION['order']))
    {
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }
?>

<!-- Categories Section Starts Here -->
<section class="categories">
    <div class="container">
   <h2 class="category-title">
    Explore <span>Cricket</span> Categories
</h2>
        <?php 
            $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 8";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if($count>0)
            {
                while($row=mysqli_fetch_assoc($res))
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>

                    <div class="category-box">
                        <a href="<?php echo SITEURL; ?>category-products.php?category_id=<?php echo $id; ?>">
                            
                            <?php 
                                if($image_name=="")
                                {
                                    echo "<div class='error'>Image not Available</div>";
                                }
                                else
                                {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" 
                                         alt="<?php echo $title; ?>" 
                                         class="img-responsive img-curve">
                                    <?php
                                }
                            ?>

                            <h3 class="float-text text-white"><?php echo $title; ?></h3>
                        </a>
                    </div>

                    <?php
                }
            }
            else
            {
                echo "<div class='error'>Category not Added.</div>";
            }
        ?>

    </div>
</section>
<!-- Categories Section Ends Here -->


<!-- FEATURED PRODUCTS Section Starts Here -->
<section class="product-menu">
    <div class="container">
        <h2 class="text-center">FEATURED CRICKET PRODUCTS</h2>

        <?php 
        $sql2 = "SELECT * FROM tbl_product WHERE active='Yes' AND featured='Yes' LIMIT 6";
        $res2 = mysqli_query($conn, $sql2);
        $count2 = mysqli_num_rows($res2);

        if($count2>0)
        {
            while($row=mysqli_fetch_assoc($res2))
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
                            if($image_name=="")
                            {
                                echo "<div class='error'>Image not available.</div>";
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
            echo "<div class='error'>Products not available.</div>";
        }
        ?>

    </div>

    <p class="text-center" style="margin-top:20px;">
        <a href="<?php echo SITEURL; ?>products.php">See All Products</a>
    </p>
</section>
<!-- FEATURED PRODUCTS Section Ends Here -->

<?php include('partials-front/footer.php'); ?>
