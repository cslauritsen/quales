<?php

$db_name = "rsvps";
$db_user = "quale";
$db_pass = "phr33kz";

function check_email_address($email) {
  // First, we check that there's one @ symbol, 
  // and that the lengths are right.
  if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
    // Email invalid because wrong number of characters 
    // in one section or wrong number of @ symbols.
    return false;
  }
  // Split it into sections to make life easier
  $email_array = explode("@", $email);
  $local_array = explode(".", $email_array[0]);
  for ($i = 0; $i < sizeof($local_array); $i++) {
    if
(!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&
.'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$",
$local_array[$i])) {
      return false;
    }
  }
  // Check if domain is IP. If not, 
  // it should be valid domain name
  if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
    $domain_array = explode(".", $email_array[1]);
    if (sizeof($domain_array) < 2) {
        return false; // Not enough parts to domain
    }
    for ($i = 0; $i < sizeof($domain_array); $i++) {
      if
(!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|
.([A-Za-z0-9]+))$",
$domain_array[$i])) {
        return false;
      }
    }
  }
  return true;
}

function captcha_init() {
  $val = 'ALPHA'; 
  $_SESSION['captcha'] = $val;
  return $val;
}

function captcha_check($userval) {
 return strtolower($userval) == strtolower($_SESSION['captcha']);
}

function rsvp_save($event) {
	$ret = 0;
	$email = trim($_REQUEST['email']);
	$email2 = trim($_REQUEST['email2']);
	$firstname = trim($_REQUEST['firstname']);
	$lastname = trim($_REQUEST['lastname']);
	$adults = trim($_REQUEST['adults']);
	$children = trim($_REQUEST['children']);
	$regrets = trim($_REQUEST['regrets']);
	$challenge = trim($_REQUEST['challenge']);
	$phone = trim($_REQUEST['phone']);

	//if (! captcha_check(trim($_REQUEST['captcha']))) {
	if (5 != $challenge) {
		return 3;
	}
	if (strtolower($email) != strtolower($email2)) {
		return 4;
	}
	if (! check_email_address($email) || is_null($email) ) {
		return 5;
	}

	$regrets = is_null($regrets) ? 0 : 1;

	$conn = mysql_connect('localhost', 'quale', 'phr33kz');
	if ($conn) {
		mysql_select_db('rsvps');
		$sql = sprintf("select count(*) from rsvps "
			. " where email='%s' and event_id=%d"
			, mysql_real_escape_string($email)
			, $event
		);
		echo '<br />sql=', $sql;
		$rs = mysql_query($sql);
		if (mysql_result($rs, 0) == 0) {
			$sql = sprintf("insert into rsvps ("
				. "event_id,email,firstname"
				. ",lastname,regrets,adults,children,phone"
				. ") values ("
				. "%d, '%s', '%s'"
				. ", '%s', '%s', %d, %d, '%s'"
				. ")"
				, $event
        			, mysql_real_escape_string($email)
        			, mysql_real_escape_string($firstname)
				, mysql_real_escape_string($lastname)
				, $regrets
				, $adults
				, $children
				, mysql_real_escape_string($phone)
			);
			echo '<br />sql=', $sql;
			mysql_query($sql);
			$last_id = mysql_insert_id();
			if ($last_id < 0) {
				$ret = 2;
			}
		}
		else {
			$sql = sprintf("update rsvps set "
				. "  firstname='%s' "
				. " ,lastname='%s' "
				. " ,regrets='%s' "
				. " ,adults=%d "
				. " ,children=%d "
				. " ,phone='%s' "
				. " ,updated=CURRENT_TIMESTAMP "
				. " WHERE email='%s' and event_id=$event "
        			, mysql_real_escape_string($firstname)
				, mysql_real_escape_string($lastname)
				, $regrets
				, $adults
				, $children
        			, mysql_real_escape_string($phone)
        			, mysql_real_escape_string($email)
			);
			echo '<br />sql=', $sql;
			mysql_query($sql);
		}
		mysql_close($conn);
	}
	else {
		$ret = 1;
	}
	return $ret;
}

?>
