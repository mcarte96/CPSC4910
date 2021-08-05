<?php
session_start();
include ('sql_connection.php');
include ('EmailSender.php');
$savedUsername = $_SESSION['username'];

$usertype = "";
$username = $savedUsername;

$query = "SELECT * FROM TruckDriver2.Information WHERE Driver='$username' ";
$results = mysqli_query($conn, $query);
if (mysqli_num_rows($results) >= 1) {
    $usertype = "Driver";
}

$query = "SELECT * FROM TruckDriver2.Information WHERE Company_Admin='$username' ";
$results = mysqli_query($conn, $query);
if (mysqli_num_rows($results) >= 1) {
    $usertype = "Company_Admin";
}

$query = "SELECT * FROM TruckDriver2.Information WHERE Admins='$username' ";
$results = mysqli_query($conn, $query);
if (mysqli_num_rows($results) >= 1) {
    $usertype = "Admins";
}

$query = "SELECT * FROM TruckDriver2.Information WHERE Company_Manager='$username' ";
$results = mysqli_query($conn, $query);
if (mysqli_num_rows($results) >= 1) {
    $usertype = "Company_Manager";
}

if ($usertype == NULL)
    echo "Something is wrong";
else
    //echo $usertype;



//query to get record
if ($usertype == "Company_Manager"){
    $Sponsor = "SELECT DISTINCT Company_Name FROM TruckDriver2.Company WHERE Company_Name IN (SELECT Company_Name FROM TruckDriver2.Sponsor_Company_Manager WHERE Username = '$savedUsername')";        
}
else if ($usertype == "Company_Admin"){
    $Sponsor = "SELECT DISTINCT Company_Name FROM TruckDriver2.Company WHERE Company_Name IN (SELECT Company_Name FROM TruckDriver2.Sponsor_Company_Admin WHERE Username = '$savedUsername')";
}

//echo $Sponsor;
$output = mysqli_query($conn, $Sponsor);
$data="";
if (mysqli_num_rows($output) > 0)
{
    // output data of each row
    while ($row = mysqli_fetch_assoc($output))
    {
    $data = $row["Company_Name"];
        //echo "<br>" . $data. "</br>";
    }

}
else
{
    echo "0 results";
}

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
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
            width: 70%;
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
        width: 70%;
        margin: 0 auto;   
         background-color: #f2bc94;
        color: #30110D;
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
        <h2>Manage Drivers for <?php echo $data?></h2>
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
    <h2>Your Drivers</h2>
    <br>
<?php
$sqlSponsor = "SELECT Driver, Points FROM TruckDriver2.Sponsored WHERE Sponsor = '$data'";
$result = mysqli_query($conn, $sqlSponsor);
if (mysqli_num_rows($result) > 0)
{
    #echo "<h2> Drivers are:</h2>";
    echo "<table><tr><th>Drivers</th><th>Points</th></tr>";
    // output data of each row
    while ($row = mysqli_fetch_assoc($result))
    {
        echo "<tr><td>" . $row["Driver"] . "</td><td>" . $row["Points"] . "</td></tr>";
    }
    echo "</table>
    <br>";
}
else
{
    echo "0 results";
}
?>

    <div>
    <form method="post" class="input">
        <div>
          <label>Driver's name</label>
            <input type = "text" name = "Driver">
	      <label>Add points</label>
	        <input type = "number" name ="Add">
	   </div>
        <div>
          <button type="submit" class="input">Add points</button>
        </div>
        </form>
    <form method="post" class="input">
        <div class = username>
            <label>Driver's name</label>
                <input type = "text" name = "Driver" required>
            <label>Take away points</label>
	            <input type = "number" name ="Subtract" not required>
        </div>
        <div>
          <button type="submit" class="input">Subtract points</button>
        </div>
	</form>
    <br>
    <form method="post" class="input">
        <div>
          <label>Add a Driver</label>
            <input type = "text" name = "Add_driver" required>
	    <!--  <label>Sponsor</label>
            <input type = "text" name = "Sponsor" required>-->

	   </div>
        <div>
          <button type="submit" class="input">Add Driver</button>
        </div>
    </form>
