<?php
require_once("config/db.php");
require_once("classes/AddComment.php");
require_once("classes/DBConnection.php");
$AddComment = new AddComment();
$DBConnection = new DBConnection();

$AddComment->addComment($_POST["id_pns"], $_POST["new_comment"]);

 //   if ($AddComment->errors) {
 //       foreach ($AddComment->errors as $err) {
 //         echo $err;
 //       }
 //   }
