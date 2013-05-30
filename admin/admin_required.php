<?php

	define('In_ZapHK', true);
	session_start();
	
	define('NO_MAINT_HERE', true);

	require_once "../engine/lightcms.php";
	require_once "../engine/classes/class_users.php";
	
	$light = new LightCMS;
	$users = new UserManager;
	
	$ssl = true;
	
	define('SQL_HOST', $light->db_hostname);
	define('SQL_USER', $light->db_username);
	define('SQL_PASS', $light->db_password);
	define('SQL_DBN', $light->db_dbname);
	$url = $light->site_url;
	
	define('WWW', $url);
	
	$db = new MySQLi(SQL_HOST, SQL_USER, SQL_PASS, SQL_DBN);
	
	function isLogged() {
		if(isset($_SESSION["HK_Username"]) && isset($_SESSION["HK_HashedPass"])) {
			return true;
		}
		return false;
	}
	function hashPass($pass, $user) {
		global $light;
		if($light->hashing_method == "Normal") {
			return sha1(md5($pass) . strtolower($user));
		}
		else if($light->hashing_method == "MD5") {
			return md5($pass);
		}
	}
	function isAllowed($username, $password) {
		global $db;
		if($check = $db->query("SELECT username,password,rank FROM users WHERE username = '" . $username . "'")) {
			while($data = $check->fetch_assoc()) {
				$dbPassword = $data['password'];
				$dbRank = $data['rank'];
			}
		}
		$enterPassword = hashPass($password, $username);
		if($enterPassword != $dbPassword) {
			return false;
		}
		else if(!hasFuse($username, 'login')) {
			return false;
		}
		return true;
	}
	function hasFuse($username, $fuse) {
		global $db, $users;
		if($getfuse = $db->query("SELECT minrank FROM hk_fuses WHERE fuse = '" . $fuse . "'")) {
			while($fused = $getfuse->fetch_assoc()) {
				$minrank = $fused['minrank'];
			}
		}
		$rank = $users->userVar($username, 'rank');
		if($minrank > $rank) { return false; }
		return true;
	}
	function filter($str) {
		global $db;
		return $db->real_escape_string($str);
	}	
	if(isLogged()) {
		define('HK_Username', $_SESSION["HK_Username"]);
		define('HK_Rank', $users->userVar(HK_Username, 'rank'));
	}
?>