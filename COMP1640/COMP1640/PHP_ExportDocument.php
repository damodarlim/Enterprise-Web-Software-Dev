<?php
    include('includes/dbconnect.php');

    if(extension_loaded('zip'))  
    {       
        $query = $conn->query("SELECT * FROM document_table"); 

        $zip = new ZipArchive(); // Load zip library   
        $zip_name = time()."_Document.zip";// Zip name 

        if($zip->open($zip_name, ZIPARCHIVE::CREATE)!==TRUE)  
        {   
                // Opening zip file to load files  
                echo("<script>alert('Sorry ZIP creation failed at this time');</script>");
        }  
        while($row = $query->fetch_assoc())
        {
            $zip->addFile($row['docPath'].$row['docName'], $row['docName']);
        }
        if(file_exists($zip_name))  
        {  
                // push to download the zip  
                header('Content-type: application/zip');  
                header('Content-Disposition: attachment; filename="'.$zip_name.'";');  
                readfile($zip_name);  
                // remove zip file is exists in temp path  
                unlink($zip_name);  
        }  
        $zip->close();
        echo("<script>alert('Download Successful');</script>");
        echo "<script>window.location='Idea_Management.php'</script>";

    }  
    else  
    {  
        echo("<script>alert('Please select file to zip');</script>");
        echo "<script>window.location='Idea_Management.php'</script>";

    }  
?>