<?php
/**
 * Created by PhpStorm.
 * User: j.fuchs
 * Date: 2018-07-20
 * Time: 13:06
 */

Class FooterModel extends A_Model
{
    public $displayMessage;

    public function __construct()
    {

    }

    public function showMessage() {
        echo($this->displayMessage);
    }
}