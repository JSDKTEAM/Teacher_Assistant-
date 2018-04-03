<?php
    require_once('models/memberModel.class.php');
    require_once('models/workModel.class.php');
    require_once('models/yearSchoolModel.class.php');
    class MyWorkController{
        public function get_myWork($param = NULL)
        {
            $member = Member::getMember($_SESSION['member']['id_member']);
            $workList = Work::getAllWorkByMember($_SESSION['member']['id_member'],$_SESSION['member']['type']);
            if($_SESSION['member']['type'] == 'นิสิต')
            {
                include('views/work/myWorkStd.php');
            }
            else
            {
                include('views/work/myWork.php');
            }
        }
    }
?>