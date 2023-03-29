<?php
	include ('includes/dbconnect.php'); 
    if(!isset($_SESSION))
	{
        session_start();
    }

	if(isset($_SESSION['VerifyCorrect']) && $_SESSION['VerifyCorrect'] == true)
	{
		;
	}
	else
	{
		if(!isset($_SESSION['VerifyCode']) || $_GET['hash'] != $_SESSION['VerifyCode'] || !isset($_GET['email']))
		{
			echo "<script>window.location.href='Login.php';</script>";
		}
		else
		{
			$_SESSION['VerifyCorrect'] = true;
			$_SESSION['uemail'] = $_GET['email'];
		}
	}

	if(isset($_POST['confirm']))
	{
		$password = md5($_POST['password']);
		$password2 = md5($_POST['password2']);
		if($password==$password2){
			$userEmail = $_SESSION['uemail'];
			$sql_u = "SELECT * FROM user_table WHERE userEmail = '$userEmail'";

			$stmt_u = mysqli_query($conn, $sql_u);

			if (mysqli_num_rows($stmt_u) > 0) {	
				$sql = "UPDATE user_table SET password='$password' WHERE userEmail='$userEmail'";
			
				if (mysqli_query($conn, $sql)) {
					$_SESSION['VerifyCorrect'] = false;
					$_SESSION['VerifyCode'] = false;
					echo "<script>alert('Password Reset Successful');
					window.location.href='Login.php';</script>";
				} else {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
				mysqli_close($conn);
			}
			else
			{
				echo("<script>alert('Error');</script>");
			}
		}
		else
		{
			echo("<script>alert('Password NOT Match');</script>");
		}
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Forget Password</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body style="background-color: #16a085;">
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Reset Password</h1>
                                    </div>
                                    <div id="forgetpw">
										<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                            <p id="label">Password</p>
                                            <input required type="password" name="password" class="form-control" id="inputPassword" maxlength="50" pattern="(?=.*\d).{8,}" placeholder="Use 8 or more characters with a mix of letters and numbers" title="Use 8 or more characters with a mix of letters and numbers">
                                            <br>
                                            <p id="label">Confirm Password</p>
                                            <input required type="password" name="password2" class="form-control" id="inputRepeatPassword" maxlength="50">
                                            <br>
                                            <button type="submit" class="btn btn-primary btn-user btn-block" name="confirm">Confirm</button>
										</form>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>