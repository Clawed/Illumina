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
		header ('Location: ' . WWW . '/');
		exit;
	}
	
	define('VipTabSelected', true);
	define('VipSelected', true);
	
	$tpl->assign('pagetitle', 'VIP Shop');
	
	$tpl->draw('cms-head');
	$tpl->draw('cms-generictop');
	$tpl->draw('vip-nav');
	
	$tpl->draw('col1-start');
	$tpl->draw('vip-aboutdeals');
	$tpl->draw('col-end');
	$tpl->draw('col2-start');
	$tpl->draw('vip-buy');
	$tpl->draw('col-end');
	
	$tpl->draw('footer');

?>