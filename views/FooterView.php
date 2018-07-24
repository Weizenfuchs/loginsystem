<html>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: j.fuchs
 * Date: 2018-07-19
 * Time: 15:28
 */

Class FooterView {
    private $model;
    private $controller;

    public function __construct($model, $controller) {
        $this->model = $model;
        $this->controller = $controller;
    }

    public function output() {
        return $this->model->displayMessage;
    }
}
?>
</body>
</html>