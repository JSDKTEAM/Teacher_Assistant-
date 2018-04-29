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
            $check = Member::updateInfo($param['id_member'],$param['id_code'],$param['fname'],$param['lname']);
            $link = 'location:index.php?controller=userSet&action=index_userSet';
            if($check)
            {
                header($link.'&success=6');
            }
            else
            {
                header($link.'&error=6');
            }
            
        }
        public function updatePassMember($param = NULL)
        {
            $check = Member::updatePassMember($param['id_member'],$param['passwd']);
            $link = 'location:index.php?controller=userSet&action=index_userSet';
            if($check)
            {
                header($link.'&success=5');
            }
            else
            {
                header($link.'&error=5');
            }
        }
        public function validatePassword($param = NULL)
        {
            Member::validatePassword($param['passwdOld'],$param['id_member']);
        }
       
    }
?>