<?php

include('sponsorAM_functions.php');

$username = $_SESSION['username'];
$query = "SELECT * FROM TruckDriver2.Information WHERE Driver='$username' ";
$results = mysqli_query($db, $query);
if (mysqli_num_rows($results) >= 1) {
	$usertype = "Driver";
}

$query = "SELECT * FROM TruckDriver2.Information WHERE Company_Admin='$username' ";
$results = mysqli_query($db, $query);
if (mysqli_num_rows($results) >= 1) {
	$usertype = "Company_Admin";
}

$query = "SELECT * FROM TruckDriver2.Information WHERE Admins='$username' ";
$results = mysqli_query($db, $query);
if (mysqli_num_rows($results) >= 1) {
	$usertype = "Admins";
}

$query = "SELECT * FROM TruckDriver2.Information WHERE Company_Manager='$username' ";
$results = mysqli_query($db, $query);
if (mysqli_num_rows($results) >= 1) {
	$usertype = "Company_Manager";
}

$query = "SELECT * FROM TruckDriver2.Information WHERE ". $usertype ."='$username' ";
$results = mysqli_query($db, $query);

if (mysqli_num_rows($results) == 1) {
	$row = $results->fetch_assoc();
	$datetime1 = date_create($row["Date_Joined"]);
}
$query = "SELECT License_Number FROM TruckDriver2.Driver WHERE Username='$username' ";
$results = mysqli_query($db, $query);

if (mysqli_num_rows($results) == 1) {
	$row2 = $results->fetch_assoc();
	
}

$datetime2 = date_create(date("Y-m-d"));
$interval = date_diff($datetime1, $datetime2);
//echo $interval->format('%a day(s)');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Safe Driver - <?php echo $username;?>'s Profile Page</title>

<style>
		
		h1 {
			float: right;
			font-size: 30px;
			padding-left: 1%;
			padding-right: 1%;
			font-family: fanwood-text;
			background-color: #f2bc94;
			text-align: center;
			margin: 0 auto;


		}
		h2 {
			font-size: 30px;
			font-family: fanwood-text;
			color: #f2bc94;
			background-color: #30110D;
			text-align: center;
			max-width: 80%;
			margin: 0 auto;
			font-family: fanwood-text;




		}
		nav {
  		float: left;
		width: 15%;
		background-color: #f2bc94;
		margin: 1% auto;
		padding: 1%;
		font-family: fanwood-text;


		}
		article {
		  float: right;
		margin: 1% auto;
		  padding: 1%;
		  width: 80%;
		  background-color: #f2bc94;
			font-family: fanwood-text;

		}
		p {
			padding-left: 30px;
			font-family: fanwood-text;

		}

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

		a:link {
  		color: #30110D;
	}

/* visited link */
	a:visited {
  		color: #722620;
	}

	</style>
	<!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.--><script>var __adobewebfontsappname__="dreamweaver"</script><script src="http://use.edgefonts.net/fanwood-text:n4:default.js" type="text/javascript"></script>
</head>

<body>


<header>
	
	<h1><a href="login.php">Log Out</a></h1>
	<h2><?php echo $username; ?>'s Profile Page</h2>
</header>

