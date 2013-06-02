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
		exit;
	}
	
	define('MeSelected', true);
	define('MeTabSelected', true);
	
	$tpl->assign('Credits', number_format($users->userVar(USERNAME, 'credits')));
	$tpl->assign('Pixels', number_format($users->userVar(USERNAME, 'activity_points')));
	$tpl->assign('Look', $users->userVar(USERNAME, 'look'));
	$tpl->assign('Motto', $users->userVar(USERNAME, 'motto'));
	$tpl->assign('username', USERNAME);
	$tpl->assign('pagetitle', 'Home');
	
	$tpl->draw('cms-head');
	$tpl->draw('cms-generictop');

	$tpl->draw('me-nav');
	$tpl->draw('me-aboutbox');
	
	$tpl->draw('col1-start');
	$tpl->draw('hotcampaigns');
	$tpl->draw('twitter');
	$tpl->draw('col-end');
	$tpl->draw('col2-start');
	$tpl->draw('newsbox');
	$tpl->draw('col-end');

	$tpl->draw('bottom');
	$tpl->draw('footer');
	
?>