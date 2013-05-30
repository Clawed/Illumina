<?php

	class LightCore {
		public function getServerStat($var) {
			global $db, $core;
			$this->query = "SELECT `" . $var . "` FROM `server_status`";
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
	}
?>