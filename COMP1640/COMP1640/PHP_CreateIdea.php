<?php
    include ('includes/dbconnect.php');
    if(isset($_POST['btncreate']))
    {
        //For Idea
        $ideaTitle = mysqli_real_escape_string($conn, $_POST['ideaTitle']);
        $ideaDesc = mysqli_real_escape_string($conn, $_POST['ideaDesc']);
        $ideaTopic = mysqli_real_escape_string($conn, $_POST['ideaTopic']);
        $ideaTnc = $_POST['ideaTnc'];
        $userID= $_POST['btncreate'];
        if(isset($_POST['ideaAnoymous']))
        {
            $ideaAnnoymous = "1";
        }
        else
        {
            $ideaAnnoymous = "0";
        }

        //get all data from topic_table by topic
        $getCateId = "SELECT * FROM topic_table AS t LEFT JOIN category_table AS c ON 
        t.cateID = c.cateID WHERE topicID='$ideaTopic'";
        $resultsGetCateId = mysqli_query($conn,$getCateId);

        if(mysqli_num_rows($resultsGetCateId) > 0)
        {
            $r_Cate = mysqli_fetch_array($resultsGetCateId);
            $ideaCate = $r_Cate['cateID'];
            $ideaTopic = $r_Cate['topicID'];
            $ideaStartDate = $r_Cate['startDate'];
            $ideaEndDate = $r_Cate['endDate'];
            $ideaFinalDate = $r_Cate['finalClosureDate'];
        }
        $getAllCoordinatorQuery = "SELECT * FROM user_table WHERE role='Quality Assurance Coordinator'";
        $executeGAUQ = mysqli_query($conn, $getAllCoordinatorQuery);

        //Idea insert SQL
        $insertToIdeaSQL = "INSERT INTO `idea_table`(`ideaTitle`,`ideaDesc`,`agreeTnc`,`cateID`,
        `userID`, `startDate`, `endDate`, `finalClosureDate`, `anoymous`, `topicID`) VALUES ('$ideaTitle',
        '$ideaDesc','$ideaTnc','$ideaCate','$userID','$ideaStartDate','$ideaEndDate',
        '$ideaFinalDate', '$ideaAnnoymous', '$ideaTopic')";
        echo $insertToIdeaSQL;
        //For Doc
        $target_dir = "Document/";
        $fileNames = array_filter($_FILES['uploadFile']['name']);
        $fileTypeAllowed = array("mp4","avi","mov","mpeg","jpg","png","pdf");
        $total = count($_FILES["uploadFile"]["name"]);
        //if any document uploaded

        if(!empty($fileNames))
        {
            //Make sure content not empty
            if(!empty($ideaTitle) && !empty($ideaDesc) && !empty($ideaTopic) && !empty($ideaTnc))
            {   
                $saveIdea = mysqli_query($conn,$insertToIdeaSQL);
                
                if($saveIdea)
                {
                    while($getUser = mysqli_fetch_array($executeGAUQ))
                    {
                        //Email to coordinator
                        $to = $getUser['userEmail'];
                        $email = $_SESSION['email'];
                        $submitBy = $_SESSION['username'];
                        $subject = "New Idea received";

                        $message = "
                        A new idea is submitted by $submitBy.    
                        ";
                        
                        $sender = "From: system <superadmin@comp1640.com>";

                        if(mail($to, $subject, $message, $sender))
                        {
                            $success = 1;
                        }
                        else
                        {
                            $success = 0;
                        }   
                    }

                    if($success = 1)
                    {
                        echo '<script>alert("Idea Created Successfully")</script>';
                        echo "<script>window.location='Homepage.php'</script>";
                        header("Refresh:0");
                    }
                    else if ($success = 0)
                    {
                        echo '<script>alert("Fail to Create Idea")</script>';
                        echo "<script>window.location='Homepage.php'</script>";

                    }
                }
            }

            //loop through each file
            for($i=0 ; $i < $total ; $i++)
            {
                $tmpFilePath = $_FILES['uploadFile']['tmp_name'][$i];
                
                //make sure file is not null
                if ($tmpFilePath != "")
                {
                    //Setup new file path
                    $newFilePath = $target_dir . $_FILES['uploadFile']['name'][$i];

                    /* No Used
                    $fileType = strtolower(pathinfo($newFilePath,PATHINFO_EXTENSION));
                    $fileValidation = in_array($fileType,$fileTypeAllowed);
                    
                    //check file type
                    if(!$fileValidation)
                    {
                        echo '<script>alert("Invalid File Type!")</script>';
                    }
                    */
                    
                    //Upload the file into the temp dir
                    if(move_uploaded_file($tmpFilePath, $newFilePath)) 
                    {
                        //get file name
                        $fileName = $_FILES['uploadFile']['name'][$i];
                        $sqlGetLatestIdeaID = "SELECT ideaID FROM idea_table ORDER BY ideaID DESC LIMIT 1";
                        $executeQuery = mysqli_query($conn, $sqlGetLatestIdeaID);
                        $getIDRow = mysqli_fetch_assoc($executeQuery);
                        $getID = $getIDRow['ideaID'];
                        $insertToDocSQL = "INSERT INTO `document_table`(`docID`,`docName`,
                        `docPath`,`ideaID`) VALUES ('','$fileName', '$target_dir','$getID')";

                        if(mysqli_query($conn,$insertToDocSQL))
                        {
                            
                        }
                    }
                }
            }
        }

        //If no document uploaded
        else if (empty($fileNames))
        {
            //Make sure content not empty
            if(!empty($ideaTitle) && !empty($ideaDesc) && !empty($ideaTopic) && !empty($ideaTnc))
            {   
                $saveIdea = mysqli_query($conn,$insertToIdeaSQL);
                
                if($saveIdea)
                {
                    while($getUser = mysqli_fetch_array($executeGAUQ))
                    {
                        //Email to coordinator
                        $to = $getUser['userEmail'];
                        $email = $_SESSION['email'];
                        $submitBy = $_SESSION['username'];
                        $subject = "New Idea received";

                        $message = "
                        A new idea is submitted by $submitBy.    
                        ";
                        
                        $sender = "From: system <superadmin@comp1640.com>";

                        if(mail($to, $subject, $message, $sender))
                        {
                            $success = 1;
                        }
                        else
                        {
                            $success = 0;
                        }   
                    }

                    if($success = 1)
                    {
                        echo '<script>alert("Idea Created Successfully")</script>';
                        echo "<script>window.location='Homepage.php'</script>";

                        header("Refresh:0");
                    }
                    else if ($success = 0)
                    {
                        echo '<script>alert("Fail to Create Idea")</script>';
                        echo "<script>window.location='Homepage.php'</script>";

                    }
                }
            }
        }

    }
?>