<?php
    if(!isset($_SESSION))
    {
		session_start();
	}
    
    require_once('includes/dbconnect.php');
    $userID = $_SESSION['id'];
    $ideaID = $_SESSION['idea_id'];

    if (isset($_POST['submit_comment'])) 
    {
        global $conn;
        // grab the comment that was submitted through Ajax call
        $commentContent = $_POST['commentContent'];
        // insert comment into database
        $sql = "INSERT INTO comment_table (commentID, commentContent, ideaID, userID, dateTime) VALUES ('', '$commentContent', '$ideaID', '$userID', now())";
        $result = mysqli_query($conn, $sql);

            //Get user email that posted the idea
            $select = "SELECT userName, userEmail from idea_table AS i INNER JOIN user_table AS u ON i.userID = u.userID
            WHERE ideaID='$ideaID'";
            $results = mysqli_query($conn, $select);
            $userEmail = mysqli_fetch_assoc($results);

            $to = $userEmail['userEmail'];
            $commented_user = $_SESSION['username'];
            $subject = "New Comment to your idea";

            $message = "
            A new comment is commented by $commented_user.
            ";
            
            $sender = "From: system <superadmin@comp1640.com>";
            mail($to, $subject, $message, $sender);
            if (mail($to,$subject,$message,$sender))
            {
                echo "<script>alert('Comment Posted Successful');</script>";

            }
            else
            {
                echo "<script>alert('Comment Posted Fail');</script>";
            }
            mysqli_close($conn);
            echo "<script>window.location='ideaDetail.php?id=$ideaID'</script>";
    }
    else 
    {
        echo "<script>alert('Comment Posted Fail');</script>";
        exit();
    }
    
?>