<?php if(!defined('In_ZapHK')) { exit; } ?>

<div class="MainContentBox">
	<div class="Box">
		<div class="Title">Make a user VIP</div>
		<div class="Content" align="left;">
			Has a user paid for VIP and not received it? You can give them VIP here. This system is logged - abuse it and you will be fired on the spot. <br />
			<br />
			<form method='post'>
				<select name="pack">
					<option value="super">Super VIP</option>
					<option value="platinum">Platinum VIP</option>
					<option value="ultimate">Ultimate VIP</option>
					<option value="legend">Legend VIP</option>
				</select>
				<br /> <br />
				Username <br />
				<input type='text' name='username'> <br />
				<br />
				Reason <br />
				<input type='text' name='reason'> <br />
				<br />
				<input type='submit' value='Adjust VIP level'>
			</form>
			<?php
				if(isset($_POST["username"]) && isset($_POST["reason"]) && isset($_POST["pack"])) {
					$un = $db->real_escape_string($_POST["username"]);
					$reason = $db->real_escape_string($_POST["reason"]);
					$pack = $db->real_escape_string($_POST["pack"]);
					$userid = $users->userVar($un, 'id');
					$userrank = $users->userVar($un, 'rank');
					$staffid = $users->userVar(HK_Username, 'id');
					$allowedPacks = array('super', 'platinum', 'ultimate', 'legend');
					if(in_array($pack, $allowedPacks) && $userrank < HK_Rank) {
						if($pack == "super") {
							$db->real_query("UPDATE users SET credits = credits + 30000, activity_points = activity_points + 20000, rank = '3' WHERE username = '" . $un . "'");
						}
						else if($pack == "platinum") {
							$db->real_query("UPDATE users SET credits = credits + 75000, activity_points = activity_points + 50000, rank = '4' WHERE username = '" . $un . "'");
						}
						else if($pack == "ultimate") {
							$db->real_query("UPDATE users SET credits = credits + 300000, activity_points = activity_points + 150000, rank = '5' WHERE username = '" . $un . "'");
						}
						else if($pack == "legend") {
							$db->real_query("UPDATE users SET credits = credits + 500000, activity_points = activity_points + 250000, rank = '5', legend = '1' WHERE username = '" . $un . "'");
							$db->real_query("INSERT INTO user_badges (user_id, badge_id, badge_slot) VALUES ('" . $userid . "', 'G10', '0')");
						}
						$db->real_query("INSERT INTO user_badges (user_id, badge_id, badge_slot) VALUES ('" . $userid . "', 'VIP', '0')");
						$db->real_query("INSERT INTO makevip_logs (staffid, userid, viplevel, reason) VALUES ('" . $staffid . "', '" . $userid . "', '" . $pack . "', '" . $reason . "')");
						
						echo "<br /> <br />User " . $un . " has been upgraded.";
					}
				}
			?>
		</div>
	</div>
</div>