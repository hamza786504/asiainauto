<?php
include_once("config.php");
session_start();
$data = json_decode(file_get_contents('php://input'),true);
$username = mysqli_real_escape_string($conn, trim($data['username']));
$password = mysqli_real_escape_string($conn, sha1($data['password']));

$sql = "SELECT * FROM admin_users WHERE username = '{$username}' AND user_password = '{$password}' ";
$result = mysqli_query($conn , $sql);
if(mysqli_num_rows($result) == 1){
    $result = mysqli_fetch_assoc($result);
    echo json_encode(["success" => "authenticated"]); 
    $_SESSION["user_name"] = $result["username"];
    $_SESSION["user_id"] = $result["user_id"];
}else{
    echo json_encode(["error" => "Something wrong"]); 
}
?>