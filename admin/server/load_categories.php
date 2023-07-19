<?php

include_once("config.php");

$cat_data = "
<p>Categories</p>
<br/><br/>
<div class='table-responsive'>
<table class='table'>
        <thead>
                <tr>
                    <th>Id</th>
                    <th>Category</th>
                    <th>Products</th>
                    <th></th>
                </tr>
        </thead>
        <tbody>";
                $read_category_query = "SELECT * FROM categories";
                $read_category_result = mysqli_query($conn , $read_category_query);
                if(mysqli_num_rows($read_category_result) > 0){
                    $i = 1;
                        while($read_category_row = mysqli_fetch_assoc($read_category_result)){
                            $cat_data .= "<tr>
                                        <td>{$i}</td>
                                        <td>{$read_category_row['category_name']}</td>
                                        <td>{$read_category_row['products']}</td>
                                        <td style='text-align: end;'>
                                            <button class='btn btn-sm btn-success' id='edit_category' data-id='{$read_category_row['category_id']}' >Edit</button>
                                            <button id='delete_category' data-id='{$read_category_row['category_id']}' class='btn btn-sm btn-danger'>Delete</button>
                                        </td>
                                    </tr>";
                                    $i++;
                        }
                }else{
                    $cat_data .= "
                    <tr><th colspan='5'><h2 style='text-align: center;'>Please add category before you add product</h2></th><tr>";
                }
                $cat_data .= "
                    </tbody>
                </table>
            </div>";
            echo json_encode(["message" => $cat_data]);
            
?>