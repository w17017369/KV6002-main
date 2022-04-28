<?php

//trim input
function trim_input($inputs)
{
    foreach ($inputs as $key => $value) {
        $inputs[$key] = trim($value);
    }
    return $inputs;
}

// function to check if a text input has a length in a certain range
function validateLength($input, $minLength, $maxLength)
{
    $length = strlen($input);

    if (($length  < $minLength) || ($length > $maxLength)) {
        return false;
    } else {
        return true;
    }
}

//sanitize query result before output
function sanitize_data($data)
{
    foreach ($data as $key => $value) {
        if (is_string($data[$key])) {
            if ($key == 'email') {
                $data[$key] = filter_var($data[$key], FILTER_SANITIZE_EMAIL);
            } else {
                $data[$key] = filter_var($data[$key], FILTER_SANITIZE_STRING);
            }
        }
    }

    return $data;
}

//check empty fields
/**
 * @throws Exception
 */
function emptyCheck($input)
{
    foreach ($input as $key => $value) {
        if (empty($input[$key])) {
            throw new Exception("You don't enter all required fields");
        }
    }
}

//check contact form field
/**
 * @throws Exception
 */
function checkContact($input)
{
    //check if all required inputs have been entered
     emptyCheck($input);

    //check if the email address is valid
    if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL) || strlen($input['email']) > 30) {
        throw new Exception("Invalid Email Address");
    }
}

//Function to connect to database
function getConnection() {
    try {
        $connection = new PDO( "mysql:host=localhost;dbname=unn_w19020174", "unn_w19020174", "PnaMtn94" );
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection;
    }
    catch (Exception $e) {
        throw new Exception("Connection error ". $e->getMessage(), 0, $e);
    }
}

//Function to save session variable
function set_session($key, $value) {
    $_SESSION[$key] = $value;
    return true;
}

//Function to read session variable
function get_session($key = 'false') {
    //Check if session element 'key' exists
    if (isset($_SESSION[$key])) {
        //Read the session’s value from the $_SESSION array
        $value = $_SESSION[$key];
        //Return session's value
        return $value;
    }
}

function check_login() {
    //Calls get_session()
    get_session();
    //Check if session variable 'logged-in' is true
    if (isset( $_SESSION[ 'logged-in' ] ) && $_SESSION[ 'logged-in' ] == true) {
        //If so return true
        return true;
    } else {
        //If not return false
        return false;
    }
}

function log_error($e) {
    //Open file
    $fileHandle = fopen("error_log_file.log", "ab");

    //Store date and time error occured
    $errorDate = date('D M j G:i:s T Y');
    //Store error details from $->getMessage()
    $errorMessage = $e->getMessage();
    //Remove line breaks
    $toReplace = array("\r\n", "\n", "\r");
    //chars to replace
    $replaceWith = '';
    $errorMessage = str_replace($toReplace, $replaceWith, $errorMessage);

    fwrite($fileHandle, "$errorDate|$errorMessage".PHP_EOL);
    //Close file
    fclose($fileHandle);
}