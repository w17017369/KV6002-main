<?php

const SUPPORT_EMAIL =  'deffetto.style@gmail.com';
const DEVELOPMENT_MODE = true;

const PDO_CONNECTION = [
    "host" => "127.0.0.1",
    "dbName" => "KF6002",
    "username" => "root",
    "password" => ""
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
