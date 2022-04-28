<?php

/**
 *
 *
 * @author MARTINA PANI w19020174
 */

namespace SRC;

use Exception;
use PDOException;

include 'functions.php';

require "vendor/autoload.php";

class Payment
{
    private Database $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    /**
     * function to insert payment details in payinfo table
     *
     */
    public function insert($details)
    {

    }

    public function ()
    {

    }

}
