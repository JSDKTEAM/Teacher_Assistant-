<?php
    require_once('models/memberModel.class.php');
    require_once('models/workModel.class.php');
    require_once('models/yearSchoolModel.class.php');
    class UserMmController{
        public function index_userMm($param = NULL)
        {
            $memberList = Member::getAllMember();
            $memberYearList =  Member::getMemberByYear();
            $memberListYear = Member::getAllMemberByYear();
            include('views/userMm/index_userMm.php');
        }
        public function validateUsername($param = NULL)
        {
            Member::validateUsername($param['username']);
        }
        public function addMember($param = NULL)
        {
            $check = Member::addMemberMm($param['fname'],$param['lname'],$param['username'],$param['passwd'],$param['type']);
            $link = 'location:index.php?controller=userMm&action=index_userMm';
            if($check)
            {
                header($link.'&success=4');
            }
            else
            {
                header($link.'&error=4');
            }
        }
        public function addMemberSys($param = NULL)
        {
           $check = Member::addMemberSys($param['id_member']);
           header('location:index.php?controller=userMm&action=index_userMm');
        }
        public function updateMember($param = NULL)
        {
            $check = Member::updateMember($param['id_member'],$param['id_code'],$param['fname'],$param['lname'],$param['type']);
            $link = 'location:index.php?controller=userMm&action=index_userMm';
            if($check)
            {
                header($link.'&success=6');
            }
            else
            {
                header($link.'&error=6');
            }
        }
        public function updatePassMember($param = NULL)
        {
            $check = Member::updatePassMember($param['id_member'],$param['passwd']);
            $link = 'location:index.php?controller=userMm&action=index_userMm';
            if($check)
            {
                header($link.'&success=5');
            }
            else
            {
                header($link.'&error=5');
            }
        }
        public function index_workMm($param  = NULL)
        {
            $workList = Work::getAllWork();
            $personList = Member::getMemberByYear();
            $patronList = Member::getAllStaff();
            include('views/userMm/index_workMm.php');
        }
        public function add_workMm($param = NULL)
        {
            $check = Work::addWork($param['id_patron'],$param['title'],$param['detail'],$param['time_start'],$param['time_stop']);
            $link ='location:index.php?controller=userMm&action=index_workMm';
            if($check)
            {
                header($link.'&success=1');
            }
            else
            {
                header($link.'&error=1');
            }
            
        }
        public function edit_workMm($param  = NULL)
        {
            $success=0;
            $error=0;
            $link='location:index.php?controller=userMm&action=index_workMm';
            if($param['status']=='waiting')
            {
                $check1=Work::editWork($param['id_work'],$param['title'],$param['time_start'],$param['time_stop'],$param['detail']);
                $check2=Work::editPatronWork($param['id_work'],$param['id_patron']);
                if($check1&&$check2)
                {
                    $success=3;
                }
                else
                {
                    $error=3;
                }
            }
            else if($param['status']=='booked')
            {
                $check1=Work::editWork($param['id_work'],$param['title'],$param['time_start'],$param['time_stop'],$param['detail']);
                $check2=Work::editPatronWork($param['id_work'],$param['id_patron']);
                $check3=Work::editPersonWork($param['id_work'],$param['id_person']);
                if($check1&&$check2&&$check3)
                {
                    $success=3;
                }
                else
                {
                    $error=3;
                }
            }
            else
            {
                $check1=Work::editWork($param['id_work'],$param['title'],$param['time_start'],$param['time_stop'],$param['detail']);
                $check2=Work::editPatronWork($param['id_work'],$param['id_patron']);
                $check3=Work::editPersonWork($param['id_work'],$param['id_person']);
                $check4=Work::finishWork($param['id_work'],$param['due_date'],$param['HH'],$param['mm'],$param['summary']);
                if($check1&&$check2&&$check3&&$check4)
                {
                    $success=3;
                }
                else
                {
                    $error=3;
                }
            }
            if($success!=0)
            {
                header($link.'&success=3');
            }
            else if($error!=0)
            {
                header($link.'&error=3');
            }
           
          
        }
        public function delete_workMm($param  = NULL)
        {
            $check = Work::deleteWork($param['id_work']);
            $link='location:index.php?controller=userMm&action=index_workMm';
            if($check)
            {
                header($link.'&success=2');
            }
            else
            {
                header($link.'&error=2');
            }
            
        }
    }
?>