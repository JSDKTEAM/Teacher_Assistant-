<?php
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
            header('location:index.php?controller=yearSet&action=index_year');

        }
        public function addYear($param = NULL)
        {
            $check = YearSchool::add_yearschool($param['id_year'],$param['start_date'],$param['end_date']);
            header('location:index.php?controller=yearSet&action=index_year');
        }
        public function validateYear($param = NULL)
        {
            YearSchool::validateYear($param['id_year']);
        }
        
        
       
    }
?>