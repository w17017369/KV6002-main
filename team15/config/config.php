<?php

const SUPPORT_EMAIL =  'deffetto.style@gmail.com';
const DEVELOPMENT_MODE = false;

const PDO_CONNECTION = [
    "host" => "localhost",
    "dbName" => "unn_w19020174",
    "username" => "unn_w19020174",
    "password" => "PnaMtn94"
];
ini_set('display_errors', DEVELOPMENT_MODE);
ini_set('display_startup_errors', DEVELOPMENT_MODE);

include 'config/autoloader.php';
spl_autoload_register("autoloader");

include 'exceptionhandler.php';
//set htmlExceptionHandler as default handler to be triggered when any exception occurs
set_exception_handler('exceptionHandler');

include 'errorHandler.php';
set_error_handler('errorHandler');
