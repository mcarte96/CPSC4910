<?php
function SendMail($email, $message, $subject){
	$string = "curl -s --user 'api:ba53728e18905ff98185ed133578e40e-ed4dc7c4-813f5044' \\
	https://api.mailgun.net/v3/sandbox2820d3bcba4644ea8ea0db1db60d18f7.mailgun.org/messages \\
	-F from='Good Driver Program <mailgun@sandbox2820d3bcba4644ea8ea0db1db60d18f7.mailgun.org>' \\
	-F to=".$email. "\\
	-F subject='$subject' \\
	-F text='$message'";

exec($string);
}
?>
