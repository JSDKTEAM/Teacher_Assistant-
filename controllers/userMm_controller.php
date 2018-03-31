<?php
    require_once('models/memberModel.class.php');
    require_once('models/yearMemberModel.class.php');
    class UserMmController{
        public function index_userMm($param = NULL)
        {
            $memberList = Member::getAllMember();
            $memberYearList =  Member::getMemberByYear();
            include('views/userMm/index_userMm.php');
        }
        public function addMember($param = NULL)
        {
            $check = Member::addMemberMm($param['fname'],$param['lname'],$param['username'],$param['passwd'],$param['type']);
            header('location:index.php?controller=userMm&action=index_userMm');
        }
        public function updateMember($param = NULL)
        {
            $check = Member::updateMember($param['id_code'],$param['fname'],$param['lname'],$param['username'],$param['type']);
        }
        public function updatePassMember($param = NULL)
        {
            $check = Member::updatePassMember($param['id_code'],$param['passwd']);
        }
    }
?>