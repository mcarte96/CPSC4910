<?php
include ('sql_connection.php');

session_start();
$username = $_SESSION['username'];
$sponsorName = $_SESSION['sponsorName'];
$_SESSION['catalog'] = "catalog.php";
$_SESSION['cart'] = "cart.php";
$username = $_SESSION['username'];
$usertype = "Driver";

//query to get sponsored connection's points
$sqlSponsored = "SELECT Driver, Sponsor, Points FROM TruckDriver2.Sponsored WHERE Driver = '$username' && Sponsor = '$sponsorName'";
$result = mysqli_query($conn, $sqlSponsored);
while ($row = mysqli_fetch_assoc($result))
{
  $points = $row["Points"];
  $_SESSION['points'] =  $points;
}

//query to get order history
$sqlOrdered = "SELECT * FROM TruckDriver2.Ordered WHERE driverUsername = '$username' && sponsorName = '$sponsorName' ORDER BY idOrdered DESC";
$result = mysqli_query($conn, $sqlOrdered);
$results="";
$x = 0;
while ($row = mysqli_fetch_assoc($result))
{
  $ids[$x] = $row["idOrdered"];
  $dollars[$x] = $row["dollarPrice"];
  $prices[$x] = $row["Price"];
  $quantities[$x] = $row["Quantity"];
  $names[$x] = $row["itemName"];
  $urls[$x] = $row["itemURL"];
  $pics[$x] = $row["Picture"];
  $dates[$x] = $row["Date"];
  $x++;
}


for($i = 0; $i < $x; $i++){
    // Build the desired HTML code for each searchResult.item node and append it to $results
    $results .= "<tr><td><img src=\"$pics[$i]\"></td><td class='txt'><a href=\"$urls[$i]\">$names[$i]</a></td>
                <td class='txt'><div class='input' align='center'><p class='input' align='center'>$prices[$i] points</p></div></div></td>
                <td class='txt'><div class='input' align='center'><p class='input' align='center'>Amount: $quantities[$i]</p></div></div></td>
		<td><div class='input' align='center'><p class='input' align='center'>Ordered $dates[$i]</p></div></div></td></tr>";
}

if($results == ""){
    $results .= "<strong>Your history is empty. Start shopping in the catalog!<br><br>";
}
?>

<!-- Build the HTML page with values from the call response -->
<html>
<head>
<title>Order History</title>
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
      width: 95%;
      margin: 0 auto;
      font-size: 25px;
      table-layout: fixed;



    }
    th,td {
      padding: 3%;
      border: 1px solid #722620;
      column-width: 20%; 
    }
    .txt{
      font-size: 15pt;
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
<!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.--><script>var __adobewebfontsappname__="dreamweaver"</script><script src="http://use.edgefonts.net/fanwood-text:n4:default.js" type="text/javascript"></script></head>
<body>

  <header>
  <h1><a href="login.php" >Log Out</a></h1>
  <h2>Order History</h2>
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

<form action="cart.php" class="input">
    <input class="input" type="submit" value="View Current Cart" />
</form>
<br>
<h2>Your Order History </h2>
<p> Your current points: <?=$points?> </p>

<table>
<tr>
  <td>
    <?php echo $results;?>
  </td>
</tr>
</table>

<?php echo "Select item to increase order quantity here:";?>

<!--INCREASE QUANTITY BUTTON-->
<form action="orderHistory.php" method='post' class="input">
<select name="add_button">
<?php 
for($k=0; $k < $x; $k++)
{
    echo "<option value=".$k.">".$names[$k]."</option>";
}
?> 
</select>
<input type="submit"/>
</form>

<?php echo "Select item to decrease order quantity here:";?>

<!--DECREASE QUANTITY BUTTON-->
<form action="orderHistory.php" method='post' class="input">
<select name="remove_button">
<?php 
for($k=0; $k < $x; $k++)
{
    echo "<option value=".$k.">".$names[$k]."</option>";
}
?> 
</select>
<input type="submit"/>
</form>

<!--DELETE BUTTON-->
<?php echo "Select item to cancel from your orders here:";?>

<form action="orderHistory.php" method='post' class="input">
<select name="delete_button">
<?php 
for($k=0; $k < $x; $k++)
{
    echo "<option value=".$k.">".$names[$k]."</option>";
}
?> 
</select>
<input type="submit"/>
</form>

<!-- Button actions -->
<?php
if(isset($_POST['add_button'])){
    $m = $_POST['add_button'];
    if($prices[$m] <= $points) {
      $newQ = $quantities[$m] + 1;
      mysqli_query($conn,'UPDATE TruckDriver2.Ordered SET Quantity = '. $newQ .' WHERE idOrdered = '. $ids[$m] .' '); 

      //Updates the driver's points
      $newP = $points - $prices[$m];
      $sqlpUp = "UPDATE TruckDriver2.Sponsored SET Points =$newP WHERE Driver = '$username' && Sponsor = '$sponsorName'";
      $updateP = mysqli_query($conn, $sqlpUp);
      echo "<meta http-equiv='refresh' content='0'>";
	} else {
      echo "You do not have enough points for that item."; 
	}
} else if(isset($_POST['delete_button'])) {
    $m = $_POST['delete_button'];
    mysqli_query($conn,'DELETE FROM TruckDriver2.Ordered WHERE idOrdered = '. $ids[$m] .' ');

    //Updates the driver's points
    $newP = $points + $prices[$m];
    $sqlpUp = "UPDATE TruckDriver2.Sponsored SET Points =$newP WHERE Driver = '$username' && Sponsor = '$sponsorName'";
    $updateP = mysqli_query($conn, $sqlpUp);

    echo "<meta http-equiv='refresh' content='0'>";
} else if(isset($_POST['remove_button'])) {
    $m = $_POST['remove_button'];
    $newQ = $quantities[$m] - 1;
    if($newQ == 0) {
        mysqli_query($conn,'DELETE FROM TruckDriver2.Ordered WHERE idOrdered = '. $ids[$m] .' ');
	} else {
        mysqli_query($conn,'UPDATE TruckDriver2.Ordered SET Quantity = '. $newQ .' WHERE idOrdered = '. $ids[$m] .' ');
	}

    //Updates the driver's points
    $newP = $points + $prices[$m];
    $sqlpUp = "UPDATE TruckDriver2.Sponsored SET Points =$newP WHERE Driver = '$username' && Sponsor = '$sponsorName'";
    $updateP = mysqli_query($conn, $sqlpUp);
    echo "<meta http-equiv='refresh' content='0'>";
}
?>

<p></p>
<!-- CATALOG BUTTON -->
<?php
echo '<a href="' . htmlspecialchars("/catalog.php?id=" . urlencode($sponsorName)) . '">'."\n";
echo '<button type="submit" class="btn btn-info"> View Catalog </button></a>';
?>
</article>
</section>
</body>
</html>