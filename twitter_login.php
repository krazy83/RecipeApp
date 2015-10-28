<?php
// The TwitterOAuth instance
require("twitteroauth/twitteroauth.php");
session_start();
$twitteroauth = new TwitterOAuth('jkrNjqeM5WVbAp7UsPyBp9Jro', 'NtQcOuNfjAYTk2Jgnmp2wmAbxlGrKaB9HickFPdfAQDLGRRJ6X');
// Requesting authentication tokens, the parameter is the URL we will be redirected to
$request_token = $twitteroauth->getRequestToken('http://notenoughingredients.com/twitter_oauth.php');
 
// Saving them into the session
$_SESSION['oauth_token'] = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
 
// If everything goes well..
if($twitteroauth->http_code==200){
    // Let's generate the URL and redirect
    $url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
    header('Location: '. $url);
} else {
    // It's a bad idea to kill the script, but we've got to know when there's an error.
    die('Something wrong happened.');
}
if(!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])){
    // We've got everything we need
} else {
    // Something's missing, go back to square 1
    header('Location: twitter_login.php');
}
$access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
// Save it in a session var
$_SESSION['access_token'] = $access_token;
// Let's get the user's info
$user_info = $twitteroauth->get('account/verify_credentials');
// Print user's info
print_r($user_info);
?>