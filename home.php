<script src="https://apis.google.com/js/platform.js" async defer></script>

<meta name="google-signin-client_id" content="345807680937-5ac3lbkn30nom6qn95pa6ib8t6v7n7jv.apps.googleusercontent.com">
<script>
		function onSignIn(googleUser) {
		var profile = googleUser.getBasicProfile();
		console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
		console.log('Name: ' + profile.getName());
		console.log('Image URL: ' + profile.getImageUrl());
		console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
		}
</script>
HENLO <br/>
<a href="#" onclick="signOut();">Sign out</a>
<script>
  function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
    });
  }
</script>
