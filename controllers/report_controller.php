<?php
    require_once('models/memberModel.class.php');
    class ReportController{
        public function index_reportMonth()
        {
            $memberList = Member::getMemberInSym();
            include('views/report/index_reportMonth.php');
        }
    }
?>