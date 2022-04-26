<?php

use SRC\Database;
use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{
    /**
     * @var Database
     */
    private Database $database;
    private PDO $PDO;

    public function setUp(): void
    {
        $this->database = new Database();
    }

    public function testExecute()
    {
        $sql = "SELECT * FROM user";
        $result = $this->database->executeSQL($sql);
        $this->assertTrue($result != false, "EXECUTE METHOD IS NOT WORKING");
    }
}
