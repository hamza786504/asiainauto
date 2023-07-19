<?php
include_once("server/config.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <!-- Use bootstrap 5 CDN path for css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

            <!-- link fontawesome css file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <!-- link animate.css -->
    <link rel="stylesheet" href="../animate.css/animate.css">
    <!-- link dropzon.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.js"></script>
            <!-- link custom css file -->
    <link rel="stylesheet" href="css/style.css">

    <title>Admin || Al Rahman Computers</title>
</head>
<body>

<?php 
if(basename($_SERVER['PHP_SELF']) !== "login.php"){        
?>
<div id="mySidenav" class="sidenav">
        <span class="squeez_sidebar">&times;</span>
        <img src="../images/header-logo.png" alt="Logo" class="logo" />
        <a href="index.php" class="icon-a <?php if(basename($_SERVER['PHP_SELF']) === "index.php"){ echo "tab_active"; } ?>"><i class="fa fa-dashboard icons"></i> &nbsp;&nbsp;<span>Dashboard</span></a>
        <a href="products.php" class="icon-a <?php if(basename($_SERVER['PHP_SELF']) === "products.php"){ echo "tab_active"; } ?>"><i class="icons fa fa-sitemap"></i> &nbsp;&nbsp;<span>Products</span></a>
        <a href="orders.php" class="icon-a <?php if(basename($_SERVER['PHP_SELF']) === "orders.php"){ echo "tab_active"; } ?>"><i class="fa fa-shopping-bag icons"></i> &nbsp;&nbsp;<span>Orders</span></a>
        <a href="inventory.php" class="icon-a <?php if(basename($_SERVER['PHP_SELF']) === "inventory.php"){ echo "tab_active"; } ?>"><i class="fa fa-tasks icons"></i> &nbsp;&nbsp;<span>Inventory</span></a>
        <a href="logout.php" class="icon-a"><i class="fa fa-sign-out icons"></i> &nbsp;&nbsp;<span>LogOut</span></a>
</div>
<div id="main">
	<div class="row">
		<div class="col">
                        <span style="font-size:30px;cursor:pointer; color: white; text-transform: capitalize;" id="navbar_expand"  >
                                &#9776;
                                <?php
                                        if(basename($_SERVER['PHP_SELF']) === "index.php"){
                                                echo "Dashboard";
                                        }else{
                                                echo pathinfo(basename($_SERVER['PHP_SELF']),PATHINFO_FILENAME);
                                        }
                                ?>
                        </span>
                </div>
                <div class="col text-end">
	                <div class="profile">
                                <?php
                                        $get_user_details = "SELECT username , role FROM admin_users WHERE user_id = '{$_SESSION['user_id']}'";
                                        $get_user_details_result = mysqli_query($conn , $get_user_details);
                                        if(mysqli_num_rows($get_user_details_result) == 1){
                                                while($get_user_details_row = mysqli_fetch_assoc($get_user_details_result)){
                                                        echo "<p>{$get_user_details_row['username']}<span>{$get_user_details_row['role']}</span></p>";
                                                }
                                        }
                                ?>
	                </div>
                </div>
        </div>
	<br/>

        <?php } ?>