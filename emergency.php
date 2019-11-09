<?php
	include("db.php");
	include("models/distance_api_mod.php");
	include("models/paramedic_stations.php");
	include("models/users.php");

	function distance($lat1, $lon1, $lat2, $lon2, $unit) {
	  if (($lat1 == $lat2) && ($lon1 == $lon2)) {
	    return 0;
	  }
	  else {
	    $theta = $lon1 - $lon2;
	    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	    $dist = acos($dist);
	    $dist = rad2deg($dist);
	    $miles = $dist * 60 * 1.1515;
	    $unit = strtoupper($unit);

	    if ($unit == "K") {
	      return ($miles * 1.609344);
	    } else if ($unit == "N") {
	      return ($miles * 0.8684);
	    } else {
	      return $miles;
	    }
	  }
	}
// GET PARAMETERS FROM REQUEST
	// number,password,

	// Nature of accident
	//fire, electricity,bloody,pregnancy,pandemic,natural disaster)
	// number of people involved
	// Accident Priority()
	// high,low,moderate

	// Picture

	// Location
	$a = new User();
	$ret = $a->authenticateByUstr($con,$_POST["token"]);
	if($ret == 1){

	}else{
		header('Content-type: application/json');
        	$RET_DATA = ['success'=>0, 'desc'=>'invalid or wrong token'];
	    	echo json_encode($RET_DATA);
        	return;
	}
	$__NOA = $_POST["nature_of_accident"];
	$__NOPI = $_POST["number_of_people_involved"] * 1;
	$__AP = $_POST["accident_priority"];
	$__LAT = $_POST["latitude"] * 1;
	$__LON = $_POST["longitude"] * 1;
	$__FILENAME = "";
// GETTING FILE
	$target_path = getcwd() . "/" . "emergency_images/";

	$__FILENAME = sha1(date("Y-m-d_h:i:sa"). $a->phone . basename( $_FILES['image']['name']));
	$target_path = $target_path . $__FILENAME.".".strtolower(pathinfo(basename( $_FILES['image']['name']),PATHINFO_EXTENSION));
	// echo $target_path;
	if(move_uploaded_file($_FILES['image']['tmp_name'], $target_path)){

	}else{
		echo "image upload failed\n\n";
	}
	$_ = new Station();
	$all_stations = $_->getAll($con);
	// print_r($all_stations);
	$my_orig = [];
	$my_dest = [];
	array_push($my_orig,$__LAT,$__LON);
	$min_distance = 9999999999;
	$min_index = -1;
	for ($i=0; $i < count($all_stations); $i++) { 
// 		array_push($my_dest,$all_stations[$i]->latitude,$all_stations[$i]->longitude);
		$miles = distance($__LAT, $LON, $all_stations[$i]->latitude, $all_stations[$i]->longitude, "miles");
		if($miles < $min_distance){
			$min_index = $i;
			$min_distance = $miles;
		}
	}
	
// 	185mph
// 	1hour = 185 miles;
// 	?     = x;
// 	s = d/t
// 	185 = $miles/x
// 	185 * x = $miles
// 	x = $miles/185
	$time_t = $miles / 185.00;
	$time_t = $time_t/60.00;
	
	$RET_DATA = array(
		'success'=>1,
		"longitude"=>(float)$all_stations[$min_index]->longitude,
		"latitude"=>(float)$all_stations[$min_index]->latitude,
		"travelDistance"=>(float)$miles,
		"travelDuration"=>(float)$time_t,
		"distanceUnit"=>"miles",
		"durationUnit"=>"minutes",
		"desc"=>"ok"
	);
	
	echo json_encode($RET_DATA);
	
	
	
/*
	// MAKE CALLS TO DISTANCE MODED_API
	api_addOrigin($my_orig);
	api_addDestination($my_dest);
	$url_str = api_buildApiRequest();
	$url_str = str_replace(",;",";",$url_str);

	// SEND REQUEST FOR DISTANCE MATRIX
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url_str);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	$data = curl_exec($ch);
	curl_close($ch);
	// print($data);
	$decoded_data = json_decode($data);
	$decoded_data = $decoded_data->resourceSets[0]->resources[0]->results;
	uasort($decoded_data, 'cmp');
	//print_r($decoded_data);
	$nearest_station = $all_stations[$decoded_data[0]->destinationIndex];
	//PREPARE RETURN DATA
	$RET_DATA = array(
		'success'=>1,
		"longitude"=>(float)$nearest_station->longitude,
		"latitude"=>(float)$nearest_station->latitude,
		"travelDistance"=>$decoded_data[0]->travelDistance,
		"travelDuration"=>$decoded_data[0]->travelDuration,
		"distanceUnit"=>"miles",
		"durationUnit"=>"minutes",
		"desc"=>"ok"
	);
	echo json_encode($RET_DATA);
	echo "<br>";
	echo $url_str;
	
	*/
?>
