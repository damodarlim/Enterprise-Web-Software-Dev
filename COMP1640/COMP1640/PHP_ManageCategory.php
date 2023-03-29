<?php
    
    include('includes/dbconnect.php');

    if(isset($_POST['btnaddcate']))
    {
        if($_POST['cateName'] != '')
        {
            $categoryName = $_POST['cateName'];
            $userID = $_SESSION['id'];
            $sql = "INSERT INTO category_table (`cateName`, `userID`) VALUES ('$categoryName', '$userID') ";

            if(mysqli_query($conn, $sql))
            {
                echo '<script>alert("Added successfully")</script>';
                header("refresh:0");
            }

            else
            {
                echo '<script>alert("Fail to add category")</script>';
            }
        }
        else
        {
            echo '<script>alert("Please enter a category name")</script>';
        }
    }

    if(isset($_POST['btndelcate']))
    {
        $cateID = $_POST['btndelcate'];
        
        $selectSQL = "SELECT * FROM category_table WHERE cateID = $cateID";
        $getAll = mysqli_query($conn, $selectSQL);

        $checkCate = false;
        if (mysqli_num_rows($getAll) > 0) 
        {
            while($cate = mysqli_fetch_assoc($getAll)) 
            {
                $deleteCate = $cate['cateID'];
                $checkCategoryInIdea = "SELECT * FROM idea_table WHERE cateID = $deleteCate";
                $checkCateResult = mysqli_query($conn, $checkCategoryInIdea);
                
                if (mysqli_num_rows($checkCateResult) > 0) 
                {
                    $checkCate = true;
                }
            }
        }

        if($checkCate == false)
        {
            $sql_delete = "DELETE FROM category_table WHERE cateID= '$cateID'";
            mysqli_query($conn, $sql_delete);
            echo "<script>alert('Category deleted successfully');
            window.location.href='Idea_Management.php';</script>";
            //header("refresh :0");
        }

        else
        {
            echo "<script>alert('Category cannot be deleted because existing idea is using this category')</script>";
        }
    }

?>