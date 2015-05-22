<?php
require_once("config/db.php");
require_once("classes/DBConnection.php");
$DBConnection = new DBConnection();

$sql = "SELECT u.*, c.* FROM comments c
		left join users u on u.id_user = c.id_user 
		WHERE id_pns=".$_POST["id_pns"];
$result1 = $DBConnection->db_connection->query($sql);
if( mysqli_num_rows($result1) != 0) {
echo "<div class=\"actionBox\">
        <ul id=\"commentList\" class=\"commentList\"> ";
            while($row1 = $result1->fetch_array()) {
            	if($row1['id_user']==0){
					$name = "guest";
				}else{
					$name = $row1['name'];
				}
echo "      <li>
                <div class=\"commenterImage\">
                  <img src=\"http://lorempixel.com/50/50/people/6\" />
                </div>
                <div class=\"commentText\">
                    <p class=\"\"> "
					.$row1['comment'];
echo "              </p> <span class=\"date sub-text\">on 
                    	".$row1['date']." by <b>".$name."</b>
                    </span>
                </div>
            </li> ";
         	}
echo " </ul>
    </div> ";
}
