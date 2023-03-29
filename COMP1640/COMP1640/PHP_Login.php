<?php
	session_start();

	// variable declaration
	$userName = "";
	$email    = "";
	$errors = array(); 

	// connect to database
	include ('includes/dbconnect.php');

	//Login part
	if (isset($_POST['btnlogin'])) 
	{
		$userName = mysqli_real_escape_string($conn, $_POST['username']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
	  
		if (empty($userName)) 
		{
			array_push($errors, "Email field is empty");
		}
		if (empty($password)) 
		{
			array_push($errors, "Password field is empty");
		}
	  
		if (count($errors) == 0) 
		{
			$password = md5($password);
			$query = "SELECT * FROM user_table WHERE userName='$userName' AND password='$password'";
			$results = mysqli_query($conn, $query);

			if (mysqli_num_rows($results) > 0) 
			{
				$r = mysqli_fetch_array($results);
				$_SESSION['login'] = true;
				$_SESSION['username'] = $r['userName'];
				$_SESSION['email'] = $r['userEmail'];
				$_SESSION['id'] = $r['userID'];
				$_SESSION['role'] = $r['role'];

				echo $_SESSION['username'];

				if(isset($_SESSION['id']))
				{
					if($_SESSION['role'] == "Quality Assurance Coordinator" || $_SESSION['role'] == "Quality Assurance Manager")
					{
						header('location: Admin_Dashboard.php');
					}
					else if ($_SESSION['role'] == "Staff")
					{
						header('location: Homepage.php');
					}
					else
					{
						header('location: Login.php');
					}
				}
			}
			else
			{
				array_push($errors, "⚠️ Wrong email/password combination ⚠️");
			}
		}
	}
?>