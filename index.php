<?php include_once ("partial/header.php"); ?>

<div class="hero-image">
  <div class="hero-text">
    <h1>Al Rehman Computers</h1>
    <p>We make IT happen</p>
    <a class="hero_button" href="#featured_product">FIND BEST PRODUCTS</a>
  </div>
</div>

<!-- featured products -->
<?php
  $sql = "SELECT product_id , product_name , product_description , sale_price , discounted_price , tags_name , varient_one , category_name FROM products 
  LEFT JOIN tags ON tags.tags_id = products.tag
  LEFT JOIN categories ON categories.category_id = products.category
  WHERE tag != '4' AND status = '1' ORDER BY product_id DESC LIMIT 6";
  $featured_prod_result = mysqli_query($conn, $sql) ;
  if(mysqli_num_rows($featured_prod_result) > 0){

echo "<div class='container' id='featured_product'>
  <h2 class='heading'>Featured Products<span></span></h2>
  <div class='row'>";
  while($featured_prod_row = mysqli_fetch_assoc($featured_prod_result)){
    echo "
    <div class='col-lg-4 col-md-6 my-2'>
      <div class='card' style='margin: 0 auto'>
        <div class='card-header'>
          <a href='product.php?id={$featured_prod_row['product_id']}'>
            <img src='images/{$featured_prod_row['varient_one']}' alt='image' />
          </a>
        </div>
        <div class='card-body'>";
          if($featured_prod_row['tags_name'] === "cheap"){
            echo "<span class='tag cheap_tag'>Cheap</span>";
          }else if($featured_prod_row['tags_name'] === "indemand"){
            echo "<span class='tag indemand_tag'>INDEMAND</span>";
          }else if($featured_prod_row['tags_name'] === "trending"){
            echo "<span class='tag trending_tag'>trending</span>";
          }
          echo "
          <h4 class='product_title'>
            <a href='product.php?id={$featured_prod_row['product_id']}'>"; 
            if(strlen($featured_prod_row['product_name']) > 50){
              echo substr($featured_prod_row['product_name'],0 , 50) . " ..."; 
            }else{
              echo substr($featured_prod_row['product_name'],0 , 50); 
            }
            echo "</a>
          </h4>
          <p class='product_description'>";
          if(strlen($featured_prod_row['product_description']) > 100){
            echo substr($featured_prod_row['product_description'],0,100) . "...";
          }else{
            echo substr($featured_prod_row['product_description'],0,100);
          }
          echo "
          </p>
          <span class='price_outer mt-2'>
            <b>Rs. </b>";
            if($featured_prod_row['sale_price'] !== $featured_prod_row['discounted_price']){
              echo "<span class='cut-price'>{$featured_prod_row['sale_price']}</span>";
            }
            echo "&nbsp;&nbsp;
            <span class='price'>{$featured_prod_row['discounted_price']}</span>
            /-</span>
        </div>
      </div>
    </div>";
    }
    echo "
  </div>
</div>";
  }
  
include_once ("partial/footer.php"); 
?>
