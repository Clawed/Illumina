<?php if(!defined('In_ZapHK')) { exit; } $modified = false; ?>

<div class="MainContentBox">
	<div class="Box">
		<div class="Title">Ban a user</div>
		<div class="Content" align="left;">
			You can ban a user in this panel by either manually choosing an amount of seconds or choosing a duration from the dropdown box. <br /><br />
			
			Pre-defined: <br />
			<form method='post'>
				<select name='predefinedSeconds'>
					<option value='94608000'>3 Years (Permanent)</option>
					<option value='63072000'>2 Years</option>
					<option value='31536000'>1 Year</option>
					<option value='15724800'>6 Months</option>
					<option value='7862400'>3 Months</option>
					<option value='2419200'>4 Weeks</option>
					<option value='1209600'>2 Weeks</option>
					<option value='604800'>1 Week</option>
					<option value='259200'>3 Days</option>
					<option value='86400'>24 Hours</option>
					<option value='43200'>12 Hours</option>
					<option value='7200'>2 Hours</option>
					<option value='601'>10 Minutes (Warning)</option>
				</select>
				<br />
				<br />
				or, seconds: <br />
				<input type='text' name='manualSeconds'> <br />
				<br />
				<br />
				Ban type: <br />
				<select name='banType'>
					<option value='ip'>IP Address</option>
					<option value='user'>Username</option>
				</select>
				<br />
				<br />
				Username/IP: <br />
				<input type='text' name='valueToBan'> <br />
				<br />
				Reason: <br />
				<input type='text' name='reason'> <br />
				<br /> <br />
				<input type='submit' value='Ban user' name='banSubmit'>
			</form>
			
			<?php
				if(isset($_POST["valueToBan"]) && isset($_POST["banSubmit"])) {
					if(!isset($_POST["manualSeconds"])) {
						$seconds = $_POST["predefinedSeconds"];
					}
					else if(isset($_POST["manualSeconds"]) && $_POST["manualSeconds"] < 94608001) {
						if(is_numeric($_POST["manualSeconds"])) {
							$seconds = $_POST["manualSeconds"];
						}
					}
					if($_POST["banType"] == "ip") {
						$params = 'sisissi';
					}
					else {
						$params = 'sssissi';
					}
						
					$bannedBy = HK_Username;
					$currentDate = date('d/m/Y H:i');
					$banTime = time() + $seconds;
					$banType = $db->real_escape_string($_POST["banType"]);
					$reason = $db->real_escape_string($_POST["reason"]);
					$userToBan = $db->real_escape_string($_POST["valueToBan"]);
						
					$db->real_query("INSERT INTO bans (bantype,value,reason,expire,added_by,added_date,appeal_state) VALUES ('" . $banType . "', '" . $userToBan . "', '" . $reason . "', '" . $banTime . "', '" . $bannedBy . "', '" . $currentDate . "', '0')");
						
					echo $_POST["valueToBan"] . " banned for " . $seconds . ".";
				}
			?>
		</div>
	</div>
</div>