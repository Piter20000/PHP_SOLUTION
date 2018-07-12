<?php

session_start();

#region Global Variables

$GLOBALS['config'] = array(
	'mysql'	=> array(
		    'host'		=> '127.0.0.1',
		    'username'	=> 'root',
		    'password'	=> '',
		    'db'		=> 'database'
	),
	'remember'	=> array(
		    'cookie_name'	=> 'hash',
		    'cookie_expiry'	=> 604800  //How long keep alive cookies (value in seconds)
	),
	'sessions'	=> array(
		    'session_name'	=> 'user',
		    'token_name'	=> 'token'
	)
);

#endregion

# Method automatically add class script
spl_autoload_register(function($class)
{
	require_once 'Classes/' .$class. '.php';
});

require_once 'functions/sanitize.php';

# Check if user have cookie on server
if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name')))
{
    // Copy cookie_bane from Cookies
    $hash = Cookie::get(Config::get('remember/cookie_name'));

    // Prepare query
    $query = "SELECT * FROME users_session WHERE hash = '{$hash}'";

    // Send query into server
    $hashCheck = DB::get_Instance()->get_Rows($query);

    // Check results
    if($hashCheck->count())
    {
        // If found create instance of User
        $user = new User($hashCheck->first()->UID);

        // Login as user
        $user->is_Logged_In();

        // Update lastlogin data
        $user->Last_Loged_Update();

        // Send raports
        $user->Send_IP_Raport();
        $user->Send_PC_Raport();
    }
}

