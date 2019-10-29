<?php 
	$API_LINK = "https://dev.virtualearth.net/REST/v1/Routes/DistanceMatrix?";
	$ORIGINS = [];
	$DESTINATIONS = [];
	$TRAVELMODE = "driving";
	$DISTANCEUNIT = "mile";
	$TIMEUNIT = "minutes";
	$KEY = "AiKAKDW9tBPqXGAKib1npZzJzP305y7txoyY--dmYv8KrvAYWJsjzytG9gUDGzaY";

	// ADDS AN ORIGIN DATA TO THE URL ARGUMENT: EVEN LIST
	function api_addOrigin($origin_list){
		global $ORIGINS,$DESTINATIONS,$TIMEUNIT,$TRAVELMODE,$KEY,$API_LINK;
		if(count($origin_list)%2){
			return false;
		}
		$ORIGINS = array_merge($ORIGINS,$origin_list);
		return true;
	}

	// ADDS A DESTINATION DATA TO THE URL ARGUMENT:EVEN LIST
	function api_addDestination($destination_list){
		global $ORIGINS,$DESTINATIONS,$TIMEUNIT,$TRAVELMODE,$KEY,$API_LINK;
		if(count($destination_list)%2){
			return false;
		}
		$DESTINATIONS = array_merge($DESTINATIONS,$destination_list);
		return true;
	}

	// SET THE TRAVEL MODE ARGUMENT : STRING
	function api_setTravelMode($travel_mode){
		global $ORIGINS,$DESTINATIONS,$TIMEUNIT,$TRAVELMODE,$KEY,$API_LINK;
		$TRAVELMODE = $travel_mode;
	}

	// SET THE DISTANCE UNIT ARGUMENT: STRING
	function api_setDistanceUnit($distance_unit){
		global $ORIGINS,$DESTINATIONS,$TIMEUNIT,$TRAVELMODE,$KEY,$API_LINK;
		$DISTANCEUNIT = $distance_unit;
	}

	// SET THE TIME UNIT ARGUMENT: STRING
	function api_setTimeUnit($time_unit){
		global $ORIGINS,$DESTINATIONS,$TIMEUNIT,$TRAVELMODE,$KEY,$API_LINK;
		$TIMEUNIT = $time_unit;
	}

	// SET THE KEY FOR THE REQUEST ARGUMENT:STRING
	function api_setKey($api_key){
		global $ORIGINS,$DESTINATIONS,$TIMEUNIT,$TRAVELMODE,$KEY,$API_LINK;
		$KEY = $api_key;
	}

	
	function api_buildApiRequest(){
		global $ORIGINS,$DESTINATIONS,$TIMEUNIT,$TRAVELMODE,$KEY,$API_LINK,$DISTANCEUNIT;
		// FORMAT API STRING
		for ($i=1; $i < count($DESTINATIONS); $i++) { 
			if($i%2){

			}else{
				$DESTINATIONS[$i] = ";" . $DESTINATIONS[$i];
			}
		}
		$origin_str = join($ORIGINS,',');
		$dest_str = join($DESTINATIONS,',');
		$url = "https://dev.virtualearth.net/REST/v1/Routes/DistanceMatrix?origins=$origin_str&destinations=$dest_str&distanceUnit=$DISTANCEUNIT&travelMode=$TRAVELMODE&timeUnit=$TIMEUNIT&key=$KEY";
		$API_LINK = $url;
		return $API_LINK;
	}

	function cmp($a, $b) {
	    if ($a == $b) {
	        return 0;
	    }
	    return ($a->travelDistance < $b->travelDistance) ? -1 : 1;
	}

?>