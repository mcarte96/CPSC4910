<?php
include ('sql_connection.php');

session_start();
$username = $_SESSION['username'];
$sponsorName = $_SESSION['sponsorName'];
$_SESSION['sponsorName'] = $sponsorName;
$points = $_SESSION['points'];
$_SESSION['catalog'] = "catalog.php";
$_SESSION['order_history'] = "orderHistory.php";
$ratio = $_SESSION['ratio'];
$usertype = "Driver";


//query to get items from their cart
$sqlCart = "SELECT * FROM TruckDriver2.Cart WHERE driverUsername = '$username' && SponsorName = '$sponsorName'";
$result = mysqli_query($conn, $sqlCart);
$x = 0;
$orderPoints = 0;
$results="";

while ($row = mysqli_fetch_assoc($result))
{
  $ids[$x] = $row["idCart"];
  $dollars[$x] = $row["dollarPrice"];
  $prices[$x] = $row["Price"];
  $quantities[$x] = $row["Quantity"];
  $names[$x] = $row["itemName"];
  $urls[$x] = $row["itemURL"];
  $pics[$x] = $row["Picture"];
  $itemIDs[$x] = $row["itemID"];

  //ensure most updated price
  $query = $itemIDs[$x];

  // Construct the findItemsByKeywords POST call
  // Load the call and capture the response returned by the eBay API
  $resp = simplexml_load_string(constructPostCallAndGetResponse($query));

  // Check to see if the call was successful, else print an error
  if ($resp->Ack == "Success") {
      // Parse the desired information from the response
      foreach($resp->Item as $item) {
        $NewPrice = $item->ConvertedCurrentPrice;
        $NewPointPrice = floatval($NewPrice) * floatval($ratio);
      }

      if($dollars[$x] != $NewPrice) {
      	mysqli_query($conn,'UPDATE TruckDriver2.Cart SET dollarPrice = '. $NewPrice .' WHERE idCart = '. $ids[$x] .' ');
	mysqli_query($conn,'UPDATE TruckDriver2.Cart SET Price = '. $NewPointPrice .' WHERE idCart = '. $ids[$x] .' ');
	$prices[$x] = $NewPointPrice;
      	$dollars[$x] = $NewPrice;
      }
  }
  $orderPoints += ($prices[$x] * $quantities[$x]);
  $x++;
}

for($i = 0; $i < $x; $i++){
    // Build the desired HTML code for each searchResult.item node and append it to $results
    $results .= "<tr><td><img src=\"$pics[$i]\"></td><td><a href=\"$urls[$i]\">$names[$i]</a></td>
                <td class='txt'><div class='pointPrice' align='center'><p class='pointPrice' align='center'>$prices[$i] points</p></div></div></td>
                <td class='txt><div class='Qs' align='center'><p class='Qs' align='center'>Amount: $quantities[$i] </p></div></div></td></tr>";
}

if($results == ""){
    $results .= "<strong>Your cart is empty. Start shopping in the catalog!<br><br>";
}

?>

<!-- Build the HTML page with values from the call response -->
<html>
<head>
<title>Cart</title>
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
  <h2><?=$sponsorName?>'s Catalog </h2>
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

<h2>Your Cart </h2>
<p> Your total points: <?=$points?> </p>

<table>
<tr>
  <td>
    <?php echo $results;?>
  </td>
</tr>
</table>
<?php echo "Select item to increase quantity here:";?>

<!--QUANTITY BUTTON-->
<form action="cart.php" method='post'>
<select name="update_button">
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
<?php echo "Select item to remove from the cart here:";?>

