<?php
	/**
	 * Paramedic Station Class
	 add station
	 remove station
	 get station by id
	 get all locations with id's
	 */
	class Station
	{
		
		// constructor for the stations class
		function Station()
		{
			$this->id = 		"";
			$this->name= 		"";
			$this->longitude = 	"";
			$this->latitude= 	"";
			$this->telephone= 	"";
		}


		// A get function to get stations details after finding that station with id "$location_id" is the closest location from the emergency.
		function get($con,$location_id){
			$query = "
				select * from paramedic_stations
				where id = '$location_id'";
			$result = mysqli_query($con,$query) or die(mysql_error());
			$rows = mysqli_num_rows($result);
			$station = new Station();
			if($row = mysqli_fetch_assoc($result)){
				$station->id = $row["id"];
				$station->name= $row["name"];
				$station->longitude = $row["longitude"];
				$station->latitude= $row["latitude"];
				$station->telephone= $row["telephone"];
			}else{
				return NULL;
			}
			return $station;

		}


		// a get function to get stations and use distance matrix to find the distance between emergency and each station. arguments: $con = mysqli connection object; return value: a list of all station data; This will be changed this is just for prototyping.
		function getAll($con){
			$query = "select * from paramedic_stations";
			$result = mysqli_query($con,$query) or die(mysql_error());
			$rows = mysqli_num_rows($result);
			$all_stations = array();
			while($row = mysqli_fetch_assoc($result)){
				$station = new Station();
				$station->id = $row["id"];
				$station->name= $row["name"];
				$station->longitude = $row["longitude"];
				$station->latitude= $row["latitude"];
				$station->telephone= $row["telephone"];
				array_push($all_stations, $station);
			}
			return $all_stations;
		}

	}
?>