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
    font-family: fanwood-text;
    font-size: 14pt;    
    text-align: center;
    padding: 2px;
    margin: 0 auto;
    


  }

    a:link {
      color: #30110D;
  }

/* visited link */
  a:visited {
      color: #722620;
  }

  img{
    position: relative; 
    left: 5%; 
    top: 5%;
  }
  </style>
  <!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.--><script>var __adobewebfontsappname__="dreamweaver"</script><script src="http://use.edgefonts.net/fanwood-text:n4:default.js" type="text/javascript"></script>

  </head>
  <body>


<?php
include('sponsorAM_functions.php');
$usertype = "Driver";
$username = $_SESSION['username'];

echo"
<header>
  
  <h1><a href=\"login.php\">Log Out</a></h1>
  <h2> Hello, ".$_SESSION['username'] ."</h2>
</header>

";

?>


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
    <form method="post">
      <!--<div class= username>
        <label>Username</label>
        <input type = "text" name = "user" required>
      </div>
      <div class="reg_button">
        <button type="submit" class="btn btn-info"> Check </button>
      </div>-->
    </form>
<?php
include ('sql_connection.php');
include ('EmailSender.php');
$savedUsername = $_SESSION['username'];
echo '<h2> Your Sponsors are: </h2>';
$_SESSION['catalog'] = "catalog.php";
    //query to get record
    $sqlAdminCompany = "SELECT Sponsor, Points FROM TruckDriver2.Sponsored WHERE Driver = '$savedUsername'";
    $result = mysqli_query($conn, $sqlAdminCompany);
    //change record table into attributes
    $record = 0;
    while ($row = mysqli_fetch_assoc($result))
    {
      $record = $record + 1;
      $sponsor = $row['Sponsor'];
        echo " <div><p>Sponsor: ", $row["Sponsor"]."
        <br>
        Points: ". $row["Points"]. "</p>";             
        echo '<a href="' . htmlspecialchars("catalog.php?id=" . urlencode($sponsor)) . '">'."\n";
        echo '<button type="submit" class="input"> Check Catalog </button></a>';
        echo "<img src='default.png' width='100' height='100' >";
        echo "</div><br>";
    }
    if ($record == 0){
      echo "You currently have no sponsors <br>";
    }
    echo "<br>";


//get the rest of sponsors
$sqlSponsorCompany = "SELECT * FROM TruckDriver2.Sponsor_Company_Admin";
$resultAdmin = mysqli_query($conn, $sqlSponsorCompany);
echo "<h2> Available Sponsors are: </h2> <br>";
while ($row2 = mysqli_fetch_assoc($resultAdmin))
{
    echo "<p>Company name: ", $row2["Company_Name"],"<br>";
    $emailUSername = $row2["Username"];
    $sqlFindEmail = "SELECT * FROM TruckDriver2.Information WHERE Company_Admin = '$emailUSername' LIMIT 1";
    $resultEmail = mysqli_query($conn, $sqlFindEmail);
    while ($rowEmail = mysqli_fetch_assoc($resultEmail))
    {
        echo $rowEmail["Email"];  
        echo "</p>";      
        echo "<img src='default.png' width='100' height='100'>";
        echo "<br>";
    }
    echo '<br>';
}
if(isset($_POST['add']))
{
	$Sponsor = $_POST['add'];
	$sql = "INSERT INTO TruckDriver2.DriverApplication(Driver, Sponsor) VALUES ('$savedUsername', '$Sponsor')";
	mysqli_query($conn,$sql);
  $sql = "SELECT * FROM TruckDriver2.Sponsor_Company_Admin WHERE Company_Name = '$Sponsor'";
  $resultAdmin = mysqli_query($conn,$sql);
  $adminUsername = "";
  while ($row = mysqli_fetch_assoc($resultAdmin)){
    $adminUsername =  $row['Username'];
  }
  $sql = "SELECT * FROM TruckDriver2.Information WHERE Company_Admin = '$adminUsername'";
  $result = mysqli_query($conn,$sql);
  $email = "";
  while ($row = mysqli_fetch_assoc($result)){
    $email = $row['Email'];
  }
  SendMail($email, $savedUsername, "New Sponsorship request!");
}
if(isset($_POST['leave']))
{
  $Sponsor = $_POST['leave'];
	$sql = "DELETE FROM TruckDriver2.Sponsored WHERE Driver ='$savedUsername' AND Sponsor = '$Sponsor'";
	mysqli_query($conn,$sql);
}

?>
<form method="post">
        <div class= username>
	  <label>Sponsor_name</label>
          <input type = "text" name = "add" required>
        </div>
        <div class="reg_button">
          <button type="submit" class="btn btn-info"> Apply </button>
        </div>
      </form>
<form method="post">
        <div class= username>
	  <label>Sponsor_name</label>
          <input type = "text" name = "leave" required>
        </div>
        <div class="reg_button">
          <button type="submit" class="btn btn-info"> Leave Sponsor </button>
        </div>
      </form>


</div>
</article>
  </body>
</html>
