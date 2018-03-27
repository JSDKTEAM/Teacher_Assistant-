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
            $work = Work::getWork($param['id_work']);
            include('views/work/work_detail.php');
        }
        public function getAllWorkByMember($param = NULL)
        {
            $member = Member::getMember($param['id_member']);
            $workList = Work::getAllWorkByMember($param['id_member'],$param['type']);
            if($param['type'] == 'นิสิต')
            {
                include('views/work/workMemberStd.php');
            }
            else
            {
                include('views/work/workMember.php');
            }
        }
        public function submitWork($param = NULL)
        {
            $check = Work::updateStatusWork($param['id_member'],$param['id_work'],'booked');
            header('location:index.php?controller=work&action=index_work');
        }
        public function cancelWork($param = NULL)
        {
            $check = Work::updateStatusWork(NULL,$param['id_work'],'waiting');
            header('location:index.php?controller=work&action=index_work');
        }
        public function finishWork($param = NULL)
        {
            $check = Work::finishWork($param['id_work'],$param['due_date'],$param['used_time'],$param['summary']);
            header('location:index.php?controller=work&action=index_work');
        }
        public function addWork($param = NULL)
        {
            $check = Work::addWork($_SESSION['member']['id_member'],$param['title'],$param['detail'],$param['time_start'],$param['time_stop']);
            header('location:index.php?controller=work&action=index_work');
        }
    }
?>