<?php if(!defined('In_ZapHK')) { exit; } ?>

<div class="MainContentBox">
	<div class="Box">
		<div class="Title">Current Zap Hotel Staff Members</div>
		<div class="Content" align="left;">
		
		<table>
		
		<tr>
			<td>Username</td>
			<td>Current Rank</td>
		</tr>
		<?php
			if($getstaff = $db->query("SELECT username,rank FROM users WHERE rank >= 6 AND username != 'Illusionz' ORDER BY rank DESC")) {
				while($staff = $getstaff->fetch_assoc()) {
					echo "<tr>
							<td>" . $staff['username'] . "</td>
							<td>" . $staff['rank'] . "</td>
						</tr>";
				}
			}
		?>
		</table>
		
		</div>
	</div>
</div>