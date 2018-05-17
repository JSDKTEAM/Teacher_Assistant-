<?php
    require_once('models/memberModel.class.php');
    require_once('models/yearSchoolModel.class.php');
    class UserMmController{
        public function index_userMm($param = NULL)
        {
            $memberList = Member::getAllMember();
            //$memberYearList =  Member::getMemberByYear();
            $memberListYear = Member::getAllMemberByYear();
            include('views/userMm/index_userMm.php');
        }
        public function validateUsername($param = NULL)
        {
            Member::validateUsername($param['username']);
        }
        public function addMember($param = NULL)
        {
            $check = Member::addMemberMm($param['fname'],$param['lname'],$param['username'],$param['passwd'],$param['type']);
            if($check)
            {
                sweetalert(4,NULL);
            }
            else
            {
                sweetalert(NULL,4);
            }
            call('userMm','index_userMm');
        }
        public function validateCode($param = NULL)
        {
            Member::validateCode($param['id_code']);
        }
        public function addMemberSys($param = NULL)
        {
           $check = Member::addMemberSys($param['id_member']);
           header('location:index.php?controller=userMm&action=index_userMm');
        }
        public function updateMember($param = NULL)
        {
            $check = Member::updateMember($param['id_member'],$param['id_code'],$param['fname'],$param['lname'],$param['type']);
            if($check)
            {
                sweetalert(6,NULL);
            }
            else
            {
                sweetalert(NULL,6);
            }
            call('userMm','index_userMm');
        }
        public function updatePassMember($param = NULL)
        {
            $check = Member::updatePassMember($param['id_member'],$param['passwd']);
            if($check)
            {
                sweetalert(5,NULL);
            }
            else
            {
                sweetalert(NULL,5);
            }
            call('userMm','index_userMm');
        }
        public function deleteUser($param = NULL)
        {
            $check = Member::deleteUser($param['id_member']);
            if($check)
            {
                sweetalert(7,NULL);
            }
            else
            {
                sweetalert(NULL,7);
            }
            call('userMm','index_userMm');
        }
        
    }
?>