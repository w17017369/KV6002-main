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
function validateLength($input, $minLength, $maxLength): bool
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
function emptyCheck($input): void
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
function checkContact($input): void
{
    //check if all required inputs have been entered
     emptyCheck($input);

    //check if the email address is valid
    if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL) || strlen($input['email']) > 30) {
        throw new Exception("Invalid Email Address");
    }
}
