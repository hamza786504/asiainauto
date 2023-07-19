<?php
include_once("config.php");

$category_id = mysqli_real_escape_string($conn , $_POST['edit_category_id']);
$category_name = addslashes(mysqli_real_escape_string($conn , trim($_POST['edit_category_name'])));


$sql1 = "SELECT * FROM categories WHERE category_id = {$_POST['edit_category_id']}";
$result1 = mysqli_query($conn , $sql1);
if(mysqli_num_rows($result1) == 1){
    $row = mysqli_fetch_assoc($result1);
    $sql = "UPDATE categories SET category_name = '{$category_name}' WHERE category_id = {$category_id};";
    $result = mysqli_query($conn,$sql);
    if(mysqli_affected_rows($conn)){
        echo json_encode(["success" => "Category '{$row['category_name']}' updated to {$category_name}"]);
    }else{
        echo json_encode(["error" => "This category can not be edited"]);
    }
}







?>