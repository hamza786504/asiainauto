<?php
include_once("server/config.php");
if(basename($_SERVER['PHP_SELF']) !== "login.php"){
    echo "</div>";
}
?>

<div class="message_box success">
    <p></p>
    <span class="close_message_box" onclick="close_message_box()">&times;</span>
</div>
<div class="message_box error">
    <p></p>
    <span class="close_message_box" onclick="close_message_box()">&times;</span>
</div>


<div class="add_product_modal_back" id="add_product_modal_back">
    <div class="add_product_modal">
        <h3 class="heading">Add Product</h3>
        <span class="modal_close_btn" id="close_add_pro_modal" onclick="close_modal()">&times</span>
        <form id="add_product_form" enctype="multipart/form-data">
            <div class="from_fields">
                <div class="form_field" id="product_name_feild">
                    <input name="product_name" id="product_name" type="text" placeholder="Product Name *" />
                    <span class="field_message error" ><i class="icon fa fa-info-circle" aria-hidden="true"></i></span>
                </div>
                <div class="form_field" id="product_tagline_feild">
                    <input name="product_tagline" id="product_tagline" type="text" placeholder="Tagline *" />
                    <span class="field_message error" ><i class="icon fa fa-info-circle" aria-hidden="true"></i></span>
                </div>
                        <?php 
                        $get_categories_query = "SELECT category_id , category_name FROM categories";
                        $execute_get_category_query = mysqli_query($conn , $get_categories_query);
                        if(mysqli_num_rows($execute_get_category_query) > 0){
                            echo "<div class='form_field'>
                            <select name='category_select' id='category_select'>";
                            while($row = mysqli_fetch_assoc($execute_get_category_query)){
                                echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>";
                            }
                            echo"</select>
                            </div>";
                        }
                        ?>
                <div class="responsive_fields">
                    <div class="form_field">
                        <label>Stock</label>
                        <input name="stock" id="stock" type="number" value="0" />
                    </div>
                </div>
                <br />
                <div class="responsive_fields">
                    <div class="form_field">
                        <label>Purchase&nbsp;Price</label>
                        <input name="purchase_price" id="purchase_price" type="number" value="1" />
                    </div>
                </div>
                <div class="form_field mt-4 mb-2">
                    <label for="fixed_price_radio">Fixed&nbsp;price</label>
                    <input value="1" name="price_radio" onchange="price_type(this);" checked id="fixed_price_radio" type="radio" />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label for="discount_radio">Discount</label>
                    <input value="2" name="price_radio" onchange="price_type(this);" id="discount_radio" type="radio" />
                </div>
                <div class="responsive_fields">
                    <div class="form_field">
                        <label>Sale&nbsp;Price</label>
                        <input name="sale_price" id="sale_price" type="number" value="1" />
                    </div>
                    <div class="form_field" id="discounted_price_box">
                        <label>Discounted&nbsp;Price</label>
                        <input name="discounted_price" id="discounted_price" type="number" value="1" />
                    </div>
                </div>
                <br /> 
                <div class="responsive_fields mt-4">
                    <div class="form_field">
                        <label style="margin-right: 20px;">Tags</label>
                        <?php
                        $fetch_product_tags = "SELECT tags_id , tags_name FROM tags";
                        $execute_tags_query = mysqli_query($conn , $fetch_product_tags);
                        if(mysqli_num_rows($execute_tags_query) > 0){
                            while($tags_query_row = mysqli_fetch_assoc($execute_tags_query)){
                                if($tags_query_row['tags_id'] == 4){
                                    $checked_tag = "checked";
                                }else{
                                    $checked_tag = "";
                                }
                                echo "<label for='{$tags_query_row['tags_id']}' class='tag {$tags_query_row['tags_name']}_tag'>{$tags_query_row['tags_name']}</label>
                                <input value='{$tags_query_row['tags_id']}' {$checked_tag} name='add_badge' id='{$tags_query_row['tags_id']}' type='radio' />";
                            }
                        }
                        ?>
                    </div>
                </div>  
                <div class="form_field mt-4 mb-2">
                    <label for="draft">Draft</label>
                    <input value="0" name="publish_type" disabled id="draft" type="radio" />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label for="publish_radio">Publish</label>
                    <input value="1" name="publish_type" checked id="publish_radio" type="radio" />
                </div>         
                <div class="form_field mt-3">
                    <h6 style="color : white; margin-right: 30px;">Main image</h6>
                    <input type="file" id='varient_one' required name="varient_one" style="color : white;">
                </div>
                <div class="form_field mt-3">
                    <h6 style="color : white; margin-right: 30px;">Second varient</h6>
                    <input type="file" id='varient_two' name="varient_two" style="color : white;">
                </div>
                <div class="form_field mt-3">
                    <h6 style="color : white; margin-right: 30px;">Third varient</h6>
                    <input type="file" id='varient_three' name="varient_three" style="color : white;">
                </div>
                <div class="form_field mt-3">
                    <h6 style="color : white; margin-right: 30px;">Forth varient</h6>
                    <input type="file" id='varient_four' name="varient_four" style="color : white;">
                </div>
                <div class="form_field" id="product_description_field">
                    <textarea name="description" required id="description" placeholder="Description *"></textarea>
                    <span class="field_message error" ><i class="icon fa fa-info-circle" aria-hidden="true"></i></span>
                </div>
                    <div class="mt-3 mb-2">
                        <input type="button" value="Cancel" class="btn btn-danger" onclick="close_modal()" />
                        <input name="add_product_save" type="submit" id="add_product_save" value="Add Product" class="btn btn-success" />
                    </div>
            </div>
        </form>
    </div>
</div>


<div class="edit_product_modal_back" id="edit_product_modal_back">
    <div class="edit_product_modal">
        <h3 class="heading">Edit Product</h3>
        <span class="modal_close_btn" id="close_edit_pro_modal" onclick="close_modal()">&times</span>
        <form id="edit_product_form"></form>
    </div>
</div>


<div class="view_product_table_back" id="view_product_table_back">
    <div class="view_product_table">
        <span class="modal_close_btn" id="close_pro_table" onclick="close_modal()">&times</span>
        <table id="product_record">
        </table>
    </div>
</div>







<div class="add_category_modal_back" id="add_category_modal_back">
    <div class="add_category_modal">
        <h3 class="heading">Add Category</h3>
        <span class="modal_close_btn" id="close_add_cat_modal" onclick="close_modal()">&times</span>
        <form id="add_category_form">
            <div class="from_fields">
                <div class="form_field" id="category_name_feild">
                    <input name="category_name" id="category_name" type="text" placeholder="Category Name *" />
                    <span class="field_message error" ><i class="icon fa fa-info-circle" aria-hidden="true"></i></span>
                </div>
                <div class="mt-3 mb-2">
                    <input type="button" value="Cancel" class="btn btn-danger" onclick="close_modal()" />
                    <input name="add_category_save" type="submit" id="add_category_save" value="Add category" class="btn btn-success" />
                </div>
            </div>
        </form>
    </div>
</div>


<div class="edit_category_modal_back" id="edit_category_modal_back">
    <div class="edit_category_modal">
        <h3 class="heading">Edit Category</h3>
        <span class="modal_close_btn" id="close_edit_cat_modal" onclick="close_modal()">&times</span>
        <form id="edit_category_form"></form>
    </div>
</div>






<!-- Use jQuery CDN path -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- Use bootstrap 5 CDN path for bundle.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script src="js/index.js"></script>
<script src="js/jquery-code.js"></script>
    <script src="../wow.js/wow.min.js"></script>
    <script> new WOW().init(); </script>
</body>
</html>