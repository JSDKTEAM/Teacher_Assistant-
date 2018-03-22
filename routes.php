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
	}
	$controller->{$action}();
}

if( ($controller =='page'&& ($action =='home'|| $action =='error')) 
||  ($controller == 'work' && ($action == 'index_work')))
{	
	call($controller,$action);	
}
else
{	
	call('page','error'); 
}
?>