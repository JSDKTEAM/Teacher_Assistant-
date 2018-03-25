<?php
    require_once('models/memberModel.class.php');
    require_once('models/workModel.class.php');
    require_once('models/yearSchoolModel.class.php');
    class WorkController{
        public function index_work($param = NULL)
        {
            $workList = Work::getAllWork();
            include('views/work/index_work.php');
        }
        public function getWork($param = NULL)
        {
            include('views/work/work_detail.php');
        }
        public function addWork($param = NULL)
        {
            $check = Work::addWork($_SESSION['member']['id_member'],$param['title'],$param['detail'],$param['time_start'],$param['time_stop']);
            header('location:index.php?controller=work&action=index_work');
        }
    }
?>