<section>
  <nav >

  	<?php
  		$_SESSION['username'] = $username;
  		$_POST['user'] = $username;
  	?>

  	<h2>Username: <?php echo $username; ?></h2>
    <?php
    	echo "<p><a href=\"homemenu.php\">Home Page</a></p>";
    	
    	if ($usertype == "Driver"){
	?>
		<p><a href="editDriverProfile.php">Profile Page</a></p>
	    <p><a href="checkSponsor.php">Sponsor Search</a></p>
	    <p><a href="orderHistory.php">Order History</a></p>

    <?php
      }
      else{
      	echo "<p><a href=\"profile.php\">Profile Page</a></p>";
      }
    ?>

    <?php
    	if ($usertype == "Company_Manager"){
    		echo "<p><a href=\"ManageDriver.php\">Search Drivers</a></p>";
    		

      	}
      	if ($usertype == "Company_Admin"){
    		echo "<p><a href=\"ManageDriver.php\">Search Drivers</a></p>";
    		echo "<p><a href=\"catalogEdit.php\">Update Catalog</a></p>";
      	}
    ?>

    <?php
    	if ($usertype == "Admins"){
    		echo "<p><a href=\"search.php\">Search Page</a></p>";
    		echo "<p><a href=\"Points.php\">Points</a></p>";
    		$_SESSION['find'] = "Driver";

      	}
    ?>

  </nav>

  <article>
	<h2>This account is <?php echo $interval->format('%a day(s)');?> old</h2>
	<p> 


	<?php
	$username = $_SESSION['username'];

	//The querry for searching rows
	//$query = "SELECT * FROM TruckDriver2.Information WHERE ". $usertype ."='$username' ";
	//$results = mysqli_query($db, $query);
	//$row = $results->fetch_assoc();
	

	//variables
	





	if ($usertype == "Driver"){
	
		echo "
			<form method=\"post\" class=\"input\">
			<input type=\"hidden\" name=\"id\" value=\"". $row['ID'] . " \">
			<div class=\"input\">
				<label>Street Address</label>
				<input type=\"text\" name=\"Street_Address\" value=\"". $row['Street_Address'] . " \">
			</div>
			<div class=\"input\">
				<label>City</label>
				<input type=\"text\" name=\"City\" value=\"". $row['City'] . " \">
			</div>
			<div class=\"input\">
				<label>State</label>
				<input type=\"text\" name=\"State\" value=\"". $row['State'] . " \">
			</div>
			<div class=\"input\">
				<label>Zipcode</label>
				<input type=\"text\" name=\"Zipcode\" value=\"". $row['Zipcode'] . " \">
			</div>
			<div class=\"input\">
				<label>Apt_Num</label>
				<input type=\"text\" name=\"Apt_Num\" value=\"". $row['Apt_Num'] . " \">
			</div>
			<div class=\"input\">
				<label>Email</label>
				<input type=\"text\" name=\"Email\" value=\"". $row['Email'] . " \">
			</div>
			<div class=\"input\">
				<label>Phone</label>
				<input type=\"text\" name=\"Phone\" value=\"". $row['Phone'] . " \">
			</div>
			<div class=\"input\">
				<label>License</label>
				<input type=\"text\" name=\"License\" value=\"". $row2['License_Number'] . " \">
			</div>

			<div class=\"input\">
						<input type=\"submit\" class=\"input\" name=\"profile_changes\" value=\"Submit\">
					</div>				
			</form>

		";
    }
		#update license

    elseif ($usertype == "Company_Manager")
    {
	
		echo "
			<form method=\"post\" class=\"input\">
			<input type=\"hidden\" name=\"id\" value=\"". $row['ID'] . " \">
			<div class=\"input\">
				<label>Street Address</label>
				<input type=\"text\" name=\"Street_Address\" value=\"". $row['Street_Address'] . " \">
			</div>
			<div class=\"input\">
				<label>City</label>
				<input type=\"text\" name=\"City\" value=\"". $row['City'] . " \">
			</div>
			<div class=\"input\">
				<label>State</label>
				<input type=\"text\" name=\"State\" value=\"". $row['State'] . " \">
			</div>
			<div class=\"input\">
				<label>Zipcode</label>
				<input type=\"text\" name=\"Zipcode\" value=\"". $row['Zipcode'] . " \">
			</div>
			<div class=\"input\">
				<label>Apt_Num</label>
				<input type=\"text\" name=\"Apt_Num\" value=\"". $row['Apt_Num'] . " \">
			</div>
			<div class=\"input\">
				<label>Email</label>
				<input type=\"text\" name=\"Email\" value=\"". $row['Email'] . " \">
			</div>
			<div class=\"input\">
				<label>Phone</label>
				<input type=\"text\" name=\"Phone\" value=\"". $row['Phone'] . " \">
			</div>

			<div class=\"input\">
						<input type=\"submit\" class=\"input\" name=\"profile_changes\" value=\"Submit\">
					</div>				
			</form>

		";


	}
    elseif ($usertype == "Company_Admin")
    {
	
		echo "
			<form method=\"post\" class=\"input\">
			<input type=\"hidden\" name=\"id\" value=\"". $row['ID'] . " \">
			<div class=\"input\">
				<label>Street Address</label>
				<input type=\"text\" name=\"Street_Address\" value=\"". $row['Street_Address'] . " \">
			</div>
			<div class=\"input\">
				<label>City</label>
				<input type=\"text\" name=\"City\" value=\"". $row['City'] . " \">
			</div>
			<div class=\"input\">
				<label>State</label>
				<input type=\"text\" name=\"State\" value=\"". $row['State'] . " \">
			</div>
			<div class=\"input\">
				<label>Zipcode</label>
				<input type=\"text\" name=\"Zipcode\" value=\"". $row['Zipcode'] . " \">
			</div>
			<div class=\"input\">
				<label>Apt_Num</label>
				<input type=\"text\" name=\"Apt_Num\" value=\"". $row['Apt_Num'] . " \">
			</div>
			<div class=\"input\">
				<label>Email</label>
				<input type=\"text\" name=\"Email\" value=\"". $row['Email'] . " \">
			</div>
			<div class=\"input\">
				<label>Phone</label>
				<input type=\"text\" name=\"Phone\" value=\"". $row['Phone'] . " \">
			</div>

			<div class=\"input\">
						<input type=\"submit\" class=\"input\" name=\"profile_changes\" value=\"Submit\">
					</div>				
			</form>

		";


	}
	
    elseif ($usertype == "Admins")
    {
	
		echo "
			<form method=\"post\" class=\"input\">
			<input type=\"hidden\" name=\"id\" value=\"". $row['ID'] . " \">
			<div class=\"input\">
				<label>Street Address</label>
				<input type=\"text\" name=\"Street_Address\" value=\"". $row['Street_Address'] . " \">
			</div>
			<div class=\"input\">
				<label>City</label>
				<input type=\"text\" name=\"City\" value=\"". $row['City'] . " \">
			</div>
			<div class=\"input\">
				<label>State</label>
				<input type=\"text\" name=\"State\" value=\"". $row['State'] . " \">
			</div>
			<div class=\"input\">
				<label>Zipcode</label>
				<input type=\"text\" name=\"Zipcode\" value=\"". $row['Zipcode'] . " \">
			</div>
			<div class=\"input\">
				<label>Apt_Num</label>
				<input type=\"text\" name=\"Apt_Num\" value=\"". $row['Apt_Num'] . " \">
			</div>
			<div class=\"input\">
				<label>Email</label>
				<input type=\"text\" name=\"Email\" value=\"". $row['Email'] . " \">
			</div>
			<div class=\"input\">
				<label>Phone</label>
				<input type=\"text\" name=\"Phone\" value=\"". $row['Phone'] . " \">
			</div>

			<div class=\"input\">
						<input type=\"submit\" class=\"input\" name=\"profile_changes\" value=\"Submit\">
					</div>				
			</form>

		";


	}





	if (isset($_POST['profile_changes'])) {
		$x = e($_POST['id']);
		$a = e($_POST['Street_Address']);
		$b = e($_POST['City']);
		$c = e($_POST['State']);
		$d = e($_POST['Zipcode']);
		$e = e($_POST['Apt_Num']);
		$f = e($_POST['Email']);
		$g = e($_POST['Phone']);



		$query = "UPDATE TruckDriver2.Information SET  Street_Address= '$a', City = '$b', State= '$c',Zipcode='$d',Apt_Num='$e',Email='$f',Phone='$g' WHERE (ID = '$x')";
		$results = mysqli_query($db, $query);


		header('location: profile.php?username='.$username.'');

	}





     ?>









	</p>
  </article>



  </section>









</body>

</html>