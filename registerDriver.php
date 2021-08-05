<!--
This is the driver registration page
-->
<html>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
      <title> Driver Registration</title>
    <style type="text/css">

		body {
	font-family: fanwood-text;
	font-style: normal;
	text-emphasis: center;
	background-color: #722620;


}
  form{
	width: 50%;
  	margin: auto;
	background-color: #f2bc94;
	color: #30110D;
	max-width: 350pt;
	height: auto;
	padding-left: 2%;
	padding-bottom: 1%;
	  	padding-top: 1%;
	  padding-right: 2%;

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

		h2 {
		margin: 0 auto;
		padding-left: 2%;
		padding-right: 2%;


		}
		h3 {
		margin: 0 auto;
		padding-left: 2%;
		padding-right: 2%;


		}

    </style>
	  <!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.--><script>var __adobewebfontsappname__="dreamweaver"</script><script src="http://use.edgefonts.net/merriweather:n3:default;fanwood-text:n4:default.js" type="text/javascript"></script>

</head>

<!--
Button to go back- LATER IMPLEMENT

<div align="right">
<form action="index.html">
<input type="submit" value="Go Back">
</form>
</div>

-->

<div>
<h2 class="dark"> Welcome, New Driver! </h2>
<h3 class="dark">
Create an account and <br>
make sure to fill out all fields:
</h3></div>


<!--
This is where the driver inserts their info and passes it to addDriver.php
-->
<form method="post">

<div>Username: <input type="text" name="user" required>
<br>

<br>
Email: <input type="email" name="email" required>
<br>

<br>
Password: <input type="password" name="pass" required>
<br>

<br>
Re-Enter Password: <input type="password" name="passconfirmed" required>
<br>

<br>
Address: <input type="text" name="address" required>
<br>

  <br>
  Apartment Number (opt.): <input type="text" name="addr2">
  <br>

  <br>
City: <input type="text" name="city" required>
<br>

<br>
State:
<select name="state" required>
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
	<option value="NE">Nebraska</option>
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
<br>


<br>
Zip Code: <input type="text" name="zipcode" required>
<br>

<br>
First Name: <input type="text" name="Fname" required>
<br>


<br>
Middle Name: <input type="text" name="Mname" required>
<br>

<br>
Last Name: <input type="text" name="Lname" required>
<br>

<br>
Cell Phone: <input type="text" name="phone" required>
<br>

<br>
Date of Birth:
<select name="dobM" required value=''>Select Month</option>
<option value='01'>January</option>
<option value='02'>February</option>
<option value='03'>March</option>
<option value='04'>April</option>
<option value='05'>May</option>
<option value='06'>June</option>
<option value='07'>July</option>
<option value='08'>August</option>
<option value='09'>September</option>
<option value='10'>October</option>
<option value='11'>November</option>
<option value='12'>December</option>
</select>

<select name="dobD" required>
<option value='01'>01</option>
<option value='02'>02</option>
<option value='03'>03</option>
<option value='04'>04</option>
<option value='05'>05</option>
<option value='06'>06</option>
<option value='07'>07</option>
<option value='08'>08</option>
<option value='09'>09</option>
<option value='10'>10</option>
<option value='11'>11</option>
<option value='12'>12</option>
<option value='13'>13</option>
<option value='14'>14</option>
<option value='15'>15</option>
<option value='16'>16</option>
<option value='17'>17</option>
<option value='18'>18</option>
<option value='19'>19</option>
<option value='20'>20</option>
<option value='21'>21</option>
<option value='22'>22</option>
<option value='23'>23</option>
<option value='24'>24</option>
<option value='25'>25</option>
<option value='26'>26</option>
<option value='27'>27</option>
<option value='28'>28</option>
<option value='29'>29</option>
<option value='30'>30</option>
<option value='31'>31</option>
</select>

<select name="dobY" required>
<?php
$selected = date('Y');
$earliest_year = 1950;
$latest_year = date('Y');

foreach (range($latest_year, $earliest_year) as $i)
{
    print '<option value="' . $i . '"' . ($i === $selected ? ' selected="selected"' : '') . '>' . $i . '</option>';
}
print '</select>';
?>
<br>

<br>
Driver's License Number: <input type="number" name="DL" required>
<br>

<br>
Private?:
<select name="private" required>
	<option value="n">No</option>
	<option value="y">Yes</option>
</select>
<br>

<br>
<br>
<div>
		<button type="submit" class="input" name="register_btn">Register</button>
</div>
<?php
//code to add the driver into the database
//variable passed in to create driver
//localhost/www_h/registerDriver.php?user=tommydong&email=tom&pass=123&passconfirmed=123&address=ti&addr2=t&city=tom&zipcode=252&Fname=tom&
//Mname=do&Lname=dong&phone=901&month=01&dobD=01&dobY=1999&DL=111111&private=n&register_btn=
if (isset($_POST['Mname']) and isset($_POST['user']) and isset($_POST['email']) and isset($_POST['pass']) and isset($_POST['passconfirmed']) and isset($_POST['Fname']) and isset($_POST['Lname']) and isset($_POST['dobM']) and isset($_POST['dobD']) and isset($_POST['dobY']) and isset($_POST['phone']) and isset($_POST['address']) and isset($_POST['addr2']) and isset($_POST['city']) and isset($_POST['state']) and isset($_POST['zipcode']) and isset($_POST['DL']) and isset($_POST['private']))
{
    $inputuser = $_POST['user'];
    $inputemail = $_POST['email'];
    $inputpass = $_POST['pass'];
    $inputpasscon = $_POST['passconfirmed'];
    $inputfname = $_POST['Fname'];
    $inputmname = $_POST['Mname'];
    $inputlname = $_POST['Lname'];
    $inputDOB1 = $_POST['dobM'];
    $inputDOB2 = $_POST['dobD'];
    $inputDOB3 = $_POST['dobY'];
    $inputphone = $_POST['phone'];
    $inputaddress = $_POST['address'];
    $inputaddr2 = $_POST['addr2'];
    $inputcity = $_POST['city'];
    $inputstate = $_POST['state'];
    $inputzipcode = $_POST['zipcode'];
    $inputDL = $_POST['DL'];
    $inputPrivate = $_POST['private'];
}

//checks that passwords match for password confirmation

?>

<?php
if (isset($_POST['pass']) and isset($_POST['passconfirmed']))
{
    $password1 = $_POST['pass'];
    $password2 = $_POST['passconfirmed'];
    $pass_confirm = True;
    if ($password1 != $password2)
    {
        $pass_confirm = False;
        echo "Error: passwords do not match. ";
    }

    preg_match("/[^a-z0-9]/", $password1, $result);
    preg_match("/[0-9]/", $password1, $result2);
    $regPassword = False;
    if ($result && $result2 && strlen($password1) > 4)
    {
        $regPassword = True;
        echo "great";
    }
    else
    {
        echo "you need 1 number and 1 special and 5 total";
    }
}
?>
<?php
if (isset($_POST['user']))
{
    $username_confirm = True;
    $username = $_POST['user'];
    if (strlen($username) < 5)
    {
        $username_confirm = False;
        echo "Username length must be greater than 5";
    }
}
?>

<?php
include ('sql_connection.php');
if (isset($_POST['user']))
{
  //username is unique and password is correct length
    if ($username_confirm && $regPassword && $pass_confirm)
    {
        $uniquePhone = "SELECT * FROM TruckDriver2.Information WHERE Phone = '$inputphone'";
        $uniquePhoneNumber = mysqli_num_rows(mysqli_query($conn, $uniquePhone));

        $uniqueUsernameDriver = "SELECT * FROM TruckDriver2.Driver WHERE Username = '$username'";
        $uniqueUserNumberDriver = mysqli_num_rows(mysqli_query($conn, $uniqueUsernameDriver));

        $uniqueUsernameAdmin = "SELECT * FROM TruckDriver2.Admins WHERE Username = '$username'";
        $uniqueUserNumberAdmin = mysqli_num_rows(mysqli_query($conn, $uniqueUsernameAdmin));

        $uniqueUsernameSponsorCompanyAdmin = "SELECT * FROM TruckDriver2.Sponsor_Company_Admin WHERE Username = '$username'";
        $uniqueUserNumberSponsorCompanyAdmin = mysqli_num_rows(mysqli_query($conn, $uniqueUsernameSponsorCompanyAdmin));

        $uniqueUsernameSponsorCompanyManager = "SELECT * FROM TruckDriver2.Sponsor_Company_Manager WHERE Username = '$username'";
        $uniqueUserNumberSponsorCompanyManager = mysqli_num_rows(mysqli_query($conn, $uniqueUsernameSponsorCompanyManager));

        $uniqueEmail = "SELECT * FROM TruckDriver2.Information WHERE Email = '$inputemail'";
        $uniqueEmailNumber = mysqli_num_rows(mysqli_query($conn, $uniqueEmail));
        if ($uniquePhoneNumber >= 1)
        {
            echo "Phone number already exists please enter a new phone number";
        }
        if ($uniqueUserNumberDriver >= 1 or $uniqueUserNumberAdmin >= 1 or $uniqueUserNumberSponsorCompanyAdmin >= 1 or $uniqueUserNumberSponsorCompanyManager >= 1)
        {
            echo "Username already exists please enter a new username";
        }
        if ($uniqueEmailNumber >= 1)
        {
            echo "Email  already exists please enter a new email";
        }
        if ($uniquePhoneNumber == 0 and $uniqueUserNumberDriver == 0 and $uniqueEmailNumber == 0 and $uniqueUserNumberAdmin == 0 and $uniqueUserNumberSponsorCompanyAdmin == 0 and $uniqueUserNumberSponsorCompanyManager == 0)
        {
          //NEED TO MANAULLY INPUT ID!!! TALK ABOUT AUTO INCREMENT

          $sql2 = "INSERT INTO TruckDriver2.Driver (Username, Fname, Mname, Lname, Private_Acct, Birth_Date, License_Number, Point_Alert, Cart_Alert) VALUES ('$username','$inputfname','$inputmname','$inputlname','$inputPrivate','$inputDOB1','$inputDL',1,1)";
          $sql =  "INSERT INTO TruckDriver2.Information (Password, Street_Address, City, State, Zipcode,Apt_Num, Email, Phone, Company_Manager,Admins,Driver,Company_Admin) VALUES ('$inputpass','$inputaddress','$inputcity','$inputstate','$inputzipcode','$inputaddr2','$inputemail','$inputphone',null,null,'$username',null)";
          if (mysqli_query($conn, $sql2))
            {
            echo "New record created successfully";
            }
            else
            {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            if (mysqli_query($conn, $sql))
            {
                echo "New record created successfully";
            }
            else
            {
                echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
            }
        }
        mysqli_close($conn);
    }
}
?>

</form>
</form>


</html>
