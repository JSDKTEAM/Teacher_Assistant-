<?php
    require_once('models/memberModel.class.php');
    class UserMmController{
        public function index_userMm($param = NULL)
        {
            $memberList = Member::getAllMember();
            include('views/userMm/index_userMm.php');
        }
        public function addMember($param = NULL)
        {
            $check = Member::addMemberMm($param['fname'],$param['lname'],$param['username'],$param['passwd'],$param['type']);
            header('location:index.php?controller=userMm&action=index_userMm');
        }
        public function updateMember($param = NULL)
        {
            require_once("models/memberModel.class.php");
            $check = Member::updateMember($param['id_code'],$param['fname'],$param['lname'],$param['username'],$param['type']);
            //include('views/userMm/update_userMm.php');
        }
        public function updatePassMember($param = NULL)
        {
            require_once("models/memberModel.class.php");
            $check = Member::updatePassMember($param['id_code'],$param['passwd']);
            //include('views/userMm/update_userMm.php');
        }
    }
?>