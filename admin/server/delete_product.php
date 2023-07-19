<?php
include_once("config.php");
$sql = "SELECT category , tag , varient_one , varient_two , varient_three , varient_four FROM products WHERE product_id = {$_GET['id']}";
$result = mysqli_query($conn , $sql);
if(mysqli_num_rows($result) == 1){
    while($row = mysqli_fetch_assoc($result)){
        $category = $row['category'];
        $tag = $row['tag'];
        $varient_one = $row['varient_one'];
        $varient_two = $row['varient_two'];
        $varient_three = $row['varient_three'];
        $varient_four = $row['varient_four'];
        $sql1 = "DELETE FROM products WHERE product_id = {$_GET['id']};";
        $sql1 .= "UPDATE categories SET products = products - 1 WHERE category_id = {$category};";
        $sql1 .= "UPDATE tags SET usedby_products = usedby_products - 1 WHERE tags_id = {$tag};";
        if(mysqli_multi_query($conn,$sql1)){
            unlink("../../images/".$varient_one);
            if($varient_two !== ""){ unlink("../../images/".$varient_two); }
            if($varient_three !== ""){ unlink("../../images/".$varient_three); }
            if($varient_four !== ""){ unlink("../../images/".$varient_four); }
            echo json_encode(["success" => "Product deleted successfully!"]);
        }else{
            echo json_encode(["error" => "Product could not deleted!"]);
        }
    }
}else{
    echo json_encode(["error" => "Product could not deleted due to server error!"]);
}
?>