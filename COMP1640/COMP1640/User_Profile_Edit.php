<?php
	include('includes/dbconnect.php');
	include('includes/userHeader.php');
?>

<?php
	if($_SESSION['login'] == false)
	{
		echo "<script>alert('Login to Continue');
			window.location.href='Login.php';</script>";
    }
?>

<?php
if(isset($_POST['update']))
	{
		$_SESSION['Update'] = false;

		$userID = $_SESSION['id'];
		$userName = $_POST['name'];
		$userEmail = $_POST['email'];
		$password = md5($_POST['password']);
		$userContact = $_POST['contact'];

		$sql_u = "SELECT * FROM user_table WHERE userID = '$userID'";

		$stmt_u = mysqli_query($conn, $sql_u);

		if (mysqli_num_rows($stmt_u) > 0) {	
		
			if($_POST['password'] != ""){
				$sql = "UPDATE user_table SET userName='$userName', userEmail='$userEmail', password='$password', userContact='$userContact' WHERE userID = '$userID'";
			}
			else{
				$sql = "UPDATE user_table SET userName='$userName', userEmail='$userEmail', userContact='$userContact' WHERE userID = '$userID'";
			}
			
			if (mysqli_query($conn, $sql)) {
				$_SESSION['Update'] = true;
                echo '<script>alert("Profile Edit Successfully")</script>';

			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($db);
			}
		}
		else
		{
			echo("<script>alert('Error');</script>");
		}
	}
?>
<div class="container-fluid" id="mainContainer">
	<div class="row">
		<div class="col-xl-12">
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
						<label>Name</label>
						<input required type=\"text\" name=\"name\" maxlength=\"50\" value=\"".$row["userName"]."\" class=\"form-control\"/>
						</div>
						
						<div class=\"form-group\">
						<label>Email Address</label>
						<input required type=\"email\" name=\"email\" maxlength=\"50\" placeholder=\"Enter Your Email Address\" value=\"".$row["userEmail"]."\" class=\"form-control\"/>
						</div>

						<div class=\"form-group\">
						<label>Password</label>
						<input type=\"password\" name=\"password\" pattern=\"(?=.*\d).{8,}\" maxlength=\"50\" title=\"Use 8 or more characters with a mix of letters and numbers\" class=\"form-control\"/>
						</div>

						<div class=\"form-group\">
						<label>Contact</label>
						<input required type=\"tel\" name=\"contact\" pattern=\"[0-9]{3}-[0-9]{7,}\" maxlength=\"11\" placeholder=\"0000-00000000\" value=\"".$row["userContact"]."\" class=\"form-control\"/>
						</div>
						<div style=\"margin:20px 0 20px 0;\">
							<button type=\"submit\" class=\"btn btn-primary btn-block\" name=\"update\">Update</button></div>
						");
				}
			}
		?>
		</form>
		</div>
	</div>
</div>
<style>
	#mainContainer{
	width:80%;
}
</style>
<?php
	include('includes/userFooter.php') 
?>