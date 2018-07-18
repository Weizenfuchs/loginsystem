/* defines the server connection */

<?php

Class Database {
    private $DB_SERVERNAME = "localhost";
    private $DB_USERNAME = "root";
    private $DB_PASSWORD = "";
    private $DB_NAME = "loginsystem";
    private static $conn;

    function __construct() {
        Database::$conn = mysqli_connect($this->DB_SERVERNAME, $this->DB_USERNAME, $this->DB_PASSWORD, $this->DB_NAME);
    }

    static function getConnection() {
        return Database::$conn;
    }

    function closeConnection() {
        mysqli_close($this->conn);
    }

}