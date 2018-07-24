<?php
/**
 * Created by PhpStorm.
 * User: j.fuchs
 * Date: 2018-07-19
 * Time: 13:06
 */
class HomeController extends A_DomainController {
    private $model;
    private $loggedIn = false; // user is logged in
    private $signedUp = false; // user is signed up
    private $empty; // empty fields
    private $error; // wrong username or password
    private $user;


    public function __construct($model, $user = null) {
        $this->model = $model;
        if (is_null($user)) {
            $this->loggedIn = false;
        } else {
            $this->user = $user;
        }
    }

    function message() {

        if ($this->user->__get($this->loggedIn)) {
            $this->model->displayMessage = "<h1 style=\"color:green;\">You've been logged in!</h1>";
        } else if ($this->user->__get($this->signedUp)) {
            $this->displayMessage = "<h1 style=\"color:green;\">You've been signed up!</h1>";
        } else if ($this->user->__get($this->empty)) {
            $this->displayMessage = "<h1 style=\"color:red;\">Empty login fields</h1>";
        } else if ($this->error) {
            $this->displayMessage = "<h1 style=\"color:red;\">Wrong username or password</h1>";
        }

        $this->model->showMessage();
    }
}