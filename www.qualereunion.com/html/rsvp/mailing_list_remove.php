<html>
	<head>
		<title>opus 8 unsub email list</title>
		<link href="style.css" rel="stylesheet" >
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" /> 
	</head>
	<body>
		<div id="container">
			<div id="hdr">
			   <h1>opus 8 </h1>
			</div>
			<div id="body">
				<ul id="nav">
					<li><a href="/">Home</a></li>
					<li><a href="bios.html">Bios</a></li>
					<li><a href="booking.html">Booking</a></li>
					<li><a href="mailing_list.html" class="selected">Mailing List</a></li>
					<li><a href="schedule.html">Schedule</a></li>
				</ul>
				<div id="copy">

<br />
<br />
<br />
<?php
require('inc.php');

$conn = mysql_connect('localhost', $db_user, $db_pass);
if (!$conn) {
?>

 <span style="color: red;">Database error</span>

<?php
 die ('Cannot connect to database: '. mysql_error());
}

mysql_select_db($db_name);


$sql = sprintf("delete from mailing_list where id=%d and email='%s'",
        $_REQUEST['id'],
        mysql_real_escape_string($_REQUEST['email'])
);

if (mysql_query($sql)) {
?>
 You have been unsubscribed from our mailing list. Thank you for your interest in Opus 8.
<?php
} else {
?>
 Sorry, there was a server error while unsubscribing from our mailing list.
<?php
}
mysql_close($conn);
?>

<br />
<br />
<br />
<br />
<br />
<br />


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