<form method="post" class="input">
        <div>
          <label>Drop a Driver</label>
          <input type = "text" name = "Drop_driver" required>
	 <!--<label>Sponsor</label>
          <input type = "text" name = "Sponsor" required>-->

	   </div>
        <div>
          <button type="submit" class="input"> Drop driver </button>
        </div>
        <br>
</form>

<?php

echo '<div>';
echo "<h2>All drivers: </h2>";
$sqlRest = "SELECT Username FROM TruckDriver2.Driver";
$res = mysqli_query($conn, $sqlRest);

if (mysqli_num_rows($res) > 0)
{
    // output data of each row
    while ($row = mysqli_fetch_assoc($res))
    {
        echo $row["Username"] . "<br>";
    }
}


echo nl2br("\n");
echo "<h2>Driver applications: </h2>";

$add = "SELECT Driver FROM TruckDriver2.DriverApplication WHERE Sponsor = '$data'";
$output = mysqli_query($conn, $add);
if (mysqli_num_rows($output) > 0)
{
    #echo "<h2> Drivers are:</h2>";
    echo "<table><tr><th>Drivers</th></tr>";
    // output data of each row
    while ($row = mysqli_fetch_assoc($output))
    {
        echo "<tr><td>" . $row["Driver"] . "</td><t/tr>";
    }
    echo "</table>";

}
else
{
    echo "0 applications";
}

echo "<br>";

if (isset($_POST['Driver']))
{
    $name = $_POST['Driver'];

    $decrease = $_POST['Subtract'];
    $increase = $_POST['Add'];
    //check to see if email option is set dont forget isset & email condition
    $checkEmail = "SELECT * FROM TruckDriver2.Driver WHERE Username = '$name'";
    $result = mysqli_query($conn, $checkEmail);
    $boolEmail = 5;
    while ($row = mysqli_fetch_assoc($result))
    {
        $boolEmail = $row['Point_Alert'];
    }
    if (isset($_POST['Add'])){
    $add = "Update TruckDriver2.Sponsored Set Points = Points +'$increase' WHERE Driver = '$name' AND Sponsor = '$data'";
    mysqli_query($conn, $add);
    if ($boolEmail){
    //email functionality
    echo "sending email\n";
    $getAddPointsDriverEmail = "SELECT * FROM TruckDriver2.Information WHERE Driver = '$name'";
    $result = mysqli_query($conn, $getAddPointsDriverEmail);
    $email = "";
    while ($row = mysqli_fetch_assoc($result))
    {
        $email = $row['Email'];
    }
    SendMail($email, "You have gained '$increase'", "Got Points!");
    }
}

    if (isset($_POST['Subtract'])){
    $subtract = "Update TruckDriver2.Sponsored Set Points = Points -'$decrease' WHERE Driver = '$name' AND Sponsor = '$data'";
    mysqli_query($conn, $subtract);
    echo "The condition is '$boolEmail'\n";
if ($boolEmail){
    echo "sending email\n";
    //email functionality
    $getSubPointsDriverEmail = "SELECT * FROM TruckDriver2.Information WHERE Driver = '$name'";
    $result = mysqli_query($conn, $getSubPointsDriverEmail);
    $email = "";
    while ($row = mysqli_fetch_assoc($result))
    {
        $email = $row['Email'];
    }
    SendMail($email, "You have lost '$decrease'", "Lost Points!");
}
}
    $Sponsor = "SELECT DISTINCT Sponsor FROM TruckDriver2.Sponsored WHERE Sponsor = '$data'";
    $output = mysqli_query($conn, $Sponsor);
    if (mysqli_num_rows($output) > 0)
    {
        #echo "<h2> Drivers are:</h2>";
        // output data of each row
        while ($row = mysqli_fetch_assoc($output))
        {
            echo "<br>" . $row["Sponsor"] . "</br>";
        }

    }
    else
    {
        echo "0 results";
    }

    $query = "SELECT Driver, Points FROM TruckDriver2.Sponsored WHERE Sponsor = '$data'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0)
    {
        #echo "<h2> Drivers are:</h2>";
        echo "<table><tr><th>Drivers</th><th>Points</th></tr>";
        // output data of each row
        while ($row = mysqli_fetch_assoc($result))
        {
            echo "<tr><td>" . $row["Driver"] . "</td><td>" . $row["Points"] . "</td></tr>";
        }
        echo "</table>";
    }
    else
    {
        echo "0 results";
    }
    echo nl2br("\n");

}

