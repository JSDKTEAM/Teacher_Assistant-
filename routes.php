<?php
function call($controller,$action)
{
	require_once("controllers/".$controller."_controller.php");
	switch($controller)
	{
		case "page":	$controller = new PageController();
						break;
		case "work":    $controller = new WorkController();
						break;
		case "userMm":  $controller = new UserMmController();
						break;
	}
	$controller->{$action}();
}

if( ($controller =='page'&& ($action =='home'|| $action =='error')) 
||  ($controller == 'work' && ($action == 'index_work'))
||  ($controller == 'userMm' && ($action == 'index_userMm')))
{	
	call($controller,$action);	
}
else
{	
	call('page','error'); 
}
?>