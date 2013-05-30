<?php if(!defined('In_ZapHK')) { exit; } $modified = false; ?>

<div class="MainContentBox">
	<div class="Box">
		<div class="Title">Edit a user</div>
		<div class="Content" align="left;">
			You can edit basic aspects of a users account here. All edits are logged and mis use will result in immediate ban. <br /><br />
			<?php
				if(!isset($_POST["select_account"]) && !isset($_POST["modify_account"])) {
			?>
				<form method='post'>
					User to edit <br />
					<input type='text' name='select_account'> <br /> <br />
					<input type='submit' value='Edit Account'>
				</form>
			<?php
			}
			else if(isset($_POST["modify_account"]) && !isset($_POST["select_account"])) {
					if(hasFuse(HK_Username, 'adv_edit')) {
						$user = $_POST["currentnamec"];
						$hashedpass = $users->userVar($user, 'password');
						if(!empty($_POST["newpassc"])) {
							$hashedpass = hashPass($_POST["newpassc"], $user);
						}
						$stmt = $db->prepare("UPDATE users SET username = ?, password = ?, rank = ?, look = ?, motto = ?, credits = ?, activity_points = ?, points = ? WHERE username = ?");
						$stmt->bind_param('ssissiiis', $user, $hashedPass, $_POST["rankc"], $_POST["lookc"], $_POST["mottoc"], $_POST["creditsc"], $_POST["pixelsc"], $_POST["pointsc"], $_POST["usernamec"]);
						$stmt->execute();
						echo "User account edited.";
					}
					else {
						$stmt = $db->prepare("UPDATE users SET look = ?, motto = ?, credits = ?, activity_points = ?, points = ? WHERE username = ?");
						$stmt->bind_param('ssiiis', $_POST["lookc"], $_POST["mottoc"], $_POST["creditsc"], $_POST["pixelsc"], $_POST["pointsc"], $_POST["usernamec"]);
						$stmt->execute();
						echo "User account edited.";
					}
					$db->real_query("INSERT INTO edit_logs (user_edited, edited_by, timestamp) VALUES ('" . $db->real_escape_string($_POST["usernamec"]) . "', '" . HK_Username . "', '" . time() . "')");
				}
				else {
					$account = $db->real_escape_string($_POST["select_account"]);
					if($getinfo = $db->query("SELECT id,username,rank,look,motto,credits,activity_points,points FROM users WHERE username = '" . $account . "'")) {
						while($di = $getinfo->fetch_row()) {
							$name = $di[1];
							$rank = $di[2];
							if(HK_Rank > $rank) {
								$id = $di[0];
								$look = $di[3];
								$motto = $di[4];
								$credits = $di[5];
								$pixels = $di[6];
								$points = $di[7];
								
								echo "<form method='post'>
									<table>
									<tr>
									<td>
										User ID
									</td>
									<td><input type='text' value='" . $id . "' name='idc' disabled='disabled'></td>
								  </tr>
								  	<tr>
										<td>
											Username
										</td>
										<td>
										<input type='text' name='currentnamec' value='" . $name . "'";
										
										if(!hasFuse(HK_Username, 'adv_edit')) { 
											echo " disabled='disabled'";
										}

											echo ">
											<input type='hidden' value='" . $account . "' name='usernamec'>
											</td>
											</tr>";
									  
							if(hasFuse(HK_Username, 'adv_edit')) {
								echo "<tr>
											<td>
												Rank
											</td>
											<td>
											<input type='text' value='" . $rank . "' name='rankc'>
											</td>
										  </tr>
										<tr>";
							}

									echo "	<tr>
											<td>
												Look
											</td>
											<td>
											<input type='text' value='" . $look . "' name='lookc'>
											</td>
										</tr>
										<tr>
											<td>
												Motto
											</td>
											<td>
											<input type='text' value='" . $motto . "' name='mottoc'>
											</td>
										</tr>
										<tr>
											<td>
												Credits
											</td>
											<td>
											<input type='text' value='" . $credits . "' name='creditsc'>
											</td>
										  </tr>
										<tr>
											<td>
												Pixels
											</td>
											<td>
											<input type='text' value='" . $pixels . "' name='pixelsc'>
											</td>
										  </tr>
										<tr>
											<td>
												Points
											</td>
											<td>
											<input type='text' value='" . $points . "' name='pointsc'>
											</td>
										  </tr></table>
										<br /><br /><input type='submit' value='Modify Account' name='modify_account'>
										</form>";
							
						}	
						else {
							echo "You cannot edit this users account.";
						}
					}
				}
				else {
					echo "Error fetching account details.. does account exist?";
				}
			}		
			?>
		</div>
	</div>
</div>
