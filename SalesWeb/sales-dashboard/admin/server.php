<?php
session_start();
include_once '../config.php';


// variable declaration
$fullName = "";
$telephone    = "";
$email = "";
$token = "";
$errors = array();
$_SESSION['success'] = "";

// REGISTER USER
if (isset($_POST['reg_admin'])) {
	// receive all input values from the form
	$fullName = mysqli_real_escape_string($db, $_POST['fullName']);
	$telephone = mysqli_real_escape_string($db, $_POST['telephone']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$token = mysqli_real_escape_string($db, $_POST['token']);

	// form validation: ensure that the form is correctly filled
	if (empty($fullName)) { array_push($errors, "fullName is required"); }
	if (empty($telephone)) { array_push($errors, "telephone is required"); }
	if (empty($email)) { array_push($errors, "email is required"); }
	if (empty($token)) { array_push($errors, "token is required"); }


	// register user if there are no errors in the form
	if (count($errors) == 0) {

		/**adminID	fullName	telephone	email	token**/
		$query = "INSERT INTO admin (fullName, telephone, email, token)
					  VALUES('$fullName', '$telephone', '$email','$token')";
		mysqli_query($db, $query);



//		$curl = curl_init();
//
//		curl_setopt_array($curl, array(
//			CURLOPT_URL => "$baseUrl/admin/register",
//			CURLOPT_RETURNTRANSFER => true,
//			CURLOPT_ENCODING => "",
//			CURLOPT_MAXREDIRS => 10,
//			CURLOPT_TIMEOUT => 0,
//			CURLOPT_FOLLOWLOCATION => true,
//			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//			CURLOPT_CUSTOMREQUEST => "POST",
//			CURLOPT_POSTFIELDS => "fullName=$fullName&telephone=$telephone&email=$email&token=$token",
//			CURLOPT_HTTPHEADER => array(
//				"Content-Type: application/x-www-form-urlencoded",
//				"Cookie: PHPSESSID=301979b68055c2cbe24467f39ab0f5e3"
//			),
//		));
//
//		$response = curl_exec($curl);
//		curl_close($curl);

//SESSION ID
		$query = "SELECT * FROM admin WHERE fullName='$fullName' AND email='$email'";
		$results = mysqli_query($db, $query);
		while ($rw=mysqli_fetch_array($results)){
			$id = $rw['adminID'];
			$_SESSION['adminID']=$id;

			$fullName = $rw['fullName'];
			$_SESSION['fullName'] = $fullName;

		}
		//this will desstroy ssession of  this page and intent to index.php(Dashboard)
		header('Location: login.php');
		exit;
	}
}

// ...

// LOGIN USER

//////


if (isset($_POST['login_admin'])) {
	$fullName = mysqli_real_escape_string($db, $_POST['fullName']);
	$email = mysqli_real_escape_string($db, $_POST['email']);

	if (empty($fullName)) {
		array_push($errors, "fullName is required");
	}
	if (empty($email)) {
		array_push($errors, "email is required");
	}

	if (count($errors) == 0) {

		$query = "SELECT * FROM admin WHERE fullName='$fullName' AND email='$email'";
		$results = mysqli_query($db, $query);
		while ($rw=mysqli_fetch_array($results)){
			//SESSION ID
			$id = $rw['adminID'];
			$_SESSION['adminID']=$id;
		}
		if (mysqli_num_rows($results) == 1) {
			$_SESSION['fullName'] = $fullName;
			//$_SESSION['success'] = "You are now logged in";
			header('location: ../index.php');
			exit;

		} else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}


//SESSION
$q = "SELECT * FROM admin WHERE fullName='$fullName' AND email='$email'";
$r = mysqli_query($db, $q);
while ($rw=mysqli_fetch_array($r)){
	$id = $rw['adminID'];
	$_SESSION['adminID']=$id;
}





?>