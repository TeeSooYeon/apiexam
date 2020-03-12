<!DOCTYPE html>
<?php 
$navigation = (isset($_GET['navigation']) && $_GET['navigation'] != '') ? $_GET['navigation']: '';

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

?>
<html lang="en">
<head>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
  	<script src="https://apis.google.com/js/client:platform.js?onload=start" async defer></script>
	<script src="https://apis.google.com/js/platform.js" async defer></script>
	<title>Login V5</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="google-signin-client_id" content="345807680937-5ac3lbkn30nom6qn95pa6ib8t6v7n7jv.apps.googleusercontent.com">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
				<form class="login100-form validate-form flex-sb flex-w" method="POST" action="apiexamsnh.herokuapp.com/home.php">
					<span class="login100-form-title p-b-53">
						Sign In With
					</span>
					<a href="#" class="btn-face m-b-20">
						<i class="fa fa-facebook-official"></i>
						Facebook
					</a>
					<?php
						if(!isset($_SESSION['access_token'])){
							$login_button = '<a href="'.$google_client->createAuthUrl().'" class="btn-google m-b-20"><img src="images/icons/icon-google.png" alt="GOOGLE"/>Google</a>';
						}
					?>
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
	</div>
	<div id="dropDownSelect1"></div>
	<script src="js/main.js"></script>
</body>
</html>