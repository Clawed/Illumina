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

	// Get LightCMS Engine
	require_once "engine/lightcms.php";
	$light = new LightCMS;
	
	if(isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
		$_SERVER["REMOTE_ADDR"] = $_SERVER["HTTP_CF_CONNECTING_IP"];
	}
		
	// Start LightCMS
	$light->exec();
	
	// Connect to DB
	$db = new DatabaseManager($light->MySQLi['Hostname'], $light->MySQLi['Username'], $light->MySQLi['Password'], $light->MySQLi['Database']);
	
	// Start LightCMS Classes
	$core = new LightCore;
	$users = new UserManager;
	$tpl = new LightTemplate;
	
	// Set LightCMS Template Variables
	$tpl->setBasicParameters();
	
	if($light->maintenance && !defined("NO_MAINT_HERE")) {
		if(!$users->isLogged()) {
			header ("Location: " . WWW . "/maintenance.php");
		}
		else if($users->isLogged() && USER_RANK < 6) {
			header ("Location: " . WWW . "/maintenance.php");
		}
	}
	
	define('maintenance', $light->maintenance);
?>