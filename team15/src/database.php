<?php

/**
 * Connect to an MySQL database
 *
 * @author MARTINA PANI w19020174
 */

namespace SRC;

use PDO;
use PDOException;

class Database
{
    /**
     * @var PDO $dbConnection
     * @var string $host
     * @var string $dbName
     * @var string $username
     * @var string $password
     *
     */
    private $dbConnection;
    private $host;
    private $dbName;
    private $username;
    private $password;

    /**
     * constructor that set a mysql database connection or throw an exception
     *
     * @return void
     *
     */

    public function __construct()
    {
        $this->host = PDO_CONNECTION['host'];
        $this->dbName = PDO_CONNECTION['dbName'];
        $this->username = PDO_CONNECTION['username'];
        $this->password = PDO_CONNECTION['password'];
        $this->setDbConnection();
    }

    /**
     * Make a connection to a sqlite database or throw an exception
     *
     * @return void
     */

    private function setDbConnection()
    {
        if (
            $this->dbConnection = new PDO(
                "mysql:host=$this->host;dbname=$this->dbName",
                $this->username,
                $this->password
            )
        ) {
            $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } else {
            throw new PDOexception("Database Connection Fault");
        }
    }
    /**
     * @return PDO
     */
    public function getDbConnection()
    {
        return $this->dbConnection;
    }
    /**
     * Execute an SQL prepared statement
     *
     * This function executes the query and uses the PDO 'fetchAll' method with the
     * 'FETCH_ASSOC' flag set so that an associative array of results is returned.
     *
     * @param string $sql       An SQL statement
     * @param array $params     An associative array of parameters (default empty array)
     * @return array            An associative array of the query results
     *
     */
    public function executeSQL($sql, $params = [])
    {
        $stmt = $this->dbConnection->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
