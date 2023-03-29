<?php 
    include ('includes/dbconnect.php'); 
    if(!isset($_SESSION))
    {
        session_start();
    }
    
	if(isset($_POST['btnsend']))
	{
		$userEmail=$_POST['email'];
		
		$sql = "SELECT * FROM user_table WHERE userEmail = '$userEmail'";
		$res = mysqli_query($conn, $sql);

		if (mysqli_num_rows($res) > 0)
		{
			$to = $userEmail;
			$subject = "Reset Password";

			$hash = md5( rand(0,1000) );
			$_SESSION['VerifyCode'] = $hash;

			$message = "
			Reset Password Link: http://localhost:8080/COMP1640/Assignment/COMP1640/PHP_ResetPassword.php?email=$userEmail&hash=$hash    
			";
			$from = "From: system <superadmin@comp1640.com>";

			if (mail($to,$subject,$message,$from))
			{
				echo "<script>alert('Link for reset password has been sent to the email address')</script>";
			}
			else
			{
				echo "<script>alert('Error')</script>";
			}
		}
		else
		{
			echo "<script>alert('Account Does Not Exist')</script>";
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
                                        <h1 class="h4 text-gray-900 mb-4">Forget Password</h1>
                                    </div>
                                    <div id="forgetpw">
										<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
											<p id="label">Email Address</p>
											<input style="margin:20px 0 20px 0;" required type="email" class="form-control form-control-user" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" maxlength="50" placeholder="xxxxx@xxx.xxx"/>
											<button type="submit" class="btn btn-primary btn-user btn-block" name="btnsend">Send</button>
										</form>
									</div>
									<hr>
                                    <div class="text-center">
                                        <a class="small" href="Login.php">Back to login</a>
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