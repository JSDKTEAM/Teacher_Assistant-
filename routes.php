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
						$param['title'] = $_POST['title']??'';
						$param['detail'] = $_POST['detail']??'';
						$param['time_start'] = $_POST['time_start']??'';
						$param['time_stop'] = $_POST['time_stop']??'';
						$param['id_work'] = $_REQUEST['id_work']??'';
						$param['id_member'] = $_REQUEST['id_member']??'';
						$param['type'] = $_REQUEST['type']??'';
						$param['due_date'] = $_POST['due_date']??'';
						$param['used_time'] = $_POST['used_time']??'';
						$param['HH'] = $_POST['HH']??'';
						$param['mm'] = $_POST['mm']??'';
						$param['summary'] = $_POST['summary']??NULL;
						break;
		case "myWork":  $controller = new MyWorkController();
						$param['title'] = $_POST['title']??'';
						$param['detail'] = $_POST['detail']??'';
						$param['time_start'] = $_POST['time_start']??'';
						$param['time_stop'] = $_POST['time_stop']??'';
						$param['id_work'] = $_REQUEST['id_work']??'';
						$param['id_member'] = $_REQUEST['id_member']??'';
						$param['type'] = $_REQUEST['type']??'';
						$param['due_date'] = $_POST['due_date']??'';
						$param['used_time'] = $_POST['used_time']??'';
						$param['HH'] = $_POST['HH']??'';
						$param['mm'] = $_POST['mm']??'';
						$param['summary'] = $_POST['summary']??NULL;
						break;
		case "userMm":  $controller = new UserMmController();
						$param['id_member'] = $_POST['id_member']??'';
						$param['id_code'] = $_POST['id_code']??'';
						$param['fname'] = $_POST['fname']??'';
						$param['lname'] = $_POST['lname']??'';
						$param['username'] = $_POST['username']??'';
						$param['passwd'] = $_POST['passwd']??'';
						$param['type'] = $_POST['type']??'';
						break;
		case "userSet":  $controller = new UserSetController();
						$param['imagebase64'] = $_POST['imagebase64']??'';
						break;
		case "identify":$controller = new IdentifyController();
						$param['id_code'] = $_POST['id_code']??'';
						$param['fname'] = $_POST['fname']??'';
						$param['lname'] = $_POST['lname']??'';
						$param['username'] = $_POST['username']??'';
						$param['passwd'] = $_POST['passwd']??'';
						$param['type'] = $_POST['type']??'';
						break;
		case "report":  $controller = new ReportController();
						break;

		case "yearSet": $controller = new YearSetController();
						$param['id_year']=$_POST['id_year']??'';
						$param['start_date']=$_POST['start_date']??'';
						$param['end_date']=$_POST['end_date']??'';
						
						break ; 
	}
	$controller->{$action}($param);
}

if( ($controller =='page'&& ($action =='home'|| $action =='error')) 
||  ($controller == 'work' && ($action == 'index_work' || $action == 'getWork' || $action == 'getAllWorkByMember' ||$action == 'addWork' || $action == 'submitWork' || $action == 'finishWork' ||$action == 'cancelWork'))
||  ($controller == 'myWork' && ($action == 'get_myWork'))
||  ($controller == 'userMm' && ($action == 'index_userMm' || $action == 'addMember'|| $action == 'updateMember'|| $action == 'updatePassMember' || $action == 'addMemberSys' || $action == 'index_workMm'))
||  ($controller == 'userSet' && ($action == 'index_userSet' || $action == 'upload_image'))
||  ($controller == 'identify' && ($action == 'index_login' || $action == 'login' || $action == 'logout' || $action == 'index_register' || $action == 'submit_register'))
|| ($controller == 'yearSet' && ($action == 'index_year' || $action == 'updateYear'))
|| ($controller == 'report' && ($action == 'index_reportMonth')))
{	
	call($controller,$action);	
}
else
{	
	call('page','error'); 
}
?>