<?php
	include("db.php");
    
	include("models/users.php");
    // echo "HELLO";
    // die();
	$a = new User();
	$ret = $a->create($con,$_POST["phone"],$_POST["password"]);
    
	
    if($ret == 1){
        $data = ['success' => 1, 'desc'=>'registration successful'];
        // echo json_encode($data);
    }else{
        if($ret == -1){
            $data = ['success' => -1,'token'=>$a->ustr, 'desc'=>'user is already registered'];
            // echo json_encode($data);
        }else{
            $data = ['success' => 0,'token'=>'null', 'desc'=>'registration failed'];
            
        }
    }
//     header('Content-Type: application/json');
    echo json_encode($data);
?>
