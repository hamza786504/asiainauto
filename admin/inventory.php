<?php include_once("partial/header.php"); 
if(!isset($_SESSION["user_name"])){
        header("Location: login.php");
}
?>

<?php include_once("partial/footer.php"); ?>