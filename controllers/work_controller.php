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
    }
?>