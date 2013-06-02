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
	
	define('UserProfileTabSelected', true);
	define('MeSelected', true);
	$_pageRights = false;
	
	if(isset($_GET["_userid"])) {
		$name = $users->userVar($users->idToName($db->real_escape_string($_GET["_userid"])), 'username');
		if($users->doesUserExist($name)) {
			$_username = $name;
		} else {
			$_username = USERNAME;
		}
	}
	else if(!isset($_GET["_username"])) {
		$_username = USERNAME;
	}
	else if(isset($_GET["_username"]) && $users->doesUserExist($db->real_escape_string($_GET["_username"]))) {
		$_username = $db->real_escape_string($_GET["_username"]);
	}
	else {
		$_username = USERNAME;
	}
	
	if($_username == USERNAME || $users->userVar(USERNAME, 'rank') > 10) {
		$_pageRights = true;
	}
	
	if(isset($_GET["deleteComment"])) {
		$commentId = $db->real_escape_string($_GET["deleteComment"]);
		if($_pageRights) {
			$db->real_query("DELETE FROM profile_wall WHERE id = '" . $commentId . "'");
		}
	}
	
	define('_pageRights', $_pageRights);
	
	$_pageId = $users->userVar($_username, 'id');
	define('_pageId', $_pageId);
	
	if(isset($_POST["_commentSubmit"])) {
		$message = $db->real_escape_string($_POST["_fullMessage"]);
		$message = strip_tags($message);
		$db->real_query("INSERT INTO profile_wall (page_id, poster_id, message) VALUES ('" . $_pageId . "', '" . USER_ID . "', '" . $message . "')");
	}
	
	$getUserInfo = $db->query("SELECT motto,look,rank,credits,activity_points,online FROM users WHERE username = '" . $_username . "'");
	while($userInfo = $getUserInfo->fetch_assoc()) {
		$tpl->assign('username', $_username);
		$tpl->assign('motto', $userInfo['motto']);
		$tpl->assign('look', $userInfo['look']);
		$tpl->assign('rank', $userInfo['rank']);
		$tpl->assign('credits', number_format($userInfo['credits']));
		$tpl->assign('pixels', number_format($userInfo['activity_points']));
		$online = $userInfo['online'];
	}
	
	if($online == 1) {
		$str = 'online_anim';
	} else {
		$str = 'offline';
	}
	
	$tpl->assign('online_status', "<img src='" . WWW . "/images/habbo_" . $str . ".gif'>");
	
	$getFriendCount = $db->query("SELECT null FROM messenger_friendships WHERE receiver = '" . $_pageId . "' OR sender = '" . $_pageId . "'");
	$friendCount = $getFriendCount->num_rows;
	
	$getRegState = $db->query("SELECT reg_timestamp FROM user_info WHERE user_id = '" . $_pageId . "'");
	while($regInfo = $getRegState->fetch_row()) {
		$regStr = $regInfo[0];
	}
	
	$tpl->assign('registered', date("d/m/Y", $regStr));
	
	$tpl->assign('friends', $friendCount);
	
	$tpl->assign('pagetitle', 'User Profile: ' . $_username);
	
	$tpl->draw('cms-head');
	$tpl->draw('cms-generictop');
	$tpl->draw('me-nav');
	
	$tpl->draw('col1-start');
	$tpl->draw('profile-wall');
	
	$db->real_query("UPDATE profile_wall SET owner_read = '1' WHERE owner_read = '0' AND page_id = '" . USER_ID . "'");
	
	$tpl->draw('col-end');
	$tpl->draw('col2-start');
	$tpl->draw('profile-stats');
	$tpl->draw('profile-friends');
	$tpl->draw('profile-badges');	
	$tpl->draw('col-end');
	
	$tpl->draw('bottom');
	$tpl->draw('footer');

?>