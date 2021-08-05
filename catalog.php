<?php
include ('sql_connection.php');
include ('EmailSender.php');

session_start();
if(isset($_GET['id'])) {
	$_SESSION['sponsorName'] = $_GET['id'];
	$sponsorName = $_SESSION['sponsorName'];
} else {
	$sponsorName = $_SESSION['sponsorName'];
}

$username = $_SESSION['username'];
$cartPoints = 0;
$usertype = "Driver";

//query to get sponsored connection's points
$sqlSponsored = "SELECT Driver, Sponsor, Points FROM TruckDriver2.Sponsored WHERE Driver = '$username' && Sponsor = '$sponsorName'";
$result = mysqli_query($conn, $sqlSponsored);
while ($row = mysqli_fetch_assoc($result))
{
  $sponsor = $row["Sponsor"];
  $points = $row["Points"];
  $_SESSION['points'] =  $points;
}

//query to get points in the cart
$sqlCurrCart = "SELECT driverUsername, SponsorName, Price, Quantity FROM TruckDriver2.Cart WHERE driverUsername = '$username' && SponsorName = '$sponsorName'";
$currCart = mysqli_query($conn, $sqlCurrCart);
while ($rowCart = mysqli_fetch_assoc($currCart))
{
  for($f = 0; $f < $rowCart["Quantity"]; $f++) {
    $cartPoints += $rowCart["Price"];
  }

}

//query to get sponsor's keywords and ratio
$sqlSponsor = "SELECT * FROM TruckDriver2.Company WHERE Company_Name = '$sponsorName'";
$result2 = mysqli_query($conn, $sqlSponsor);
while ($row2 = mysqli_fetch_assoc($result2))
{
  $query = $row2["keyword1"];
  $query2 = $row2["keyword2"];
  $query3 = $row2["keyword3"];
  $ratio = $row2["Point_Ratio"];
  $_SESSION['ratio'] = $ratio;
}

// API request
$endpoint = 'https://svcs.ebay.com/services/search/FindingService/v1';  // URL to call
$x = 0;

// Construct the findItemsByKeywords POST call
// Load the call and capture the response returned by the eBay API
$resp = simplexml_load_string(constructPostCallAndGetResponse($endpoint, $query));
$resp2 = simplexml_load_string(constructPostCallAndGetResponse($endpoint, $query2));
$resp3 = simplexml_load_string(constructPostCallAndGetResponse($endpoint, $query3));

// Check to see if the call was successful, else print an error
if ($resp->ack == "Success") {
  $results = '';  // Initialize the $results variable

  // Parse the desired information from the response
  foreach($resp->searchResult->item as $item) {
    $pic   = $item->galleryURL;
    $link  = $item->viewItemURL;
    $title = $item->title;
    $price = $item->sellingStatus->currentPrice;
    $pointPrice = floatval($price) * floatval($ratio);
    $itemID = $item->itemId;
    $x = $x + 1;

    $titles[$x] = "$title";
    $prices[$x] = "$pointPrice";
    $urls[$x] = "$link";
    $pictures[$x] = "$pic";
    $dollars[$x] = "$price";
    $itemIDs[$x] = "$itemID";

    // Build the desired HTML code for each searchResult.item node and append it to $results
    $results .= "<tr><td><img src=\"$pic\"></td><td class='txt'><a href=\"$link\">$title</a></td>
                <td class='txt'><div class='txt' align='center'><p class='txt' align='center'> $pointPrice points</p></div></div></td></tr>";
  }
}

if ($resp2->ack == "Success") {
  $results2 = '';  // Initialize the $results variable

  // Parse the desired information from the response
  foreach($resp2->searchResult->item as $item) {
    $pic   = $item->galleryURL;
    $link  = $item->viewItemURL;
    $title = $item->title;
    $price = $item->sellingStatus->currentPrice;
    $pointPrice = floatval($price) * floatval($ratio);
    $itemID = $item->itemId;
    $x = $x + 1;

    $titles[$x] = "$title";
    $prices[$x] = "$pointPrice";
    $urls[$x] = "$link";
    $pictures[$x] = "$pic";
    $dollars[$x] = "$price";
    $itemIDs[$x] = "$itemID";

    // Build the desired HTML code for each searchResult.item node and append it to $results
    $results2 .= "<tr><td><img src=\"$pic\"></td><td class='txt'><a href=\"$link\">$title</a></td>
                <td class='txt'><div class='txt' align='center'><p class='txt' align='center'> $pointPrice points</p></div></div></td></tr>";
  }
}

if ($resp3->ack == "Success") {
  $results3 = '';  // Initialize the $results variable

  // Parse the desired information from the response
  foreach($resp3->searchResult->item as $item) {
    $pic   = $item->galleryURL;
    $link  = $item->viewItemURL;
    $title = $item->title;
    $price = $item->sellingStatus->currentPrice;
    $pointPrice = floatval($price) * floatval($ratio);
    $itemID = $item->itemId;
    $x = $x + 1;

    $titles[$x] = "$title";
    $prices[$x] = "$pointPrice";
    $urls[$x] = "$link";
    $pictures[$x] = "$pic";
    $dollars[$x] = "$price";
    $itemIDs[$x] = "$itemID";

    // Build the desired HTML code for each searchResult.item node and append it to $results
    $results3 .= "<tr><td><img src=\"$pic\"></td><td class='txt'><a href=\"$link\">$title</a></td>
                <td class='txt'><div align='center'><p class='pointPrice' align='center'> $pointPrice points</p></div></div></td></tr>";
  }
}
?>

