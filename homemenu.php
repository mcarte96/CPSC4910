<?php include('sponsorAM_functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Safe Driver - Home Page</title>
	<?php
	//$username = "tommydong";
	//$username = "admin1";
	?>

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
			width: 90%;
			margin: 0 auto;
			font-size: 25px;



		}
		th,td {
			padding: 3%;
			border: 1px solid #722620;


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
			text-align: center;

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
	<h1><a href="login.php" >Log Out</a></h1>
  <h2>Home Page - 
<?php 
	$usertype = "";
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
	
	<?php
    	if ($usertype == "Driver"){
    		echo "
    			<h2>Your Sponsors:</h2>
    			<p>
    			";

			$query = "SELECT * FROM TruckDriver2.Sponsored WHERE Driver='$username' ";
			$results = mysqli_query($db, $query);
			if (mysqli_num_rows($results) >= 1) {
				
				echo "	<table>
						<tr>
						<th>Sponsorship</th>
						<th>Points Earned</th>
						<th>Catalog</th>
						</tr>"; 

				while($row = $results->fetch_assoc()) {
					/*
					echo " <tr>
					<td> " . $row["Sponsor"] . "</td>
					<td> " . $row["Points"] . "</td>
					<td><a href=\"#\">Go Shopping</a>
							</tr>
					";
					*/

					echo " <tr>
					<td> " . $row["Sponsor"] . "</td>
					<td> " . $row["Points"] . "</td>
					<td>
						<form method=\"post\" class=\"input\" action=\"catalog.php?id=". $row['Sponsor'] . "\">
						<input type=\"hidden\" name=\"whichCatalog\" value=\"". $row['Sponsor'] . " \">
						<button type=\"submit\" name=\"shop\" class=\"input\">Go Shopping</button>
						</form>

					</td>
							</tr>
					";



				}
				echo "</table>";

			}



    		echo "</p>";

    	}
    	else{
    		echo "<h2>Welcome</h2>";
    	}


    	if (isset($_POST['shop'])) {
			$_SESSION['username'] = $username;
			$_SESSION['sponsorName'] = e($_POST['whichCatalog']);
		}






	?>





  </article>



  </section>




</body>