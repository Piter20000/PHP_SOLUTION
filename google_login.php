<?php

session_start();

require ("Google/vendor/autoload.php");

// Create Google Client instance
$g_client = new Google_Client();

// Set Client ID
$g_client->setClientId("495701683966-lsdvu0dv723ake15t0osd5hbgdf4u3c8.apps.googleusercontent.com");

// Set Client secret
$g_client->setClientSecret("FW3w7-zRYkvCDSaTacGKJnp_");

// Set redirect URI
$g_client->setRedirectUri("http://localhost/php_solution/google_login.php");
$g_client->setScopes("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");

// Create URL
$auth_url = $g_client->createAuthUrl();


// Get the authorization  code
$code = isset($_GET['code']) ? $_GET['code'] : NULL;

// Get access token
if(isset($code)) {
    try {
        $token = $g_client->fetchAccessTokenWithAuthCode($code);
        $g_client->setAccessToken($token);
    }
    catch (Exception $e){
        echo $e->getMessage();
    }
    try {
        $pay_load = $g_client->verifyIdToken();
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }
} else{
    $pay_load = null;
}
if(isset($pay_load)){

    /*
    echo '<pre>';
    print_r($pay_load);
    echo '</pre>';
    */

    $_SESSION['Guid'] = $pay_load['sub'];
    $_SESSION['email'] = $pay_load['email'];
    $_SESSION['fname'] = $pay_load['given_name'];
    $_SESSION['lname'] = $pay_load['family_name'];
    $_SESSION['fullname'] = $pay_load['name'];
    $_SESSION['picture'] = $pay_load['picture'];

    header('Location: login.php');

}
else
    header('Location: '.$auth_url);