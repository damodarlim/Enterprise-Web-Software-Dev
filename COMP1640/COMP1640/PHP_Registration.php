<?php 
include('includes/dbconnect.php'); 
$error_message = "";$success_message = "";

// Register user
if(isset($_POST['btnsignup'])){
	$_SESSION['AddUser'] = false;
		if(!empty($_POST['userName']) && !empty($_POST['password']) && isset($_POST['userName'],$_POST['password']))
		{
			$userName = trim($_POST['userName']);
			$email = trim($_POST['email']);
			$contact = trim($_POST['contact']);
			$role = trim($_POST['role']);
			$department = trim($_POST['department']);
			$password = trim(md5($_POST['password']));
			$confirmpassword = trim(md5($_POST['confirmpassword']));

			if($password==$confirmpassword){
				$sql_u = "SELECT * FROM user_table WHERE userEmail = '$email'";

				$stmt_u = mysqli_query($conn, $sql_u);

				if (mysqli_num_rows($stmt_u) > 0) {	
					echo("<script>alert('User Already Exists');</script>");
				}
				else
				{
					$sql = "INSERT INTO user_table (userName, userEmail, userContact, role, password, department)
					VALUES ('$userName','$email','$contact','$role','$password', '$department')";
				
					if (mysqli_query($conn, $sql)) {
						$passwordE=$_POST['password'];
                        $to = $email;
                        $subject = "User Account";
                        $message = "
                        Username: $userName
						Password: $passwordE    
                        ";
						$from = "From: system <superadmin@comp1640.com>";

						if (mail($to,$subject,$message,$from)){
							$_SESSION['AddUser'] = true;
							echo "<script>alert('New User Added');</script>";

						}
						else
						{
							echo "<script>alert('Error');</script>";
							echo "<script>window.location='Staff_Registration.php'</script>";
						}
					}
					else
					{
						echo "Error: " . $sql . "<br>" . mysqli_error($conn);
					}
					mysqli_close($conn);
					echo "<script>window.location='Staff_Registration.php'</script>";

				}
			}
			else
			{
				echo("<script>alert('Password NOT Match');</script>");
				echo "<script>window.location='Staff_Registration.php'</script>";
			}
		}	
}
?>