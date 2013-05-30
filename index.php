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
	
	if(!isset($_GET["novote"]) && $light->thehabbos_enabled && $light->isVotingOnline()) {
		$vote_uri = str_replace('/', '!', WWW);
		header ("Location: http://votingapi.com/vote.php?username=" . $light->thehabbos_username . "&api=" . $vote_uri . "!?novote");
	}
	
	$tpl->assign('loginError', null);
	$tpl->assign('title', 'Welcome to the best Retro on the web');
	
	if ($users->isLogged()) {
		header ("Location: /me");
	}
	if (isset($_POST["credentials_username"]) && isset($_POST["credentials_password"])) {
		$u = $db->real_escape_string($_POST["credentials_username"]);
		$p = $users->userHash($_POST["credentials_password"], $u);

		if ($users->validCredentials($u, $p)) {
			$_SESSION["Username"] = $users->userVar($u, 'username');
			$_SESSION["HashedPassword"] = $p;
			header ("Location: " . WWW . "/me");
		}
		else {
			$tpl->assign('LoginError', 'Invalid username or password.');
		}
	}
	
	// Initialize HTML Output
	$tpl->draw('index-top');
	$tpl->draw('index');
	$tpl->draw('footer');
?>