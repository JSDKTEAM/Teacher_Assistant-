<?php
function call($controller,$action)
{
	require_once("controllers/".$controller."_controller.php");
	$param = array();
	switch($controller)
	{
		case "page":	$controller = new PageController();
						break;
		case "work":    $controller = new WorkController();
						$param['title'] = $_POST['title']??NULL;
						$param['detail'] = $_POST['detail']??NULL;
						$param['time_start'] = $_POST['time_start']??NULL;
						$param['time_stop'] = $_POST['time_stop']??NULL;
						$param['id_work'] = $_REQUEST['id_work']??NULL;
						$param['id_member'] = $_REQUEST['id_member']??NULL;
						$param['type'] = $_REQUEST['type']??NULL;
						$param['due_date'] = $_POST['due_date']??NULL;
						$param['used_time'] = $_POST['used_time']??NULL;
						$param['HH'] = $_POST['HH']??NULL;
						$param['mm'] = $_POST['mm']??NULL;
						$param['summary'] = $_POST['summary']??NULL;
						$param['id_year'] =  $_POST['id_year']??NULL;
						break;
		case "myWork":  $controller = new MyWorkController();
						$param['title'] = $_POST['title']??NULL;
						$param['detail'] = $_POST['detail']??NULL;
						$param['time_start'] = $_POST['time_start']??NULL;
						$param['time_stop'] = $_POST['time_stop']??NULL;
						$param['id_work'] = $_REQUEST['id_work']??NULL;
						$param['id_member'] = $_REQUEST['id_member']??NULL;
						$param['type'] = $_REQUEST['type']??NULL;
						$param['due_date'] = $_POST['due_date']??NULL;
						$param['used_time'] = $_POST['used_time']??NULL;
						$param['HH'] = $_POST['HH']??NULL;
						$param['mm'] = $_POST['mm']??NULL;
						$param['summary'] = $_POST['summary']??NULL;
						break;
		case "userMm":  $controller = new UserMmController();
						$param['id_member'] = $_POST['id_member']??NULL;
						$param['id_code'] = $_POST['id_code']??NULL;
						$param['fname'] = $_POST['fname']??NULL;
						$param['lname'] = $_POST['lname']??NULL;
						$param['username'] = $_POST['username']??NULL;
						$param['passwd'] = $_POST['passwd']??NULL;
						$param['type'] = $_POST['type']??NULL;
						break;
		case "userSet":  $controller = new UserSetController();
						$param['id_member'] = $_POST['id_member']??NULL;
						$param['id_code'] = $_POST['id_code']??NULL;
						$param['fname'] = $_POST['fname']??NULL;
						$param['lname'] = $_POST['lname']??NULL;
						$param['passwdOld'] = $_POST['passwdOld']??NULL;
						$param['passwd'] = $_POST['passwd']??NULL;

						$param['imagebase64'] = $_POST['imagebase64']??NULL;
						break;
		case "identify":$controller = new IdentifyController();
						$param['id_code'] = $_POST['id_code']??NULL;
						$param['fname'] = $_POST['fname']??NULL;
						$param['lname'] = $_POST['lname']??NULL;
						$param['username'] = $_POST['username']??NULL;
						$param['passwd'] = $_POST['passwd']??NULL;
						$param['type'] = $_POST['type']??NULL;
						break;
		case "report":  $controller = new ReportController();
						$param['year'] = $_REQUEST['year']??NULL;
						$param['person_id'] = $_REQUEST['person_id']??NULL;
						break;

		case "yearSet": $controller = new YearSetController();
						$param['id_year']=$_POST['id_year']??NULL;
						$param['start_date']=$_POST['start_date']??NULL;
						$param['end_date']=$_POST['end_date']??NULL;
						
						break ; 
	}
	$controller->{$action}($param);
}

if( ($controller =='page'&& ($action =='home'|| $action =='error')) 
||  ($controller == 'work' && ($action == 'index_work' || $action == 'searchWork' || $action == 'getWork' || $action == 'getAllWorkByMember' ||$action == 'addWork' || $action == 'submitWork' || $action == 'finishWork' ||$action == 'cancelWork'|| $action == 'editWork'|| $action == 'deleteWork'))
||  ($controller == 'myWork' && ($action == 'index_work' || $action == 'getWork' ||$action == 'get_myWork' || $action == 'getWork' ||$action == 'addWork' || $action == 'submitWork' || $action == 'finishWork' ||$action == 'cancelWork'|| $action == 'editWork'|| $action == 'deleteWork' ))
||  ($controller == 'userMm' && ($action == 'index_userMm' || $action == 'addMember'|| $action == 'updateMember'|| $action == 'updatePassMember' || $action == 'addMemberSys' || $action == 'index_workMm' || $action == 'validateUsername'))
||  ($controller == 'userSet' && ($action == 'index_userSet' || $action == 'upload_image' || $action == 'updateInfo' || $action == 'updatePassMember' || $action == 'validatePassword'))
||  ($controller == 'identify' && ($action == 'index_login' || $action == 'login' || $action == 'logout' || $action == 'index_register' || $action == 'submit_register'))
|| ($controller == 'yearSet' && ($action == 'index_year' || $action == 'updateYear'|| $action == 'addYear'))
|| ($controller == 'report' && ($action == 'index_reportMonth' || $action == 'getMemberByYear' || $action == 'reportMonth' || $action == 'reportYear')))
{	
	call($controller,$action);	
}
else
{	
	call('page','error'); 
}
?>