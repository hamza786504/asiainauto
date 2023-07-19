<?php
include_once("config.php");
$single_product_query = "SELECT * FROM products WHERE product_id = {$_GET['id']}";
$execute_fetch_single_query = mysqli_query($conn , $single_product_query);
if(mysqli_num_rows($execute_fetch_single_query) == 1){
    while($row1 = mysqli_fetch_assoc($execute_fetch_single_query)){
        $product_name = stripslashes($row1['product_name']);
        $product_tagline = stripslashes($row1['product_tagline']);
        $product_description = stripslashes($row1['product_description']);
        
$data = "<div class='from_fields'>
                <div class='form_field' id='edit_product_name_feild'>
                    <input name='edit_product_id' value='{$row1['product_id']}' id='edit_product_name' type='hidden' />
                    <input name='edit_product_name' value='{$product_name}' id='edit_product_name' type='text' placeholder='Product Name *' />
                    <span class='field_message error' ><i class='icon fa fa-info-circle' aria-hidden='true'></i></span>
                </div>
                <div class='form_field' id='edit_product_tagline_feild'>
                    <input name='edit_product_tagline' value='{$product_tagline}' id='edit_product_tagline' type='text' placeholder='Tagline *' />
                    <span class='field_message error' ><i class='icon fa fa-info-circle' aria-hidden='true'></i></span>
                </div>";
                        $get_categories_query = "SELECT category_id , category_name FROM categories";
                        $execute_get_category_query = mysqli_query($conn , $get_categories_query);
                        if(mysqli_num_rows($execute_get_category_query) > 0){
                            $data .= "<div class='form_field'>
                            <select name='edit_category_select' id='edit_category_select'>";
                            while($row = mysqli_fetch_assoc($execute_get_category_query)){
                                if($row1["category"] == $row["category_id"]){
                                    $selected = "selected";
                                }else{
                                    $selected = "";
                                }
                                $data .= "<option {$selected} value='{$row['category_id']}'>{$row['category_name']}</option>";
                            }
                            $data .="</select>
                            </div>";
                        }
                $data .="<div class='responsive_fields'>
                    <div class='form_field'>
                        <label>Stock</label>
                        <input name='edit_stock' id='edit_stock' type='number' value='{$row1['stock']}' />
                    </div>
                </div>
                <br />
                <div class='responsive_fields'>
                    <div class='form_field'>
                        <label>Purchase&nbsp;Price</label>
                        <input name='edit_purchase_price' id='edit_purchase_price' type='number' value='{$row1['purchase_price']}' />
                    </div>
                </div>
                <div class='form_field mt-4 mb-2'>
                    <label for='edit_fixed_price_radio'>Fixed&nbsp;price</label>
                    "; 
                        if($row1["sale_price"] == $row1["discounted_price"]){
                            $fixedprice_checked = "checked";
                            $discountprice_checked = "";
                        }else{
                            $fixedprice_checked = "";
                            $discountprice_checked = "checked";
                        }
                    $data .= "
                    <input value='1' name='edit_price_radio' onchange='price_type(this);' {$fixedprice_checked} id='edit_fixed_price_radio' type='radio' />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label for='edit_discount_radio'>Discount</label>
                    <input value='2' name='edit_price_radio' onchange='price_type(this);' {$discountprice_checked} id='edit_discount_radio' type='radio' />
                </div>
                <div class='responsive_fields'>
                    <div class='form_field'>
                        <label>Sale&nbsp;Price</label>
                        <input name='edit_sale_price' id='edit_sale_price' type='number' value='{$row1['sale_price']}' />
                    </div>
                    <div id='edit_discounted_price_box' class='form_field "; 
                    if($row1["discounted_price"] == $row1["sale_price"]){
                        $data .= "d-none";
                    }
                    $data .="'>
                        <label>Discounted&nbsp;Price</label>
                        <input name='edit_discounted_price' id='edit_discounted_price' type='number' value='{$row1['discounted_price']}' />
                    </div>
                </div>
                <br /> 
                <div class='responsive_fields mt-4'>
                    <div class='form_field'>
                        <label style='margin-right: 20px;'>Tags</label>";
                        if($row1['tag'] == 0){
                            $check_product_tag_none = "checked";
                        }else{
                            $check_product_tag_none = "";
                        }
                        $fetch_product_tags = 'SELECT tags_id , tags_name FROM tags';
                        $execute_tags_query = mysqli_query($conn , $fetch_product_tags);
                        if(mysqli_num_rows($execute_tags_query) > 0){
                            while($tags_query_row = mysqli_fetch_assoc($execute_tags_query)){
                                if($row1['tag'] == $tags_query_row['tags_id']){
                                    $checked_product_tag = "checked";
                                }else{
                                    $checked_product_tag = "";
                                }
                                $data .= "<label for='edit_{$tags_query_row['tags_id']}'"; 
                                if($tags_query_row['tags_name'] !== "none"){
                                    $data .= "class='tag {$tags_query_row['tags_name']}_tag'";
                                }
                                $data .= ">{$tags_query_row['tags_name']}</label>
                                <input value='{$tags_query_row['tags_id']}' {$checked_product_tag} name='edit_add_badge' id='edit_{$tags_query_row['tags_id']}' type='radio' />";
                            }
                        }
                        $data .= " 
                    </div>
                </div> 
                <div class='form_field mt-4 mb-2'>
                    <label for='draft'>Draft</label>";
                        if($row1["status"] == 1){
                            $publish_type_status = "checked";
                            $draf_type_status = "";
                        }else{
                            $publish_type_status = "";
                            $draf_type_status = "checked";
                        }
                    $data .= "
                    <input value='0' name='edit_publish_type' {$draf_type_status} disabled id='edit_draft' type='radio' />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label for='publish_radio'>Publish</label>
                    <input value='1' name='edit_publish_type' {$publish_type_status} id='edit_publish_radio' type='radio' />
                </div>
                        

                <div class='form_field mt-3'>
                    <h6 style='color : white; margin-right: 30px;'>Main image</h6>
                    <span style='display:flex; flex-direction: column; flex-wrap: wrap;'>
                        <img class='mt-3' src='../images/{$row1['varient_one']}' alt='{$row1['varient_one']}' style='max-width: 150px; max-height: 60px; height:100%;' />
                        <input type='file' id='edit_varient_one' name='edit_varient_one' style='color : white;'>
                        <input type='hidden' id='old_varient_one' name='old_varient_one' value='{$row1['varient_one']}' />
                    </span>
                </div>
                <div class='form_field mt-3'>
                    <h6 style='color : white; margin-right: 30px;'>Second varient</h6>
                    <span style='display:flex; flex-direction: column; flex-wrap: wrap;'>";
                    if($row1['varient_two'] != ""){
                        $varient_two_val = $row1['varient_two'];
                        $data .= "<img class='mt-3' src='../images/{$row1['varient_two']}' alt='{$row1['varient_two']}' style='max-width: 150px; max-height: 60px; height:100%;' />";
                    }else{
                        $varient_two_val = "";
                    }
                    $data .= "
                        <input type='file' id='edit_varient_two' name='edit_varient_two' style='color : white;'>
                        <input type='hidden' id='old_varient_two' name='old_varient_two' value='{$row1['varient_two']}' />
                    </span>
                </div>
                <div class='form_field mt-3'>
                    <h6 style='color : white; margin-right: 30px;'>Third varient</h6>
                    <span style='display:flex; flex-direction: column; flex-wrap: wrap;'>";
                    if($row1['varient_three'] != ""){
                        $varient_three_val = $row1['varient_three'];
                        $data .= "<img class='mt-3' src='../images/{$row1['varient_three']}' alt='{$row1['varient_three']}' style='max-width: 150px; max-height: 60px; height:100%;' />";
                    }else{
                        $varient_three_val = "";
                    }
                    $data .= "
                        <input type='file' id='edit_varient_three' name='edit_varient_three' style='color : white;'>
                        <input type='hidden' id='old_varient_three' name='old_varient_three' value='{$row1['varient_three']}' />
                    </span>
                </div>
                <div class='form_field mt-3'>
                    <h6 style='color : white; margin-right: 30px;'>Forth varient</h6>
                    <span style='display:flex; flex-direction: column; flex-wrap: wrap;'>";
                    if($row1['varient_four'] != ""){
                        $varient_four_val = $row1['varient_four'];
                        $data .= "<img class='mt-3' src='../images/{$row1['varient_four']}' alt='{$row1['varient_four']}' style='max-width: 150px; max-height: 60px; height:100%;' />";
                    }else{
                        $varient_four_val = "";
                    }
                    $data .= "
                        <input type='file' id='edit_varient_four' name='edit_varient_four' style='color : white;'>
                        <input type='hidden' id='old_varient_four' name='old_varient_four' value='{$row1['varient_four']}' />
                    </span>
                </div>


                <div class='form_field' id='edit_product_description_field'>
                    <textarea name='edit_description' id='edit_description' placeholder='Description *'>{$product_description}</textarea>
                    <span class='field_message error' ><i class='icon fa fa-info-circle' aria-hidden='true'></i></span>
                </div>
                    <div class='mt-3 mb-2'>
                        <input type='button' value='Cancel' class='btn btn-danger' onclick='close_modal()' />
                        <input name='edit_product_save' onclick='close_modal()' type='submit' id='edit_product_save' value='Update Product' class='btn btn-success' />
                    </div>
            </div>";
                    } }





echo json_encode(['message' => $data]);
?>