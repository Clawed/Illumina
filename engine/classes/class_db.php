<?php
	class DatabaseManager extends mysqli {
		public function __construct($hostname, $username, $password, $database) {
			@parent::__construct($hostname, $username, $password, $database);
			if($this->connect_error) {
				$this->databaseError($this->connect_error);
			}
		}
		public function databaseError($text) {
			echo '<center><font face="verdana" size="2"><b>LightCMS MySQLi Engine Error</b><hr>' . $text . '</font></center>';
			exit;
		}
		public function lnumrows($query) {
			if($this->q = parent::query($query)) {
				$this->numRows = $this->q->num_rows;
				$this->q->close();
			}
			else {
				$this->databaseError($this->error);
			}
			if($this->numRows > 0) {
				return $this->numRows;
			}
			else {
				return 0;
			}
		}
	}
?>