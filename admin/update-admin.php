<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>UPDATE ADMIN - CRICKET STORE</h1>

        <br><br>

        <?php 
            $id=$_GET['id'];

            $sql="SELECT * FROM tbl_admin WHERE id=$id";
            $res=mysqli_query($conn, $sql);

            if($res==true)
            {
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    $row=mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else
                {
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
        ?>

        <form action="" method="POST" class="modern-form">

            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="full_name" value="<?php echo $full_name; ?>">
            </div>

            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" value="<?php echo $username; ?>">
            </div>

            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <div class="form-group">
                <input type="submit" name="submit" value="Update Admin" class="modern-btn">
            </div>

        </form>

    </div>
</div>

<?php 

    if(isset($_POST['submit']))
    {
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username' 
        WHERE id='$id'
        ";

        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
            $_SESSION['update'] = "<div class='error'>Failed to Update Admin.</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }

?>

<?php include('partials/footer.php'); ?>
