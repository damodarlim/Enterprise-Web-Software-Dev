<?php     
include('includes/dbconnect.php');
?>

<?php
if(isset($_POST['editUser']))
{
	$userid=$_POST['userID'];
	$sql = "SELECT * FROM user_table WHERE userID = '$userid'";

	$res_data = mysqli_query($conn,$sql);
	if (mysqli_num_rows($res_data) > 0){
		while($row = mysqli_fetch_array($res_data)){
			$return_arr[] = array("userName" => $row['userName'], "email" => $row['userEmail'], "contact" => $row['userContact'],"role" => $row['role'], "department" => $row['department']);
		}
		echo json_encode($return_arr);
	}
	else
	{
		echo json_encode("error");
	}
}
?>