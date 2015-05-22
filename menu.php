<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php"><img style="max-width: 100px; margin-top: -7px;" class="img-responsive" src="img/LOGO_white.png" alt="VOTE mania"></a>
    </div>

   <!--  Collect the nav links, forms, and other content for toggling    -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
   <!--    <ul class="nav navbar-nav">
        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
   -->
      

      <ul class="nav navbar-nav navbar-right">
        <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
       </form>
        <?php 
        if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1) { ?>
        <li class="dropdown">
          <a href="#log-out" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span>&nbsp;<?php echo $_SESSION['name']."&nbsp;".$_SESSION['sirname']; ?></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="user_conf.php">Configure</a></li>
            <li class="divider"></li>
            <li><a href="index.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Log out</a></li>
          </ul>
        </li>
  <?php }else{ ?>
          <li> <a href="#sigm-up" data-toggle="modal">Sing Up </a> </li>
          <li> <a href="#log-in" data-toggle="modal"><span class="glyphicon glyphicon-log-in"></span>&nbsp;Log In </a> </li>
        <?php } ?>
      </ul>
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>