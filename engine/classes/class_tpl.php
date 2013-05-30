<?php
	// Credit to RainTPL.com for the Template Engine - I am simply adding features in a wrapper.
	class LightTemplate extends RainTPL {
		public function setBasicParameters() {
			global $core, $users, $light;
			$site_url = $light->site_url;
			$this->assign('sitename', $light->site_name);
			$this->assign('shortname', $light->site_short);
			$this->assign('stat_fig', number_format($core->getServerStat('users_online')));
			$this->assign('users_online', number_format($core->getServerStat('users_online')) . " user(s) online");
			$this->assign('facebook', $light->facebook_account);
			$this->assign('twitteraccount', $light->twitter_account);
			$this->assign('cl', 0);
			define('WWW', $light->site_url);
			$this->assign('www', WWW);
			
			// Assign other vars
			$this->assign('loginError', null);
			$this->assign('greenTopText', "Join now");
			$this->assign('greenBottomText', "For free!");
			$this->assign('onlineBubbleText', "players online now");
			
			// Check for IP Ban before looking for user info
			if($users->isIpBanned($_SERVER["REMOTE_ADDR"])) {
				header ("Location: " . WWW . "/banned");
			}
			// Define site browsing variables
			if($users->isLogged()){
				// Check for user ban instead of wasting db usage on vars
				if($users->isUserBanned($_SESSION["Username"])) {
					header ("Location: " . WWW . "/banned");
				}
				$this->assign('Username', $_SESSION["Username"]);
				define("USERNAME", $_SESSION["Username"]);
				define("USER_RANK", $users->userVar(USERNAME, 'rank'));
				define("LOGGED", true);
				define("USER_ID", $users->userVar(USERNAME, 'id'));
			}
		}
		public function tplError($text) {
			echo '<center><font face="verdana" size="2"><b>Illumina CMS Template Engine Error</b><hr>' . $text . '</font></center>';
			exit;
		}
	}
?>