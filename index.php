<?php 
if(isset($_REQUEST['controller'])&&isset($_REQUEST['action']))
{
	$controller = $_REQUEST['controller'];
	$action = $_REQUEST['action'];
}
else
{
	$controller = 'work';
	$action = 'index_work';
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

	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet"> 

	<style>
	body{
		font-family:Kanit;
	}
	</style>
</head>
<body>
<?php require_once("routes.php"); ?>
<!--/.container-->
<footer class="container-fluid">
    <p class="text-right small">Copyright © Kasetsart University Kamphaeng Saen Campus</p>
</footer>
	<script>
		$(document).ready(function() {
			$("#rice a:contains('จัดการข้าว')").parent().addClass('active');
			$("#dep a:contains('จัดการหน่วยงาน')").parent().addClass('active');
			$("#district a:contains('จัดการที่อยู่')").parent().addClass('active');
			$("#user a:contains('จัดการผู้ใช้')").parent().addClass('active');
			
		}); //jQuery is loaded
	</script>
</body>
</html>