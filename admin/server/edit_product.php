<?php
include_once("config.php");

$product_id = addslashes($_POST['edit_product_id']);
$product_name = mysqli_real_escape_string($conn , addslashes(trim($_POST['edit_product_name'])));
$product_tagline = mysqli_real_escape_string($conn , addslashes(trim($_POST['edit_product_tagline'])));
$category_select = $_POST['edit_category_select'];
$stock = $_POST['edit_stock'];
$purchase_price = $_POST['edit_purchase_price'];
$sale_price = $_POST['edit_sale_price'];
if($_POST['edit_price_radio'] === "1"){
   $discounted_price = $_POST['edit_sale_price'];
}else if($_POST['edit_price_radio'] === "2"){
   $discounted_price = $_POST['edit_discounted_price'];
}
$add_badge = $_POST['edit_add_badge'];   
$publish_type = intval($_POST['edit_publish_type']);
$description = mysqli_real_escape_string($conn , addslashes(trim($_POST['edit_description'])));
if(empty($_FILES['edit_varient_one']["name"])){
   $main_image = $_POST['old_varient_one'];
}else{
   unlink("../../images/".$_POST['old_varient_one']);
   $main_image = mt_rand(1,10000) . $_FILES['edit_varient_one']["name"];
   $path = "../../images/" . $main_image;
   move_uploaded_file($_FILES['edit_varient_one']['tmp_name'],$path);
}
if(empty($_FILES['edit_varient_two']["name"])){
   $varient_two = $_POST['old_varient_two'];
}else{
   unlink("../../images/".$_POST['old_varient_two']);
   $varient_two = mt_rand(1,10000) . $_FILES['edit_varient_two']["name"];
   $path = "../../images/" . $varient_two;
   move_uploaded_file($_FILES['edit_varient_two']['tmp_name'],$path);
}
if(empty($_FILES['edit_varient_three']["name"])){
   $varient_three = $_POST['old_varient_three'];
}else{
   unlink("../../images/".$_POST['old_varient_three']);
   $varient_three = mt_rand(1,10000) . $_FILES['edit_varient_three']["name"];
   $path = "../../images/" . $varient_three;
   move_uploaded_file($_FILES['edit_varient_three']['tmp_name'],$path);
}
if(empty($_FILES['edit_varient_four']["name"])){
   $varient_four = $_POST['old_varient_four'];
}else{
   unlink("../../images/".$_POST['old_varient_four']);
   $varient_four = mt_rand(1,10000) . $_FILES['edit_varient_four']["name"];
   $path = "../../images/" . $varient_four;
   move_uploaded_file($_FILES['edit_varient_four']['tmp_name'],$path);
}

$sql1 = "SELECT category , tag FROM products WHERE product_id = {$product_id}";
$result1 = mysqli_query($conn , $sql1);
if(mysqli_num_rows($result1) == 1){
    $row1 = mysqli_fetch_assoc($result1);
    $existing_category_id = $row1["category"];
    $existing_tag_id = $row1["tag"];


    $sql = "UPDATE products SET product_name = '{$product_name}' , product_tagline = '{$product_tagline}' , product_description = '{$description}' , purchase_price = {$purchase_price} , sale_price = {$sale_price} , discounted_price = {$discounted_price} , stock = {$stock} , varient_one = '{$main_image}' , varient_two = '{$varient_two}' , varient_three = '{$varient_three}' , varient_four = '{$varient_four}' , tag = {$add_badge} ,status = {$publish_type}, category = {$category_select} WHERE product_id = {$product_id};";

    $sql .= "UPDATE categories SET products = products - 1 WHERE category_id = {$existing_category_id};";
    $sql .= "UPDATE categories SET products = products + 1 WHERE category_id = {$category_select};";

    $sql .= "UPDATE tags SET usedby_products = usedby_products - 1 WHERE tags_id = {$existing_tag_id};";
    $sql .= "UPDATE tags SET usedby_products = usedby_products + 1 WHERE tags_id = {$add_badge}";

   if(mysqli_multi_query($conn,$sql)){
      echo json_encode(["success" => "Your product has been successfully added"]);
   }else{
      echo json_encode(["error" => "Your product has been successfully added"]);
   }


}

?>