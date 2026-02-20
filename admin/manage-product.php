<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>MANAGE PRODUCT</h1>

        <br /><br />

        <!-- Button to Add Product -->
        <a href="<?php echo SITEURL; ?>admin/add-product.php" class="btn-primary">ADD PRODUCT</a>

        <br /><br /><br />

        <?php 
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['unauthorize']))
            {
                echo $_SESSION['unauthorize'];
                unset($_SESSION['unauthorize']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>

        <table class="tbl-full">
            <tr>
                <th>SR.NO</th>
                <th>TITLE</th>
                <th>PRICE</th>
                <th>IMAGE</th>
                <th>FEATURED</th>
                <th>ACTIVE</th>
                <th>ACTION</th>
            </tr>

            <?php 
                // Get all Products
                $sql = "SELECT * FROM tbl_product";

                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                $sn=1;

                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                        ?>

                        <tr>
                            <td><?php echo $sn++; ?>. </td>
                            <td><?php echo $title; ?></td>
                            <td><?php echo $price; ?></td>

                            <td>
                                <?php  
                                    if($image_name=="")
                                    {
                                        echo "<div class='error'>Image not Added.</div>";
                                    }
                                    else
                                    {
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/products/<?php echo $image_name; ?>" width="100px">
                                        <?php
                                    }
                                ?>
                            </td>

                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>

                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-product.php?id=<?php echo $id; ?>" class="btn-secondary">Update Product</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-product.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Product</a>
                            </td>
                        </tr>

                        <?php
                    }
                }
                else
                {
                    echo "<tr> <td colspan='7' class='error'> Product not Added Yet. </td> </tr>";
                }

            ?>
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>
