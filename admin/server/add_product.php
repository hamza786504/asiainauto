<?php
include_once("config.php");

$product_name = mysqli_real_escape_string($conn , addslashes(trim($_POST['product_name'])));
$product_tagline = mysqli_real_escape_string($conn , addslashes(trim($_POST['product_tagline'])));
$category_select = $_POST['category_select'];
$stock = $_POST['stock'];
$purchase_price = $_POST['purchase_price'];
$sale_price = $_POST['sale_price'];
$main_image = $_FILES['varient_one']["name"];



if($_POST['price_radio'] === "1"){
   $discounted_price = $_POST['sale_price'];
}else if($_POST['price_radio'] === "2"){
   $discounted_price = $_POST['discounted_price'];
}
$add_badge = $_POST['add_badge'];   
$publish_type = intval($_POST['publish_type']);
$description = addslashes($_POST['description']);

$main_image = mt_rand(1,10000) . $main_image;
$path = "../../images/" . $main_image;
move_uploaded_file($_FILES['varient_one']['tmp_name'],$path);

if($_FILES['varient_two']["name"] != ""){
   $varient_two = mt_rand(1,10000) . $_FILES['varient_two']["name"];
   $path2 = "../../images/" . $varient_two;
   move_uploaded_file($_FILES['varient_two']['tmp_name'],$path2);
}else{
   $varient_two = "";
}

if($_FILES['varient_three']["name"] != ""){
   $varient_three =  mt_rand(1,10000) . $_FILES['varient_three']["name"];
   $path3 = "../../images/" . $varient_three;
   move_uploaded_file($_FILES['varient_three']['tmp_name'],$path3);
}else{
   $varient_three = "";
}

if($_FILES['varient_four']["name"] != ""){
   $varient_four = mt_rand(1,10000) . $_FILES['varient_four']["name"];
   $path4 = "../../images/" . $varient_four;
   move_uploaded_file($_FILES['varient_four']['tmp_name'],$path4);
}else{
   $varient_four = "";
}

$date = date("Y/m/d");
$sql = "INSERT INTO products (product_name , product_tagline , product_description , purchase_price , sale_price , discounted_price , stock,tag , varient_one , varient_two , varient_three , varient_four ,  status, category,date) VALUES ('{$product_name}','{$product_tagline}','{$description}',{$purchase_price},{$sale_price},{$discounted_price},{$stock},{$add_badge},'{$main_image}','{$varient_two}','{$varient_three}','{$varient_four}',{$publish_type},{$category_select},'{$date}');";
$sql .= "UPDATE categories SET products = products + 1 WHERE category_id = {$category_select};";
$sql .= "UPDATE tags SET usedby_products = usedby_products + 1 WHERE tags_id = {$add_badge}";


if(mysqli_multi_query($conn,$sql)){
   echo json_encode(["success" => "Your product has been successfully added"]);
}else{
   echo json_encode(["error" => "Your product could not add"]);
}


?>