<?php
	
	class StaffManager {
		public function hasSession() {
			if(isset($_SESSION["HK_Username"]) && isset($_SESSION["HK_HashedPassword"])) {
				return true;
			}
			return false;
		}
	}
	
?>