<form action="cart.php" method='post'>
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
if(isset($_POST['update_button'])){
    $m = $_POST['update_button'];
    if($prices[$m] <= ($points - $orderPoints)) {
      $newQ = $quantities[$m] + 1;
      mysqli_query($conn,'UPDATE TruckDriver2.Cart SET Quantity = '. $newQ .' WHERE idCart = '. $ids[$m] .' '); 
      echo "<meta http-equiv='refresh' content='0'>";
	} else {
      echo "You do not have enough points for that item."; 
	}
} else if(isset($_POST['delete_button'])) {
    $m = $_POST['delete_button'];
    if($quantities[$m] == 1) {
        mysqli_query($conn,'DELETE FROM TruckDriver2.Cart WHERE idCart = '. $ids[$m] .' ');
        echo "<meta http-equiv='refresh' content='0'>";
	} else {
        $newQ = $quantities[$m] - 1;
        mysqli_query($conn,'UPDATE TruckDriver2.Cart SET Quantity = '. $newQ .' WHERE idCart = '. $ids[$m] .' ');
        echo "<meta http-equiv='refresh' content='0'>";
	}
}
?>

<!-- Point Info -->
<p> Order Total Points: <?=$orderPoints?> </p>
<p> Points Remaining: <?=($points - $orderPoints)?> </p>

<!--ORDER BUTTON-->
<form action="cart.php" method='post'>
<input type="submit" name="order_button" value="Place Order" />
</form>

<?php
if(isset($_POST['order_button'])){
    for($y = 0; $y < $x; $y++)
    {
        //Adds item to the Ordered table
        $sqlBuy = "INSERT INTO TruckDriver2.Ordered (driverUsername, Price, dollarPrice, Quantity, sponsorName, itemName, itemURL, Picture, Date) VALUES ('$username', '$prices[$y]', '$dollars[$y]', '$quantities[$y]', '$sponsorName', '$names[$y]', '$urls[$y]', '$pics[$y]', NOW())";
        $buy = mysqli_query($conn, $sqlBuy);

        //Deletes the item from the Cart table
        mysqli_query($conn,'DELETE FROM TruckDriver2.Cart WHERE idCart = '. $ids[$y] .' ');

        //Updates the driver's points
        $newP = $points - $orderPoints;
        $sqlpUp = "UPDATE TruckDriver2.Sponsored SET Points =$newP WHERE Driver = '$username' && Sponsor = '$sponsorName'";
        $updateP = mysqli_query($conn, $sqlpUp);

        echo "Item has been ordered!";
        echo "<meta http-equiv='refresh' content='0'>";
    }
}
?>

<p></p>

<!-- CATALOG BUTTON -->
<?php
echo '<a href="' . htmlspecialchars("catalog.php?id=" . urlencode($sponsorName)) . '">'."\n";
echo '<button type="submit" class="btn btn-info"> Return to Catalog </button></a>';
?>

<p></p>

<!-- ORDER REVIEW -->
<?php
echo '<a href="' . htmlspecialchars("orderHistory.php?id=" . urlencode($sponsorName)) . '">'."\n";
echo '<button type="submit" class="btn btn-info"> Review Order History </button></a>';
?>

</article>
</section>
</body>
</html>

<?php
function constructPostCallAndGetResponse($query) {
  $curl  = curl_init();                       // create a curl session
  
  curl_setopt_array($curl, array(
  	CURLOPT_URL => "https://open.api.ebay.com/shopping?callname=GetSingleItem&responseencoding=XML&appid=ErinHilt-4910Shop-PRD-5ca7fae94-8700e288&siteid=0&version=967&ItemID=$query",
  	CURLOPT_RETURNTRANSFER => true,
  	CURLOPT_ENCODING => "",
  	CURLOPT_MAXREDIRS => 10,
  	CURLOPT_TIMEOUT => 0,
  	CURLOPT_FOLLOWLOCATION => true,
  	CURLOPT_HTTP_VERSION => 'CURL_HTTP_VERSION_1_3',
  	CURLOPT_CUSTOMREQUEST => "GET",
  ));

  $responsexml = curl_exec($curl);                     // send the request
  curl_close($curl);                                   // close the session
  return $responsexml;                                    // returns a string

}  // End of constructPostCallAndGetResponse function
?>