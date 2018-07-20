<?php
/**
 * Created by PhpStorm.
 * User: j.fuchs
 * Date: 2018-07-19
 * Time: 15:28
 */

Class FooterView {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function output() {
        return $this->model->displayMessage;
    }
}
?>
</body>
</html>

