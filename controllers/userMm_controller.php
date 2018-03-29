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
            Member::updateMember($param['id_member'],$param['id_code'],$param['fname'],$param['lname'],$param['type']);
            UserMmController::index_userMm();
            //include('views/userMm/update_userMm.php');
        }
        public function updatePassMember($param = NULL)
        {
            Member::updatePassMember($param['username'],$param['passwd']);
            UserMmController::index_userMm();
            //include('views/userMm/update_userMm.php');
        }
    }
?>