<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/product-image.css">
    <title>Al Rahman Computers</title>
</head>
<body style='background-color: black;'>
    <div class="wrapper">
        <div class='product-img'>
            <div class="main_image">    
                <img src="images/23934.jpg" id='active_varient_image'>
            </div>
            <div class='varients'>
                <div class='varient active'>
                    <img class='varient_img_normal' src="images/23934.jpg" alt='image' />
                </div>
                <?php
                    // if($row['varient_two'] !== ""){
                ?>
                        <div class='varient'>
                            <img class='varient_img_normal' src="images/23934.jpg" alt='image' />
                        </div>
                    <?php 
                    // } 
                    // if($row['varient_three'] !== ""){ 
                        ?>
                        <div class='varient'>
                            <img class='varient_img_normal' src="images/23934.jpg" alt='image' />
                        </div>
                    <?php 
                    // }
                    // if($row['varient_four'] !== ""){ 
                        ?>
                        <div class='varient'>
                            <img class='varient_img_normal' src="images/23934.jpg" alt='image' />
                        </div>
                    <?php
                //  } 
                ?>
            </div>
        </div>
    </div>
    <script src="js/product-image.js"></script>
</body>
</html>