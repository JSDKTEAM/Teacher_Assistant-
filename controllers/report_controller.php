<?php
    require_once('models/memberModel.class.php');
    require_once('models/yearSchoolModel.class.php');
    require_once('models/workModel.class.php');
    class ReportController{
        public function index_reportMonth()
        {
            $memberList = Member::getMemberInSym();
            $yearListSchool = YearSchool::getAllYearSchool();
            $yearList = Work::getYearWork();
            include('views/report/index_reportMonth.php');
        }
    }
?>