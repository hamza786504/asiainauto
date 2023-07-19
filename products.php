<?php include_once ("partial/header.php"); ?>

<!-- it's html is combined with index page featred products so the it's css is also present in sytle.css -->
<div class="container-fluid" id="shop_product">
  <h2 class="heading">Visit Our Shop<span></span></h2>
  <div class="row" id="shop_products_list">
  <?php 
  if(isset($_GET["page_no"])){
    $page_no = $_GET["page_no"];
  }else{
    $page_no = 1;
  }
  $limit = 30;
  $offset = ($page_no - 1) * $limit;
  $sql = "SELECT product_id , product_name , product_description , sale_price , discounted_price , tags_name , varient_one ,status, category_name FROM products 
  LEFT JOIN tags ON tags.tags_id = products.tag
  LEFT JOIN categories ON categories.category_id = products.category WHERE status = 1 ORDER BY product_id DESC LIMIT {$offset} , {$limit}";
  $shop_prod_result = mysqli_query($conn, $sql) ;
  if(mysqli_num_rows($shop_prod_result) > 0){
    while($shop_prod_row = mysqli_fetch_assoc($shop_prod_result)){
      echo "
    <div class='col-xl-3 col-lg-4 col-md-6 my-3'>
      <div class='card' style='margin: 0 auto'>
        <div class='card-header'>
          <a href='product.php?id={$shop_prod_row['product_id']}'>
            <img src='images/{$shop_prod_row['varient_one']}' alt='image' />
          </a>
        </div>
        <div class='card-body'>";
          if($shop_prod_row['tags_name'] === "cheap"){
            echo "<span class='tag cheap_tag'>Cheap</span>";
          }else if($shop_prod_row['tags_name'] === "indemand"){
            echo "<span class='tag indemand_tag'>INDEMAND</span>";
          }else if($shop_prod_row['tags_name'] === "trending"){
            echo "<span class='tag trending_tag'>trending</span>";
          }
          echo "
          <h4 class='product_title'>
            <a href='product.php?id={$shop_prod_row['product_id']}'>";
             if(strlen($shop_prod_row['product_name']) > 40){
              echo substr($shop_prod_row['product_name'],0 , 40) . " ..."; 
            }else{
              echo substr($shop_prod_row['product_name'],0 , 40); 
            }
            echo"</a>
          </h4>
          <p class='product_description'>";
          if(strlen($shop_prod_row['product_description']) > 80){
            echo substr($shop_prod_row['product_description'],0,80) . "...";
          }else{
            echo substr($shop_prod_row['product_description'],0,80);
          }
          echo "
          </p>
          <span class='price_outer mt-2'>
            <b>Rs. </b>";
            if($shop_prod_row['sale_price'] !== $shop_prod_row['discounted_price']){
              echo "<span class='cut-price'>{$shop_prod_row['sale_price']}</span>";
            }
            echo "&nbsp;&nbsp;
            <span class='price'>{$shop_prod_row['discounted_price']}</span>
            /-</span>
        </div>
      </div>
    </div>";
  } }
echo "</div></div>";
        $pagination_query = "SELECT product_id , product_name , product_description , sale_price , discounted_price , tags_name , varient_one ,status, category_name FROM products 
        LEFT JOIN tags ON tags.tags_id = products.tag
        LEFT JOIN categories ON categories.category_id = products.category WHERE status = 1";
        $pagination_result = mysqli_query($conn , $pagination_query);
        if(mysqli_num_rows($pagination_result) > 0){
          $total_pages = ceil(mysqli_num_rows($pagination_result) / $limit);  
          if($total_pages > 1){
            echo "<ul class='custom-pagination'>";
            if($page_no >= 2){
              echo "<li><a href='shop.php?page_no=" . $page_no - 1 . "'>Prev</a></li>";
            }
            for($i = $page_no; $i <= $total_pages; $i++){
              $times = $page_no + 1;
              if($i <= $total_pages){
                echo "<li><a href='shop.php?page_no=" . $i . "'>" . $i . "</a></li>";
              }
            }
            if($page_no < $total_pages){
              echo "<li><a href='shop.php?page_no=" . $page_no + 1 . "'>Next</a></li>";
            }
            echo "</ul>";
          }
        }
        ?>
<?php include_once ("partial/footer.php"); ?>
