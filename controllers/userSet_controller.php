<?php
    require_once('models/memberModel.class.php');
    class UserSetController
    {
        public function index_userSet($param = NULL)
        {
            include('views/userSet/index_userSet.php');
        }
        public function upload_image($param = NULL)
        {
            $check = Member::upload_image($param['imagebase64'],$_SESSION['member']['id_member'],$_SESSION['member']['username']);
            header('location:index.php?controller=userSet&action=index_userSet');
        }
        public function updateInfo($param = NULL)
        {
            $check = Member::updateInfo($param['id_member'],$param['id_code'],$param['fname'],$param['lname'],$param['id_code_new']);
            if($check)
            {
                sweetalert(6,NULL);
            }
            else
            {
                sweetalert(NULL,6);
            }
           call('userSet','index_userSet');
            
        }
        public function updatePassMember($param = NULL)
        {
            $check = Member::updatePassMember($param['id_member'],$param['passwd']);
            $link = 'location:index.php?controller=userSet&action=index_userSet';
            if($check)
            {
                sweetalert(5,NULL);
            }
            else
            {
                sweetalert(NULL,5);
            }
            call('userSet','index_userSet');
        }
        public function validatePassword($param = NULL)
        {
            Member::validatePassword($param['passwdOld'],$param['id_member']);
        }
       
    }
?>