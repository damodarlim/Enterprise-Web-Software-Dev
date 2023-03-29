<?php 
    if(!isset($_SESSION))
    {
		session_start();
	}

    if (isset($_GET['logout'])) 
    {
        session_destroy();
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        unset($_SESSION['id']);
        unset($_SESSION['role']);
        header("location: Homepage.php");
    }
?>