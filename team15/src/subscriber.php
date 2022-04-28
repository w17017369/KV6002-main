<?php

/**
 * A class that provides ways of interacting with subscriber table
 * in order to manage newsletter subscriptions
 *
 * @author MARTINA PANI w19020174
 */

namespace SRC;

use Exception;
use PDOException;

include 'functions.php';

class Subscriber
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }
/**
 * Insert new record into subscriber table
 */
    public function subscribe($input)
    {
        $input['email'] = filter_has_var(INPUT_POST, 'email') ? $_POST['email'] : null;
        $input['name'] = filter_has_var(INPUT_POST, 'name') ? $_POST['name'] : null;

        $input = trim_input($input);

        try {
            //check if all required inputs have been entered
            emptyCheck($input);

            //check if the email address is valid
            if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL) || strlen($input['email']) > 30) {
                throw new Exception("Invalid Email Address");
            }

            //if the email is already used catch exception
            try {
                //insert new record
                $sql = "INSERT INTO subscriber (name, email, created) VALUES ( :name, :email, now())";

                //execute the prepared statement, passing it an array of values to be substituted for
                //the placeholders
                $this->database->executeSQL($sql, [":name" => $input['name'], ":email" => $input['email']]);
            } catch (Exception $e) {
                return "Your email already exists in our subscribers list.";
            }
        } catch (PDOException $e) {
            //return instead to echo -> stop instead to continue compiling the code
            return"There was a problem with the connection. Try again after few minutes";
        } catch (Exception $e) {
            return "<span>" . $e->getMessage() . "</span>";
        }

        return "Thank you for subscribing in our Newsletter";
    }

/**
 * Delete a record from subscriber table
 */
    public function delete($email)
    {
        $sql = "DELETE FROM subscriber WHERE email = :email";
        $this->database->executeSQL($sql, [":email" => $email]);
    }

/**
 * Update a record into subscriber table
 */
    public function findAll()
    {
        $sql = "SELECT * FROM subscriber";
        $result = $this->database->executeSQL($sql);

        return sanitize_data($result);
    }

    public function findOne($email)
    {
        $sql = "SELECT * FROM subscriber WHERE email = :email";

        $result = $this->database->executeSQL($sql, ["email" => $email]);

        return sanitize_data($result);
    }
}
