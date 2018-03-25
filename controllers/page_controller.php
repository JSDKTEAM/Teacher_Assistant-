<?php
class PageController
{
	public function home($param = NULL)
	{
		include('views/pages/home.php');
	}
	public function error($param = NULL)
	{
		include("views/pages/error.php");
	}
}
?>