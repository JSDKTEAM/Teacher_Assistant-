<?php
    require_once('models/workModel.class.php');
    require_once('models/memberModel.class.php');
    require_once('models/yearSchoolModel.class.php');
    class WorkMmController
    {
        public function index_workMm($param  = NULL)
        {
            $workList = Work::getAllWork();
            $personList = Member::getAllMemberByYear();
            $patronList = Member::getAllStaff();
            $yearSchoolList = YearSchool::getAllYearSchool();
            include('views/workMm/index_workMm.php');    
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
            call('workMm','index_workMm');
            
        }
        public function searchWork($param = NULL)
        {
            $workList = Work::searchWork($param['id_year']);
            $yearSchoolList = YearSchool::getAllYearSchool();
            $personList = Member::getAllMemberByYear();
            $patronList = Member::getAllStaff();
            include('views/workMm/index_workMm.php');    
        }
        public function edit_workMm($param  = NULL)
        {
            $success=0;
            $error=0;
            $link='location:index.php?controller=workMm&action=index_workMm';
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
            call('workMm','index_workMm');
        
        
        }
        public function delete_workMm($param  = NULL)
        {
            $check = Work::deleteWork($param['id_work']);
            $link='location:index.php?controller=workMm&action=index_workMm';
            if($check)
            {
                sweetalert(2,NULL);
            }
            else
            {
                sweetalert(NULL,2);
            }
            call('workMm','index_workMm');
            
        }   
            
    }
?>