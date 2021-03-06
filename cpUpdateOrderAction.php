<!DOCTYPE html>
<html lang="en">
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="modal fade" id="successModal" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Successful Message</h4>
				</div>
				<div class="modal-body">
					<p>Data updated successfully!</p>
				</div>
				<div class="modal-footer">
					<a class="btn btn-primary" href="cp_main.php">GO TO MAIN PAGE</a>
				</div>
			</div>

		</div>
	</div>

	<div class="modal fade" id="failureModal" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header bg-warning">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Error Message</h4>
				</div>
				<div class="modal-body">
					<p>Data updates failed!</p>
				</div>
				<div class="modal-footer">
					<a class="btn btn-danger" href="cp_main.php">GO TO MAIN PAGE</a>
				</div>
			</div>

		</div>
	</div>
</body>
</html>
<?php 
session_start();
if(!$_SESSION["userName"]) {
	header("Location:login.php");
}

$dbc = @mysqli_connect ('localhost', 'root', '', 'medisupply') OR die ('Could not connect to MySQL: ' . mysqli_connect_error());

	// Receive input from the previous page (cp_main.php)
$clinicID = mysqli_real_escape_string($dbc, trim($_POST['clinicID']));
$clinicAddress = mysqli_real_escape_string($dbc, trim($_POST['clinicAddress']));
$clinicArea = mysqli_real_escape_string($dbc, trim($_POST['clinicArea']));
$clinicTelephone = mysqli_real_escape_string($dbc, trim($_POST['clinicTelephone']));
$clinicDetails = mysqli_real_escape_string($dbc, trim($_POST['clinicDetails']));

$q = "UPDATE clinic SET clinicAddress = '$clinicAddress', clinicArea = '$clinicArea', clinicTelephone = '$clinicTelephone', clinicDetails = '$clinicDetails' WHERE clinicID = '$clinicID'";



$r = @mysqli_query ($dbc, $q);
if (mysqli_affected_rows($dbc) == 1) {
	echo 
	'<script type="text/javascript">
	$(document).ready(function(){
		$("#successModal").modal("show");
		});
		</script>
		';
	} else {
		echo '<script type="text/javascript">
		$(document).ready(function(){
			$("#failureModal").modal("show");
			});
			</script>
			';
		}
		mysqli_close($dbc);
		?>
