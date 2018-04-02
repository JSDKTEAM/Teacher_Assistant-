<?php
    require_once('models/memberModel.class.php');
    require_once('models/yearSchoolModel.class.php');
    class ReportController{
        public function index_reportMonth()
        {
            $memberList = Member::getMemberInSym();
            $yearList = YearSchool::getAllYearSchool();
            include('views/report/index_reportMonth.php');
        }
    }
?>