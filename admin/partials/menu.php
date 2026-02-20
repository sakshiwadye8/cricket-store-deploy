
         <?php 

    include('../config/constants.php'); 
    include('login-check.php');

?>

<html>
    <head>
        <title>Cricket Store - Admin Panel</title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="../css/admin.css">
    </head>
    
    <body>
        <!-- Menu Section Starts -->
        <div class="menu text-center">
            <div class="wrapper">
                <ul>
                    <li><a href="index.php">DASHBOARD</a></li>
                    <li><a href="manage-admin.php">ADMIN</a></li>
                    <li><a href="manage-category.php">CATEGORY</a></li>
                    <li><a href="manage-product.php">PRODUCT</a></li>
                    <li><a href="manage-order.php">ORDERS</a></li>
                    <li><a href="logout.php">LOGOUT</a></li>
                </ul>
            </div>
        </div>
        <!-- Menu Section Ends -->
