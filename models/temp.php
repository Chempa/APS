<?php
$target_path = "C:/xampp/htdocs/cms/private/materials/";  
    $target_path = $target_path . md5($_SESSION['selectedcourse'].$title.basename( $_FILES['file']['name'])).".pdf"; 
    if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {  
        $mat = new Material();
        if($mat->create($con,$title,$description,$author,$target_path,$_SESSION['selectedcourse'])){
            $notify = 1;
            $success = 1;
            $message = "  Course material uploaded successfully";
        } else{
            $notify = 1;
            $success = 0;
            $message = "  Course material could not upload, Material title conflict";
        }
    } else{  
        echo "Sorry, file not uploaded, please try again!";  
        $notify = 1;
        $success = 0;
        $message = "  File not uploaded, please try again";
    }

?>