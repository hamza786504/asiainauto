<?php

include_once("config.php");

$data = "
<p>Products</p>
<br/><br/>
<div class='table-responsive'>
<table class='table'>
        <thead>
                <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Total Sales</th>
                        <th></th>
                </tr>
        </thead>
        <tbody>";
                if(isset($_GET['page_no'])){
                  $page_no = $_GET['page_no'];
                }else{
                  $page_no = 1;
                }
                $limit = 50;
                $offset = ($page_no - 1) * $limit;

                $read_products_query = "SELECT product_id , product_name ,sale_price , discounted_price , tags_name , total_sales , category_name FROM products 
                LEFT JOIN tags ON tags.tags_id = products.tag
                LEFT JOIN categories ON categories.category_id = products.category ORDER BY product_id DESC LIMIT {$offset} , {$limit}";
                $read_products_result = mysqli_query($conn , $read_products_query);
                if(mysqli_num_rows($read_products_result) > 0){
                        while($read_products_row = mysqli_fetch_assoc($read_products_result)){
                            $product_name = substr($read_products_row['product_name'],0,40);
                            $data .= "<tr>
                                        <td>{$product_name}</td>
                                        <td>
                                            <span class='price_outer mt-2'>";
                                            if($read_products_row['sale_price'] !== $read_products_row['discounted_price']){
                                                $data .= "
                                                    <span class='cut-price'>{$read_products_row['sale_price']}</span>
                                                    &nbsp;&nbsp
                                                    <span class='price'>{$read_products_row['discounted_price']}</span>
                                                    /-</span>";
                                            }else{
                                                $data .= "
                                                <span class='price'>{$read_products_row['sale_price']}</span>
                                                /-</span>";
                                            }
                                        $data .="</td>
                                        <td>{$read_products_row['category_name']}</td>
                                        <td>{$read_products_row['total_sales']}</td>
                                        <td style='text-align: end;'>
                                        <button class='btn btn-sm btn-warning' id='view_product' data-view_product_id='{$read_products_row['product_id']}'>View</button>
                                        <button class='btn btn-sm btn-success' id='edit_product' data-id='{$read_products_row['product_id']}' >Edit</button>
                                        <button id='delete_product' data-id='{$read_products_row['product_id']}' class='btn btn-sm btn-danger'>Delete</button>
                                        </td>
                                    </tr>";
                        }
                }else{
                    $data .= "
                    <tr><th colspan='5'><h1 style='text-align: center;'>Products are not listed yet</h1></th><tr>";
                }
                $data .= "
                    </tbody>
                </table>
            </div>";

            $pagination_query = "SELECT * FROM products";
            $pagination_result = mysqli_query($conn , $pagination_query);
            if(mysqli_num_rows($pagination_result) > $limit){
                $data .= "<ul class='custom-pagination'>";
                    if(mysqli_num_rows($pagination_result) > 0){
                        $total_pages = ceil(mysqli_num_rows($pagination_result) / $limit);
                        if($page_no >= 2){
                            $data .= "<li><a href='products.php?page_no=" . $page_no - 1 . "'>Prev</a></li>";
                        }
                        for($i = $page_no; $i <= $total_pages; $i++){
                            $times = $page_no + 1;
                            if($i <= $total_pages){
                                $data .= "<li><a href='products.php?page_no=" . $i . "'>" . $i . "</a></li>";
                            }
                        }
                        if($page_no < $total_pages){
                            $data .= "<li><a href='products.php?page_no=" . $page_no + 1 . "'>Next</a></li>";
                        }
                    }
                $data .= "</ul>"; 
            }
            echo json_encode(["message" => $data]);
?>