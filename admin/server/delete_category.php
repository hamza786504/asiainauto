<?php
include_once("config.php");
$sql = "SELECT category FROM products WHERE category = {$_GET['id']}";
$result = mysqli_query($conn , $sql);
if(mysqli_num_rows($result) == 0){
    $sql1 = "DELETE FROM categories WHERE category_id = {$_GET['id']}";
    $result1 = mysqli_query($conn , $sql1);
    if(mysqli_affected_rows($conn)){
        echo json_encode(["success" => "Category deleted successfully!"]);
    }else{
        echo json_encode(["error" => "Unfortunatlly, category could not delete due to some server error!"]);
    }
}else{
    echo json_encode(["error" => "You can not delete the category because some products are listed with this category"]);
}
?>