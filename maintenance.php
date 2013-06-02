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

	define('NO_MAINT_HERE', true);
	require_once "required.php";
	
	if(!$light->maintenance) {
		header ("Location: " . WWW . "/");
		exit;
	}
	else if($users->isLogged()) {
		header ("Location: " . WWW . "/me");
		exit;
	}
	
	$tpl->assign('title', 'Maintenance break');
	$tpl->draw('maintenance');
	
?>