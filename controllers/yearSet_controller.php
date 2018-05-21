<?php
    if(!isset($_SESSION['member']))
    {
        header('location:index.php?controller=identify&action=index_login');
    }
    require_once('models/yearSchoolModel.class.php');
    class YearSetController
    {
        public function index_year($param = NULL)
        {
            $yearlist = YearSchool::getAllYearSchool();
            include('views/yearSchool/index_year.php');
        }
        public function updateYear($param = NULL)
        {
            $check = YearSchool::update_yearschool($param['id_year'],$param['start_date'],$param['end_date']);
            if($check)
            {
                sweetalert(10,NULL);
            }
            else
            {
                sweetalert(NULL,10);
            }
            call('yearSet','index_year');
        }
        public function addYear($param = NULL)
        {
            $check = YearSchool::add_yearschool($param['id_year'],$param['start_date'],$param['end_date']);
            //header('location:index.php?controller=yearSet&action=index_year');
            if($check)
            {
                sweetalert(8,NULL);
            }
            else
            {
                sweetalert(NULL,8);
            }
            call('yearSet','index_year');
        }
        public function deleteYear($param = NULL)
        {
            $check = YearSchool::delete_yearschool($param['id_year']);
            if($check)
            {
                sweetalert(13,NULL);
            }
            else
            {
                sweetalert(NULL,13);
            }
            call('yearSet','index_year');
        }
        public function validateYear($param = NULL)
        {
            YearSchool::validateYear($param['id_year']);
        }
        public function curYear($param = NULL)
        {
            YearSchool::curYear();
        }
        
        
       
    }
?>