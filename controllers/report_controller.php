<?php
    require_once('models/memberModel.class.php');
    require_once('models/yearSchoolModel.class.php');
    require_once('models/workModel.class.php');
    class ReportController{
        public function index_reportMonth($param = NULL)
        {
            $memberList = Member::getMemberInSym();
            $yearListSchool = YearSchool::getAllYearSchool();
            $yearList = Work::getYearWork();
            include('views/report/index_reportMonth.php');
        }
        public function getMemberByYear($param = NULL)
        {
            Member::getMemberByYearReport($param['year']);
            //header('Content-type: application/json');
        }
        public function reportMonth($param = NULL)
        {
            Member::reportMonth($param['person_id'],$param['year']);
        }
        public function reportYear($param = NULL)
        {
            Member::reportYear($param['year']);
        }
    }
?>