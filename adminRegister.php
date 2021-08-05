<!DOCTYPE html>
<html>
<head>
	<title>Safe Driver - Admin Registration</title>
	
	<style type="text/css">

		body {
	font-family: fanwood-text;
	font-style: normal;
	text-emphasis: center;
	background-color: #722620; 

	  
}
  form{
	width: 50%;
  	margin: auto;	  
	background-color: #f2bc94;
	color: #30110D;
	max-width: 350pt;	  
	height: auto;
	padding-left: 2%;
	padding-bottom: 1%;
	  	padding-top: 1%;
	  padding-right: 2%;

		}
		
    .dark {
		font-family: fanwood-text;
	font-style: bold;
	font-weight: 500;
	background-color: #30110D;
	max-width: 350pt;
	text-align: center;
	color: #f2bc94;
}
		 .light {
	align-content: center;
	position: relative;
	margin: 0 auto;
	width: 50%;
	padding: 2px;
	  
}
  .input-group {
	display: block;
	margin: 0 auto;
	font-family: fanwood-text;
	font-size: 14pt;	  
	text-align: center;
	padding: 2px;
	  
	  
		}
		
		h2 {
		margin: 0 auto;
		padding-left: 2%;
			  padding-right: 2%;


		}
		
    </style>
	  <!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.--><script>var __adobewebfontsappname__="dreamweaver"</script><script src="http://use.edgefonts.net/merriweather:n3:default;fanwood-text:n4:default.js" type="text/javascript"></script>
	
</head>
<body>

<!-- This is the main header for the page -->
<div>
<h2 class="dark">Register as an Admin</h2>
</div>
<!-- This is the "first box" for registering -->
<form method="post">
<div>
	<h4>Account Information</h4>
	<div>
		<label>Username:</label>
		<input type="text" name="username" required>
	</div>
	<div>
		<label>Email:</label>
		<input type="email" name="email1" required>
	</div>
	<div>
		<label>Enter Password:</label>
		<input type="password" name="password_4" required>
	</div>
	<div>
		<label>Confirm password:</label>
		<input type="password" name="password_5" required>
	</div>
	<div>
		<label>Admin Email Verification:</label>
		<input type="email" name="email2" required>
	</div>
	<h4>Personal Information</h4>
	<div>
		<label>First Name:</label>
		<input type="text" name="fname" required>
	</div>
	<div>
		<label>Last Name:</label>
		<input type="text" name="lname" required>
	</div>
	<div>
		<label>Cell Phone Number:</label>
		<input type="Phone" name="phone" required>
	</div>
	<div>
		<label>Date of Birth:</label>
		<input type="Date" name="dob" required>
	</div>
</div>


<div>
	<button type="submit" class="input-group"> Register </button>
</div>

</form>
<?php
if (isset($_POST['password_4']) and isset($_POST['password_5']))
{
    $password1 = $_POST['password_4'];
    $password2 = $_POST['password_5'];
    $password_correct = True;

    if (strcmp($password1, $password2) !== 0)
    {
        echo "Passwords do not match, please try again";
        $password_correct = False;
    }
    if ($password_correct)
    {
        $password = $password1;
    }
		preg_match("/[^a-z0-9]/",$password1,$result);
    preg_match("/[0-9]/",$password1,$result2);
		$regPassword = False;
    if($result&&$result2&&strlen($password1)>4){
        echo "great";
				$regPassword = True;
    }else {
			$regPassword = False;
        echo "you need 1 number and 1 special and 5 total";
    }
}
if (isset($_POST['username']))
{
    $username = $_POST['username'];
    if (strlen($username) < 5)
    {
        echo "Username length must be greater than 5";
    }
}
?>
<?php
include ('sql_connection.php');
if (isset($_POST['username']))
{
		$inputEmail = $_POST['email1'];
		$inputfname = $_POST['fname'];
		$inputlname = $_POST['lname'];
		$inputphone = $_POST['phone'];

    if (strlen($username) >= 5 and $regPassword)
    {
				$uniquePhone = "SELECT * FROM TruckDriver2.Information WHERE Phone = '$inputphone'";
				$uniquePhoneNumber = mysqli_num_rows(mysqli_query($conn,$uniquePhone));

				$uniqueUsernameDriver = "SELECT * FROM TruckDriver2.Driver WHERE Username = '$username'";
				$uniqueUserNumberDriver = mysqli_num_rows(mysqli_query($conn, $uniqueUsernameDriver));

				$uniqueUsernameAdmin = "SELECT * FROM TruckDriver2.Admins WHERE Username = '$username'";
				$uniqueUserNumberAdmin = mysqli_num_rows(mysqli_query($conn, $uniqueUsernameAdmin));

				$uniqueUsernameSponsorCompanyAdmin = "SELECT * FROM TruckDriver2.Sponsor_Company_Admin WHERE Username = '$username'";
				$uniqueUserNumberSponsorCompanyAdmin = mysqli_num_rows(mysqli_query($conn, $uniqueUsernameSponsorCompanyAdmin));

				$uniqueUsernameSponsorCompanyManager = "SELECT * FROM TruckDriver2.Sponsor_Company_Manager WHERE Username = '$username'";
				$uniqueUserNumberSponsorCompanyManager = mysqli_num_rows(mysqli_query($conn, $uniqueUsernameSponsorCompanyManager));

				$uniqueEmail = "SELECT * FROM TruckDriver2.Information WHERE Email = '$inputEmail'";
				$uniqueEmailNumber = mysqli_num_rows(mysqli_query($conn,$uniqueEmail));
				if ($uniquePhoneNumber >=1){
					echo "Phone number already exists please enter a new phone number";
				}
				if ($uniqueUserNumberDriver >= 1 or $uniqueEmailNumber >= 1 or $uniqueUserNumberAdmin >= 1 or $uniqueUserNumberSponsorCompanyAdmin >= 1 or $uniqueUserNumberSponsorCompanyManager >= 1){
					echo "Username already exists please enter a new username";
				}
				if ($uniqueEmailNumber >=1){
					echo "Email  already exists please enter a new email";
				}
//NEED TO MANAULLY INPUT ID!!! TALK ABOUT AUTO INCREMENT

				if ($uniquePhoneNumber == 0 and $uniqueUserNumberDriver == 0 and $uniqueEmailNumber == 0 and $uniqueUserNumberAdmin == 0 and $uniqueUserNumberSponsorCompanyAdmin == 0 and $uniqueUserNumberSponsorCompanyManager == 0){
					$sql2 = "INSERT INTO TruckDriver2.Admins (Username) VALUES ('$username')";
					$sql = "INSERT INTO TruckDriver2.Information (Password, Email, Phone, Company_Manager,Admins,Driver,Company_Admin) VALUES ('$password', '$email','$inputphone',null,'$username',null,null)";
					if (mysqli_query($conn, $sql2))
					{
							echo "New record created successfully";
					}
					else
					{
							echo "Error: " . $sql . "<br>" . mysqli_error($conn);
					}
					if (mysqli_query($conn, $sql))
	        {
	            echo "New record created successfully";
	        }
	        else
	        {
	            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	        }
				}
        mysqli_close($conn);
    }
}
?>

</body>
</html>
