<?php

require_once 'core/init.php';

$user = new User();

############################
// Update lastlogin data
$user->Last_Loged_Update();

// Send raports
$user->Send_IP_Raport();
$user->Send_PC_Raport();
############################

$user->log_Out();

Redirect::to('index.php');
