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
        <script type="text/javascript" src="lib/jquery-1.10.1.min.js"></script>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

        <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.css" />
        <script type="text/javascript" src="js/dataTables.bootstrap.js"></script>
        <link rel="stylesheet" type="text/css" href="css/bootstrap-select.css" />
        <script type="text/javascript" src="js/bootstrap-select.js"></script>

        <script type="text/javascript" src="js/jquery.selectpicker.js"></script>
        <link type="text/css" rel="stylesheet" href="css/jquery.selectpicker.css"></link>
        
        <link href="external/google-code-prettify/prettify.css" rel="stylesheet">
        <link href="http://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">

        <script src="external/jquery.hotkeys.js"></script>
        <script src="external/google-code-prettify/prettify.js"></script>

        <script src="js/bootstrap-wysiwyg.js"></script>

        <link href="css/styles.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="css/set1.css" />


        <script src="js/myjs.js"> </script>
        <script type="text/javascript">
            $(function() {
                $(document.body).on('click','.category_name', function () {

      //          $('.selectpicker.show-menu-arrow.change-state-abastract.category_name').on('change', function(){
                    var selected = $(".category_name :selected").val();
                    
                    console.log(selected);
                    if(selected==0){
                        $('.category_set_name').fadeIn("slow");
                        $('.category_set_photo').fadeIn("slow");
                    }else{
                        $('.category_set_name').fadeOut("slow");
                        $('.category_set_photo').fadeOut("slow");
                    }
                });
              
            });
        </script>
    </head>

    <body>
        <!-- site bar up -->
        <?php include("menu.php"); ?>
        <!--
         <div class="navbar-img"><img src="img/grammh.png" width="100%" height="3px"></div> -->
               <!-- site body -->
        <div class="container">
            <div class="row">
            <div class="col-md-12">
        <?php 
        $sql = "SELECT * FROM categories";
           $result = $dbCon->db_connection->query($sql);
           if( mysqli_num_rows($result) != 0){ ?>
           <form id="bootstrapSelectForm" method="post" class="form-horizontal">

                <div class="form-group">
                <label class="col-xs-5 control-label" for="sel1">Select category</label>
                <div class="col-xs-5">
                    <select class="selectpicker show-menu-arrow change-state-abastract category_name" id="category_name" data-width="auto" data-size="auto" data-value="1" data-filter="true" data-live-search="true" id="sel1" data-style="btn-default">
                        <option value="0">Create new category</option>
                        <option data-divider="true"></option>
                <?php while($row = $result->fetch_array() ){ ?>
                        <option value="<?php echo $row['id_category']; ?>"><?php echo $row['title']; ?></option>
                <?php } ?>
                    </select>
                </div>
                </div>

                <div class="form-group category_set_name">
                <label class="col-xs-5 control-label" for="sel1">Set the name of category</label>
                <div class="col-xs-5">
                    <input type="text" class="form-control" placeholder="Category name">
                </div>
                </div>

                <div class="form-group category_set_photo">
                <label class="col-xs-5 control-label" for="sel1">Upload photo for the new category</label>
                <div class="col-xs-5">
                     <input type="file" class="filestyle" id="upload_photo_category">
                </div>
                </div>

                <div class="form-group pns_set_name">
                <label class="col-xs-5 control-label" for="sel1">Set the name of product or service</label>
                <div class="col-xs-5">
                    <input type="text" class="form-control" placeholder="Product or service name">
                </div>
                </div>

                <div class="form-group">
                <label class="col-xs-5 control-label" for="sel1">Upload photo for the new product or service</label>
                <div class="col-xs-5">
                     <input type="file" class="filestyle" id="upload_photo_category">
                </div>
                </div>

                <div class="form-group">
                <div class="col-xs-10" align="right">
                <button type="button" class="btn btn-primary" disabled="true">Action</button>
                </div>
                </div>

            </form>
     <?php  } ?>
            </div>
            </div>
        </div>
        <hr>
                
        <?php include("sign_up.php"); ?>
        <?php include("log_in.php"); ?>
        
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"> </script>
    
    </body>

</html>