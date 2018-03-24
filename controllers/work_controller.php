<?php
    require_once('models/memberModel.class.php');
    require_once('models/workModel.class.php');
    require_once('models/yearSchoolModel.class.php');
    class WorkController{
        public function index_work()
        {
            $workList = Work::getAllWork();
            require_once('views/work/index_work.php');
        }
    }
?>