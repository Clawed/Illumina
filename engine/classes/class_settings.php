<?php

	class settings {
		public function changeUserPassword($username, $newpassword) {
			global $users, $db, $core;
			$this->newPassword = $users->userHash($password, $username);
			$db->real_query("UPDATE `users` SET `password` = '" . $this->newPassword . "' WHERE `username` = '" . $username . "'")
			or $db->databaseError($db->error);
		}
	}
	
?>