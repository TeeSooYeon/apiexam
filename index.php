<?php 
$page = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page']: '';

include('config.php');

$login_button = '';

if(isset($_GET["code"])){
 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
 if(!isset($token['error'])){
  $google_client->setAccessToken($token['access_token']);
  $_SESSION['access_token'] = $token['access_token'];
  $google_service = new Google_Service_Oauth2($google_client);
  $data = $google_service->userinfo->get();
  if(!empty($data['given_name'])){
   $_SESSION['user_first_name'] = $data['given_name'];
  }
  if(!empty($data['family_name'])){
   $_SESSION['user_last_name'] = $data['family_name'];
  }
  if(!empty($data['email'])){
   $_SESSION['user_email_address'] = $data['email'];
  }
  if(!empty($data['gender'])){
   $_SESSION['user_gender'] = $data['gender'];
  }
  if(!empty($data['picture'])){
   $_SESSION['user_image'] = $data['picture'];
  }
 }
}
if(!isset($_SESSION['access_token'])){
 $login_button = '<br><a href="'.$google_client->createAuthUrl().'" class="btn-google m-b-20"><img src="images/icons/icon-google.png" alt="GOOGLE"></a>';
}

?>
<html> 
    <head>
      <title>Login</title>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	  	<link rel="stylesheet" type="text/css" href="css/util.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">
    </head>
    <body>
      <div>
        <a href="index.php">Home</a>
        <a href="index.php?page=main">Menu</a>
        <a href="index.php?page=home">Profile</a>
	<a href="index.php?page=logout">Logout</a>
      </div>
	  <div>
	  <?php
        if($login_button == '')
        {
          switch($navigation){
            case 'main':
              require_once 'index.php';
              break;
	    case 'home':
	      require_once 'home.php';
              break;
	    case 'logout':
	      require_once 'logout.php';
	      break;
            default:
              require_once 'index.php';
              break;
          }
        }
        else
        {
          echo '<div align="center">'.$login_button.'</div>';
        }
        ?>
	  </div>
    </body>
</html>
