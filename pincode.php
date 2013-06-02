<?php

	/*
	  _____ _ _                 _             
	 |_   _| | |               (_)            
	   | | | | |_   _ _ __ ___  _ _ __   __ _ 
	   | | | | | | | | '_ ` _ \| | '_ \ / _` |
	  _| |_| | | |_| | | | | | | | | | | (_| |
	 |_____|_|_|\__,_|_| |_| |_|_|_| |_|\__,_|
		
		Illumina CMS by Jonteh (http://zaphotel.net/)
		RaGEZONE Thread for updates & help: http://forum.ragezone.com/f353/rel-illumina-cms-php-oop-917506/
	*/

	require_once "required.php";
	
	if(!$light->pin_enabled) {
		header ("Location: " . WWW . "/client");
		exit;
	}
	
	if(isset($_SESSION["Attempts"])) {
		$tries = $_SESSION["Attempts"];
		if($tries > 2) {
			$db->real_query("UPDATE users SET acc_flagged = '1' WHERE username = '" . USERNAME . "'");
		}
	}
	
	$currentPin = $light->pin_code;
	
	if(isset($_POST["entered"])) {
		$pin = $_POST["key1"] . $_POST["key2"] . $_POST["key3"] . $_POST["key4"];
		if($pin == $currentPin) {
			$_SESSION["Pincode_Passed"] = true;
			header ("Location: " . WWW . "/client");
			exit;
		}
		else {
			if(!isset($_SESSION["Attempts"])) {
				$_SESSION["Attempts"] = 1;
			}
			else {
				$_SESSION["Attempts"] = $_SESSION["Attempts"] + 1;
			}
		}
	}
	
?>
<font face='verdana'> <b>PIN System Triggered</b><br />
Please enter your PIN Code below. An incorrect attempt will get your account status frozen and Senior Administration
will be notified. </font> <br /> <br />

<form method="post">
	<select name = "key1">
		<option>1</option>
		<option>2</option>
		<option>3</option>
		<option>4</option>
		<option>5</option>
		<option>6</option>
		<option>7</option>
		<option>8</option>
		<option>9</option>
	</select>
	<select name = "key2">
		<option>1</option>
		<option>2</option>
		<option>3</option>
		<option>4</option>
		<option>5</option>
		<option>6</option>
		<option>7</option>
		<option>8</option>
		<option>9</option>
	</select>
	<select name = "key3">
		<option>1</option>
		<option>2</option>
		<option>3</option>
		<option>4</option>
		<option>5</option>
		<option>6</option>
		<option>7</option>
		<option>8</option>
		<option>9</option>
	</select>
	<select name = "key4">
		<option>1</option>
		<option>2</option>
		<option>3</option>
		<option>4</option>
		<option>5</option>
		<option>6</option>
		<option>7</option>
		<option>8</option>
		<option>9</option>
	</select>
<br /> <br />
<input type='submit' value='Enter PIN' name='entered'>
</form>