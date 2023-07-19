<?php include_once("partial/header.php"); 
if(!isset($_SESSION["user_name"])){
        header("Location: login.php");
}
?>
<div class="row">
        <div class="col">
                <canvas id="sales_chart"></canvas>
        </div>
</div>
<?php include_once("partial/footer.php"); ?>