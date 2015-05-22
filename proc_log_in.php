<?php
require_once("config/db.php");
require_once("classes/Login.php");
require_once("classes/DBConnection.php");
$login = new Login();
$DBConnection = new DBConnection();

$login->dologinWithPostData($_POST["login_input_email"], $_POST["login_input_password"]);

if($login->temp==0){
    if ($login->errors) {
        foreach ($login->errors as $err) {
          echo $err;
        }
    }
}else{
    echo "1";
}
