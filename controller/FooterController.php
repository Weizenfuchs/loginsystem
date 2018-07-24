<?php
/**
 * Created by PhpStorm.
 * User: j.fuchs
 * Date: 2018-07-23
 * Time: 13:06
 */
class FooterController extends A_DomainController {
    private $model;


    public function __construct($model) {
        $this->model = $model;
    }

    function message() {
        $this->model->showMessage();
    }
}