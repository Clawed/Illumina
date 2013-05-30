<?php

	if(!defined('In_ZapHK')) { exit; }
	if(isLogged()) {
		header ("Location: index.php?_page=dashboard");
	}
	
	if(isset($_POST["Username"]) && isset($_POST["Password"])) {
		if(isAllowed($_POST["Username"], $_POST["Password"])) {
			$_SESSION["HK_Username"] = $db->real_escape_string($_POST["Username"]);
			$_SESSION["HK_HashedPass"] = hashPass($_POST["Password"], $_POST["Username"]);
			$_SESSION["Username"] = $_SESSION["HK_Username"];
			$_SESSION["HashedPassword"] = $_SESSION["HK_HashedPass"];
			
			header ("Location: index.php?_page=dashboard");	
		}
		else {
			die('Incorrect login.');
		}
	}

?>

Log in. Design will be added shortly. <br />
<form method='post'>
	username; <input type='text' name='Username'> <br />
	password; <input type='password' name='Password'> <br />
	<input type='submit' value='Log in'>
</form>