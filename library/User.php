<?php
/**
 * Created by PhpStorm.
 * User: j.fuchs
 * Date: 2018-07-18
 * Time: 08:51
 */

class User
{
    private $first;
    private $last;
    private $email;
    private $username;
    private $sessionId;
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    /** REGISTER */
    public function create($first, $last, $email, $username, $password) {
        // check for existing username
        if($this->exists($username)) {
            // if username is already taken return false
            return false;
        } else {
            /** TODO: Check for better place for these lines of code */
            $this->__set("first", $first);
            $this->__set("last", $last);
            $this->__set("email", $email);
            $this->__set("username", $username);

            // Hashing the password (making it unrecognizable)
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
            // insert the user into the database
            $sql = "INSERT INTO users (vorname, nachname, email, username, password) VALUES ('$first', '$last', '$email', '$username', '$hashedPwd');";
            // run the query on the database
            mysqli_query($this->database->getConnection(), $sql);
            // successfully creating the user in the database will return true
            return true;
        }
    }

    /** LOGIN
     * @param username, password
     * @return null if user not found, else the user object
     */
    public function load($username, $password) {
        // check if user exists
        if ($this->exists($username)) {
            // Hashing the password (making it unrecognizable)
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
            // check if the password is correct
            $sql = "SELECT * FROM users WHERE user='$username' AND password='$hashedPwd'";
            // run the query on the database
            $result = mysqli_query($this->database->getConnection(), $sql);
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck > 0) {
                // Loading the columns from the table user and writing it in the object
                $this->__set("first", $result->fetch_row("vorname"));
                $this->__set("last", $result->fetch_row("nachname"));
                $this->__set("email", $result->fetch_row("email"));
                $this->__set("username", $result->fetch_row("username"));

                return $this;
            }
        } else {
            return null;
        }
    }

    public function exists($username) {
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($this->database->getConnection(), $sql);
        $resultCheck = mysqli_num_rows($result);
        // if username already exists in database return true
        if($resultCheck > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function isLoggedIn() {

    }

    public function __get($prop) {
        if(property_exists($this, $prop)) {
            return $this->$prop;
        }
    }

    public function __set($prop, $value) {
        if(property_exists($this, $prop)) {
            $this->$prop = $value;
        }
    }

}