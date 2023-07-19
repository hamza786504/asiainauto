<?php
include_once("config.php");

$category_name = addslashes(trim(mysqli_real_escape_string($conn , $_POST['category_name'])));



$sql = "INSERT INTO categories (category_name , products) VALUES ('{$category_name}' , 0)";


if(mysqli_query($conn,$sql)){
   echo json_encode(["success" => "Category has been added successfully!"]);
}else{
   echo json_encode(["error" => "Category could not add"]);
}


?>