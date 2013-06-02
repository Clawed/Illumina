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
	define('ProfileTabSelected', true);
	define('points', $users->userVar(USERNAME, 'points'));
	
	$tpl->assign('pagetitle', 'Account settings');
	$tpl->assign('fr_checkvalues', null);
	$tpl->assign('trd_checkvalues', null);
	$tpl->assign('errorSpace', null);
	$tpl->assign('successSpace', null);
	$tpl->assign('Username', USERNAME);
	$tpl->assign('Points', points);
	$tpl->assign('username', USERNAME);
	
	$tpl->draw('cms-head');
	$tpl->draw('cms-generictop');
	$tpl->draw('me-nav');
	
	if(isset($_GET["_profile_page"])) {
		$_proPage = str_replace('_', '-', $db->real_escape_string($_GET["_profile_page"]));
	}
	else {
		$_proPage = "account-settings";
	}
	define('selected', $_proPage);
	
	if(selected == 'account-settings') {
		if($light->server_type == "Butterfly") {
			$tradename = "block_trade";
		}
		else if($light->server_type == "Phoenix") {
			$tradename = "accept_trading";
		}
		define('friendStatus', $users->userVar(USERNAME, 'block_newfriends'));
		define('tradeStatus', $users->userVar(USERNAME, $tradename));
		define('Motto', $db->real_escape_string($users->userVar(USERNAME, 'motto')));
		if(isset($_POST["SaveSettings"])) {
			if(isset($_POST["FriendRequests"]) && friendStatus == 0) {
				$db->real_query("UPDATE `users` SET `block_newfriends` = '1' WHERE `username` = '" . USERNAME . "'");
				$tpl->assign('fr_checkvalues', "checked='checked' value='1'");
			}
			else if(!isset($_POST["FriendRequests"]) && friendStatus == 1) {
				$db->real_query("UPDATE `users` SET `block_newfriends` = '0' WHERE `username` = '" . USERNAME . "'");
			}
			else if(isset($_POST["TradeStatus"]) && tradeStatus == 0) {
				$db->real_query("UPDATE `users` SET `" . $tradename . "` = '1' WHERE `username` = '" . USERNAME . "'");
				$tpl->assign('trd_checkvalues', "checked='checked' value='1'");
			}
			else if(!isset($_POST["TradeStatus"]) && tradeStatus == 1) {
				$db->real_query("UPDATE `users` SET `" . $tradename . "` = '0' WHERE `username` = '" . USERNAME . "'");
			}
			else if(isset($_POST["Motto"]) && $_POST["Motto"] != Motto) {
				$db->real_query("UPDATE `users` SET `motto` = '" . $db->real_escape_string($_POST["Motto"]) . "' WHERE `username` = '" . USERNAME . "'");
				$tpl->assign('Motto', $db->real_escape_string($_POST["Motto"]));
			}
		}
		if(friendStatus == '1') {
			$tpl->assign('fr_checkvalues', "checked='checked' value='1'");
		}
		if(tradeStatus == '1') {
			$tpl->assign('trd_checkvalues', "checked='checked' value='1'");
		}
		$tpl->assign('motto', Motto);
	}
	else if(selected == 'pass-settings') {
		if(isset($_POST["UpdatePassword"])) {
			$currPass = $users->userVar(USERNAME, 'password');
			$entPass = $users->userHash($_POST["CurrentPass"], USERNAME);
			if($entPass == $currPass) {
				$newPass = $users->userHash($_POST["NewPass"], USERNAME);
				$verPass = $users->userHash($_POST["VerifyPass"], USERNAME);
				if($newPass == $verPass) {
					$db->real_query("UPDATE `users` SET `password` = '" . $newPass . "' WHERE `username` = '" . USERNAME . "'");
					$_SESSION["Username"] = USERNAME;
					$_SESSION["HashedPassword"] = $newPass;
					$tpl->assign('successSpace', $light->successMessage('Your password has been successfully changed.'));
				}
				else {
					$tpl->assign('errorSpace', $light->errorMessage('Your new passwords do not match.'));
				}
			}
			else {
				$tpl->assign('errorSpace', $light->errorMessage('Your current password is incorrect.'));
			}
		}
	}
	else if(selected == 'change-name') {
		if(isset($_POST["current_username"]) && isset($_POST["current_password"]) && isset($_POST["new_username"])) {
			$userPoints = $users->userVar(USERNAME, 'points');
			$curUsername = USERNAME;
			$passPosted = $users->userHash($_POST["current_password"], $curUsername);
			$newName = $users->forceFormat($db->real_escape_string($_POST["new_username"]));
				if($passPosted == $_SESSION["HashedPassword"]) {
					if($db->lnumrows("SELECT username FROM users WHERE username = '" . $newName . "'") == 0) {
						$newPassword = $users->userHash($_POST["current_password"], $newname);
						$db->real_query("UPDATE users SET username = '" . $newname . "', password = '" . $newPassword . "', points = points - 2 WHERE username = '" . $curUsername . "'");
						$db->real_query("INSERT INTO namechange_logs (uid, time, currentname, changedname) VALUES ('" . USER_ID . "', '" . time() . "', '" . $curUsername . "', '" . $newName . "'");
						$db->real_query("UPDATE rooms SET owner = '" . $newName . "' WHERE owner = '" . $curUsername . "'");
						$_SESSION["Username"] = $newName;
						$_SESSION["HashedPassword"] = $newPassword;
						$tpl->assign('successSpace', $light->successMessage('Username successfully changed to ' . $newName));
					}	
					else {
						$tpl->assign('errorSpace', $light->errorMessage('That username is already taken, please choose another.'));
					}
				}
				else {
					$tpl->assign('errorSpace', $light->errorMessage('Your password does not match the one you signed in with.'));
				}
			}	
		}
		else {
			$tpl->assign('errorSpace', $light->errorMessage('You need to fill in all of the fields.'));
		}
	
	$tpl->draw('col1-start');
	$tpl->draw('profile-nav');
	$tpl->draw('col-end');
	$tpl->draw('col2-start');
	$tpl->draw(selected);
	$tpl->draw('col-end');
	$tpl->draw('bottom');
	$tpl->draw('footer');
	
?>