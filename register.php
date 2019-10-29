<?php
	include("db.php");
    
	include("models/users.php");
    // echo "HELLO";
    // die();
	$a = new User();
	$ret = $a->create($con,$_POST["phone"],$_POST["password"]);
    
	
    if($ret == 1){
        $data = ['SUCCESS' => 1];
        // echo json_encode($data);
    }else{
        if($ret == -1){
            $data = ['SUCCESS' => -1,'token'=>$a->ustr];
            // echo json_encode($data);
        }else{
            $data = ['SUCCESS' => 0,'token'=>'null'];
            
        }
    }
    header('Content-Type: application/json');
    echo json_encode($data);
?>