<!-- Build the HTML page with values from the call response -->
<html>
<head>
<title>Sponsor Catalog</title>
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

    .txt{
      font-size: 15pt;
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
      table-layout: fixed;




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
  <!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.--><script>var __adobewebfontsappname__="dreamweaver"</script><script src="http://use.edgefonts.net/fanwood-text:n4:default.js" type="text/javascript"></script></head>
<body>

<header>
  <h1><a href="login.php" >Log Out</a></h1>
  <h2><?=$sponsor?>'s Catalog </h2>
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

<form action="checkSponsor.php" class="input">
    <input type="submit" value="Choose Different Sponsor"  class="input"/>
</form>

<form action="cart.php" class="input">
    <input type="submit" value="View Cart"  class="input"/>
</form>

<h2><?=$sponsor?>'s Catalog </h2>
<p> Your total points: <?=$points?> </p>
<p> Points available that are not in your current cart: <?=($points - $cartPoints)?> </p>

<table>
<tr>
  <td>
    <?php echo $results;?>
    <?php echo $results2;?>
    <?php echo $results3;?>
  </td>
</tr>
</table>

<form action="catalog.php" method='post'>
<select name="browse">
<?php
for($i=1; $i<=$x; $i++)
{
    echo "<option value=".$i.">".$titles[$i]."</option>";
}
?>
</select>
<input type="submit" />
</form>

<?php
if(isset($_POST['browse'])){
    $j = $_POST['browse'];
    $done = 0;
    if($prices[$j] <= ($points - $cartPoints)) {
        //if item is already in the cart, just increase quantity
        $ScurrCart = "SELECT driverUsername, SponsorName, itemName, Price, Quantity, idCart FROM TruckDriver2.Cart WHERE driverUsername = '$username' && SponsorName = '$sponsorName'";
        $currCartRes = mysqli_query($conn, $ScurrCart);
        while ($rowCurr = mysqli_fetch_assoc($currCartRes))
        {
            if($rowCurr["itemName"] == "$titles[$j]") {
                if($cartPoints + ($rowCurr["Price"]*newQ) <= $points) {
                    $newQ = $rowCurr["Quantity"]+1;
                    $done = 1;
                    $id = $rowCurr["idCart"];
                    mysqli_query($conn,'UPDATE TruckDriver2.Cart SET Quantity = '. $newQ .' WHERE idCart = '. $id .' ');
                    echo "<meta http-equiv='refresh' content='0'>";
		} else {
                    echo "You do not have enough points for that item.";
		}
	    }
        }
        if ($done == 0 && $titles[$j] != "") {
					//check to see if email option is set dont forget isset & email condition
          $checkEmail = "SELECT * FROM TruckDriver2.Driver WHERE Username = '$username'";
          $result = mysqli_query($conn, $checkEmail);
          $boolEmail = 5;
          while ($row = mysqli_fetch_assoc($result))
          {
              $boolEmail = $row['Cart_Alert'];
          }
            if ($boolEmail){
            //email functionality
            echo "sending email \n";
				    $getDriverEmail = "SELECT * FROM TruckDriver2.Information WHERE Driver = '$username'";
				    $result = mysqli_query($conn, $getDriverEmail);
				    $email = "";
				    while ($row = mysqli_fetch_assoc($result))
				    {
				        $email = $row['Email'];
            }
            $productName = $titles[$j];
            echo "email is '$email'";
				    SendMail($email, $productName, "New Item!");
          }
            $sqlCart = "INSERT INTO TruckDriver2.Cart (driverUsername, Price, dollarPrice, Quantity, SponsorName, itemName, itemURL, Picture, itemID) VALUES ('$username', '$prices[$j]', '$dollars[$j]', '1', '$sponsorName', '$titles[$j]', '$urls[$j]', '$pictures[$j]', '$itemIDs[$j]')";
            $cartAdd = mysqli_query($conn, $sqlCart);
            echo "<meta http-equiv='refresh' content='0'>";
        }
    } else {
        echo "You do not have enough points for that item.";
    }
}
?>
</article>
</body>
</html>

<?php
function constructPostCallAndGetResponse($endpoint, $query) {
  global $xmlrequest;

  // Create the XML request to be POSTed
  $xmlrequest  = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
  $xmlrequest .= "<findItemsByKeywordsRequest xmlns=\"http://www.ebay.com/marketplace/search/v1/services\">\n";
  $xmlrequest .= "<keywords>";
  $xmlrequest .= $query;
  $xmlrequest .= "</keywords>\n";
  $xmlrequest .= "<paginationInput>\n  <entriesPerPage>5</entriesPerPage>\n</paginationInput>\n";
  $xmlrequest .= "</findItemsByKeywordsRequest>";

  // Set up the HTTP headers
  $headers = array(
    'X-EBAY-SOA-OPERATION-NAME: findItemsByKeywords',
    'X-EBAY-SOA-SERVICE-VERSION: 1.3.0',
    'X-EBAY-SOA-REQUEST-DATA-FORMAT: XML',
    'X-EBAY-SOA-GLOBAL-ID: EBAY-US',
    'X-EBAY-SOA-SECURITY-APPNAME: ErinHilt-4910Shop-PRD-5ca7fae94-8700e288',
    'Content-Type: text/xml;charset=utf-8',
  );

  $session  = curl_init($endpoint);                       // create a curl session
  curl_setopt($session, CURLOPT_POST, true);              // POST request type
  curl_setopt($session, CURLOPT_HTTPHEADER, $headers);    // set headers using $headers array
  curl_setopt($session, CURLOPT_POSTFIELDS, $xmlrequest); // set the body of the POST
  curl_setopt($session, CURLOPT_RETURNTRANSFER, true);    // return values as a string, not to std out

  $responsexml = curl_exec($session);                     // send the request
  curl_close($session);                                   // close the session
  return $responsexml;                                    // returns a string

}  // End of constructPostCallAndGetResponse function
?>
