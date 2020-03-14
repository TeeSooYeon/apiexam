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
 $login_button = '<br><a href="'.$google_client->createAuthUrl().'" class="btn-google m-b-20"><img src="images/icons/icon-google.png" alt="GOOGLE">Google</a>';
}

//Facebook

$facebook_output = '';

$facebook_helper = $facebook->getRedirectLoginHelper();

if(isset($_GET['code']))
{
 if(isset($_SESSION['access_token']))
 {
  $access_token = $_SESSION['access_token'];
 }
 else
 {
  $access_token = $facebook_helper->getAccessToken();

  $_SESSION['access_token'] = $access_token;

  $facebook->setDefaultAccessToken($_SESSION['access_token']);
 }

 $_SESSION['user_id'] = '';
 $_SESSION['user_name'] = '';
 $_SESSION['user_email_address'] = '';
 $_SESSION['user_image'] = '';

 $graph_response = $facebook->get("/me?fields=name,email", $access_token);

 $facebook_user_info = $graph_response->getGraphUser();

 if(!empty($facebook_user_info['id']))
 {
  $_SESSION['user_image'] = 'http://graph.facebook.com/'.$facebook_user_info['id'].'/picture';
 }

 if(!empty($facebook_user_info['name']))
 {
  $_SESSION['user_name'] = $facebook_user_info['name'];
 }

 if(!empty($facebook_user_info['email']))
 {
  $_SESSION['user_email_address'] = $facebook_user_info['email'];
 }
 
}
else
{
 // Get login url

    $facebook_login_url = $facebook_helper->getLoginUrl('https://apiexamsnh.herokuapp.com/');
    
    // Render Facebook login button
    $facebook_login_url = '<a href="'.$facebook_login_url.'" class="btn-face m-b-20"><i class="fa fa-facebook-official"></i>Facebook</a>';
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
        if(($login_button == '')||($facebook_login_url !== ''))
        {
          switch($page){
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
          echo '<div class="limiter">
		<div class="container-login100" style="background-image: url("images/bg-01.jpg");">
			<div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
				<form class="login100-form validate-form flex-sb flex-w" method="POST" action="apiexamsnh.herokuapp.com/home.php">
					<span class="login100-form-title p-b-53">
						Sign In With
					</span>
					'.$facebook_login_url.'
					'.$login_button.'
					<div class="p-t-31 p-b-9">
						<span class="txt1">
							Username
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Username is required">
						<input class="input100" type="text" name="username">
						<span class="focus-input100"></span>
					</div>
					
					<div class="p-t-13 p-b-9">
						<span class="txt1">
							Password
						</span>

						<a href="#" class="txt2 bo1 m-l-5">
							Forgot?
						</a>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="pass" >
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn m-t-17">
						<button class="login100-form-btn" type="submit">
							Sign In
						</button>
					</div>
					<div class="g-signin2" data-onsuccess="onSignIn"></div>
					<div class="w-full text-center p-t-55">
						<span class="txt2">
							Not a member?
						</span>

						<a href="#" class="txt2 bo1">
							Sign up now
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>';
        }
        ?>
	  </div>
    </body>
	<div id="dropDownSelect1"></div>
	<script src="js/main.js"></script>
</html>