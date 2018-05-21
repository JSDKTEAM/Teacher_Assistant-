<?php
    if(!isset($_SESSION['member']))
    {
        header('location:index.php?controller=identify&action=index_login');
    }
    require_once('models/memberModel.class.php');
    require_once('models/workModel.class.php');
    require_once('models/yearSchoolModel.class.php');
    require_once('models/yearMemberModel.class.php');
    
    Class AddStdController{
        public function index_addStd($param = NULL){
            $memberListYear = YearMember::getAllYearMember();
            $listYear = YearSchool::getAllYearSchool();
            include('views/addStd/index_addStd.php');
        }
        public function getMember($param = NULL)
        {
            Member::getMemberNotInSys($param['id_year']);
        }
        public function addMemberSys($param = NULL)
        {
           $check = Member::addMemberSys($param['id_member'],$param['id_year']);
           if($check)
           {
                sweetalert(11,NULL);
                call('addStd','index_addStd');
           }
           else
           {
                sweetalert(NULL,11);
                call('addStd','index_addStd');
           }
        }
        public function searchMemberByYear($param = NULL)
        {   
            $memberListYear = YearMember::getMemberByYearSch($param['id_year']);
            $listYear = YearSchool::getAllYearSchool();
            include('views/addStd/index_addStd.php');
        }
        public function deleteStd($param = NULL)
        {
            $check = YearMember::deleteStd($param['id_member'],$param['id_year']);
            /*$link = "location:index.php?controller=addStd&action=searchMemberByYear&id_year=".$param['id_year'];
            if($check)
            {
                    header($link."&success=12");
            }
            else
            {
                    header($link."&error=12");
            }*/
            if($check)
            {
                 sweetalert(12,NULL);
                 call('addStd','index_addStd');
            }
            else
            {
                 sweetalert(NULL,12);
                 call('addStd','index_addStd');
            }
        }
    }
?>