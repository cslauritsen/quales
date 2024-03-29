<!DOCTYPE HTML>
<?php 
require('inc.php');
?>
<html xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:website="http://ogp.me/ns/website" lang="en-US" itemscope itemtype="http://schema.org/WebPage" >
<head>
    <meta http-equiv="X-UA-Compatible" content="chrome=1" />
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />
	<base href="" />
	<meta charset="utf-8" />

    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto" />
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine" />
    <link rel="stylesheet" type="text/css" href="/static/style.css" />
	<title>RSVP Quale Reunion 2016</title>

    <script>

function errmsg(msg) { 
	var ems = document.getElementById('errmsgs');
	ems.innerHTML += '<br /> ' + msg;
	ems.visible = true;
}
function validate(f) {
	var rv = true;
	var ems = document.getElementById('errmsgs');
	ems.innerHTML = '';
	if (f.elements['firstname'].value == '') {
		errmsg('firstname is a required field.');
		rv = false;
	}
	if (f.elements['lastname'].value == '') {
		errmsg('lastname is a required field.');
		rv = false;
	}
	if (f.elements['phone'].value == '') {
		errmsg('phone is a required field.');
		rv = false;
	}
	if (f.elements['email'].value == '') {
		errmsg('email is a required field.');
		rv = false;
	}
	if (f.elements['email2'].value == '') {
		errmsg('email (confirm) is a required field.');
		rv = false;
	}
	if (f.elements['children'].value == 0 && f.elements['adults'].value == 0 && !f.elements['regrets'].checked ) {
		errmsg('Please indicate the number of children and adults, or please check the box indicating you will not attend.');
		rv = false;
	}

	return rv;
}
    </script>

</head>

<body>

 <div id="top">

	<div id="header">
		<h1 class="strokeme">Quale Reunion &#9734; RSVP</h1>
	</div>

	<div id="content">
		<div id="cleft" class="sidebar">
  			<img src="/static/quales300.jpg" />
		</div>
		<div id="cmid">
			<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') { $rv = rsvp_save(1); echo 'RV: ', $rv; } ?>
			<form action="." method="POST" onsubmit='return validate(this);'>
				<table>
					<tbody>
						<tr> <td colspan="2"> <input type="text" name="firstname" placeholder="first name" /> </td> </tr>
						<tr> <td colspan="2"> <input type="text" name="lastname" placeholder="last name" /> </td> </tr>
						<tr> <td colspan="2"> <input type="text" name="email" placeholder="email" /> </td> </tr>
						<tr> <td colspan="2"> <input type="text" name="email2" placeholder="email (please eneter again to confirm)" /> </td> </tr>
						<tr> <td colspan="2"> <input type="text" name="phone" placeholder="daytime phone" /> </td> </tr>
						<tr> 
							<td> 
								<input type="checkbox" id="regrets" name="regrets" /> Sorry, we will not attend.
							</td>
							<td> 
							<p>Adults attending: 
							<select name="adults" > 
								<option>0</option>
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
								<option>6</option>
								<option>7</option>
								<option>8</option>
								<option>9</option>
								<option>10</option>
								</select>
							</p>
							<p>
							 Children attending: 
							<select name="children" > 
								<option>0</option>
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
								<option>6</option>
								<option>7</option>
								<option>8</option>
								<option>9</option>
								<option>10</option>
								</select>
							</p>
							</td> 
						</tr>
						<tr> <td> <input type="text" name="challenge" placeholder="what's the sum of 2 and three?" style="width: 24.2em;"/> </td> 
							<td><span style="font-size: 15px;"><a href="#" onclick="alert('We ask you to provide the answer to a simple arithmetic problem to prove that you are a person. This helps prevent our RSVP list from being overrun with machine-generated postings from computers trolling the internet.'); return false;">What's this?</a></span></td> 
						</tr>
						<tr> <td colspan="2"> &nbsp; </td> </tr>
						<tr> <td colspan="2"> <button type="submit" >SUBMIT</button> </td> </tr>
					</tbody>
				</table>
			</form>
		</div>
		<div id="cright" class="sidebar">
		</div>
	</div>
 <div>
 <div id="errmsgs" />
</body>

</html>
