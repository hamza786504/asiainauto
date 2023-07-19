<?php
include_once("config.php");
if(isset($_GET['id'])){
    $sql = "SELECT * FROM products
    LEFT JOIN categories ON products.category = categories.category_id
    LEFT JOIN tags ON products.tag = tags.tags_id where product_id = {$_GET['id']}";
    $result = mysqli_query($conn , $sql);
    $table = "";
    if(mysqli_num_rows($result) == 1){
        while($row = mysqli_fetch_assoc($result)){
            $table .= "
                        <tr>
                            <td>Product Title</td>
                            <td>{$row['product_name']}</td>
                        </tr>
                        <tr>
                            <td>Product Tagline</td>
                            <td>{$row['product_tagline']}</td>
                        </tr>
                        <tr>
                            <td>Category</td>
                            <td>{$row['category_name']}</td>
                        </tr>
                        <tr>
                            <td>Tag</td>
                            <td>{$row['tags_name']}</td>
                        </tr>
                        <tr>
                            <td>Purchase Price</td>
                            <td>{$row['purchase_price']}</td>
                        </tr>
                        <tr>
                            <td>Sale Price</td>
                            <td>{$row['sale_price']}</td>
                        </tr>
                        <tr>
                            <td>Discounted Price</td>
                            <td>{$row['discounted_price']}</td>
                        </tr>
                        <tr>
                            <td>Stock</td>
                            <td>{$row['stock']}</td>
                        </tr>
                        <tr>
                            <td>Varients</td>
                            <td>
                            <img width='70px' style='margin-left:5px; margin-top: 5px;' src='../images/{$row['varient_one']}' /> ";
                                if($row['varient_two'] != ""){
                                    $table .= "<img width='70px' style='margin-left:5px; margin-top: 5px;' src='../images/{$row['varient_two']}' />"; 
                                }
                                if($row['varient_three'] != ""){
                                    $table .= "<img width='70px' style='margin-left:5px; margin-top: 5px;' src='../images/{$row['varient_three']}' />"; 
                                }
                                if($row['varient_four'] != ""){
                                    $table .= "<img width='70px' style='margin-left:5px; margin-top: 5px;' src='../images/{$row['varient_four']}' />"; 
                                }
                            $table .= "</td></tr>
                            <tr>
                                <td>Total Sales</td>
                                <td>{$row['total_sales']}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>{$row['status']}</td>
                            </tr>
                            <tr>
                                <td>Date</td>
                                <td>{$row['date']}</td>
                            </tr>
                            ";
        }
    }
    echo json_encode(["message" => $table]);
}
?>