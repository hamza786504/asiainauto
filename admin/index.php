<?php 
include_once("partial/header.php"); 
include_once("server/config.php"); 
if(!isset($_SESSION["user_name"])){
        header("Location: login.php");
}
?>
	<div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 my-2">
                        <div class="box">
                                <p>
                                        <?php echo mysqli_num_rows(mysqli_query($conn,"SELECT product_id FROM products")); ?>
                                        <br/>
                                        <span>Products</span>
                                </p>
                                <i class="box-icon fa fa-sitemap"></i>
                        </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 my-2">
                        <div class="box">
                                <p>0<br/><span>Orders</span></p>
                                <i class="fa fa-shopping-bag box-icon"></i>
                        </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 my-2">
                        <div class="box">
                                <p>0<br/><span>Delevered</span></p>
                                <i class="box-icon fa fa-location-arrow"></i>
                        </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 my-2">
                        <div class="box">
                                <p>0<br/><span>Pending</span></p>
                                <i class="fa fa-clock-o box-icon"></i>
                        </div>
                </div>
        </div>
	<br/><br/>

<?php include_once("partial/footer.php"); ?>