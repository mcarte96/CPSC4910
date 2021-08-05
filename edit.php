<?php
include('sponsorAM_functions.php');

$username = e($_GET['username']);
$finding = $_SESSION['find_name'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Safe Driver - Edit</title>
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

		table{
			border: 1px solid #722620;
			margin: 0 auto;
			min-width: 30%;


		}
		th,td {
			margin: 0 auto;
			border: 1px solid #722620;
			padding: 3%;
			min-width: 10%;
			text-align: center;


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
	  	color: #f2bc94;

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
		font-family: fanwood-text;
		font-size: 14pt;	  
		text-align: left;
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
</head>
<body>

<header>
	<h1><a href="login.php">Log Out</a></h1>
  <h2>Edit Page - 
<?php 
	$usertype = "";

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

	if ($usertype == NULL)
		echo "";
	else
		echo $usertype;


?>
  </h2>
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
	<h2>Editing <?php echo $_SESSION['find_name'] ?>'s Page</h2>
	<p>
		<?php 
			if ($_SESSION['find'] != ""){
				if ($_SESSION['find'] == "Company_Name"){
					}
				else{
					$query = "SELECT * FROM TruckDriver2.Information WHERE " . $_SESSION['find'] . " ='$finding' ";
					$results = mysqli_query($db, $query);
					
					if ($results->num_rows == 1)
						$row = $results->fetch_assoc();
					else
						echo "opps";

					echo "
						<form method=\"post\" class=\"input\" >
							<input type=\"hidden\" name=\"id\" value=\"". $row['ID'] . " \">
							<div>
							" . $row[$_SESSION['find']] . "
							</div>
							<div class=\"input\">
								<label>Password:</label>
								<input type=\"text\" name=\"change_pass\" value=\"". $row['Password'] . " \">
							</div>
							<div class=\"input\">
								<label>Email:</label>
								<input type=\"email\" name=\"change_email\" value=\"". $row['Email'] . " \">
							</div>
							<div class=\"input\">
								<label>Phone Number:</label>
								<input type=\"phone\" name=\"change_phone\" value=\"". $row['Phone'] . " \">
							</div>";


					if ($_SESSION['find'] == "Company_Admin" || $_SESSION['find'] == "Company_Manager"){
						$query = "SELECT * FROM TruckDriver2.Sponsor_" . $_SESSION['find'] . " WHERE Username ='$finding' ";
						$results = mysqli_query($db, $query);
						
						if ($results->num_rows == 1)
							$row = $results->fetch_assoc();
						else
							echo "opps";


						echo "
						<div class=\"input\">
							<label>Company Name:</label>
							<input type=\"text\" name=\"change_cname\" value=\"". $row['Company_Name'] . " \">
						</div>";

					}



					echo "
					<div class=\"input\">
						<input type=\"submit\" class=\"input\" name=\"make_changes\" value=\"Submit\">
					</div>
					</form>
					";

					}
			}

		?>
	</p>
	</article>
</section>
</body>
</html>