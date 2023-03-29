<?php
    include('PHP_GetDataFromDb.php');
?>

<?php
//Fetch records from database 
$query = $conn->query("SELECT * FROM idea_table AS i
LEFT JOIN category_table AS c ON i.cateID = c.cateID
LEFT JOIN user_table AS u ON i.userID = u.userID 
LEFT JOIN topic_table AS t ON i.topicID = t.topicID"); 
 
if($query->num_rows > 0){ 
    $delimiter = ","; 
    $filename = "Ideas-Data_" . date('d/m/Y') . ".csv"; 
     
    //Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    //Set column headers 
    $fields = array('Idea ID', 'Topic', 'Title', 'Description', 'Category', 'User Name', 'Start Date', 'End Date', 'Final Closure Date', 'TnC'); 
    fputcsv($f, $fields, $delimiter);

    // Output each row of the data, format line as csv and write to file pointer 
    while($row = $query->fetch_assoc()){
        $status = ($row['agreeTnc'] == 1)?'Agree':'Disagree'; 
        $lineData = array($row['ideaID'], $row['topicName'], $row['ideaTitle'], $row['ideaDesc'], 
        $row['cateName'], $row['userName'], $row['department'], $row['startDate'], $row['endDate'], 
        $row['finalClosureDate'], $status); 
        fputcsv($f, $lineData, $delimiter); 
    }
     
    //Move back to beginning of file 
    fseek($f, 0); 
     
    //Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //Output all remaining data on a file pointer 
    fpassthru($f); 
} 
exit;
?>