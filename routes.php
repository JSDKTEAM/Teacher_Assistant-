<?php
function call($controller,$action)
{
	require_once("controllers/".$controller."_controller.php");
	switch($controller)
	{
		case "page":	$controller = new PageController();
						break;
	}
	$controller->{$action}();
}

if( ($controller=='page'&&($action=='home'||$action=='error')) )
{	
	call($controller,$action);	
}
else
{	
	call('page','error'); 
}
?>