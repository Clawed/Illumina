<?php if(!defined('In_ZapHK')) { exit; } ?>

<div class="MainContentBox">
	<div class="Box">
		<div class="Title">IP Checker</div>
		<div class="Content" align="left;">
		You can IP check users here if you believe they are scammers or hiding something. It is also good if you need to IP ban someone. <br />
		<br />
		<form method='post'>
			Username <br />
				<input type='text' name='username_check'> <br />
			<br />
			IP Address <br />
				<input type='text' name='ipaddress_check'> <br />
			<br />
			<input type='submit' value='Check IP/Username'>				
		</form>
		<?php
			if(isset($_POST["username_check"]) && empty($_POST["ipaddress_check"])) {
				$username = $db->real_escape_string($_POST["username_check"]);
				if($getinfo = $db->query("SELECT ip_last, ip_reg, rank FROM users WHERE username = '" . $username . "'")) {
					while($drow = $getinfo->fetch_assoc()) {
						$ip_last = $drow['ip_last'];
						$ip_reg = $drow['ip_reg'];
						$rank = $drow['rank'];
					}
					if($rank >= HK_Rank && $username != HK_Username) {
						$output = "<br /> <br />You are not permitted to view that users IP address or IP address history.";
					}
					else if($searchfor = $db->query("SELECT username,rank,mail,ip_reg,ip_last,online,last_online FROM users WHERE ip_reg = '" . $ip_last . "' OR ip_reg = '" . $ip_reg . "'")) {
						$output = "<br />
								<table>
									<tr>
										<td>Username</td>
										<td>Rank</td>
										<td>E-mail</td>
										<td>Registration IP</td>
										<td>Last IP used</td>
										<td>Online status</td>
										<td>Last online</td>
									</tr>";
						while($urow = $searchfor->fetch_assoc()) {
							$output .= "<tr>";
							$output .= "<td>" . $urow['username'] . "</td>";
							$output .= "<td>" . $urow['rank'] . "</td>";
							$output .= "<td>" . $urow['mail'] . "</td>";
							$output .= "<td>" . $urow['ip_reg'] . "</td>";
							$output .= "<td>" . $urow['ip_last'] . "</td>";
							if($urow['online'] == "1") {
								$output .= "<td style='color:green'>Online</td>";
							}
							else {
								$output .= "<td style='color:red'>Offline</td>";
							}
							$output .= "<td>" . $urow['last_online'] . "</td>";
							$output .= "<tr>";
							
						}
						$output .= "</table>";
						
						
					}
					echo $output;
				}
			}
			else if(isset($_POST["ipaddress_check"])) {
				$ipchecked = $db->real_escape_string($_POST["ipaddress_check"]);
				if($search = $db->query("SELECT username,rank,mail,ip_reg,ip_last,online,last_online FROM users WHERE ip_reg = '" . $ipchecked . "' OR ip_last = '" . $ipchecked . "'")) {
					$output = "<br />
									<table>
									<tr>
										<td>Username</td>
										<td>Rank</td>
										<td>E-mail</td>
										<td>Registration IP</td>
										<td>Last IP used</td>
										<td>Online status</td>
										<td>Last online</td>
									</tr>";
					while($irow = $search->fetch_assoc()) {
						if($irow['rank'] >= HK_Rank && $irow['username'] != HK_Username) {
							$output = "<br /> <br />You are not permitted to view that users IP address or IP address history.";
						}
						else {
							$output .= "<tr>";
							$output .= "<td>" . $irow['username'] . "</td>";
							$output .= "<td>" . $irow['rank'] . "</td>";
							$output .= "<td>" . $irow['mail'] . "</td>";
							$output .= "<td>" . $irow['ip_reg'] . "</td>";
							$output .= "<td>" . $irow['ip_last'] . "</td>";
							if($irow['online'] == "1") {
								$output .= "<td style='color:green'>Online</td>";
							}
							else {
								$output .= "<td style='color:red'>Offline</td>";
							}
							$output .= "<td>" . $irow['last_online'] . "</td>";
							$output .= "</tr>";
						}
					}
					$output .= "</table>";
					echo $output;
				}
			}
				
		?>	
		</div>
	</div>
</div>