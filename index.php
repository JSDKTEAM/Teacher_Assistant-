<?php 
	require_once('views/sweetalert/sweetalert.php');
	function isAjax() {
		return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower(
			$_SERVER['HTTP_X_REQUESTED_WITH']
		) == 'xmlhttprequest';
	}
	session_start();
	if(isAjax())
	{
		ob_start();
	}
	if((isset($_REQUEST['controller'])&&isset($_REQUEST['action'])) || (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'))
	{
		$controller = $_REQUEST['controller'];
		$action = $_REQUEST['action'];
		if($controller == 'workMm' || $controller == 'userMm' || $controller == 'report')
		{
			//echo $_SESSION['member']['type']);
			if(isset($_SESSION['member']['type']))
			{
				if($_SESSION['member']['type'] != 'ผู้ประเมิน')
				{
					$controller = 'identify';
					$action = 'index_login';
				}
			}
			else
			{
				$controller = 'identify';
				$action = 'index_login';
			}

		}
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
	<title>ระบบสั่งงานนิสิตทุนทำงาน</title>
	<link rel="shortcut icon" href="http://www.ku.ac.th/web2012/resources/upload/content/images/edu_kasetsart.jpg" />
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
	<!-- fontaws -->
	<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet"> 
	<!-- dataTable -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
	<!-- mutiselect -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.15.0/slimselect.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.15.0/slimselect.min.css" rel="stylesheet"></link>

	<!-- Crop images -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">

	<!-- ตรวจสอบ Form -->
	<script src="js/validate/validate_form.js"></script>
	<!-- ดึงค่านิสิต แล้ว ตรวจสอบปีการศึกษา -->
	<script src="js/ajax/yearSchool/getMember.js"></script>
	<script src="js/ajax/yearSchool/curYear.js"></script>
	<!--  sweetalert -->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<!-- dataTablefunc -->
	<script src="js/dataTable.js"></script>
	
	<style>
	body{
		margin:0;
		font-family:Kanit;
		background-color:#EBEBEB;
	}
	table{
		background-color:#FFFF;	
	}
	tbody tr{
		line-height: 20px;
		font-size:14px;
	}
	.red{
		color:red;
	}
	</style>
</head>
<body id="<?php echo $controller ?>">
<?php 
	require_once("routes.php"); 
?>
<?php if(isAjax()){ob_start();} ?>
<hr class="footer">
<footer  class="footer">
    <p class="text-center small">Copyright © Kasetsart University Kamphaeng Saen Campus</p>
</footer>
	<script>
		dataTable(".Tabledata");
		$(document).ready(function() {
			$("#work a:contains('หน้าแรก')").parent().addClass('active');
			$("#myWork a:contains('จัดการงาน')").parent().addClass('active');
			$("#report a:contains('สถิติ')").parent().addClass('active');
			$("#userMm a:contains('จัดการระบบ')").parent().addClass('active');
			$("#yearSet a:contains('จัดการระบบ')").parent().addClass('active');
			$("#addStd a:contains('จัดการระบบ')").parent().addClass('active');
			$("#workMm a:contains('จัดการระบบ')").parent().addClass('active');
			$("#report a:contains('สถิติ')").parent().addClass('active');
		}); //jQuery is loaded
		
	</script>
</body>
</html>
<?php if(isAjax()){ob_end_clean();} ?>




