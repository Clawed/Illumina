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
		header ("Location: http://votingapi.com/vote.php?username=" . $light->thehabbos_username . "&api=" . $vote_uri . "!client?novote");
	}
	
	if(!$users->isLogged()) {
		header ("Location: " . WWW . "/");
	}
	else if($users->userVar(USERNAME, 'acc_pornbanned') == 1) {
		header ("Location: http://meatspin.com/");
	}
	else if(isset($_GET["e"])) {
		$e = $db->real_escape_string($_GET["e"]);
		if($e == "flash_client_error") {
			echo "<font face='verdana> <center> <b>" . $light->site_name . " - Client Error</b><hr>";
			if($light->flash_client_dump) {
				foreach($_POST as $key => $val) {
					echo $key . "=" . $val . " . <br />";
				}
			}
		}
		exit;
	}
	else if($light->pin_enabled == true && !isset($_SESSION["Pincode_Passed"]) && $users->userVar(USERNAME, 'rank') >= 6) {
		header ("Location: " . WWW . "/client_denied");
	}
	
	$sso = $users->genSSO();
	
	$db->real_query("UPDATE users SET ip_last = '" . $_SERVER["REMOTE_ADDR"] . "', auth_ticket = '" . $sso . "' WHERE id = '" . USER_ID . "'");
	
	if($light->server_type == "Butterfly") {
		$check = $db->lnumrows("SELECT null FROM user_tickets WHERE userid = '" . USER_ID . "'");
		if($check > 0) {
			$db->real_query("UPDATE user_tickets SET sessionticket = '" . $sso . "', ipaddress = '" . $_SERVER["REMOTE_ADDR"] . "' WHERE userid = '" . USER_ID . "'");
		}
		else {
			$db->real_query("INSERT INTO user_tickets (userid, sessionticket, ipaddress) VALUES ('" . USER_ID . "', '" . $sso . "', '" . $_SERVER["REMOTE_ADDR"] . "')");
		}
	}
	else if($light->server_type == "Phoenix") {
		$db->real_query("UPDATE users SET last_online = UNIX_TIMESTAMP() WHERE id = '" . USER_ID . "'");
	}
	
	$tpl->assign('connection_info_host', $light->connection_info_host);
	$tpl->assign('connection_info_port', $light->connection_info_port);
	$tpl->assign('variables', $light->variables);
	$tpl->assign('texts', $light->texts);
	$tpl->assign('override_texts', $light->override_texts);
	$tpl->assign('productdata', $light->productdata);
	$tpl->assign('furnidata', $light->furnidata);
	$tpl->assign('baseurl', $light->baseurl);
	$tpl->assign('habbo_swf', $light->habbo_swf);
	$tpl->assign('loadingtext', $light->loadingtext);
	$tpl->assign('sso', $sso);
	$tpl->draw('client');
	
?>