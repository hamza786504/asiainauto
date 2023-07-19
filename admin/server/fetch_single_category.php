<?php
include_once("config.php");
$single_category_query = "SELECT * FROM categories WHERE category_id = {$_GET['id']}";
$execute_fetch_single_query = mysqli_query($conn , $single_category_query);
if(mysqli_num_rows($execute_fetch_single_query) == 1){
    while($row1 = mysqli_fetch_assoc($execute_fetch_single_query)){
        $category_name = stripslashes($row1['category_name']);        
$data = "<div class='from_fields'>
                <div class='form_field' id='edit_category_name_feild'>
                    <input name='edit_category_id' value='{$row1['category_id']}' id='edit_category_name' type='hidden' />
                    <input name='edit_category_name' value='{$category_name}' id='edit_category_name' type='text' placeholder='Product Name *' />
                    <span class='field_message error' ><i class='icon fa fa-info-circle' aria-hidden='true'></i></span>
                </div>
                    <div class='mt-3 mb-2'>
                        <input type='button' value='Cancel' class='btn btn-danger' onclick='close_modal()' />
                        <input name='edit_category_save' onclick='close_modal()' type='submit' id='edit_category_save' value='Update Product' class='btn btn-success' />
                    </div>
            </div>";
                    } }





echo json_encode(['message' => $data]);
?>