<?php
	include('includes/dbconnect.php');
	include('includes/adminHeader.php');
?>

<?php
	if($_SESSION['login'] == false)
	{
		echo "<script>alert('Login to Continue');
			window.location.href='Login.php';</script>";
    }
?>

<?php
	if(isset($_POST['edit']))
	{
		$_SESSION['ToEdit'] = $_POST['edit'];
		echo("<script>window.location.href='Admin_Profile_Edit.php';</script>");
	}
?>
<div class="container-fluid" id="mainContainer">
	<div class="row">
		<div class="col-xl-12">
			<div class="col-xl-12 mb-4" style="background-color:white;">
			<h1>My Profile</h1>
			<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
			<?php
				$userID = $_SESSION["id"];
				$sql = "SELECT * FROM user_table WHERE userID = '$userID'";

				$res_data = mysqli_query($conn,$sql);
				if (mysqli_num_rows($res_data) > 0){
					while($row = mysqli_fetch_array($res_data)){
						echo("
							<div class=\"form-group\">
								<div class=\"row\">
									<div class=\"col mb-2 text-right\"><label>Name:</label></div>
									<div class=\"col mb-2 text-left\"><label>".$row["userName"]."</label></div>
								</div>
							</div>
						
							<div class=\"form-group\">
								<div class=\"row\">
									<div class=\"col mb-2 text-right\"><label>Email:</label></div>
									<div class=\"col mb-2 text-left\"><label>".$row["userEmail"]."</label></div>
								</div>
							</div>

							<div class=\"form-group\">
								<div class=\"row\">
									<div class=\"col mb-2 text-right\"><label>Password:</label></div>
									<div class=\"col mb-2 text-left\"><label>********</label></div>
								</div>
							</div>

							<div class=\"form-group\">
								<div class=\"row\">
									<div class=\"col mb-2 text-right\"><label>Contact:</label></div>
									<div class=\"col mb-2 text-left\"><label>".$row["userContact"]."</label></div>
								</div>
							</div>
							</div>
							<div class=\"col text-center md-4\" style=\"margin: 0 0 20px 0;\">
								<button name=\"edit\" value=".$row["userID"]." class=\"btn btn-primary\"><i class='fa fa-edit' aria-hidden='true'></i>Edit</button>
							</div>
						");
					}
				}
			?>
			</form>
		</div>
	</div>
</div>

<?php
	include('includes/adminFooter.php') 
?>