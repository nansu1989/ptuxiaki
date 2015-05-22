<?php
    if (version_compare(PHP_VERSION, '5.3.7', '<')) {
        exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
    } else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
        require_once("libraries/password_compatibility_library.php");
    }

    require_once("config/db.php");

    require_once("classes/Login.php");
    $login = new Login();
    require_once("classes/DBConnection.php");
    $dbCon = new DBConnection();
    $_SESSION['page'] = "instrument";

    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
?>
<!DOCTYPE html>
<html>
    
    <!-- browser bar -->
	<head>
		<title> VOTE mania </title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="css/set2.css" />

        <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.2.0/css/font-awesome.min.css" />

        <!-- Add jQuery library -->
        <script type="text/javascript" src="lib/jquery-1.10.1.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"> </script>
        <!-- Add mousewheel plugin (this is optional) -->
        <script type="text/javascript" src="lib/jquery.mousewheel-3.0.6.pack.js"></script>
        <!-- Add fancyBox main JS and CSS files -->
        <script type="text/javascript" src="source/jquery.fancybox.js?v=2.1.5"></script>
        <link rel="stylesheet" type="text/css" href="source/jquery.fancybox.css?v=2.1.5" media="screen" />
        <!-- Add Button helper (this is optional) -->
        <link rel="stylesheet" type="text/css" href="source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
        <script type="text/javascript" src="source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
        <!-- Add Thumbnail helper (this is optional) -->
        <link rel="stylesheet" type="text/css" href="source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
        <script type="text/javascript" src="source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
        <!-- Add Media helper (this is optional) -->
        <script type="text/javascript" src="source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
        <script type="text/javascript">
            $(document).ready(function() {              
                $('.fancybox').fancybox({
                    autoScale   : true,
                    width       : '100%',
                    height      : '100%',
                    closeClick  : false,
                    scrolling   : 'auto',
                    openEffect  : 'elastic',
                    closeEffect : 'elastic',
                    afterClose  : function() { 
                        window.location.reload();
                    }
                });
            });
        </script>
        <script src="js/bootstrap.js"> </script>

        <script src="js/myjs.js"> </script>

	</head>

	<body>    
        <!-- site bar up -->
		<!-- site bar up -->
        <?php include("menu.php"); ?>
        <!--
        
        <!-- site body -->
        <div class="container">
            <div class="row">
        <?php 
                $sql = "SELECT * FROM pns WHERE id_category=".$id;
            //  echo $sql;  HAVING user_type LIKE '%admin%'
                $result = $dbCon->db_connection->query($sql);
                if( mysqli_num_rows($result) != 0){
                    while($row = $result->fetch_array()){
                        $x = 0;
                        $y = 0;
                        $im = imagecreatefromjpeg($row['photo']);
                        $width = imagesx($im);
                        $height = imagesy($im);

                        $rgb = imagecolorat($im, $x, $y);
                   //     $rgb = $rgb+imagecolorat($im, $x, $height-1);
                  //      $rgb = $rgb+imagecolorat($im, $height-1, $y);
                  //      $rgb = $rgb+imagecolorat($im, $width-1, $height-1);
                  //      $rgb = $rgb/4;
                        $r = ($rgb >> 16) & 0xFF;
                        $g = ($rgb >> 8) & 0xFF;
                        $b = $rgb & 0xFF;
                        $cssBack = "background: rgb(". $r.",".$g.",".$b.")";

                        $sql2 = "SELECT COUNT(CASE WHEN `like` = true THEN 1 END) as likes FROM votes WHERE id_pns=".$row['id_pns'];
                        $sql3 = "SELECT COUNT(*) as counter_com FROM comments WHERE id_pns = ".$row['id_pns'];
                    //    echo $sql2;
                        $result2 = $dbCon->db_connection->query($sql2);
                        if( mysqli_num_rows($result2) != 0){
                            $row2 = $result2->fetch_array();
                        }
                        $result3 = $dbCon->db_connection->query($sql3);
                        if( mysqli_num_rows($result3) != 0){
                            $row3 = $result3->fetch_array();
                        }
                ?>

                <div class="col-md-3 col-sm-4 col-xs-12">

                <div class="grid">
                    <figure class="effect-kira" style="<?php echo $cssBack; ?>">
                        <img src="<?php echo $row['photo']; ?>" alt="img11"/>
                        <figcaption>
                            <a class="fancybox fancybox.iframe" href="pns_info.php?<?php echo 'r='.$r.'&g='.$g.'&b='.$b.'&id_pns='.$row['id_pns']; ?>"></a>
                     		<h2><span><?php echo $row['title']; ?></span></h2>
                            <p>
                                <a href="#<?php echo $row['id_pns']; ?>" class="like"><i class="glyphicon glyphicon-heart"></i><span class="badge like"><?php echo $row2['likes']; ?></span></a>
                                <a href="#<?php echo $row['id_pns']; ?>" class="dislike"><i class="glyphicon glyphicon-comment"></i><span class="badge comments"><?php echo $row3['counter_com']; ?></span></a>
                            </p>
                        </figcaption>
                    </figure>
                </div>
                </div>
            <?php }
                }else{ ?>
                    <div class="alert alert-info">
                    <strong>There are mpt any product or service</strong>
                    </div>
           <?php } ?>
            </div>
        </div>
                
        <?php include("sign_up.php"); ?>
        <?php include("log_in.php"); ?>
	
	</body>

</html>