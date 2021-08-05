<?php
if(isset($_POST['menu'])){
  if($_POST["menu"]=="1")
    header("Location: registerDriver.php");
    if($_POST["menu"]=="2")
      header("Location: sponsorManagerRegister.php");
      if($_POST["menu"]=="3")
        header("Location: sponsorAdminRegister.php");
    if($_POST["menu"]=="4")
      header("Location: adminRegister.php");
    }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> Login</title>
  <style type="text/css">
  body {
	font-family: fanwood-text;
	font-style: normal;
	text-emphasis: center;
	background-color: #722620; 
	  
}
  form{
	width: 50%;
  	margin: 0 auto;	  
	 background-color: #f2bc94;
	color: #30110D;
	max-width: 350pt;	  
	height: auto;

	  
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
  .field {
}
  .light {
	align-content: center;
	position: relative;
	margin: 0 auto;
	width: 50%;
	padding: 2px;
	  
}
  .input {
	display: block;
	margin: 0 auto;
	font-family: fanwood-text;
	font-size: 14pt;	  
	text-align: center;
	padding: 2px;
	  
}
	  
  </style>
  <!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.--><script>var __adobewebfontsappname__="dreamweaver"</script><script src="http://use.edgefonts.net/merriweather:n3:default;fanwood-text:n4:default.js" type="text/javascript"></script>
</head>
  <body>

    <form method="post">
      <h1 class="dark"> Good Truck Driver Login</h1>
            <div class="light">
              <label class="field">Username</label>
              <input type="text" name="user" required>
            </div>
            <div class="light">
              <label> Password </label>
              <input type="password" name ="password" required>
            </div>
            <div >
              <button type="submit" class="input"> Log In </button> 
			</div>
  </form>

	
      <form method="post" action = "login.php">
		<h1 class="dark"> Good Truck Driver Registration</h1>
        <select name="menu" class="input">
          <option value="0"> Select User Type </option>
          <option value="1"> Driver </option>
          <option value="2"> Sponsor Manager </option>
          <option value="3"> Sponsor Admin </option>
          <option value="4"> Admin </option>
        </select>
        <div>
          <button type="submit" class="input"> Register </button>
        </div>
        <a href="forgotPassword.php" class="input">Forgot password?</a>
        <a href="faq.php" class="input">Frequently Asked Questions</a>
        </form>
	  <br></br>
	    <img src="https://people.cs.clemson.edu/~afenwic/driver2/download.png" alt="a" width="275" height="183" class="input"/>
	  
<?php
include ('sql_connection.php');
session_start();
if(isset($_POST['user'])){
$username = $_POST['user'];
$uniqueUsernameDriver = "SELECT * FROM TruckDriver2.Driver WHERE Username = '$username'";
$uniqueUserNumberDriver = mysqli_num_rows(mysqli_query($conn, $uniqueUsernameDriver));

$uniqueUsernameAdmin = "SELECT * FROM TruckDriver2.Admins WHERE Username = '$username'";
$uniqueUserNumberAdmin = mysqli_num_rows(mysqli_query($conn, $uniqueUsernameAdmin));

$uniqueUsernameSponsorCompanyAdmin = "SELECT * FROM TruckDriver2.Sponsor_Company_Admin WHERE Username = '$username'";
$uniqueUserNumberSponsorCompanyAdmin = mysqli_num_rows(mysqli_query($conn, $uniqueUsernameSponsorCompanyAdmin));

$uniqueUsernameSponsorCompanyManager = "SELECT * FROM TruckDriver2.Sponsor_Company_Manager WHERE Username = '$username'";
$uniqueUserNumberSponsorCompanyManager = mysqli_num_rows(mysqli_query($conn, $uniqueUsernameSponsorCompanyManager));

$password = $_POST['password'];
if ($uniqueUserNumberDriver == 0 and $uniqueUserNumberAdmin == 0 and $uniqueUserNumberSponsorCompanyAdmin == 0 and $uniqueUserNumberSponsorCompanyManager == 0){
  echo "Username does not exist";
}
else{
  if ($uniqueUserNumberDriver == 1){
    $sqlPassword = "SELECT Password FROM TruckDriver2.Information WHERE Driver = '$username' LIMIT 1";
    $result = mysqli_query($conn, $sqlPassword);
    while ($row = mysqli_fetch_assoc($result)){
      $obtainedPassword = $row["Password"];
    }
    if ($obtainedPassword == $password){
      echo "Correct you are in ";
      $_SESSION['username'] = $username;
      header('location: homemenu.php');    }
    else{
      echo "wrong password try again";
    }
  }

  if ($uniqueUserNumberAdmin == 1){
    $sqlPassword = "SELECT Password FROM TruckDriver2.Information WHERE Admins = '$username' LIMIT 1";
    $result = mysqli_query($conn, $sqlPassword);
    while ($row = mysqli_fetch_assoc($result)){
      $obtainedPassword = $row["Password"];
    }
    if ($obtainedPassword == $password){
      echo "Correct you are in ";
      $_SESSION['username'] = $username;
      header('location: homemenu.php');
    }
    else{
      echo "wrong password try again";
    }
  }


  if ($uniqueUserNumberSponsorCompanyAdmin == 1){
    $sqlPassword = "SELECT Password FROM TruckDriver2.Information WHERE Company_Admin = '$username' LIMIT 1";
    $result = mysqli_query($conn, $sqlPassword);
    while ($row = mysqli_fetch_assoc($result)){
      $obtainedPassword = $row["Password"];
    }
    if ($obtainedPassword == $password){
      echo "Correct you are in ";
      $_SESSION['username'] = $username;
      header('location: homemenu.php');    }
    else{
      echo "wrong password try again";
    }
  }



  if ($uniqueUserNumberSponsorCompanyManager == 1){
    $sqlPassword = "SELECT Password FROM TruckDriver2.Information WHERE Company_Manager = '$username' LIMIT 1";
    $result = mysqli_query($conn, $sqlPassword);
    while ($row = mysqli_fetch_assoc($result)){
      $obtainedPassword = $row["Password"];
    }
    if ($obtainedPassword == $password){
      echo "Correct you are in ";
      $_SESSION['username'] = $username;
      header('location: homemenu.php');
    }
    else{
      echo "wrong password try again";
    }
  }
}
}

 ?>
  </body>
</html>
