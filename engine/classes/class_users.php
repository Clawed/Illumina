<?php
	
	class UserManager {
		public function userHash($password, $username) {
			global $light;
			if($light->hashing_method == "Normal") {
				return sha1(md5($password) . strtolower($username));
			}
			else if($light->hashing_method == "MD5") {
				return md5($password);
			}
		}
		public function userVar($username, $var) {
			global $db, $core, $light;
			if($light->apc_enabled) {
				$key = $username . "_" . $var;
				if(apc_exists($key)) {
					return json_decode(apc_fetch($key), true);
				}
				else {
					$returner = json_encode($this->getUserVar($username, $var), true);
					apc_store($key, $returner, 120);
					return json_decode(apc_fetch($key), true);
				}
			}
			else {
				return $this->getUserVar($username, $var);
			}
		}
		public function getUserVar($username, $var) {
			global $db;
			$this->query = "SELECT `" . $var . "` FROM `users` WHERE `username` = '" . $username . "'";
			if($this->result = $db->query($this->query)) {
				while($this->data = $this->result->fetch_row()) {
					$this->return = $this->data[0];
					return $this->return;
				}
			} 
			else {
				$db->databaseError($db->error);
			}
		}
		public function idToName($id) {
			global $db;
			if($query = $db->query("SELECT username FROM users WHERE id = '" . $id . "'")) {
				while($data = $query->fetch_row()) {
					return $data[0];
				}
			}
			else {
				return null;
			}
		}
		public function forceFormat($name) {
			return preg_replace("/[^A-Za-z0-9 ]/", '', $name);
		}
		public function validCredentials($username, $password) {
			if ($password == $this->userVar($username, 'password')) {
				return true;
			}
			return false;
		}
		public function isLogged() {
			if (isset($_SESSION["Username"]) && isset($_SESSION["HashedPassword"])) {
				return true; 
			}
			return false;
		}
		public function doesUserExist($username) {
			global $db;
			$query = $db->query("SELECT null FROM users WHERE username = '" . $username . "'");
			$rows = $query->num_rows;
			if($rows < 1) {
				return false;
			}
			return true;
		}
		public function checkSessions() {
			if($this->isLogged()) {
				$this->username = $_SESSION["Username"];
				$this->sesPass = $_SESSION["HashedPassword"];
				if(!$this->doesUserExist($this->username) || $this->sesPass != $this->userVar($this->username, 'password', false)) {
					unset($_SESSION["Username"]);
					unset($_SESSION["HashedPassword"]);
				}
			}
		}
		public function isBlockedName($name) {
			$this->blockedNames = array ('mod', 'adm', 'staff', 'jonty', 'jonteh', 'tech', 'sulake', 'owner', 'ownr', ' ', '£', '™', '£', '¢', '∞', '§', '¶', '•', 'ª', '©', '®');
			foreach($this->blockedNames as $this->list) {
				if(strtolower($name) == strtolower($this->list)) {
					return true;
				}
			}
			foreach($this->blockedNames as $this->two) {
				if(strpos(strtolower($name), strtolower($this->two)) !== false) {
					return true;
				}
			}
			return false;
		}
		public function isEmailValid($email) {
			if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
				return true;
			}
			else {
				return false;
			}
		}
		public function isUsernameValid($username) {
			if(!preg_match('/^[a-z0-9]+$/i', $username) && strlen($username) < 1 && strlen($username) > 32) {
				return false;
			}
			elseif($this->doesUserExist($username)) {
				return false;
			}
			elseif($this->isBlockedName($username)) {
				return false;
			}
			return true;
		}
		public function addUser($username, $passwordHash, $email, $rank, $figure, $sex, $motto, $homeroom) {
			global $db, $core;
			if($this->stmt = $db->prepare("INSERT INTO users (username,password,mail,auth_ticket,rank,look,gender,motto,home_room,credits,activity_points,last_online,account_created,ip_last,ip_reg) VALUES ('" . $username . "','" . $passwordHash . "','" . $email . "','','" . $rank . "','" . $figure . "','" . $sex . "', '" . $motto . "', '" . $homeroom . "','15000','1000','','" . date('d-M-Y') . "', '".$_SERVER['REMOTE_ADDR']."', '".$_SERVER['REMOTE_ADDR']."')")) {
				$this->stmt->execute();
				$this->stmt->close();
			}
			else {
				$db->databaseError($db->error);
			}
		}
		public function genSSO() {
			global $light;
			$this->sso = "LIG";
			$this->sso .= "-";
			$this->sso .= rand(1,12345);
			$this->sso .= rand(1,12345);
			$this->sso .= rand(1,12345);
			$this->sso .= "-";
			$this->sso .= rand(1,12345);
			$this->sso .= rand(1,12345);
			$this->sso .= "-" . str_replace(" ", "", $light->site_name);
			$this->sso .= "-" . USER_ID;
			return $this->sso;
		}
		public function doesUserHaveTicket($user_id) {
			global $db, $light;
			if($light->server_type == "Butterfly") {
				$this->query = "SELECT null FROM user_tickets WHERE userid = '" . $user_id . "'";
				if($this->result = $db->query($this->query)) {
					$this->check = $this->result->num_rows;
					$this->result->close();
				}
				else {
					return false;
				}
				if($this->check >= 1) {
					return true;
				}
			}
			return false;
		}
		public function isUserBanned($username) {
			global $db;
			$this->query = "SELECT * FROM bans WHERE expire > " . time() . " AND value = '" . $username . "'";
			if($this->result = $db->query($this->query)) {
				$this->check = $this->result->num_rows;
				$this->result->close();
			}
			else {
				$db->databaseError($db->error);
			}
			if($this->check >= 1) {
				return true;
			}
		}
		public function isIpBanned($ip) {
			global $db, $core;
			$this->query = "SELECT * FROM bans WHERE expire > " . time() . " AND value = '" . $ip . "'";
			if($this->result = $db->query($this->query)) {
				$this->check = $this->result->num_rows;
				$this->result->close();
			}
			else {
				$db->databaseError($db->error);
			}
			if($this->check >= 1) {
				return true;
			}
		}
		public function doesUserHaveBadge($userid, $badgeid) {
			global $db;
			if(!$db->lnumrows("SELECT * FROM user_badges WHERE user_id = '" . $userid . "' AND badge_id = '" . $badgeid . "'")) {
				return false;
			}
			return true;
		}
		public function isUserOnline($username) {
			if($this->userVar($username, 'online') == 1) {
				return true;
			}
			return false;
		}
	}
?>