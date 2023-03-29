<?php
    if(!isset($_SESSION))
    {
		session_start();
	}

    include("includes/dbconnect.php");

    if(isset($_POST['action']))
    {
        $idea_id = $_POST['idea_id'];
        $action = $_POST['action'];
        $user_id = $_SESSION['id'];
        $sql_chk = "SELECT * FROM like_table WHERE ideaID = $idea_id AND userID = $user_id";
        $result = mysqli_query($conn, $sql_chk);

        switch ($action) 
        {
            case 'like':
			    if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) 
                    {
                        if($row['likeDislike'] == "dislike")
                        {
                            $sql2="DELETE FROM like_table WHERE userID=$user_id AND ideaID=$idea_id";
                            mysqli_query($conn, $sql2);
                        }
                    }
                    $sql="INSERT INTO like_table (likeID, userID, ideaID, likeDislike) 
                    VALUES ('', $user_id, $idea_id, 'like')
                    ON DUPLICATE KEY UPDATE likeDislike='like'";
                    mysqli_query($conn, $sql);
                }
                else
                {
                    $sql="INSERT INTO like_table (likeID, userID, ideaID, likeDislike) 
                    VALUES ('', $user_id, $idea_id, 'like')
                    ON DUPLICATE KEY UPDATE likeDislike='like'";
                    mysqli_query($conn, $sql);
                }
                break;

            case 'dislike':
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result))
                    {
                        if($row['likeDislike'] == "like")
                        {
                            $sql2="DELETE FROM like_table WHERE userID=$user_id AND ideaID=$idea_id";
                            mysqli_query($conn, $sql2);
                        }
                    }
                    $sql="INSERT INTO like_table (likeID, userID, ideaID, likeDislike) 
                    VALUES ('', $user_id, $idea_id, 'dislike')
                    ON DUPLICATE KEY UPDATE likeDislike='dislike'";
                    mysqli_query($conn, $sql);
                }
                else
                {
                    $sql="INSERT INTO like_table (likeID, userID, ideaID, likeDislike) 
                    VALUES ('', $user_id, $idea_id, 'dislike')
                    ON DUPLICATE KEY UPDATE likeDislike='dislike'";
                    mysqli_query($conn, $sql);
                }
                break;

            case 'unlike':
                if (mysqli_num_rows($result) == 0) 
                {
                    $sql="DELETE FROM like_table WHERE userID=$user_id AND ideaID=$idea_id";
                    mysqli_query($conn, $sql);
                    break;
                }

            case 'undislike':
                  $sql="DELETE FROM like_table WHERE userID=$user_id AND ideaID=$idea_id";
                  mysqli_query($conn, $sql);
            break;

            default:
                break;
        }

        
        //return number of likes
        echo getRating($idea_id);
        exit(0);
    }

    // Get particular idea data
    function getIdea($ideaID)
    {
        global $conn;
        $idea_id = $_GET['id'];
        $query = "SELECT * FROM idea_table AS i INNER JOIN user_table AS u ON i.userID = u.userID
        WHERE ideaID='$idea_id'";
        $result = mysqli_query($conn, $query);
        $Ideas = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        return $Ideas;
    }

    // Get total number of likes for a particular post
    function getLikes($id)
    {
        global $conn;
        $sql = "SELECT COUNT(*) FROM like_table
                WHERE ideaID = $id AND likeDislike='like'";
        $rs = mysqli_query($conn, $sql);
        $result = mysqli_fetch_array($rs);
        return $result[0];
    }

    // Get total number of dislikes for a particular post
    function getDislikes($id)
    {
        global $conn;
        $sql = "SELECT COUNT(*) FROM like_table
                WHERE ideaID = $id AND likeDislike='dislike'";
        $rs = mysqli_query($conn, $sql);
        $result = mysqli_fetch_array($rs);
        return $result[0];
    }

    function userLiked($idea_id)
    {
        global $conn;
        $user_id = $_SESSION['id'];

        $sql = "SELECT * FROM like_table WHERE userID=$user_id 
                AND ideaID=$idea_id AND likeDislike='like'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    // Check if user already dislikes post or not
    function userDisliked($idea_id)
    {
        global $conn;
        $user_id = $_SESSION['id'];
        $sql = "SELECT * FROM like_table WHERE userID=$user_id 
                AND ideaID=$idea_id AND likeDislike='dislike'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function getRating($id)
    {
        global $conn;
        $rating = array();
        $likes_query = "SELECT COUNT(*) FROM like_table WHERE ideaID = $id AND likeDislike='like'";
        $dislikes_query = "SELECT COUNT(*) FROM like_table 
                            WHERE ideaID = $id AND likeDislike='dislike'";
        $likes_rs = mysqli_query($conn, $likes_query);
        $dislikes_rs = mysqli_query($conn, $dislikes_query);
        $likes = mysqli_fetch_array($likes_rs);
        $dislikes = mysqli_fetch_array($dislikes_rs);
        $rating = [
            'likes' => $likes[0],
            'dislikes' => $dislikes[0]
        ];
        return json_encode($rating);
    }

?>