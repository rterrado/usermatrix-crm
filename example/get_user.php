<?php

ini_set('error_reporting', E_ALL);
ini_set( 'display_errors', 1 );

require $_SERVER['DOCUMENT_ROOT'].'/autoloader.php';

$user = new usermatrix\UserMatrix('5142279225519');

if (!$user->doExist()) {
    echo 'User does not exist';
    exit();
}
