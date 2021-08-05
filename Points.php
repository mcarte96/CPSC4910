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
  <h2>Points Page</h2>
</header>

<section>
  <nav >

    <?php
    include ('sql_connection.php');
    session_start();
      $username = $_SESSION['username'];
      $_POST['user'] = $username;
      $usertype = "Admins";
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
include ('sql_connection.php');
$query = "SELECT SUM(Price) FROM TruckDriver2.Ordered";
$res = mysqli_query($conn, $query);
if (mysqli_num_rows($res) > 0)
{
    // output data of each row
    while ($row = mysqli_fetch_assoc($res))
    {
        echo "<h2>Total Points"." ". $row['SUM(Price)'] . "</h2><br>";
    }
}
$redemption = "SELECT SUM(Price*0.01) FROM TruckDriver2.Ordered";
$result = mysqli_query($conn, $redemption);
if (mysqli_num_rows($result) > 0)
{
    // output data of each row
    while ($row = mysqli_fetch_assoc($result))
    {
        echo "<h2>Redemption Points"." ". $row['SUM(Price*0.01)'] . "</h2><br>";
    }
}

?>
</div>

</article>
</section>
  </body>
</html>
