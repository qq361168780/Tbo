<?php
    class Index extends FLController {
        function run () {
            $this->view->render ();
        }
        function init () {
            $systemModel = new SystemModel;
            if ($_COOKIE['password'] != $systemModel->password ()) {
                header ('Location: ' . APP_URL . '/index.php/login');
                exit ();
            }
        }
    }
