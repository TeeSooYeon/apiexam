<?php 
$page = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page']: '';

include('google_config/google_read.php');

  if($login_button == true){
    include('facebook_config/facebook_read.php');
  }

?>
<html> 
    <head>
      <title>Movies API</title>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	  	<link rel="stylesheet" type="text/css" href="css/util.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">
    </head>
    <body>
      <div>
        <a href="index.php">Home</a>
        <a href="index.php?page=main">Menu</a>
        <a href="index.php?page=home">Profile</a>
      </div>
	  <div>
	  <?php
        if($login_button == '')
        {
          switch($page){
            case 'main':
              require_once 'index.php';
              break;
	    case 'home':
	      require_once 'home.php';
              break;
		case 'login':
	      require_once 'login.php';
	      break;
            default:
              require_once 'index.php';
              break;
          }
        }
		else{
          echo $login_button;
        }
		?>
		<?php
		if(isset($facebook_login_url)){
           echo $facebook_login_url;
         }
		else{
			switch($page){
            case 'main':
              require_once 'index.php';
              break;
	    case 'home':
	      require_once 'home.php';
              break;
		case 'login':
	      require_once 'login.php';
	      break;
            default:
              require_once 'index.php';
              break;
          }
			}
        ?>
	  </div>
    </body>
	<div id="dropDownSelect1"></div>
	<script src="js/main.js"></script>
</html>