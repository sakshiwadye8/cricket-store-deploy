<?php 
    // Include Constants Page
    include('../config/constants.php');

    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        // 1. Get ID and Image Name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // 2. Remove the Image if Available
        if($image_name != "")
        {
            // Get the Image Path
            $path = "../images/products/".$image_name;

            // Remove Image File from Folder
            $remove = unlink($path);

            if($remove == false)
            {
                $_SESSION['upload'] = "<div class='error'>Failed to Remove Product Image.</div>";
                header('location:'.SITEURL.'admin/manage-product.php');
                die();
            }
        }

        // 3. Delete Product from Database
        $sql = "DELETE FROM tbl_product WHERE id=$id";

        $res = mysqli_query($conn, $sql);

        // 4. Redirect with Message
        if($res == true)
        {
            $_SESSION['delete'] = "<div class='success'>Product Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-product.php');
        }
        else
        {
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Product.</div>";
            header('location:'.SITEURL.'admin/manage-product.php');
        }
    }
    else
    {
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-product.php');
    }

?>
