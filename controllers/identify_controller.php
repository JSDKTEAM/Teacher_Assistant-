<?php
    require_once('models/identifyModel.class.php');
    require_once('models/workModel.class.php');
    class IndentifyController{
        public function index_login($param = NULL)
        {
            include('views/indentify/login.php');
        }
        public function login($param = NULL)
        {
            call('work','index_work');
        }
        public function logout($param = NULL)
        {
            call('identify','index_login');
        }
        public function index_register($param = NULL)
        {
            include('views/indentify/register.php');
        }
        public function submit_register($param = NULL)
        {
            
        }

    }
?>