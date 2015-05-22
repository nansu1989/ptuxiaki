<?php
require_once("config/db.php");
require_once("classes/Registration.php");
require_once("classes/DBConnection.php");
$reg = new Registration();
$DBConnection = new DBConnection();

$reg->registerNewUser($_POST["name"], $_POST["sirname"],$_POST["email"], $_POST["password"],$_POST["re_password"]);

if($reg->temp==0){
    if ($reg->errors) {
        foreach ($reg->errors as $err) {
        	echo $err;
        }
    }
}else{
    echo "1";
}
