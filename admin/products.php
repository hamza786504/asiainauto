<?php include_once("partial/header.php");
if(!isset($_SESSION["user_name"])){
        header("Location: login.php");
}
?>
<div class="row" style="min-height: 100px; text-align: end;">
        <div class="col">
                <button class="btn btn-secondary" id="add_product">Add products</button>
                <button class="btn btn-secondary" id="add_category">Add category</button>
        </div>
</div>
<div class="row mb-5">
        <div style="max-width: 500px;">
                <div id="load_categories" class="box"></div>
        </div>
</div>
<div class="row">
        <div class="col">
                <div id="load_products" class="box"></div>
        </div>
</div>
                <!-- <div class='col-4'>
                        <div class='box-4'>
                                <div class='content-box'>
                                        <p>Total Sale <span>Sell All</span></p>
                                        <div class='circle-wrap'>
                                                <div class='circle'>
                                                        <div class='mask full'>
                                                                <div class='fill'></div>
                                                        </div>
                                                        <div class='mask half'>
                                                                <div class='fill'></div>
                                                        </div>
                                                        <div class='inside-circle'> 70% </div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div> -->
        </div>";
?>

<?php include_once("partial/footer.php"); ?>