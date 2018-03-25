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
						break;
		case "userMm":  $controller = new UserMmController();
						break;
		case "identify":$controller = new IndentifyController();
						$param['fname'] = $_POST['fname']??'';
						$param['lname'] = $_POST['lname']??'';
						$param['username'] = $_POST['username']??'';
						$param['passwd'] = $_POST['passwd']??'';
						break;
	}
	$controller->{$action}($param);
}

if( ($controller =='page'&& ($action =='home'|| $action =='error')) 
||  ($controller == 'work' && ($action == 'index_work'))
||  ($controller == 'userMm' && ($action == 'index_userMm'))
||  ($controller == 'identify' && ($action == 'index_login' || $action == 'login' || $action == 'logout' || $action == 'index_register')))
{	
	call($controller,$action);	
}
else
{	
	call('page','error'); 
}
?>