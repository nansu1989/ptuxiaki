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
?>
<!DOCTYPE html>
<html>
    
    <!-- browser bar -->
    <head>
        <title> VOTE mania </title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=4, user-scalable=no">
       
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"> </script>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

        <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.css" />
        <script type="text/javascript" src="js/dataTables.bootstrap.js"></script>
        <link rel="stylesheet" type="text/css" href="css/bootstrap-select.css" />
        <script type="text/javascript" src="js/bootstrap-select.js"></script>
        
        <link href="external/google-code-prettify/prettify.css" rel="stylesheet">
        <link href="http://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">

        <script src="external/jquery.hotkeys.js"></script>
        <script src="external/google-code-prettify/prettify.js"></script>

        <script src="js/bootstrap-wysiwyg.js"></script>
        
        <link href="css/styles.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="css/set1.css" />

     <!--   <script type="text/javascript" src="lib/jquery-1.10.1.min.js"></script> -->

        <script src="js/myjs.js"> </script>
    </head>

    <body>
       
        <!-- site bar up -->
        <?php include("menu.php"); ?>
        <!--
         <div class="navbar-img"><img src="img/grammh.png" width="100%" height="3px"></div> -->
               <!-- site body -->
        <div class="container">
            <div class="row">
        <?php 
        $sql = "SELECT * FROM categories";
            //  echo $sql;  HAVING user_type LIKE '%admin%'
                $result = $dbCon->db_connection->query($sql);
                if( mysqli_num_rows($result) != 0){
                    while($row = $result->fetch_array() ){

                        $x = 0;
                        $y = 0;
                        $im = imagecreatefromjpeg($row['photo']);
                        $rgb = imagecolorat($im, $x, $y);
                        $r = ($rgb >> 16) & 0xFF;
                        $g = ($rgb >> 8) & 0xFF;
                        $b = $rgb & 0xFF;
                        $cssBack = "background: rgb(". $r.",".$g.",".$b.")";
        ?>

                <div class="col-md-4 col-sm-6 col-xs-12">

                <div class="grid">
                    <figure class="effect-marley" style="<?php echo $cssBack; ?>">
                        <img src="<?php echo $row['photo']; ?>" alt="img11"/>
                        <figcaption>
                            <h2><span><?php echo $row['title']; ?></span></h2>
                            <p><?php echo $row['caption']; ?></p>
                            <a href="<?php echo "pns.php?id=".$row['id_category']; ?>">View more</a>
                        </figcaption>           
                    </figure>
                </div>
                </div>
            <?php }
                } ?>
            </div>
        </div>
        <hr>
                
        <?php include("sign_up.php"); ?>
        <?php include("log_in.php"); ?>
        
    
    </body>

</html>