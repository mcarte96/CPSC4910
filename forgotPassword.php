<?php
  $username = "";
?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
<style>

    h1 {
      font-size: 30px;
      font-family: fanwood-text;
      color: #f2bc94;
      background-color: #30110D;
      text-align: center;
      max-width: 30%;
      margin: 0 auto;
      font-family: fanwood-text;


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

    body{
      background-color: #f2bc94;
      text-align: center;
      font-family: fanwood-text;
      color: #30110D;
    }
    img{
      margin-left: auto;
    margin-right: auto;

    }

    .input {
    display: block;
    margin: 0 auto;
    font-family: fanwood-text;
    font-size: 14pt;    
    text-align: center;
    padding: 2px;

  }



</style>
<!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.--><script>var __adobewebfontsappname__="dreamweaver"</script><script src="http://use.edgefonts.net/fanwood-text:n4:default.js" type="text/javascript"></script>    

  </head>
  <body>
    <form method="post" class="input">
          
      <h2>Forgot Password</h2>
      <br>
        <h1>Username</h1>
        <input type="text" name="username" class="input" required>
        <button type="submit" class="input" required>Send Email</button>
    </form>
    <br>
    <form method="post" action="login.php">
      <button type="submit" class="input">Back</button>
    </form>
    
<?php

if(isset($_POST['username'])){
  $username = $_POST['username'];

}



function random_password()
{
   $password = "";
   $chars = "abcdefghijklmanopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
   $numbers = "0123456789";
   $special = "!@#$%^&*()_-+=?/>.<,:;";
   $size = strlen($chars);
   for ($i = 0; $i < 6; $i++) {
       $password .= $chars[rand(0, $size - 1)];
   }
   for ($i = 0; $i < 3; $i++){
       $password .= $numbers[rand(0,strlen($numbers)-1)];
   }

   for ($i = 0; $i < 3; $i++){
    $password .= $special[rand(0,strlen($special)-1)];
}
   return $password;
}
include ('sql_connection.php');
include ('EmailSender.php');
$new_password = random_password();
//$username = $_POST['username'];
//echo "User is".$username;
$uniqueUsernameDriver = "SELECT * FROM TruckDriver2.Driver WHERE Username = '$username'";
$uniqueUserNumberDriver = mysqli_num_rows(mysqli_query($conn, $uniqueUsernameDriver));

$uniqueUsernameAdmin = "SELECT * FROM TruckDriver2.Admins WHERE Username = '$username'";
$uniqueUserNumberAdmin = mysqli_num_rows(mysqli_query($conn, $uniqueUsernameAdmin));

$uniqueUsernameSponsorCompanyAdmin = "SELECT * FROM TruckDriver2.Sponsor_Company_Admin WHERE Username = '$username'";
$uniqueUserNumberSponsorCompanyAdmin = mysqli_num_rows(mysqli_query($conn, $uniqueUsernameSponsorCompanyAdmin));

$uniqueUsernameSponsorCompanyManager = "SELECT * FROM TruckDriver2.Sponsor_Company_Manager WHERE Username = '$username'";
$uniqueUserNumberSponsorCompanyManager = mysqli_num_rows(mysqli_query($conn, $uniqueUsernameSponsorCompanyManager));
$email = "";
if ($uniqueUserNumberDriver == 1){
  $sqlEmail = "SELECT * FROM TruckDriver2.Information WHERE Driver = '$username' LIMIT 1";
  $result = mysqli_query($conn, $sqlEmail);
  while ($row = mysqli_fetch_assoc($result)){
    $email = $row["Email"];
  }
  
}
//echo "Email is '$email'";

if ($uniqueUserNumberAdmin == 1){
  $sqlEmail = "SELECT * FROM TruckDriver2.Information WHERE Admins = '$username' LIMIT 1";
  $result = mysqli_query($conn, $sqlEmail);
  while ($row = mysqli_fetch_assoc($result)){
    $email = $row["Email"];
}
}


if ($uniqueUserNumberSponsorCompanyAdmin == 1){
  $sqlEmail = "SELECT * FROM TruckDriver2.Information WHERE Company_Admin = '$username' LIMIT 1";
  $result = mysqli_query($conn, $sqlEmail);
  while ($row = mysqli_fetch_assoc($result)){
    $email = $row["Email"];
}
}



if ($uniqueUserNumberSponsorCompanyManager == 1){
  $sqlEmail = "SELECT * FROM TruckDriver2.Information WHERE Company_Manager = '$username' LIMIT 1";
  $result = mysqli_query($conn, $sqlEmail);
  while ($row = mysqli_fetch_assoc($result)){
    $email = $row["Email"];
}
}
$sqlAdminCompany = "UPDATE TruckDriver2.Information SET Password = '$new_password' WHERE Email = '$email'";
$result = mysqli_query($conn, $sqlAdminCompany);

//echo $new_password;
$emailPassword = "Your new password is ". $new_password;
SendMail($email,$emailPassword, "New Password");
?>
