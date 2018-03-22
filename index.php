<?php 
if(isset($_REQUEST['controller'])&&isset($_REQUEST['action']))
{
	$controller = $_REQUEST['controller'];
	$action = $_REQUEST['action'];
}
else
{
	$controller = 'page';
	$action = 'home';
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Language" content="th">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
<header> 
	<?php  echo "controller = ".$controller.", action = ".$action."<br>"; ?>
	[ <a href="?controller=page&action=home">Home </a> ] 
	[ <a href="?controller=student&action=index"> student </a> ]<br>
	<hr>
</header>
<?php require_once("routes.php"); ?>
<footer>
	<hr> 
	
</footer>
</body>
</html>