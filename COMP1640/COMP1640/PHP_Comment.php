<?php
    if(!isset($_SESSION))
    {
		session_start();
	}
    
    require_once('includes/dbconnect.php');
    $userID = $_SESSION['id'];
    $ideaID = $_SESSION['idea_id'];
    $comment_table_query_result = mysqli_query($conn, "SELECT * FROM comment_table WHERE ideaID='$ideaID'");
	$comments = mysqli_fetch_all($comment_table_query_result, MYSQLI_ASSOC);

    // Receives a user id and returns the username
    function getUsernameById($id)
	{
        global $conn;
		$result = mysqli_query($conn, "SELECT userName FROM user_table WHERE userID='$id' LIMIT 1");
		// return the username
		return mysqli_fetch_assoc($result)['userName'];
	}

    // Receives a comment id and returns the username
    function getRepliesByCommentId($id)
    {
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM comment_table WHERE commentID=$id");
        $replies = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $replies;
    }

    // Receives a post id and returns the total number of comment_table on that post
    function getcomment_tableCountByPostId($commentID)
    {
        global $conn;
        $result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM comment_table");
        $data = mysqli_fetch_assoc($result);
        return $data['total'];
    }

?>