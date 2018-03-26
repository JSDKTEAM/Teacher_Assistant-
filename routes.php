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
						$param['id_member'] = $_POST['id_member']??'';
						$param['due_date'] = $_POST['due_date']??'';
						$param['used_time'] = $_POST['used_time']??'';
						$param['summary'] = $_POST['summary']??NULL;
						break;
		case "userMm":  $controller = new UserMmController();
						$param['id_code'] = $_POST['id_code']??'';
						$param['fname'] = $_POST['fname']??'';
						$param['lname'] = $_POST['lname']??'';
						$param['username'] = $_POST['username']??'';
						$param['passwd'] = $_POST['passwd']??'';
						$param['type'] = $_POST['type']??'';
						break;
		case "userSet":  $controller = new UserSetController();
						break;
		case "identify":$controller = new IdentifyController();
						$param['id_code'] = $_POST['id_code']??'';
						$param['fname'] = $_POST['fname']??'';
						$param['lname'] = $_POST['lname']??'';
						$param['username'] = $_POST['username']??'';
						$param['passwd'] = $_POST['passwd']??'';
						$param['type'] = $_POST['type']??'';
						break;
	}
	$controller->{$action}($param);
}

if( ($controller =='page'&& ($action =='home'|| $action =='error')) 
||  ($controller == 'work' && ($action == 'index_work' || $action == 'getWork' || $action == 'addWork'))
||  ($controller == 'userMm' && ($action == 'index_userMm' || $action == 'addMember'|| $action == 'updateMember'|| $action == 'updatePassMember'))
||  ($controller == 'userSet' && ($action == 'index_userSet'))
||  ($controller == 'identify' && ($action == 'index_login' || $action == 'login' || $action == 'logout' || $action == 'index_register' || $action == 'submit_register')))
{	
	call($controller,$action);	
}
else
{	
	call('page','error'); 
}
?>