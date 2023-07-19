<?php 
include_once("partial/header.php");
if(isset($_SESSION["user_name"])){
        header("Location: index.php");
}
?>

    <div class="form_section">
        <div class="form_logo">
            <div class="logo_box">
                <img src="../images/logo.png" alt="" />
            </div>
            <div class="form_fields">
                <form id="login_form">
                    <div class="form_field">
                        <input id="login_username" type="text" placeholder="Username *" />
                        <span class="field_message error" ><i class="icon fa fa-info-circle" aria-hidden="true"></i></span>
                    </div>
                    <div class="form_field">
                        <input id="login_password" type="password" placeholder="Password *" />
                        <span class="field_message error" ><i class="icon fa fa-info-circle" aria-hidden="true"></i></span>
                    </div>
                    <div class="responsive_fields my-4">
                        <input type="submit" value="Login" class="form_btn" />
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
include_once("partial/footer.php");
?>