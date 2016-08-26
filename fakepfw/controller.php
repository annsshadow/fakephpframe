<?php
class Controller{
    public function _before_action() {

    }

    public function _after_action() {

    }

    public function __call($name, $arguments) {
        echo "error url 404";
    }

}
