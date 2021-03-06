<?php
    
    if(!isset($_SESSION['member']))
    {
        header('location:index.php?controller=identify&action=index_login');
    }
    require_once('models/memberModel.class.php');
    require_once('models/workModel.class.php');
    require_once('models/yearSchoolModel.class.php');
    
    class WorkController{
        public function index_work($param = NULL)
        {
            $workList = Work::getAllWork();
            if($workList == 2)
            {
                $workList = FALSE;
                sweetalert(NULL,17);
            }
            $yearSchoolList = YearSchool::getAllYearSchool();
            include('views/work/index_work.php');
        }
        public function getWork($param = NULL)
        {
            $work = Work::getWork($param['id_work']);
            include('views/work/work_detail.php');
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
            $status_count = Work::countStatus($param['id_member'],$param['type']);
            if($param['type'] == 'นิสิต')
            {
                include('views/work/workMemberStd.php');
            }
            else
            {
                include('views/work/workMember.php');
            }
        }
        public function searchWork($param = NULL)
        {
            $workList = Work::searchWork($param['id_year']);
            $yearSchoolList = YearSchool::getAllYearSchool();
            include('views/work/index_work.php');
        }
        public function submitWork($param = NULL)
        {
            $check = Work::updateStatusWork($param['id_member'],$param['id_work'],'booked');
            header("location:index.php?controller=work&action=getWork&id_work=$param[id_work]");
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
            call('work','index_work');
        }
        public function finishWork($param = NULL)
        {
            $check = Work::finishWork($param['id_work'],$param['due_date'],$param['HH'],$param['mm'],$param['summary']);
            header("location:index.php?controller=work&action=getWork&id_work=$param[id_work]");
        }
        public function addWork($param = NULL)
        {
            $check = Work::addWork($_SESSION['member']['id_member'],$param['title'],$param['detail'],$param['time_start'],$param['time_stop']);
            if($check === 2)
            {
                $check = false;
                sweetalert(NULL,17);
            }
            else if($check  === true)
            {
                sweetalert(1,NULL);
            }
            else
            {
                sweetalert(NULL,1);
            }
            call('work','index_work');
            
        }
        public function editWork($param = NULL)
        {
           
            $check = Work::editWork($param['id_work'],$param['title'],$param['time_start'],$param['time_stop'],$param['detail']);
            $link ='location:index.php?controller=work&action=index_work';
            if($check)
            {
                sweetalert(3,NULL);
            }
            else
            {
                sweetalert(NULL,3);
            }
            call('work','index_work');
        }
        public function deleteWork($param = NULL)
        {
           
            $check = Work::deleteWork($param['id_work']);  
            if($check)
            {
                sweetalert(2,NULL);
            }
            else
            {
                sweetalert(NULL,2);
            }
            call('work','index_work');
        }
        /*
        public function editWork($param = NULL)
        {
            $check = Work::editWork($param['id_work'],$param['title'],$param['time_start'],$param['time_stop'],$param['detail']);
            if($_SESSION['member']['type']=='อาจารย์')
            header("location:index.php?controller=myWork&action=get_myWork");
        }
        public function deleteWork($param = NULL)
        {
            $check = Work::deleteWork($param['id_work']);
            if($_SESSION['member']['type']=='อาจารย์')
            header("location:index.php?controller=myWork&action=get_myWork");
        }
        */
    }
?>