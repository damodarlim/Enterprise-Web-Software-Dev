<?php
include('PHP_Login.php');
?>
<!DOCTYPE html>
<html>  
    
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>Login Page</title>
<!-- Custom fonts for this template-->
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>
    <body style="background-image: url(img/background.jpg); background-size: cover;background-position: center;" >
     
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9" style="opacity: 0.9;">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <div style="margin:20px 0 20px 0;">
                                        <a href="Homepage.php">&#8592 Back to Homepage</a>
                                    </div>
                                    <form class="user" method="post">
                                    <?php
                                            if (count($errors) > 0) :
                                        ?>
                                        <div class="text-center bg-danger" id="errorMsg">
                                            <?php foreach ($errors as $error) : ?>
                                                <p id="errorMsg2"><?php echo $error ?></p>
                                            <?php endforeach ?>
                                        </div>
                                        <?php
                                            endif
                                        ?>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                name="username" aria-describedby="emailHelp"
                                                placeholder="Enter Username" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                name="password" placeholder="Password" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block" name="btnlogin" >Log In</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="Forget_Password.php">Forgot Password?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <style>
        #errorMsg{
            margin: 0 0 20px 0;
            border-radius: 10rem;
            color:yellow;
            font-size:20px;
            padding:4px;
        }
    </style>

<?php
include('includes/scripts.php');
?>

</body>
  
</html>

