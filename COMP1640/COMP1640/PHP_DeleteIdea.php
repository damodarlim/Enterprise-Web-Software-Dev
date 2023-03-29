<?php

    include('includes/dbconnect.php');
    if(isset($_POST['btndelete']))
    {
        if($_SESSION['role'] == "Quality Assurance Manager" || $_SESSION['role'] == "Quality Assurance Coordinator")
        {
            // get id to delete
            $getID = $_POST['btndelete'];
            $deleteQuery = "DELETE FROM idea_table where ideaID = '$getID'";
            $deleteQuery2 = "DELETE FROM document_table where ideaID = '$getID'";
            $deleteQuery3 = "DELETE FROM like_table where ideaID = '$getID'";
            $deleteQuery4 = "DELETE FROM comment_table where ideaID = '$getID'";
            $result = mysqli_query($conn, $deleteQuery);
            $result2 = mysqli_query($conn, $deleteQuery2);
            $result3 = mysqli_query($conn, $deleteQuery3);            
            $result3 = mysqli_query($conn, $deleteQuery4); 

            if($result || $result2 || $result3 || $result4 )
            {
                echo '<script>alert("Idea deleted.")</script>';
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