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
	
	if(!$users->isLogged()) {
		header ("Location: " . WWW . "/");
	}
	
	define('StaffPageSelected', true);
	define('CommunitySelected', true);
	
	$allowedRanks = array("founders", "sadmins", "admins", "moderators");
	
	if(isset($_GET["_rankGroup"]) && in_array($_GET["_rankGroup"], $allowedRanks)) {
		$_toLoad = "staff-" . $_GET["_rankGroup"];
		define('selected', $_toLoad);
	}
	else {
		$_toLoad = 'stafflist-about';
	}
	
	$tpl->assign('pagetitle', "Staff");
	$tpl->assign('rankGroup', $_rankGroup);
	
	$tpl->draw('cms-head');
	$tpl->draw('cms-generictop');
	$tpl->draw('com-nav');
	$tpl->draw('col1-start');
	$tpl->draw($_toLoad);
	$tpl->draw('col-end');
	$tpl->draw('col2-start');
	$tpl->draw('stafflist-nav');
	$tpl->draw('col-end');
	$tpl->draw('bottom');
	$tpl->draw('footer');
	
?>