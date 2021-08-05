<?php
include ('sql_connection.php');

session_start();
//$username = 'Bob';
//$sponsorName = 'Test2';
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
    $query = "SELECT * FROM TruckDriver2.Sponsor_Company_Admin WHERE Username='$username' ";
    $results = mysqli_query($conn, $query);
    if (mysqli_num_rows($results) >= 1) {
        while ($row = mysqli_fetch_assoc($results))
        {
          $sponsorName = $row["Company_Name"];
        }
    }
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



//query to get sponsor's keywords and ratio
$sqlSponsor = "SELECT * FROM TruckDriver2.Company WHERE Company_Name = '$sponsorName'";
$result2 = mysqli_query($conn, $sqlSponsor);
while ($row2 = mysqli_fetch_assoc($result2))
{
  $query = $row2["keyword1"];
  $query2 = $row2["keyword2"];
  $query3 = $row2["keyword3"];
  $ratio = $row2["Point_Ratio"];
  $id = $row2["ID"];
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
    $x = $x + 1;

    $titles[$x] = "$title";
    $prices[$x] = "$pointPrice";
    $urls[$x] = "$link";
    $pictures[$x] = "$pic";
    $dollars[$x] = "$price";

    // Build the desired HTML code for each searchResult.item node and append it to $results
    $results .= "<tr><td><img src=\"$pic\"></td><td class=\"txt\"><a href=\"$link\">$title</a></td>
                <td class=\"txt\"><div class='pointPrice' align='center'><p class='pointPrice' align='center'> $pointPrice points</p></div></div></td></tr>";
  }
} else {  // If the response does not indicate 'Success,' print an error
  $results  = "<h3>Oops! The request was not successful. Make sure you are using a valid ";
  $results .= "AppID for the Production environment.</h3>";
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
    $x = $x + 1;

    $titles[$x] = "$title";
    $prices[$x] = "$pointPrice";
    $urls[$x] = "$link";
    $pictures[$x] = "$pic";
    $dollars[$x] = "$price";

    // Build the desired HTML code for each searchResult.item node and append it to $results
    $results2 .= "<tr><td><img src=\"$pic\"></td><td class=\"txt\"><a href=\"$link\">$title</a></td>
                <td class=\"txt\"><div class='pointPrice' align='center'><p class='pointPrice' align='center'> $pointPrice points</p></div></div></td></tr>";
  }
} else {  // If the response does not indicate 'Success,' print an error
  $results2  = "<h3>Oops! The request was not successful. Make sure you are using a valid ";
  $results2 .= "AppID for the Production environment.</h3>";
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
    $x = $x + 1;

    $titles[$x] = "$title";
    $prices[$x] = "$pointPrice";
    $urls[$x] = "$link";
    $pictures[$x] = "$pic";
    $dollars[$x] = "$price";

    // Build the desired HTML code for each searchResult.item node and append it to $results
    $results3 .= "<tr><td><img src=\"$pic\"></td><td class=\"txt\"><a href=\"$link\">$title</a></td>
                <td class=\"txt\"><div class='pointPrice' align='center'><p class='pointPrice' align='center'> $pointPrice points</p></div></div></td></tr>";
  }
} else {  // If the response does not indicate 'Success,' print an error
  $results3  = "<h3>Oops! The request was not successful. Make sure you are using a valid ";
  $results3 .= "AppID for the Production environment.</h3>";
}
?>

<!-- Build the HTML page with values from the call response -->
<html>
<head>
<title>Edit Catalog</title>
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
  <h2><?=$sponsorName?>'s Catalog Information</h2>
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


<!-- Keyword summary and form -->
<?php echo "<strong> Your current keywords are: ", $query, ", ", $query2, ", ", $query3;?>
<p></p>

<form action="catalogEdit.php" method="POST" id="nameform">
  <label for="key1">Keyword 1:</label>
  <input type="text" id="key1" name="key1"><br><br>
  <label for="key2">Keyword 2:</label>
  <input type="text" id="key2" name="key2"><br><br>
  <label for="key3">Keyword 3:</label>
  <input type="text" id="key3" name="key3"><br><br>
  <button type="submit" form="nameform" value="Submit">Update Keywords</button>
</form>

<!-- Keyword button actions -->
<?php
if(isset($_POST['key1'])){
    if($_POST['key1'] != "") {
        $key = $_POST["key1"];
        $sqlKey1 = "UPDATE TruckDriver2.Company SET keyword1 = '$key' WHERE Company_Name = '$sponsorName'";
        $key1SQL = mysqli_query($conn, $sqlKey1);
    }
} 

if(isset($_POST['key2'])){
    if($_POST['key2'] != "") {
        $key = $_POST["key2"];
        $sqlKey2 = "UPDATE TruckDriver2.Company SET keyword2 = '$key' WHERE Company_Name = '$sponsorName'";
        $key2SQL = mysqli_query($conn, $sqlKey2);
    }
}

if(isset($_POST['key3'])){
    if($_POST['key3'] != "") {
        $key = $_POST["key3"];
        $sqlKey3 = "UPDATE TruckDriver2.Company SET keyword3 = '$key' WHERE Company_Name = '$sponsorName'";
        $key3SQL = mysqli_query($conn, $sqlKey3);
    }
    echo "<meta http-equiv='refresh' content='0'>"; 
}
?>

<!-- Ratio summary and button -->
<?php echo "<strong>Your current point to dollar ratio is: ", $ratio, ", or ", $ratio, " points for every dollar";?>
<p></p>
<form action="catalogEdit.php" method="POST" id="ratioform">
    <label for="ratio">Change Your Point Ratio:</label>
    <input type="number" id="ratio" name="ratio" min="0">
    <button type="submit" form="ratioform" value="Submit">Update Ratio</button>
</form>

<!-- Ratio button actions -->
<?php
if(isset($_POST['ratio'])){
   $ratN = $_POST["ratio"];
   $sqlRat = "UPDATE TruckDriver2.Company SET Point_Ratio = '$ratN' WHERE Company_Name = '$sponsorName'";
   $ratSQL = mysqli_query($conn, $sqlRat);
   echo "<meta http-equiv='refresh' content='0'>"; 
}
?>

<p></p>
<p></p>
<h2>Catalog Preview</h2>

<table>
<tr>
  <td>
    <?php echo $results;?>
    <?php echo $results2;?>
    <?php echo $results3;?>
  </td>
</tr>
</table>


</article>
</body>
</section>
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