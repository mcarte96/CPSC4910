<?php 
session_start();

 $dbhost = 'database4910.cz6dbibz7hku.us-east-1.rds.amazonaws.com';
 $dbuser = 'database4910';
 $dbpass = 'database4910';
 $db = mysqli_connect($dbhost, $dbuser, $dbpass);


 $errors = array(); 
 $username = "";
 $email = "";
 $password_1 = "";
 $password_2 = "";
 $compName = "";
 $compID = "";
 $hrEmail = "";
 $fName = "";
 $mName = "";
 $lName = "";
 $cellPhone = "";
 $dateOfBirth = "";
 $sAddress = "";
 $aNumber = "";
 $city = "";
 $state = "";
 $zip = "";
 $x = "";

if($db ->connect_error ) {
 	die('Could not connect: ' . $db->connect_error);
}
else {
	//echo 'Yep';
}

if (isset($_POST['SM_register_btn'])) {
	register_SM();
}

if (isset($_POST['SA_register_btn'])) {
	register_SA();
}
if (isset($_POST['search_driver'])) {
	$_SESSION['find'] = "Driver";

}
if (isset($_POST['search_company'])) {
	$_SESSION['find'] = "Company_Name";
}
if (isset($_POST['search_admins'])) {
	$_SESSION['find'] = "Company_Admin";
}
if (isset($_POST['search_managers'])) {
	$_SESSION['find'] = "Company_Manager";
}
if (isset($_POST['search'])) {
	$_SESSION['find_name'] = e($_POST["id"]);
}
if (isset($_POST['make_changes'])) {
	$b = e($_POST['change_pass']);
	$c = e($_POST['change_email']);
	$d = e($_POST['change_phone']);
	$x = e($_POST['id']);

	$query = "UPDATE TruckDriver2.Information SET  Password= '$b', Email = '$c', Phone = '$d' WHERE (ID = '$x')";
	$results = mysqli_query($db, $query);

	if ($_SESSION['find'] == "Company_Admin" || $_SESSION['find'] == "Company_Manager"){
		$e = e($_POST['change_cname']);
		$query = "UPDATE TruckDriver2.Sponsor_" . $_SESSION['find'] . " SET Company_Name= '$e' WHERE (ID = '$x')";
		$results = mysqli_query($db, $query);


	}


}
if (isset($_POST['add_comp'])) {
	add_comp();
}




//THE FUNCTION FOR GESTIERING THE SPONSOR COMPANY MANAGER
function register_SM(){
	global $db, $errors, $username, $email, $password_1, $password_2, $compName, $compID, $hrEmail, $fName, $mName, $lName, $cellPhone, 
	$dateOfBirth, $sAddress, $aNumber, $city, $state, $zip;

	$username = e($_POST['username']);
	$email = e($_POST['email']);
	$password_1 = e($_POST['password_1']);
	$password_2 = e($_POST['password_2']);
	$compName = e($_POST['compName']);
	$compID = e($_POST['compID']);
	$hrEmail = e($_POST['hrEmail']);
	$fName = e($_POST['fName']);
	$mName = e($_POST['mName']);
	$lName = e($_POST['lName']);
	$cellPhone = e($_POST['cellPhone']);
	$dateOfBirth = e($_POST['dateOfBirth']);
	$sAddress = e($_POST['sAddress']);
	$aNumber = e($_POST['aNumber']);
	$city = e($_POST['city']);
	$state = e($_POST['state']);
	$zip = e($_POST['zip']);

	if (empty($username)) { 
		array_push($errors, "Username is required"); 
	}
	else{
		$query = "SELECT * FROM TruckDriver2.Sponsor_Company_Manager WHERE Username='$username' ";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) >= 1) { // user found
			array_push($errors, "That username is already in use"); 
		}
		if (strlen($username) < 5){
			array_push($errors, "Please enter a username with 5 or more characters");
	    }
	}

	if (empty($email)) { 
		array_push($errors, "Your email is required"); 
	}
	else{
		$query = "SELECT * FROM TruckDriver2.Information WHERE Email='$email' ";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) >= 1) { // user found
			array_push($errors, "That email address is already in use"); 
		}
	}

	if (empty($password_1) || empty($password_2)) { 
		array_push($errors, "Please enter your password in both fields"); 
	}
	else{
		if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
		}
		else{
	    	
    		if(!preg_match("/[0-9]/",$password_1) || !preg_match("/[!@#$%^&*()<>?,.-=]/",$password_1) || strlen($password_1) < 5){
    			array_push($errors, "Please enter a password with 5 or more characters, with at least 1 number and 1 special character");
    		}
    		
    		
		}

	}

	if (empty($compName)) { 
		array_push($errors, "Your company's name is required"); 
	}
	if (empty($compID)) { 
		array_push($errors, "Your unique ID with your company is required"); 
	}
	if (empty($hrEmail)) { 
		array_push($errors, "The email to your company's Human Resoures Division is required"); 
	}
	if (empty($fName)) { 
		array_push($errors, "First Name is required"); 
	}
	if (empty($mName)) { 
		array_push($errors, "Middle Name is required"); 
	}
	if (empty($lName)) { 
		array_push($errors, "Last Name is required"); 
	}

	if (empty($cellPhone)) { 
		array_push($errors, "Your cell phone number is required"); 
	}
	else{
		$query = "SELECT * FROM TruckDriver2.Information WHERE Phone='$cellPhone' ";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) >= 1) { // user found
			array_push($errors, "That cell phone number is already in use"); 
		}
	}

	if (empty($dateOfBirth)) { 
		array_push($errors, "Your date of birth is required"); 
	}
	if (empty($sAddress)) { 
		array_push($errors, "Your street address is required"); 
	}
	if (empty($city)) { 
		array_push($errors, "Your city is required"); 
	}
	if (empty($state)) { 
		array_push($errors, "Your state is required"); 
	}
	if (empty($zip)) { 
		array_push($errors, "Your zipcode is required"); 
	}

	if (count($errors) == 0) {
	$query = "INSERT INTO TruckDriver2.Sponsor_Company_Manager  VALUES('$username', '$compID', '$fName', '$mName', '$lName')";
		if(mysqli_query($db, $query)){
			echo 'inserted';
		}	
		else{
			//echo 'fuck';
		}
	}
	//echo 'wtf';
}

