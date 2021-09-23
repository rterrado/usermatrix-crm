<?php

spl_autoload_register ( 'autoloader' );

function autoloader ( string $className ) {

    $path = $_SERVER['DOCUMENT_ROOT'].'/src/'.str_replace('\\', '/', $className).'.php';
    if (file_exists($path)) require_once $path;

}
