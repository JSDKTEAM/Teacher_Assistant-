<?php
    require_once('models/memberModel.class.php');
    class UserMmController{
        public function index_userMm($param = NULL)
        {
            $memberList = Member::getAllMember();
            include('views/userMm/index_userMm.php');
        }
    }
?>