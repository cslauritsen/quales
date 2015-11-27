<?php
session_start();
require('inc.php');
include_once $_SERVER['DOCUMENT_ROOT'] . '/securimage/securimage.php';
$securimage = new Securimage();

$captcha_result = $securimage->check($_REQUEST['captcha_code']);

?>
<html>
	<head>
		<title>opus 8 thanks for contacting us </title>
		<link href="style.css" rel="stylesheet" >
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" /> 
	</head>
	<body>


<!-- 
  *
  * Captcha Passed?: <?php echo $captcha_result ? "Yes" : "No" ?> 
  *
-->


		<div id="container">
			<div id="hdr">
			   <h1>opus 8 </h1>
			</div>
			<div id="body">
				<ul id="nav">
					<li><a href="/">Home</a></li>
					<li><a href="bios.html">Bios</a></li>
					<li><a href="booking.html" class="selected" >Booking</a></li>
					<li><a href="mailing_list.html" >Mailing List</a></li>
					<li><a href="schedule.html">Schedule</a></li>
				</ul>
				<div id="copy">

<?php

if ($captcha_result) {

$name = trim($_REQUEST['name']);
$org = trim($_REQUEST['org']);
$event = trim($_REQUEST['event']);
$loc = trim($_REQUEST['loc']);
$phone = trim($_REQUEST['phone']);
$comments = trim($_REQUEST['comments']);

$to = 'csl4jc@gmail.com,billylums@hotmail.com,leebury@hotmail.com';
$hdrs = 'From: Opus 8 Music <info@opuseight.org>';
$subject = 'Opus 8 Booking Request';

$body = <<<EOS
Name:           $name
Org:            $org
Event:          $event
Location:       $loc
Daytime Phone:  $phone
Comments:       $comments

--------------------------------
This message was sent to: $to
--------------------------------
EOS;

$msg_sent = mail($to, $subject, $body, $hdrs);

	if ($msg_sent) {
	?>
	
	<h1>Thank You</h1>
	
	Thank you for your interest in booking Opus 8. We have received the information below. Someone will contact you soon.
	<table>
	<tr> <td>Name</td><td><?php echo $name?></td> </tr>
	<tr> <td>Organization</td><td><?php echo $org?></td> </tr>
	<tr> <td>Event</td><td><?php echo $event?></td> </tr>
	<tr> <td>Event Location</td><td><?php echo $loc?></td> </tr>
	<tr> <td>Daytime Phone</td><td><?php echo $phone?></td> </tr>
	<tr> <td>Requests/Comments</td><td><?php echo $comments?></td> </tr>
	</table>
	
	<?php
	} else {
	?>
	
	   A server error occurred and your message was not sent. 
		You may <a href="javascript:history.go(-1);">try again</a>.
	<?php
	}
} else {
?>

You did not enter the correct characters shown in the image. 
You may <a href="javascript:history.go(-1);">try again</a>.

<?php
}
?>

					

				</div>

			</div>
			<div id="footer">
				&copy; 2009 Opus 8. All rights reserved. |
				<a href="mailto:info@opuseight.org">Contact Opus 8</a>
				| (440) 836-3083
			</div>
		</div>

	</body>
</html>
