<?php
    require_once('models/memberModel.class.php');
    require_once('models/workModel.class.php');
    require_once('models/yearSchoolModel.class.php');
    class UserMmController{
        public function index_userMm($param = NULL)
        {
            $memberList = Member::getAllMember();
            //$memberYearList =  Member::getMemberByYear();
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
            if($check)
            {
                sweetalert(4,NULL);
            }
            else
            {
                sweetalert(NULL,4);
            }
            call('userMm','index_userMm');
        }
        public function validateCode($param = NULL)
        {
            Member::validateCode($param['id_code']);
        }
        public function addMemberSys($param = NULL)
        {
           $check = Member::addMemberSys($param['id_member']);
           header('location:index.php?controller=userMm&action=index_userMm');
        }
        public function updateMember($param = NULL)
        {
            $check = Member::updateMember($param['id_member'],$param['id_code'],$param['fname'],$param['lname'],$param['type']);
            if($check)
            {
                sweetalert(6,NULL);
            }
            else
            {
                sweetalert(NULL,6);
            }
            call('userMm','index_userMm');
        }
        public function updatePassMember($param = NULL)
        {
            $check = Member::updatePassMember($param['id_member'],$param['passwd']);
            if($check)
            {
                sweetalert(5,NULL);
            }
            else
            {
                sweetalert(NULL,5);
            }
            call('userMm','index_userMm');
        }
        public function index_workMm($param  = NULL)
        {
            $workList = Work::getAllWork();
            $personList = Member::getAllMemberByYear();
            $patronList = Member::getAllStaff();
            include('views/userMm/index_workMm.php');
        }
        public function add_workMm($param = NULL)
        {
            $check = Work::addWork($param['id_patron'],$param['title'],$param['detail'],$param['time_start'],$param['time_stop']);
            if($check)
            {
                sweetalert(1,NULL);
            }
            else
            {
                sweetalert(NULL,1);
            }
            call('userMm','index_userMm');
            
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
                sweetalert(3,NULL);
            }
            else if($error!=0)
            {
                sweetalert(NULL,3);
            }
            call('userMm','index_workMm');
           
          
        }
        public function delete_workMm($param  = NULL)
        {
            $check = Work::deleteWork($param['id_work']);
            $link='location:index.php?controller=userMm&action=index_workMm';
            if($check)
            {
                sweetalert(2,NULL);
            }
            else
            {
                sweetalert(NULL,2);
            }
            call('userMm','index_workMm');
            
        }
        public function deleteUser($param = NULL)
        {
            $check = Member::deleteUser($param['id_member']);
            if($check)
            {
                sweetalert(7,NULL);
            }
            else
            {
                sweetalert(NULL,7);
            }
            call('userMm','index_userMm');
        }
    }
?>