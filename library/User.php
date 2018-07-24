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
    private $sessionID;

    private $loggedIn;
    private $signedUp;

    private $database;

    private $homeModel;
    private $homeController;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function signup() {
        $first = mysqli_real_escape_string(Database::getConnection(), $_POST['first']); /*first input in the signup form*/
        $last = mysqli_real_escape_string(Database::getConnection(), $_POST['last']);
        $email = mysqli_real_escape_string(Database::getConnection(), $_POST['email']);
        $username = mysqli_real_escape_string(Database::getConnection(), $_POST['username']);
        $password = mysqli_real_escape_string(Database::getConnection(), $_POST['password']);
        $sessionID = session_id();

        $this->create($first, $last, $email, $username, $password);
        // Updating the View over the DomainController
        $this->homeModel = new HomeModel();
        $this->homeController = new HomeController($this->homeModel, $this);
    }

    /** REGISTER
     *
     */
    private function create($first, $last, $email, $username, $password) {
        // check for existing username
        if($this->exists($username)) {
            // if username is already taken return false
            $this->__set("signedUp", false);
            return $this->__get("signedUp");
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
            $this->__set("signedUp", true);
            return $this->__get("signedUp");
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
                $this->__set("loggedIn", true);

                // setting the session id
                $this->__set("sessionID", session_id());

                // writing the session id into the database
                $this->updateSessionID($this->__get("sessionID"), $username);

                // setting session variables
                $_SESSION["Username"] = $this->__get("username");

                // updating the View over the DomainController
                $this->homeModel = new HomeModel();
                $this->homeController = new HomeController($this->homeModel, $this);

                return $this->__get("loggedIn");
            }
        } else {
            $this->__set("loggedIn", false);
            $this->homeModel = new HomeModel();
            $this->homeController = new HomeController($this->homeModel, $this);
            return $this->__get("loggedIn");
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

    function updateSessionID($session_id, $username) {
        $sql = "UPDATE users SET session_id = '$session_id' FROM users WHERE username='$username'";
        mysqli_query($this->database->getConnection(), $sql);
    }

    public static function isLoggedIn($session_id) {
        if(isset($session_id) && isset($_SESSION["Username"])) {
            $sql = "SELECT session_id FROM users WHERE username='$_SESSION\['Username'\]'";
            $result = mysqli_query(Database::getConnection(), $sql);
            $resultCheck = mysqli_num_rows($result);
            // if username already exists in database return true
            if($resultCheck > 0) {
                if ($result[1] == $session_id)
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
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