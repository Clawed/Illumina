<?php

	require_once "admin_required.php";
	
	unset($_SESSION["HK_Username"], $_SESSION["HK_HashedPass"]);
	header ("Location: http://zaphotel.net/me"); exit;

?>