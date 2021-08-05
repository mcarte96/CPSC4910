<?php

$dbhost = 'database4910.cz6dbibz7hku.us-east-1.rds.amazonaws.com';
         $dbuser = 'database4910';
         $dbpass = 'database4910';
         $conn = new mysqli($dbhost, $dbuser, $dbpass);
$msg = "";
session_start();

$savedUsername = $_SESSION['username'];
$username = $savedUsername;
$usertype = "Company_Admin";
if (isset($_POST['upload'])) {
	  $sqlAdminCompany = "SELECT Company_Name FROM TruckDriver2.Sponsor_Company_Admin WHERE Username = '$savedUsername'";
    	  $output = mysqli_query($conn, $sqlAdminCompany);
	 if (mysqli_num_rows($output) > 0)
    {
		// output data of each row
		while($row = mysqli_fetch_assoc($output))
		{
			echo "<h2> Company name: " . $row["Company_Name"] . "</h2>";
		}
    }
    else
    {
		echo "0 results";
   	}



	$target = "uploads/".basename($_FILES['image']['name']);


	$image = $_FILES['image']['name'];
	$image_text = mysqli_real_escape_string($conn, $_POST['image_text']);

	$sql = "DELETE FROM TruckDriver2.Images WHERE Sponsor_Admin = '$savedUsername'";
	mysqli_query($conn, $sql);

	$sql = "INSERT INTO TruckDriver2.Images (image, image_text, Sponsor_Admin) VALUES ('$image', '$image_text','$savedUsername')";
	mysqli_query($conn, $sql);

	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
		$msg = "Image uploaded successfully";
	}else{
		$msg = "Failed to upload image";
	}
}

$result = mysqli_query($conn, "SELECT * FROM TruckDriver2.Images WHERE Sponsor_Admin = '$savedUsername'");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Image Upload</title>
	<style type="text/css">
	#content{
		width: 50%;
		margin: 20px auto;
		border: 1px solid #cbcbcb;
	}
	form{
		width: 50%;
		margin: 20px auto;
	}
	form div{
		margin-top: 5px;
	}
	#img_div{
		width: 80%;
		padding: 5px;
		margin: 15px auto;
		border: 1px solid #cbcbcb;
	}
	#img_div:after{
		content: "";
		display: block;
		clear: both;
	}
	img{
		float: left;
		margin: 5px;
		width: 300px;
		height: 140px;
	}
		
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
	<h2>New Logo</h2>
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
	<div id="content">
		<?php

		$sql = "SELECT * FROM TruckDriver2.Images WHERE Sponsor_Admin = '$savedUsername'";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) >= 1) {

		while ($row = mysqli_fetch_array($result)) {
			echo "<div id='img_div'>";
			echo "<img src='uploads/".$row['image']."' >";
			echo "<p>".$row['image_text']."</p>";
			echo "</div>";
		}
	}
		?>
		<form method="post">
      </form>
		<form method="POST" action="CompanyLogo.php" enctype="multipart/form-data">
			<input type="hidden" name="size" value="1000000">
			<div>
				<div>
				<input type="file" name="image">
				</div>
			</div>
			<div>
				<textarea id="text" cols="40" rows="4" name="image_text" placeholder="Say something about this image..."></textarea>
			</div>
			<div>
				<button type="submit" name="upload">POST</button>
			</div>
		</form>
	</div>
</article>
</section>
</body>
</html> 