<?php 
 session_start();
if(isset($_REQUEST['controller'])&&isset($_REQUEST['action']))
{
	$controller = $_REQUEST['controller'];
	$action = $_REQUEST['action'];
}
else
{
	$controller = 'identify';
	$action = 'index_login';
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Language" content="th">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Chart -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

	<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet"> 
	
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.16/datatables.min.css"/>
 
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.16/datatables.min.js"></script>

	<!--<link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/croppie.css">
	<script src="http://demo.itsolutionstuff.com/plugin/croppie.js"></script>-->

	<!-- Crop images -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">

	<!-- Search Tags -->
	<link rel="stylesheet" href="Searchable-Multi-select-jQuery-Dropdown/jquery.dropdown.css">
    <script src="Searchable-Multi-select-jQuery-Dropdown/jquery.dropdown.js"></script>
	<style>
	body{
		font-family:Kanit;
	}
	</style>
</head>
<body id="<?php echo $controller ?>">
<?php require_once("routes.php"); ?>
<hr>
<footer>
    <p class="text-center small">Copyright © Kasetsart University Kamphaeng Saen Campus</p>
</footer>
	<script>
		$(document).ready(function() {
			$("#work a:contains('หน้าแรก')").parent().addClass('active');
			$("#myWork a:contains('จัดการงาน')").parent().addClass('active');
			$("#report a:contains('สถิติ')").parent().addClass('active');
			$("#userMm a:contains('จัดการระบบ')").parent().addClass('active');
			$("#yearSet a:contains('จัดการระบบ')").parent().addClass('active');
			$("#report a:contains('สถิติ')").parent().addClass('active');
		}); //jQuery is loaded
	</script>
</body>
</html>