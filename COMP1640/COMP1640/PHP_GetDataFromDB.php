<?php
//-----------------------------------------Get Idea Part-----------------------------------------
    include('includes/dbconnect.php');
    //get all idea to show
    
    $getIdeaQuery = "SELECT * FROM idea_table AS i INNER JOIN category_table AS c ON i.cateID = c.cateID
    INNER JOIN user_table AS u ON i.userID = u.userID INNER JOIN topic_table AS t ON i.topicID = t.topicID ORDER BY ideaID DESC";
    $getIdea = mysqli_query($conn, $getIdeaQuery);
    $showIdeas = mysqli_fetch_all($getIdea, MYSQLI_ASSOC);

//-----------------------------------------Get Staff Part-----------------------------------------

$getStaffQuery = "SELECT * FROM user_table";
$getStaff = mysqli_query($conn, $getStaffQuery);
$showStaff = mysqli_fetch_all($getStaff, MYSQLI_ASSOC);

//-----------------------------------------Get Category Part-----------------------------------------
    $getAllCategory = "SELECT * FROM category_table";
    $getCategory = mysqli_query($conn, $getAllCategory);
    $showCategory = mysqli_fetch_all($getCategory, MYSQLI_ASSOC);

//-----------------------------------------Get Topic Part-----------------------------------------
    $getAllTopic = "SELECT * FROM topic_table WHERE endDate >= now()";
    $getTopic = mysqli_query($conn, $getAllTopic);
    $showTopic = mysqli_fetch_all($getTopic, MYSQLI_ASSOC);

//-----------------------------------------Statistic-----------------------------------------
$sql_a="SELECT count(ideaID) AS totalIdea FROM idea_table INNER JOIN category_table ON idea_table.cateID = category_table.cateID
INNER JOIN user_table ON idea_table.userID = user_table.userID";
$result = mysqli_query($conn,$sql_a);

if(mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_array($result))
    {
        $all=$row['totalIdea'];
    }
}

$sql_b="SELECT * FROM idea_table INNER JOIN category_table ON idea_table.cateID = category_table.cateID
INNER JOIN user_table ON idea_table.userID = user_table.userID WHERE department = 'Bursary'";
 $result = mysqli_query($conn,$sql_b);

if(mysqli_num_rows($result) > 0)
{
    $bursary=mysqli_num_rows($result);
    $bursary_p=number_format(($bursary/$all)*100,1);
    mysqli_free_result($result);
}

$sql_i="SELECT * FROM idea_table INNER JOIN category_table ON idea_table.cateID = category_table.cateID
INNER JOIN user_table ON idea_table.userID = user_table.userID WHERE department = 'Information Technology'";
 $result = mysqli_query($conn,$sql_i);

if(mysqli_num_rows($result) > 0)
{
    $it=mysqli_num_rows($result);
    $it_p=number_format(($it/$all)*100,1);
    mysqli_free_result($result);
}

$sql_s="SELECT * FROM idea_table INNER JOIN category_table ON idea_table.cateID = category_table.cateID
INNER JOIN user_table ON idea_table.userID = user_table.userID WHERE department = 'Student Affair'";
 $result = mysqli_query($conn,$sql_s);

if(mysqli_num_rows($result) > 0)
{
    $stu=mysqli_num_rows($result);
    $stu_p=number_format(($stu/$all)*100,1);
    mysqli_free_result($result);
}

$sql_b="SELECT * FROM idea_table INNER JOIN category_table ON idea_table.cateID = category_table.cateID
INNER JOIN user_table ON idea_table.userID = user_table.userID WHERE department = 'Business'";
 $result = mysqli_query($conn,$sql_b);

if(mysqli_num_rows($result) > 0)
{
    $busi=mysqli_num_rows($result);
    $busi_p=number_format(($busi/$all)*100,1);
    mysqli_free_result($result);
}

$sql_t="SELECT * FROM idea_table INNER JOIN category_table ON idea_table.cateID = category_table.cateID
INNER JOIN user_table ON idea_table.userID = user_table.userID WHERE department = 'Tourism and Hospitality Management'";
$result = mysqli_query($conn,$sql_t);

if(mysqli_num_rows($result) > 0)
{
    $tour=mysqli_num_rows($result);
    $tour_p=number_format(($tour/$all)*100,1);
    mysqli_free_result($result);
}
?>