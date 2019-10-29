 <?php
// 	/**
// 	 * Paramedic Station Class
// 	 add station
// 	 remove station
// 	 get station by id
// 	 get all locations with id's
// 	 */
    function random_string($length) {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $key;
    }
	class User
	{
		
// 		// constructor for the stations class
		function User()
		{
			$this->phone = 		"";
			$this->password=    "";
            $this->ustr =       "";
		}

		function get($con,$phone){
			$query = "
				select * from users
				where phone = '$phone'";
			$result = mysqli_query($con,$query) or die(mysql_error());
			$rows = mysqli_num_rows($result);
			$user = new User();
			if($row = mysqli_fetch_assoc($result)){
				$user->phone = $row["phone"];
				$user->password= $row["password"];
                $user->ustr= $row["ustr"];
			}else{
				return NULL;
			}
			return $user;

		}
        function getByUstr($con,$ustr){
			$query = "
				select * from users
				where ustr = '$ustr'";
			$result = mysqli_query($con,$query) or die(mysql_error());
			$rows = mysqli_num_rows($result);
			$user = new User();
			if($row = mysqli_fetch_assoc($result)){
				$user->phone = $row["phone"];
				$user->password= $row["password"];
                $user->ustr= $row["ustr"];
			}else{
				return NULL;
			}
			return $user;

		}
		function create($con,$phone,$password){
			$password = sha1(sha1(sha1($password)));
            $_u = new User();
            $_u = $_u->get($con,$phone);
            if($_u == NULL){
                
            }else{
                return -1;
            }
            $uniquestring = random_string(63);
			$query = "
				INSERT INTO 
				users (phone, password, ustr) 
				VALUES ('$phone', '$password', '$uniquestring');";
			$result = mysqli_query($con,$query) or die(mysql_error());
			if($result){
				$this->phone = $phone;
				$this->password = $password;
                $this->ustr = $uniquestring;
				return 1;
			}
			return 0;

		}
		function authenticate($con,$phone,$password){
			$u = $this->get($con,$phone);
			if($u == NULL){
				return -1;
			}
			$password = sha1(sha1(sha1($password)));
			if($u->password == $password){
				$this->phone = $phone;
				$this->password = $password;
                $this->ustr = $u->ustr;
				return 1;
			}else{
				return 0;
			}
		}

        function authenticateByUstr($con,$ustr){
			$u = $this->getByUstr($con,$ustr);
			if($u == NULL){
				return -1;
			}
            $this->phone = $u->phone;
            $this->password = $u->password;
            $this->ustr = $u->ustr;
            return 1;
		}

	}
 ?>