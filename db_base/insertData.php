<?php

require $_SERVER['DOCUMENT_ROOT']."/login/db_base/connect-db.php";
require_once $_SERVER['DOCUMENT_ROOT']."/login/db_base/extractData.php";


class InsertData{



	function __destruct(){
		global $conn;
		mysqli_close($conn);
	}

	function insertRegisration($firstname, $lastname, $email, $pwd, $gender, $age, $height, $bio, $newfilename){
		/* insert data of regirstration form in database*/

		global $conn;

		

		$query = "INSERT INTO user_tb (firstname, lastname, email, pass, gender, height, age, bio, profileImg, alreadyvisited) VALUES ('$firstname', '$lastname', '$email', '$pwd', '$gender', '$height', '$age', '$bio', '$newfilename', '0')";

		$retval = mysqli_query($conn, $query);

		if($retval){
			$a = new ExtractData();
			$user_id = $a->extUserId($email);
			$img_query = "INSERT INTO user_img ('userid', 'email', 'image1', 'image2', 'image3', 'image4', 'image5') VALUES ('$user_id','$email','0','0','0','0','0')";
		}

		return $retval;
	}



	function insertNewSession($new_session_id, $email){
		/* this function will insert new session in data*/

		global $conn;

		$query = "UPDATE user_tb SET oldSession='$new_session_id' WHERE email='$email'";
		$retval = mysqli_query($conn, $query);
		
		return $retval;

	}

	function insertEditProfile($tempemail, $firstname, $lastname, $email, $age, $height, $bio){
		/* updates firstname, lastname, age, height, email, bio */

		global $conn;

		$query = "UPDATE user_tb SET firstname='$firstname', lastname='$lastname', email='$email', height='$height', age='$age', bio='$bio' WHERE email ='$tempemail'";

		$retval = mysqli_query($conn, $query);

		return $retval;


	}


	function insertPassword($email, $npwd){

		/* update password in database */

		global $conn;

		$query = "UPDATE user_tb SET pass='$npwd' WHERE email = '$email'";

		$retval = mysqli_query($conn, $query);

		 return $retval;

	}

	function insertAlreadyVisited($email, $updatevisited){
		/* this function will update alreadyvisited data */

		global $conn;

		$query = "UPDATE user_tb SET alreadyvisited='$updatevisited' WHERE email='$email'";

		$retval = mysqli_query($conn, $query);

		return $retval;
	}
}


?>