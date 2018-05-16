<?php
    require_once('models/memberModel.class.php');
    require_once('models/workModel.class.php');
    require_once('models/yearSchoolModel.class.php');
    Class AddStdController{
        public function index_addStd($param = NULL){
            $memberYearList =  Member::getMemberByYear();
            $memberListYear = Member::getAllMemberByYear();
            include('views/addStd/index_addStd.php');
        }
        public function addMemberSys($param = NULL)
        {
           $check = Member::addMemberSys($param['id_member']);
           header('location:index.php?controller=userMm&action=index_userMm');
        }
    }
?>