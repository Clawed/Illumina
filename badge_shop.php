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
	
	define('BadgeShopSelected', true);
	define('CommunitySelected', true);
	
	$tpl->assign('creditAmount', number_format($users->userVar(USERNAME, 'credits')));
	
	$tpl->assign('pagetitle', 'Badge Shop');
	$tpl->assign('lolSpace', null);
	
	if(isset($_POST["BadgeId"])) {
		$badgeId = $db->real_escape_string(strtoupper($_POST["BadgeId"]));
		$badgeQuery = "SELECT cost FROM badge_shop WHERE badge_id = '" . $badgeId . "'";
		if($db->lnumrows($badgeQuery)) {
			if($bq = $db->query($badgeQuery)) {
				while($bi = $bq->fetch_assoc()) {
					$badgePrice = $bi['cost'];
				}
				
				$userCredits = $users->userVar(USERNAME, 'credits');
				if($users->doesUserHaveBadge(USERNAME, $badgeId)) {
					$tpl->assign('lolSpace', '<div style="color:darkred; font-weight:bold; align:center;">
												You already own this badge.
												</div>');
				}
				else if($users->isUserOnline(USERNAME)) {
					$tpl->assign('lolSpace', '<div style="color:darkred; font-weight:bold; align:center;">
												You are currently online! Please close the hotel client before purchasing.
												</div>');
				}
				else if($userCredits > $badgePrice) {
					$db->real_query("INSERT INTO user_badges (badge_id, user_id, badge_slot) VALUES ('" . $badgeId . "', '" . USER_ID . "', '0')");
					$db->real_query("UPDATE users SET credits = credits - '" . $badgePrice . "' WHERE username = '" . USERNAME . "'");
					$tpl->assign('lolSpace', '<div style="color:darkgreen; font-weight:bold; align:center;">
												<img src="' . $light->c_images . '/album1584/' . $badgeId . '.gif" align="left"> Badge Purchased.
												</div>');
				}
				else {
					$tpl->assign('lolSpace', '<div style="color:darkred; font-weight:bold; align:center;">
												You do not have enough credits for this badge.
												</div>');
				}
				
			}
			else {
				$db->databaseError($db->error);
			}
		}
	}
	
	$tpl->draw('cms-head');
	$tpl->draw('cms-generictop');
	$tpl->draw('com-nav');
	$tpl->draw('col1-start');
	$tpl->draw('badgeshop-list');
	$tpl->draw('col-end');
	$tpl->draw('col2-start');
	$tpl->draw('badgeshop-about');
	$tpl->draw('col-end');
	$tpl->draw('bottom');
	$tpl->draw('footer');
	
?>