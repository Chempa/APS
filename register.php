<?php
	include("db.php");
	include("models/users.php"); 
	$a = new User();
	$ret = $a->create($con,$_POST["phone"],$_POST["password"]);
    if($ret == 1){
        $data = ['success' => 1, 'token'=>$a->ustr,'desc'=>'registration successful'];
    }else{
	$data = ['success' => 0,'desc'=>'registration failed, user already registered'];
    }
    echo json_encode($data);
?>
