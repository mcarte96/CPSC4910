<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <?php
include('sponsorAM_functions.php');
$username = $_SESSION['username'];
$usertype = "Driver";

$query = "SELECT * FROM TruckDriver2.Information WHERE Driver='$username' ";
$results = mysqli_query($db, $query);
$row = $results->fetch_assoc();
$datetime1 = date_create($row["Date_Joined"]);
$datetime2 = date_create(date("Y-m-d"));
$interval = date_diff($datetime1, $datetime2);


?>
<title>Safe Driver - <?php echo $username;?>'s Profile Page</title>

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
    img{
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
  <h2><?php echo $username; ?>'s Profile Page</h2>
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
  <h2>This account is <?php echo $interval->format('%a day(s)');?> old</h2>

<?php
    echo "<img src='default.png' width='100' height='100' align=\"middle\">";
?>
    <form method="post"  class="input">
    <div>
      <label>New Phone Number:</label>
      <input type="text" name="Phone">
    </div>

    <div>
      <label>New Email:</label>
      <input type="email" name="Email">
    </div>

    <div>
      <label>New Password:</label>
      <input type="password" name="Password">
    </div>

    <div>
      <label>Confirm Password:</label>
      <input type="password" name="PasswordConfirmation">
    </div>

    <div>
    New Address: <input type="text" name="address" >
  </div>

    <div>
  New City: <input type="text" name="city" >
</div>
  <div>
  New State:
  <select name="state" >
  	<option value=""></option>
  	<option value="AL">Alabama</option>
  	<option value="AK">Alaska</option>
  	<option value="AZ">Arizona</option>
  	<option value="AR">Arkansas</option>
  	<option value="CA">California</option>
  	<option value="CO">Colorado</option>
  	<option value="CT">Connecticut</option>
  	<option value="DE">Delaware</option>
  	<option value="DC">District Of Columbia</option>
  	<option value="FL">Florida</option>
  	<option value="GA">Georgia</option>
  	<option value="HI">Hawaii</option>
  	<option value="ID">Idaho</option>
  	<option value="IL">Illinois</option>
  	<option value="IN">Indiana</option>
  	<option value="IA">Iowa</option>
  	<option value="KS">Kansas</option>
  	<option value="KY">Kentucky</option>
  	<option value="LA">Louisiana</option>
  	<option value="ME">Maine</option>
  	<option value="MD">Maryland</option>
  	<option value="MA">Massachusetts</option>
  	<option value="MI">Michigan</option>
  	<option value="MN">Minnesota</option>
  	<option value="MS">Mississippi</option>
  	<option value="MO">Missouri</option>
  	<option value="MT">Montana</option>
  	<option value="NE">Nedivaska</option>
  	<option value="NV">Nevada</option>
  	<option value="NH">New Hampshire</option>
  	<option value="NJ">New Jersey</option>
  	<option value="NM">New Mexico</option>
  	<option value="NY">New York</option>
  	<option value="NC">North Carolina</option>
  	<option value="ND">North Dakota</option>
  	<option value="OH">Ohio</option>
  	<option value="OK">Oklahoma</option>
  	<option value="OR">Oregon</option>
  	<option value="PA">Pennsylvania</option>
  	<option value="RI">Rhode Island</option>
  	<option value="SC">South Carolina</option>
  	<option value="SD">South Dakota</option>
  	<option value="TN">Tennessee</option>
  	<option value="TX">Texas</option>
  	<option value="UT">Utah</option>
  	<option value="VT">Vermont</option>
  	<option value="VA">Virginia</option>
  	<option value="WA">Washington</option>
  	<option value="WV">West Virginia</option>
  	<option value="WI">Wisconsin</option>
  	<option value="WY">Wyoming</option>
  </select>
</div>

  <div>
  New Zip Code: <input type="text" name="zipcode" >
</div>
<div>
<input type="radio" name="point_alert" value=1> Yes give me Alerts for points
<input type="radio" name="point_alert" value=2> No dont give me Alerts for points
</div>
<div>
<input type="radio" name="cart_alert" value=1> Yes give me Alerts for carts
<input type="radio" name="cart_alert" value=2> No dont give me Alerts for carts
</div>
<div>
<input type="radio" name="useless" value=1> Yes give me Alerts for mistakes in cart orders
<input type="radio" name="useless" value=2> No dont give me Alerts for mistakes in cart orders
</div>
<div class="reg_button">
  <button type="submit" class="btn btn-info" name='updated'> Update </button>
</div>
</form>

<?php
include ('sql_connection.php');
$_SESSION['username'] = $username;
$savedUsername = $_SESSION['username'];
//email update info
if (@$_POST['point_alert']){
  $newPoint = $_POST['point_alert'];
  if ($newPoint == 2){
    $updatePoints = "UPDATE TruckDriver2.Driver SET Point_Alert = 0 WHERE Username = '$savedUsername'";
  }
  else{
    $updatePoints = "UPDATE TruckDriver2.Driver SET Point_Alert = 1 WHERE Username = '$savedUsername'";
  }
  mysqli_query($conn, $updatePoints);
}

if (@$_POST['cart_alert']){
  $newCart = $_POST['cart_alert'];
  if ($newCart == 2){
    $updateCart = "UPDATE TruckDriver2.Driver SET Cart_Alert = 0 WHERE Username = '$savedUsername'";
  }
  else{
    $updateCart = "UPDATE TruckDriver2.Driver SET Cart_Alert = 1 WHERE Username = '$savedUsername'";
  }
  mysqli_query($conn, $updateCart);
}

//check to see if password is fits in password requirements and update password
if (@$_POST['Password'] != "" and @$_POST['PasswordConfirmation'] != "")
{
  $password = $_POST['Password'];
  $passwordConfirmation = $_POST['PasswordConfirmation'];
    $pass_confirm = True;
    if ($password != $passwordConfirmation)
    {
        $pass_confirm = False;
        echo "Error: passwords do not match. ";
    }

    preg_match("/[^a-z0-9]/", $password, $result);
    preg_match("/[0-9]/", $passwordConfirmation, $result2);
    $regPassword = False;
    if ($result && $result2 && strlen($password) > 4)
    {
        $regPassword = True;
        echo "great";
        if ($pass_confirm){
            $updatePassword = "UPDATE TruckDriver2.Information SET Password = '$password' WHERE Driver = '$savedUsername'";
            mysqli_query($conn, $updatePassword);
            echo "password has been updated";
          }
}
    else
    {
        echo "you need 1 number and 1 special and 5 total";
    }
}

//updates email
if (@$_POST['Email']!= "")
{
  $email = $_POST['Email'];
    $uniqueEmail = "SELECT * FROM TruckDriver2.Information WHERE Email = '$email'";
    $uniqueEmailNumber = mysqli_num_rows(mysqli_query($conn, $uniqueEmail));
    if ($uniqueEmailNumber >= 1)
    {
        echo "Email  already exists please enter a new email";
    }
    else
    {
        $updateEmail = "UPDATE TruckDriver2.Information SET Email = '$email' WHERE Driver = '$savedUsername'";
        mysqli_query($conn, $updateEmail);
        echo "successfully updated email to ", $email, "\n";
    }
}


//updates Phone
if (@$_POST['Phone']!= "")
{
  $phone = $_POST['Phone'];
  $uniquePhone = "SELECT * FROM TruckDriver2.Information WHERE Phone = '$phone'";
  $uniquePhoneNumber = mysqli_num_rows(mysqli_query($conn, $uniquePhone));
    if ($uniquePhoneNumber >= 1)
    {
        echo "Phone number already exists please enter a new phone number";
    }
    else
    {
        $updatePhone = "UPDATE TruckDriver2.Information SET Phone = '$phone' WHERE Driver = '$savedUsername'";
        mysqli_query($conn, $updatePhone);
        echo "successfully updated phone to ", $phone, "\n";
    }
}

//updates Address
if (@$_POST['address']!= "")
{
  $address = $_POST['address'];

        $updateAddress = "UPDATE TruckDriver2.Information SET Street_Address = '$address' WHERE Driver = '$savedUsername'";
        mysqli_query($conn, $updateAddress);
        echo "successfully updated address to ", $address, "\n";
    }



//updates City
if (@$_POST['city']!="")
{
  $city = $_POST['city'];
        $updateCity = "UPDATE TruckDriver2.Information SET City = '$city' WHERE Driver = '$savedUsername'";
        mysqli_query($conn, $updateCity);
        echo "successfully updated city to ", $city, "\n";
    }


//updates State
if (@$_POST['state'] != "")
{
  $state = $_POST['state'];
        $updateState = "UPDATE TruckDriver2.Information SET State = '$state' WHERE Driver = '$savedUsername'";
        mysqli_query($conn, $updateState);
        echo "successfully updated state to ", $state, "\n";
    }


//updates Zipcode
if (@$_POST['zipcode'] != "")
{
  $zipcode = $_POST['zipcode'];
        $updateZipcode = "UPDATE TruckDriver2.Information SET Zipcode = '$zipcode' WHERE Driver = '$savedUsername'";
        mysqli_query($conn, $updateZipcode);
        echo "successfully updated zipcode to ", $zipcode, "\n";
    }

?>

  </article>
</section>
  </body>
</html>
