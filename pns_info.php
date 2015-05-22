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

  if(isset($_GET['r']) && isset($_GET['g']) && isset($_GET['id_pns']) ){
  	$r = $_GET['r'];
  	$g = $_GET['g'];
  	$b = $_GET['b'];
    $id_pns = $_GET['id_pns'];
    $cssBack = "background: rgb(". $r.",".$g.",".$b.")";
  }
?>

<html>
<head>
	<meta charset='utf-8'>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=4, user-scalable=no">
  <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
  <link href="css/styles.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="css/set2.css" />
  
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"> </script>
  <script type="text/javascript">

    function adjustHeight(el){
      el.style.height = (el.scrollHeight > el.clientHeight) ? (el.scrollHeight)+"px" : "40px";
    }
    function loadComments(){
      var x = $(location).attr('search');
        var id_pns = x.split("=")[4];
        console.log("id_pns = "+id_pns);
        var URL = "pns_load_comments.php";
        $.post(URL,
        {
            'id_pns':id_pns
        },
        function(data, textStatus, jqXHR)
        {
            $('#comments').html(data);
        }).fail(function(jqXHR, textStatus, errorThrown) 
        {

        });

    }

    $(document).ready(function(){
      loadComments();       
                        
      $('#add_comment').click(function(){
          var $form = $(this).closest(".form-inlines");
          var x = $(location).attr('search');
          var id_pns = x.split("=")[4];
          console.log("id_pns = "+id_pns);
          var new_comment = $form.find("#new_comment").val();
          $form.find("#new_comment").val('');
          console.log("new cooment = "+new_comment);

          var URL = "add_comment.php";
          $.post(URL,
          {
              'id_pns':id_pns,
              'new_comment':new_comment
          },
          function(data, textStatus, jqXHR)
          {
              loadComments();
              console.log("ok" + data);
          }).fail(function(jqXHR, textStatus, errorThrown) 
          {

          });
      });

    });
    
  </script>
</head>
<body style="<?php echo $cssBack; ?>">
<?php
$sql = "SELECT * FROM pns WHERE id_pns=".$id_pns;
$result = $dbCon->db_connection->query($sql);
if( mysqli_num_rows($result) != 0){
  $row = $result->fetch_array();
?>
  <div class="container">
    <div class="row">
      <div class="col-md-6">

        <div id="mainwrapper">
          <div id="box-1" class="box">
            <img id="image-1" src="<?php echo $row['photo']; ?>" alt="img11" class="img-responsive"/>
              <span class="caption simple-caption">
                <p><?php echo $row['title']; ?></p>
              </span>
          </div>
        </div>

      </div>

    <div class="col-md-6">
  
    <div id="comments"></div>
        <?php if($login->isUserLoggedIn()==true){ ?>
        <form class="form-inlines" method="post" action="">
          <input type="hidden" name="id_pns" value="<?php echo $id_pns;?>">
            <div class="row">
              <div class="col-md-10 col-sm-10 col-xs-8">
              <div class="form-group">
                  <textarea id="new_comment" onkeyup="adjustHeight(this)" style="overflow:hidden; word-wrap:break-word" placeholder="Write a comment..." name="comment" maxlength="500" class="form-control"></textarea>
              </div>
              </div>
            
            
              <div class="col-md-2 col-sm-2 col-xs-3">
              <div class="form-group">
                  <button type="button" id="add_comment" class="btn btn-default">Add</button>
              </div>
              </div>
            </div>
        </form>
        <?php }else{ ?>
          <div class="row">
            <div class="col-md-10 col-sm-10 col-xs-8">
              <p style="color: #fff;"> You have to login if you want to make comments! </p>
            </div>
          </div>

        <?php } ?>
    </div>

  </div>
<?php
}
?>
</body>
</html>

