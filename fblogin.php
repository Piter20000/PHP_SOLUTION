<?php

session_start();

require_once'Facebook/autoload.php';

# Set the default parameters
$fb = new Facebook\Facebook([
  'app_id' => '2088552364492197',
  'app_secret' => '475e03324bb4acbfc8e593b2fc049a1d',
  'default_graph_version' => 'v2.5',
]);
$redirect = 'http://localhost/php_solution/fblogin.php';


# Create the login helper object
$helper = $fb->getRedirectLoginHelper();

# Get the access token and catch the exceptions if any
try {
    $accessToken = $helper->getAccessToken();
}
catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
}
catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

# If the
if (isset($accessToken)) {
    // Logged in!
    // Now you can redirect to another page and use the
    // access token from $_SESSION['facebook_access_token']
    // But we shall we the same page

    // Sets the default fallback access token so
    // we don't have to pass it to each request
    $fb->setDefaultAccessToken($accessToken);

    try {
        $response = $fb->get('/me?fields=id,name,first_name,last_name,email');
        $userNode = $response->getGraphUser();
    }
    catch(Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    }
    catch(Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }

    // Copy all data from FB into array
    $array = $userNode->asArray();

    // Create profile image link
    $image = 'https://graph.facebook.com/'.$userNode->getId().'/picture?width=200';

    $_SESSION['Fuid'] = $array['id'];
    $_SESSION['fullname'] = $array['name'];
    $_SESSION['fname'] = $array['first_name'];
    $_SESSION['lname'] = $array['last_name'];
    $_SESSION['email'] = $array['email'];
    $_SESSION['img'] = $image;

    header('Location: login.php');
}
else{

    $permissions  = ['email'];
    $loginUrl = $helper->getLoginUrl($redirect,$permissions);

    header('Location: '.$loginUrl);
}
