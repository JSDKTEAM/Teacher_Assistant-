<?php
    require_once('models/identifyModel.class.php');
    require_once('models/workModel.class.php');
    require_once('models/memberModel.class.php');
    class IdentifyController{
        public function index_login($param = NULL)
        {
            include('views/identify/login.php');
        }
        public function login($param = NULL)
        {
            //session_start();
            $member = Indentify::login($param['username'],$param['passwd']);
            if($member != FALSE)
            {
                $_SESSION['member'] = $member;
                header('location:index.php?controller=work&action=index_work');
                //call('work','index_work');
            }
            else
            {
                call('identify','index_login');
            }
        }
        public function logout($param = NULL)
        {
            session_destroy();
            session_unset();
            unset($_SESSION['member']);
            call('identify','index_login');
        }
        public function index_register($param = NULL)
        {
            include('views/identify/register.php');
        }
        public function submit_register($param = NULL)
        {
            $check = Member::addMemberRegister($param['id_code'],$param['fname'],$param['lname'],$param['username'],$param['passwd']);
        }

    }
?>