if (isset($_POST['Add_driver']))
{
    $addDriver = $_POST['Add_driver'];
    //email functionality
    $getAddDriverEmail = "SELECT * FROM TruckDriver2.Information WHERE Driver = '$addDriver'";
    $result = mysqli_query($conn, $getAddDriverEmail);
    $email = "";
    while ($row = mysqli_fetch_assoc($result))
    {
        $email = $row['Email'];
    }
    SendMail($email, "You have been added by '$data'", "New Sponsor!");
    $output = "INSERT INTO TruckDriver2.Sponsored (Driver, Sponsor) VALUES ('$addDriver','$data')";
    mysqli_query($conn, $output);
    $output = "SELECT Driver FROM TruckDriver2.Sponsored WHERE Sponsor = '$data'";
    $result = mysqli_query($conn, $output);
    if (mysqli_num_rows($result) > 0)
    {
        #echo "<h2> Drivers are:</h2>";
        echo "<table><tr><th>Drivers</th></tr>";
        // output data of each row
        while ($row = mysqli_fetch_assoc($result))
        {
            echo "<tr><td>" . $row["Driver"] . "</td></tr>";
        }
        echo "</table>";
    }
    else
    {
        echo "0 results";
    }
    $output = "DELETE FROM TruckDriver2.DriverApplication WHERE Driver = '$addDriver' AND Sponsor= '$data'";
    mysqli_query($conn, $output);
    echo "<h2>Driver applications: </h2>";

    $add = "SELECT Driver FROM TruckDriver2.DriverApplication WHERE Sponsor = '$data'";
    $output = mysqli_query($conn, $add);
    if (mysqli_num_rows($output) > 0)
    {
        #echo "<h2> Drivers are:</h2>";
        echo "<table><tr><th>Drivers</th></tr>";
        // output data of each row
        while ($row = mysqli_fetch_assoc($output))
        {
            echo "<tr><td>" . $row["Driver"] . "</td><t/tr>";
        }
        echo "</table>";

    }
    else
    {
        echo "0 applications";
    }

}
if (isset($_POST['Drop_driver']))
{
    $dropDriver = $_POST['Drop_driver'];
    //email functionality
    $getDropDriverEmail = "SELECT * FROM TruckDriver2.Information WHERE Driver = '$dropDriver'";
    $result = mysqli_query($conn, $getDropDriverEmail);
    $email = "";
    while ($row = mysqli_fetch_assoc($result))
    {
        $email = $row['Email'];
    }
    SendMail($email, "You have been dropped by '$data'", "New Sponsor!");
    $output = "DELETE FROM TruckDriver2.Sponsored WHERE Driver = '$dropDriver' AND Sponsor= '$data'";
    mysqli_query($conn, $output);
    $output = "SELECT Driver FROM TruckDriver2.Sponsored WHERE Sponsor = '$data'";
    $result = mysqli_query($conn, $output);
    if (mysqli_num_rows($result) > 0)
    {
        #echo "<h2> Drivers are:</h2>";
        echo "<table><tr><th>Drivers</th></tr>";
        // output data of each row
        while ($row = mysqli_fetch_assoc($result))
        {
            echo "<tr><td>" . $row["Driver"] . "</td></tr>";
        }
        echo "</table>";
    }
    else
    {
        echo "0 results";
    }
    $drop = "DELETE FROM TruckDriver2.DriverApplication WHERE Driver = '$dropDriver' AND Sponsor= '$data'";
    mysqli_query($conn, $drop);
    echo "<h2>Driver applications: </h2>";

    $add = "SELECT Driver FROM TruckDriver2.DriverApplication WHERE Sponsor = '$data'";
    $output = mysqli_query($conn, $add);
    if (mysqli_num_rows($output) > 0)
    {
        #echo "<h2> Drivers are:</h2>";
        echo "<table><tr><th>Drivers</th></tr>";
        // output data of each row
        while ($row = mysqli_fetch_assoc($output))
        {
            echo "<tr><td>" . $row["Driver"] . "</td><t/tr>";
        }
        echo "</table>";

    }
    else
    {
        echo "0 applications";
    }

}

?>
</div>
</article>
  </body>
</html>
