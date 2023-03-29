<?php

    include('includes/dbconnect.php');
    if(isset($_POST['delete']))
    {
        if($_SESSION['delete'] == "Quality Assurance Manager" || $_SESSION['role'] == "Quality Assurance Coordinator")
        {
            // get id to delete
            $getID = $_POST['btndelete'];
            $deleteQuery = "DELETE FROM user_table where userID = '$getID'";
            $result = mysqli_query($conn, $deleteQuery);

            if($result)
            {
                echo '<script>alert("Staff deleted.")</script>';
                header("Refresh:0");
            }
            else
            {
                echo '<script>alert("Error")</script>';
            }
        }
        else
        {
            echo '<script>alert("You are not authorized to delete the idea")</script>';
        }
    }
?>