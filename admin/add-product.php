<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>ADD PRODUCT</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data" class="modern-form">

            <div class="form-group">
                <label>TITLE</label>
                <input type="text" name="title" placeholder="Enter Product Name">
            </div>

            <div class="form-group">
                <label>DESCRIPTION</label>
                <textarea name="description" rows="4" placeholder="Enter Product Description"></textarea>
            </div>

            <div class="form-group">
                <label>PRICE</label>
                <input type="number" name="price" placeholder="Enter Price">
            </div>

            <div class="form-group">
                <label>SELECT IMAGE</label>
                <input type="file" name="image">
            </div>

            <div class="form-group">
                <label>CATEGORY</label>
                <select name="category">
                    <?php 
                    $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);

                    if($count>0){
                        while($row=mysqli_fetch_assoc($res)){
                            ?>
                            <option value="<?php echo $row['id']; ?>">
                                <?php echo $row['title']; ?>
                            </option>
                            <?php
                        }
                    } else {
                        echo "<option>No Category Found</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group radio-group">
                <label>FEATURED</label>
                <input type="radio" name="featured" value="Yes"> Yes
                <input type="radio" name="featured" value="No"> No
            </div>

            <div class="form-group radio-group">
                <label>ACTIVE</label>
                <input type="radio" name="active" value="Yes"> Yes
                <input type="radio" name="active" value="No"> No
            </div>

            <div class="form-group">
                <input type="submit" name="submit" value="Add Product" class="modern-btn">
            </div>

        </form>

        <?php 

            if(isset($_POST['submit']))
            {
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
                $active = isset($_POST['active']) ? $_POST['active'] : "No";

                if(isset($_FILES['image']['name']))
                {
                    $image_name = $_FILES['image']['name'];

                    if($image_name!="")
                    {
                        $ext = pathinfo($image_name, PATHINFO_EXTENSION);

                        $image_name = "Cricket-Product-".rand(0000,9999).".".$ext;

                        $src = $_FILES['image']['tmp_name'];
                        $dst = "../images/products/".$image_name;

                        $upload = move_uploaded_file($src, $dst);

                        if($upload==false)
                        {
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            header('location:'.SITEURL.'admin/add-product.php');
                            die();
                        }
                    }
                }
                else
                {
                    $image_name = "";
                }

                // 🔥 TABLE CHANGED HERE
                $sql2 = "INSERT INTO tbl_product SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";

                $res2 = mysqli_query($conn, $sql2);

                if($res2 == true)
                {
                    $_SESSION['add'] = "<div class='success'>Product Added Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-product.php');
                }
                else
                {
                    $_SESSION['add'] = "<div class='error'>Failed to Add Product.</div>";
                    header('location:'.SITEURL.'admin/manage-product.php');
                }
            }

        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>
