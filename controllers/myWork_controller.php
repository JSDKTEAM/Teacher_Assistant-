<?php
    require_once('models/memberModel.class.php');
    require_once('models/workModel.class.php');
    require_once('models/yearSchoolModel.class.php');
    class MyWorkController{
        public function index_work($param = NULL)
        {
            $member = Member::getMember($_SESSION['member']['id_member']);
            $workList = Work::getAllWorkByMember($_SESSION['member']['id_member'],$_SESSION['member']['type']);
            if($workList == 2)
            {
                $workList = FALSE;
                sweetalert(NULL,17);
            }
            $status_count = Work::countStatus($_SESSION['member']['id_member'],$_SESSION['member']['type']);
            if($_SESSION['member']['type'] == 'นิสิต')
            {
                include('views/myWork/myWorkStd.php');
            }
            else
            {
                include('views/myWork/myWork.php');
            }
        }
        public function searchWork($param = NULL)
        {
            $member = Member::getMember($_SESSION['member']['id_member']);
            $workList = Work::searchWork($param['id_year']);
            $yearSchoolList = YearSchool::getAllYearSchool();
            $status_count = Work::countStatus($_SESSION['member']['id_member'],$_SESSION['member']['type']);
            if($_SESSION['member']['type'] == 'นิสิต')
            {
                include('views/myWork/myWorkStd.php');
            }
            else
            {
                include('views/myWork/myWork.php');
            }
        }
        public function getAllWorkByMember($param = NULL)
        {
            $member = Member::getMember($param['id_member']);
            $workList = Work::getAllWorkByMember($param['id_member'],$param['type']);
            if($workList == 2)
            {
                $workList = FALSE;
                sweetalert(NULL,17);
            }
            if($param['type'] == 'นิสิต')
            {
                include('views/work/workMemberStd.php');
            }
            else
            {
                include('views/work/workMember.php');
            }
        }
        public function getWork($param = NULL)
        {
            $work = Work::getWork($param['id_work']);
            include('views/myWork/work_detail.php');
        }
        public function get_myWork($param = NULL)
        {
            $member = Member::getMember($_SESSION['member']['id_member']);
            $workList = Work::getAllWorkByMember($_SESSION['member']['id_member'],$_SESSION['member']['type']);
            if($workList == 2)
            {
                $workList = FALSE;
                sweetalert(NULL,17);
            }
            $yearSchoolList = YearSchool::getAllYearSchool();
            $status_count = Work::countStatus($_SESSION['member']['id_member'],$_SESSION['member']['type']);
            if($_SESSION['member']['type'] == 'นิสิต')
            {
                include('views/myWork/myWorkStd.php');
            }
            else
            {
                include('views/myWork/myWork.php');
            }
        }
        public function submitWork($param = NULL)
        {
            $check = Work::updateStatusWork($param['id_member'],$param['id_work'],'booked');
            header("location:index.php?controller=myWork&action=getWork&id_work=$param[id_work]");
        }
        public function cancelWork($param = NULL)
        {
            $check = Work::updateStatusWork(NULL,$param['id_work'],'waiting');
            if($check)
            {
                sweetalert(18,NULL);
            }
            else
            {
                sweetalert(NULL,18);
            }
            call('myWork','get_myWork');
        }
        public function finishWork($param = NULL)
        {
            $check = Work::finishWork($param['id_work'],$param['due_date'],$param['HH'],$param['mm'],$param['summary']);
            header("location:index.php?controller=myWork&action=getWork&id_work=$param[id_work]");
        }
        public function editWork($param = NULL)
        {
            if($_SESSION['member']['type'] !='นิสิต')
            $check = Work::editWork($param['id_work'],$param['title'],$param['time_start'],$param['time_stop'],$param['detail']);
            if($check)
            {
                sweetalert(3,NULL);
            }
            else
            {
                sweetalert(NULL,3);
            }
            
        }
        public function deleteWork($param = NULL)
        {
            if($_SESSION['member']['type'] !='นิสิต')
            $check = Work::deleteWork($param['id_work']);   
            if($check)
            {
                sweetalert(2,NULL);
            }
            else
            {
                sweetalert(NULL,2);
            }      
            call('myWork','get_myWork');
        }
    }
?>