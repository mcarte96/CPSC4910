<?php
include('sponsorAM_functions.php');

$username = $_SESSION['username'];
$query2 = "";
$search = "";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Safe Driver - Search</title>
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
</head>
<body>

<header>
	<h1><a href="login.php">Log Out</a></h1>
  <h2>Search Page - 
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

      	}
    ?>

  </nav>

  <article>
	<h2>Search</h2>
	<p>

	<form method="post" class ="input">
	<div class="input">
    	<input class="input" type="submit" name="search_driver" value="Search Drivers">
    	<input class="input" type="submit" name="search_company" value="Search Companies">
    	<input class="input" type="submit" name="search_admins" value="Company Admins">
    	<input class="input" type="submit" name="search_managers" value="Company Managers">
	</div>
	</form>
	<br>


	<?php
		if ($_SESSION['find'] != ""){
			if ($_SESSION['find'] == "Company_Name"){
				$query = "SELECT * FROM TruckDriver2.Company";
				echo "
				<form method=\"post\" class =\"input\" >
				   ". display_error() . "
		    		<label>Add a Company:</label>
	  				<input type=\"text\" name=\"newcomp\" required >
	  				<button type=\"submit\" name=\"add_comp\" class=\"input\">Add</button>

				</form>
				<br>
				";
			}
			else
				$query = "SELECT * FROM TruckDriver2.Information WHERE " . $_SESSION['find'] . " != ''";
			
			$result = $db->query($query); 

			echo "<table>";

			if ($_SESSION['find'] == "Company_Name"){
				echo "	<tr>
						<th>Company Name</th>
						<th>Edit</th>
						</tr>";
			}
			else{
				echo "	<tr>
						<th>Username</th>
						<th>Edit</th>
						</tr>";
			}
			
			if ($result->num_rows > 0) {
			// output data of each row
				while($row = $result->fetch_assoc()) {
					$search = $row[$_SESSION['find']];
					echo "
					<tr>
					<form method=\"post\" action=\"edit.php?username=".$username."\">

					<td> " . $search . "</td>
					<td> 
						    <input type=\"submit\" name=\"search\" class=\"input\" value=\"Edit\">
	    					<input type=\"hidden\" name=\"id\" value=\"" . $row[$_SESSION['find']] ."\">
					</td>
					</form>
					</tr>";
				}
				echo "</table>";
			}
			else
			{ echo "0 results"; }


			echo "
				<form method=\"post\" class =\"input\" >
				   ". display_error() . "
		    		<label>Add an admin:</label>
		    		<div>
		    		<label>Username:</label>
	  				<input type=\"text\" name=\"newadmin\" required >
	  				</div>
	  				<div>
	  				<label>Password:</label>
	  				<input type=\"text\" name=\"newpass\" required >
	  				</div>
	  				<button type=\"submit\" name=\"add_add\" class=\"input\">Add</button>

				</form>
				<br>
				";



		}
	?>
	</div>
	</p>
  </article>
  </section>
</body>
</html>

<?php


if (isset($_POST['add_add'])) {
	$b = e($_POST['newadmin']);
	$a = e($_POST['newpass']);
	
	$query = "INSERT INTO TruckDriver2.Admins VALUES ('$b')";
		if(mysqli_query($db, $query)){
			echo 'inserted';
		}	
		else{
			echo 'fuck';
		}
	

	$query = "INSERT INTO TruckDriver2.Information (Password, Admins) VALUES ('$a','$b' )";
		if(mysqli_query($db, $query)){
			echo 'inserted';
		}	
		else{
			echo 'fuck';
		}
	}
	/*$query = "INSERT INTO TruckDriver2.Admins  VALUES('$username', '$compID', '$fName', '$mName', '$lName', '$compName')";
		if(mysqli_query($db, $query)){
			echo 'inserted';
		}	
		else{
			echo 'fuck';
		}
	//}*/



	?>
