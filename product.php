<?php 
include_once('partial/header.php');
$product_id = $_GET["id"];
$single_product_query = "SELECT product_id , product_name , product_tagline , product_description , sale_price , discounted_price , tags_name , stock , varient_one , varient_two , varient_three , varient_four , category_name FROM products 
LEFT JOIN tags ON tags.tags_id = products.tag
LEFT JOIN categories ON categories.category_id = products.category
WHERE product_id = '{$product_id}'";
$execute_single_prod_query = mysqli_query($conn,$single_product_query);
if(mysqli_num_rows($execute_single_prod_query) == 1){
    while($row = mysqli_fetch_assoc($execute_single_prod_query)){
echo "



<div class='wrapper'>
    <div class='product-img'>
      <span id='main_varient_link'>
        <img src='images/{$row['varient_one']}' id='active_varient'>
      </span>
      <div class='varients'>
          <div class='varient active'>
              <img class='varient_img' src='images/{$row['varient_one']}' alt='image' />
          </div>";
            if($row['varient_two'] !== ""){
                echo "<div class='varient'>
                        <img class='varient_img' src='images/{$row['varient_two']}' alt='image' />
                    </div>";
            }
            if($row['varient_three'] !== ""){
                echo "<div class='varient'>
                        <img class='varient_img' src='images/{$row['varient_three']}' alt='image' />
                    </div>";
            }
            if($row['varient_four'] !== ""){
                echo "<div class='varient'>
                        <img class='varient_img' src='images/{$row['varient_four']}' alt='image' />
                    </div>";
            }
          echo"
      </div>
    </div>
    <div class='product-info'>
      <div class='product-text'>
        <h1 class='product-title'>"; echo stripslashes($row['product_name']); echo "</h1>";
            if($row['product_tagline'] !== ""){
                echo "<h2 class='product-tagline'>"; echo stripslashes($row['product_tagline']); echo "</h2>";
            }
            echo "
        <table class='product_quantity'>";
                    if($row['stock'] == 0){
                        echo "<tr><td colspan='2'><h5>This product is out of stock</h5></td></tr>";
                    // }else{
                    //     echo "
                    //     <tr>
                    //         <td><h4>Quantity</h4></td>
                    //         <td>
                    //             <div class='quantity-counter'>
                    //                 <button class='counter-change-btn' id='decrement_quantity' onclick='decreament_quantity()'>-</button>
                    //                 <h2 class='quantity' id='quantity' style='color: black; display: inline-block; margin_bottom:0;'></h2>
                    //                 <button class='counter-change-btn' id='increment_quantity' onclick='increament_quantity({$row['stock']})'>+</button>
                    //             </div>
                    //         </td>
                    //     </tr>";
                    }
            echo "<tr>
                <td><h4>Price</h4></td>
                <td>
                    <span class='price_outer mt-2'>
            <b>Rs. </b>";
            if($row['sale_price'] !== $row['discounted_price']){
              echo "<span class='cut-price'>{$row['sale_price']}</span>";
            }
            echo "&nbsp;&nbsp;
            <span class='price'>{$row['discounted_price']}</span>
            /-</span>
        </div>
                </td>
            </tr>";
            // <tr>
            //     <td><button class='wishlist-btn'><i class='icon fa-solid fa-heart'></i></button></td>
            //     <td><input type='submit' class='addtocart-btn' value='Add to cart' /></td>
            // </tr>
            echo "
        </table>
        <p class='product-description'>"; echo stripslashes($row['product_description']); echo "</p>
      </div>
    </div>
  </div>
  <div class='varients_model' id='varients_model'>
<span class='close_images_model' id='close_images_model' style='color:white; font-size:35px; position: absolute; top:20px; right: 25px; cursor:pointer; font-weight:bold;'>&times;</span>
  <div class='container'>
    <div class='mySlides'>
      <img src='images/{$row['varient_one']}' style='width: 100%; max-width:500px; max-height: 500px;'>
    </div>";
    if($row['varient_two'] != ""){
      echo "<div class='mySlides'>
        <img src='images/{$row['varient_two']}' style='width: 100%; max-width:500px; max-height: 500px;'>
      </div>";
    }
    if($row['varient_three'] != ""){
      echo "<div class='mySlides'>
        <img src='images/{$row['varient_three']}' style='width: 100%; max-width:500px; max-height: 500px;'>
      </div>";
    }
    if($row['varient_four'] != ""){
      echo "<div class='mySlides'>
        <img src='images/{$row['varient_four']}' style='width: 100%; max-width:500px; max-height: 500px;'>
      </div>";
    }
    echo"
    <a class='prev' onclick='plusSlides(-1)'>&#10094;</a>
    <a class='next' onclick='plusSlides(1)'>&#10095;</a>
    <div class='row' style='margin-top: 40px; justify-content: center; align-items: center; flex-wrap: wrap; display: flex;'>
      <div class='column'>
        <img class='demo cursor' src='images/{$row['varient_one']}' style='width:100%' onclick='currentSlide(1)' alt='The Woods'>
      </div>";
      if($row['varient_two'] != ""){
        echo "<div class='column'>
          <img class='demo cursor' src='images/{$row['varient_two']}' style='width:100%' onclick='currentSlide(2)' alt='The Woods'>
        </div>";
      }
      if($row['varient_three'] != ""){
        echo "<div class='column'>
          <img class='demo cursor' src='images/{$row['varient_three']}' style='width:100%' onclick='currentSlide(3)' alt='The Woods'>
        </div>";
      }
      if($row['varient_four'] != ""){
        echo "<div class='column'>
          <img class='demo cursor' src='images/{$row['varient_four']}' style='width:100%' onclick='currentSlide(4)' alt='The Woods'>
        </div>";
      }
      echo "
    </div>
  </div>
</div>


  
  
  ";
    } } 
  include_once('partial/footer.php'); ?>
