<?php

$error = $name = $email = $message = $telephone = $company = "";

$secret = "6Lf0UzkUAAAAAEt9jaseX6uDRt1RugeM0FIJ4r9Y";
$response = null;
$reCaptcha = new ReCaptcha($secret);
if ($_POST["g-recaptcha-response"]) {
	$response = $reCaptcha->verifyResponse(
		$_SERVER["REMOTE_ADDR"],
		$_POST["g-recaptcha-response"]
	);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (!($response != null && $response->success)) {
		$error .= "Invalid reCAPTCHA\r\n";
	}
	
	if (empty($_POST["name"])) {
		$error .= "Name field is required\r\n";
	} else {
		$name = test_input($_POST["name"]);
		if (!preg_match("/^[a-zA-Z0-9 \.\,]*$/", $name)) {
			$error .= "Only letters and white space are allowed in the name\r\n";
		}
	}
	
	if (empty($_POST["email"])) {
		$error .= "Email field is required\r\n";
	} else {
		$email = test_input($_POST["email"]);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$error .= "Invalid email format\r\n";
		}
	}
	
	if (empty($_POST["message"])) {
		$error .= "Message field is required\r\n";
	} else {
		$message = test_input($_POST["message"]);
	}
	
	if (!empty($_POST["telephone"])) {
		$telephone = test_input($_POST["telephone"]);
	}
	
	if (!empty($_POST["company"])) {
		$company = test_input($_POST["company"]);
	}

	if (empty($error)) {
		$ip=getRealIpAddr();
		
		date_default_timezone_set("America/Denver");
		$date = date('l, F jS, Y \a\t h:i A');
		
		$message =
'<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
<html>
  <head>
	<title>New Message Recieved!</title>
	
  </head>
  <body style="background-color:#333;color:#000;">
	<center>
	  <h2 style="background-color:#0F0E0D;color:#FFF;margin:0;padding:20px;">New Message</h2>
	</center>
	<table style="border-collapse:collapse;width:100%;">
	  <tr style="background-color:#A69B8C;">
		<td style="text-align:left;padding:8px;">Submitted on</td>
		<td style="text-align:left;padding:8px;">'.$date.'</td>
	  </tr>
	  <tr style="background-color:#D6CCBC;">
		<td style="text-align:left;padding:8px;">Name</td>
		<td style="text-align:left;padding:8px;">'.$name.'</td>
	  </tr>
	  <tr style="background-color:#A69B8C;">
		<td style="text-align:left;padding:8px;">Email</td>
		<td style="text-align:left;padding:8px;">'.$email.'</td>
	  </tr>
	  <tr style="background-color:#D6CCBC;">
		<td style="text-align:left;padding:8px;">Message</td>
		<td style="text-align:left;padding:8px;">'.$message.'</td>
	  </tr>
	  <tr style="background-color:#A69B8C;">
		<td style="text-align:left;padding:8px;">Telephone Number</td>
		<td style="text-align:left;padding:8px;">'.$telephone.'</td>
	  </tr>
	  <tr style="background-color:#D6CCBC;">
		<td style="text-align:left;padding:8px;">Company</td>
		<td style="text-align:left;padding:8px;">'.$company.'</td>
	  </tr>
	  <tr style="background-color:#A69B8C;">
		<td style="text-align:left;padding:8px;">IP Address</td>
		<td style="text-align:left;padding:8px;">'.$ip.'</td>
	  </tr>
	</table>
  </body>
</html>';
		$message = str_replace("\n.", "\n..", $message);
		$message = wordwrap($message, 70, "\r\n");
		
		$subject = "Message Received";
		
		$success = mail_html("webmaster@s1meon.art", $name, "admin@s1meon.art", $name, $email, $subject, $message);
		if ($success) {
			echo '<script>alert("Success!\nYour message has been sent.")</script>';
		} else {
			echo '<script>alert("An error occured when submitting your message.\nPlease try again later in a few minutes.")</script>';
		}
	} else {
		echo '<script>alert("Error:\n\n' . preg_replace("/\r\n|\r|\n/", '\\n', $error) . '")</script>';
	}
}

function mail_html($to, $from_user, $from_email, $reply_to_name, $reply_to, $subject = '(No subject)', $message = '')
{
	$headers   = "From: $from_user <$from_email>\r\n" . "Reply-to: $reply_to_name <$reply_to>\r\n" . "MIME-Version: 1.0" . "\r\n" . "Content-type: text/html; charset=ISO-8859-1" . "\r\n";
	return mail($to, $subject, $message, $headers);
}

function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function getRealIpAddr(){
	if (!empty($_SERVER['HTTP_CLIENT_IP'])){ //check ip from share internet
		$ip=$_SERVER['HTTP_CLIENT_IP'];
	}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){ //to check ip is pass from proxy
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	}else{
		$ip=$_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}
?>
