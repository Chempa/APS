<?php
	include("db.php");
	include("models/users.php");
	$a = new User();
	$ret = $a->authenticate($con,$_POST["phone"],$_POST["password"]);

    // header('Content-type: application/json');
    $data = [];
    if($ret == 1){
        // MY METHOD
        // $data = ['success' => 1 ,'token'=>$a->ustr];

        // ALTERNATE METHOD
        $data['success'] = 1;
        $data['token'] = $a->ustr;
	$data['desc'] = 'login successful';
    }else{
        // MY METHOD
        // $data = ['success' => 0 ,'token'=>'null'];
        
        // ALTERNATE METHOD
        $data['success'] = 0;
        $data['token'] = "";
	$data['desc'] = 'login failed';
    }
	echo json_encode($data);
?>
