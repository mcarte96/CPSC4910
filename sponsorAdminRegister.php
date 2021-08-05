<?php include('sponsorAM_functions.php') ?>


<!DOCTYPE html>
<html>
<head>
	<title>Safe Driver - Sponsor Company Admin Registration</title>
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
<body>

<h2 class="dark">Register as a Company Sponsor Admin</h2>
<div id="first">
<form method="post">
	<?php echo display_error(); ?>
	<h4>Account Information</h4>
	<div class="input-group">
		<label>Username:</label>
		<input type="text" name="username" value="<?php echo $username; ?>">
	</div>
	<div class="input-group">
		<label>Email:</label>
		<input type="email" name="email" value="<?php echo $email; ?>">
	</div>
	<div class="input-group">
		<label>Enter Password:</label>
		<input type="password" name="password_1" value="<?php echo $password_1; ?>">
	</div>
	<div class="input-group">
		<label>Confirm password:</label>
		<input type="password" name="password_2" value="<?php echo $password_2; ?>">
	</div>

	<h4>Company Information</h4>
	<div class="input-group">
		<label>Company Name: &#x1F50D</label>
		<input type="text" name="compName" value="<?php echo $compName; ?>">
	</div>
	<div class="input-group">
		<label>Company ID:</label>
		<input type="text" name="compID" value="<?php echo $compID; ?>">
	</div>
	<div class="input-group">
		<label>Email Address to your Company's HR Manager:</label>
		<input type="email" name="hrEmail" value="<?php echo $hrEmail; ?>">
	</div>

	<h4>Personal Information</h4>
	<div class="input-group">
		<label>First Name:</label>
		<input type="text" name="fName" value="<?php echo $fName; ?>">
	</div>
	<div class="input-group">
		<label>Middle Name:</label>
		<input type="text" name="mName" value="<?php echo $mName; ?>">
	</div>
	<div class="input-group">
		<label>Last Name:</label>
		<input type="text" name="lName" value="<?php echo $lName; ?>">
	</div>
	<div class="input-group">
		<label>Cell Phone Number:</label>
		<input type="Phone" name="cellPhone" value="<?php echo $cellPhone; ?>">
	</div>
	<div class="input-group">
		<label>Date of Birth:</label>
		<input type="Date" name="dateOfBirth" value="<?php echo $dateOfBirth; ?>">
	</div>


	<h4>Mailing Address</h4>
	<div class="input-group">
		<label>Stress Address:</label>
		<input type="text" name="sAddress" value="<?php echo $username; ?>">
	</div>
	<div class="input-group">
		<label>Apartment Number: (optional)</label>
		<input type="text" name="aNumber" value="<?php echo $username; ?>">
	</div>
	<div class="input-group">
		<label>City:</label>
		<input type="text" name="city" value="<?php echo $username; ?>">
	</div>
	<div class="input-group">
		<label>State:</label>
		<select name="state" value="<?php echo $state; ?>">
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
	</div>
	<div class="input-group">
		<label>Zipcode:</label>
		<input type="text" name="zip" value="<?php echo $zip; ?>">
	</div>

	<div id="rBtn">
	<button type="submit" name="SA_register_btn" class="input"> Register </button>
	</div>
</form>
</div>


</body>
</html>