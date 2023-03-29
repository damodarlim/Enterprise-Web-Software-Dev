<?php
    include('includes/dbconnect.php');
    
    if(isset($_POST['btnaddtopic']))
    {
        $topicName = mysqli_real_escape_string($conn, $_POST['topicName']);
        $topicCategory = mysqli_real_escape_string($conn, $_POST['topicCategory']);
        $topicStartDate = date('Y-m-d', strtotime($_POST['startDate']));
        $topicEndDate = date('Y-m-d', strtotime($_POST['endDate']));
        $topicFinalDate = date('Y-m-d', strtotime($_POST['finalDate']));
        $getUserID = $_SESSION['id'];
        $topic_check_query = "SELECT * FROM topic_table WHERE topicName='$topicName' LIMIT 1";
		$result = mysqli_query($conn, $topic_check_query);
		$topic = mysqli_fetch_assoc($result);

		if ($topic) 
		{
            // if topic already exists
			if ($topic['topicName'] === $topicName) 
			{
				echo "<script>alert('This topic already exist')</script>";
			}
        }

        else
        {
            // if date is invalid
            if($topicEndDate < $topicStartDate || $topicFinalDate < $topicStartDate || $topicFinalDate < $topicEndDate)
            {
                echo "<script>alert('The start date, end date, and final closure date is invalid')</script>";
            }

            else
            {
                //get category id by value
                $getCateId = "SELECT cateID FROM category_table WHERE cateID='$topicCategory'";
                $resultsGetCateId = mysqli_query($conn,$getCateId);
                if(mysqli_num_rows($resultsGetCateId) > 0)
                {
                    $r_Cate = mysqli_fetch_array($resultsGetCateId);
                    $topicCate = $r_Cate['cateID'];
                }
                //Idea insert SQL
                $insertToTopicSQL = "INSERT INTO `topic_table`(`topicName`,`cateID`,`userID`,`startDate`,
                `endDate`,`finalClosureDate`) VALUES ('$topicName','$topicCate','$getUserID','$topicStartDate',
                '$topicEndDate','$topicFinalDate')";

                //Make sure content not empty
                if(!empty($topicName) && !empty($topicCategory) && !empty($topicStartDate) && !empty($topicEndDate) && !empty($topicFinalDate))
                {   
                    $saveTopic = mysqli_query($conn,$insertToTopicSQL);
                    
                    if($saveTopic)
                    {
                        echo '<script>alert("Topic Added Successfully")</script>';
                        header("Refresh:0");
                    }
                    else
                    {
                        echo '<script>alert("Fail to Add Topic")</script>';
                    }
                }
            }
        }      
    }
?>