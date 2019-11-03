<?php
	include("db.php");
	include("models/users.php");
	$a = new User();
	$data = [];
	$failed = 0;
	if($_POST["phone"] == "" or $_POST["password"] == ""){
		$data['desc'] = 'Empty credentials'; $failed = 1;
	}
	if(strlen($_POST["phone"]) < 10 or strlen($_POST['password']) < 8){
		$data['desc'] = "Invalid Phone number or password";$failed = 1;
	}

	if (!ctype_digit($_POST["phone"])){
		$data['desc'] = 'Invalid Phone number'; $failed = 1;
	}	
	if($failed == 1){
		$data['success'] = -1;
		echo json_encode($data);
		exit();
	}
	
	$ret = $a->authenticate($con,$_POST["phone"],$_POST["password"]);

    // header('Content-type: application/json');
    
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
	$data['desc'] = 'login failed';
    }
	echo json_encode($data);
?>
