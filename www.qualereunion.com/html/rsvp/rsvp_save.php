<?php
require('inc.php');
?>
<html>
	<head>
		<title>Thank You | Quale Reunion RSVP</title>
		<link href="/static/style.css" rel="stylesheet" >
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

<?php

$firstname = trim($_REQUEST['firstname']);
$lastname = trim($_REQUEST['lastname']);
$email = strtolower(trim($_REQUEST['email']));
$email2 = strtolower(trim($_REQUEST['email2']));

if ($email != $email2) {
?>
 <span style="color: red;">Validation error: email addresses did not match</span>
<?php
}

if (check_email_address($email)) {
 

$conn = mysql_connect('localhost', $db_user, $db_pass);
if (!$conn) {
?>

 <span style="color: red;">Database error</span>

<?php
 die ('Cannot connect to database: '. mysql_error());
}

mysql_select_db($db_name);


$sql = sprintf("insert into mailing_list (email,firstname,lastname) values ('%s', '%s', '%s')",
        mysql_real_escape_string($email),
        mysql_real_escape_string($first),
        mysql_real_escape_string($last)
);

mysql_query($sql);
$last_id = mysql_insert_id();
if ($last_id > 0) {
?>
Thank your for joining our email list<span class="super">*</span>. 
We you have been signed up with the following information:
<br />
<br />

 <table>
   <tr>
    <th>Name</th>
    <th>Email</th>
   </tr>
   <tr>
    <td>
	<?php echo $_REQUEST['lastname']; ?>, <?php echo $_REQUEST['firstname']; ?>
    </td>
    <td>
	<?php echo $_REQUEST['email']; ?>
    </td>
   </tr>
 </table>

<br />
<br />
I changed my mind, <a href="<?php printf("mailing_list_remove.php?id=%d&email=%s", $last_id, $email);?>">Unsubscribe me.</a>

<br />
<br />

<span class="super">*</super>We'll only use your information for these announcments, and We won't give it to anyone. You can un-subscribe at anytime.

<?php
} else {
 $err = mysql_error();
 $pos = strripos($err, "duplicate", 0);
 if ($pos || $pos >= 0) {
	
?>
	<?php echo $email;?> has already signed up.
 	<br />
<?php
 } else {
?>
	Sorry, there was a problem saving your information: <br/>
		<?php echo $err; ?>
 	<br />
	Please press your browser's back button and try again.
<?php
 }
}
mysql_close($conn);
} else {
?>
  Sorry, "<?php echo $email ?>" is not a valid email address.
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
