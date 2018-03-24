<?php
    require_once('models/memberModel.class.php');
    class UserMmController{
        public function index_userMm()
        {
            $memberList = Member::getAllMember();
            require_once('views/userMm/index_userMm.php');
        }
    }
?>