//THE FUNCTION FOR REGISTERING THE SPONSOR COMPANY Admin
function register_SA(){
	global $db, $errors, $username, $email, $password_1, $password_2, $compName, $compID, $hrEmail, $fName, $mName, $lName, $cellPhone, 
	$dateOfBirth, $sAddress, $aNumber, $city, $state, $zip;

	//Pushing all the items from the form to the variables
	$username = e($_POST['username']);
	$email = e($_POST['email']);
	$password_1 = e($_POST['password_1']);
	$password_2 = e($_POST['password_2']);
	$compName = e($_POST['compName']);
	$compID = e($_POST['compID']);
	$hrEmail = e($_POST['hrEmail']);
	$fName = e($_POST['fName']);
	$mName = e($_POST['mName']);
	$lName = e($_POST['lName']);
	$cellPhone = e($_POST['cellPhone']);
	$dateOfBirth = e($_POST['dateOfBirth']);
	$sAddress = e($_POST['sAddress']);
	$aNumber = e($_POST['aNumber']);
	$city = e($_POST['city']);
	$state = e($_POST['state']);
	$zip = e($_POST['zip']);

	if (empty($username)) { 
		array_push($errors, "Username is required"); 
	}
	else{
		$query = "SELECT * FROM TruckDriver2.Sponsor_Company_Admin WHERE Username='$username' ";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) >= 1) { // user found
			array_push($errors, "That username is already in use"); 
		}
		if (strlen($username) < 5){
			array_push($errors, "Please enter a username with 5 or more characters");
	    }
	}

	if (empty($email)) { 
		array_push($errors, "Your email is required"); 
	}
	else{
		$query = "SELECT * FROM TruckDriver2.Information WHERE Email='$email' ";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) >= 1) { // user found
			array_push($errors, "That email address is already in use"); 
		}
	}

	if (empty($password_1) || empty($password_2)) { 
		array_push($errors, "Please enter your password in both fields"); 
	}
	else{
		if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
		}
		else{
    		if(!preg_match("/[0-9]/",$password_1) || !preg_match("/[!@#$%^&*()<>?,.-=]/",$password_1) || strlen($password_1) < 5){
    			array_push($errors, "Please enter a password with 5 or more characters, with at least 1 number and 1 special character");
    		}
		}
	}

	if (empty($compName)) { 
		array_push($errors, "Your company's name is required"); 
	}
	if (empty($compID)) { 
		array_push($errors, "Your unique ID with your company is required"); 
	}
	if (empty($hrEmail)) { 
		array_push($errors, "The email to your company's Human Resoures Division is required"); 
	}
	if (empty($fName)) { 
		array_push($errors, "First Name is required"); 
	}
	if (empty($mName)) { 
		array_push($errors, "Middle Name is required"); 
	}
	if (empty($lName)) { 
		array_push($errors, "Last Name is required"); 
	}

	if (empty($cellPhone)) { 
		array_push($errors, "Your cell phone number is required"); 
	}
	else{
		$query = "SELECT * FROM TruckDriver2.Information WHERE Phone='$cellPhone' ";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) >= 1) { // user found
			array_push($errors, "That cell phone number is already in use"); 
		}
	}

	if (empty($dateOfBirth)) { 
		array_push($errors, "Your date of birth is required"); 
	}
	if (empty($sAddress)) { 
		array_push($errors, "Your street address is required"); 
	}
	if (empty($city)) { 
		array_push($errors, "Your city is required"); 
	}
	if (empty($state)) { 
		array_push($errors, "Your state is required"); 
	}
	if (empty($zip)) { 
		array_push($errors, "Your zipcode is required"); 
	}

	if (count($errors) == 0) {
	$query = "INSERT INTO TruckDriver2.Sponsor_Company_Admin  VALUES('$username', '$compID', '$fName', '$mName', '$lName')";
		if(mysqli_query($db, $query)){
			echo 'inserted';
		}	
		else{
		}
	}
}


function add_comp(){
	global $db, $errors, $compName;

	$newcomp = e($_POST['newcomp']);

	$query = "SELECT * FROM TruckDriver2.Company WHERE Company_Name='$newcomp' ";
	$results = mysqli_query($db, $query);

	if (mysqli_num_rows($results) >= 1) { 
		array_push($errors, "That Company already exists"); 
	}
	else{
			$query = "INSERT INTO TruckDriver2.Company (Company_Name) VALUES ('$newcomp')";
			if(mysqli_query($db, $query)){
			}
			else
				echo "failed";

	}






}

//This is the function for displaying all the errors pushed to the error array during the registration process
function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}	
// escape string
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function search_driver(){
	$_SESSION['find'] = "Driver";




}








?>