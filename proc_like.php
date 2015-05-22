<?php
require_once("config/db.php");
require_once("classes/LikeDislike.php");
require_once("classes/DBConnection.php");
$likeDislike = new LikeDislike();
$DBConnection = new DBConnection();

$likeDislike->addVote($_POST["id_pns"], $_POST["like"], $_POST["dislike"]);

 //   if ($likeDislike->errors) {
 //       foreach ($likeDislike->errors as $err) {
 //         echo $err;
 //       }
 //   }

echo $likeDislike->votes;
