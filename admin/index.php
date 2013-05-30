<?php

	require_once "admin_required.php";

	if(!isLogged()) {
		header ("Location: login.php");
	}
	
	if(isset($_GET["_page"])) {
		$page = $_GET["_page"];
	}
	
	$file = "pages/" . $page . ".php";
	
	include('header.php');
	
	if(file_exists($file)) {
		include($file);
	}
	else {
		include('pages/notfound.php');
	}
	
	include('bottom.php');
?>