<?php if(!defined('In_ZapHK')) { exit; } if(!hasFuse(HK_Username, 'adv_edit')) { exit; } ?>

<div class="MainContentBox">
	<div class="Box">
		<div class="Title">Modify users password</div>
		<div class="Content" align="left;">
			You can modify a users password here. This is extremely helpful if a user has forgotten their password or you have changed their username.
			<br />
			<br />
			<form method='post'>
				Username <br /> <input type='text' name='username'> <br /><br />
				Password <br /> <input type='text' name='password'> <br /><br />
				<input type='submit' value='Change password'>
			</form>
			
			<?php
			if(isset($_POST["username"]) && isset($_POST["password"])) {
				$username = filter($_POST["username"]);
				$password = filter($_POST["password"]);
				$combined = sha1(md5($password) . strtolower($username));
				if($users->userVar($username, 'rank') > HK_Rank) {
					echo "You cannot change this users password.";
				}
				else {
					$db->real_query("UPDATE users SET password = '" . $password . "' WHERE username = '" . $username . "'");
					echo $username . "'s password has been set to " . $password;
				}
			}
			?>
		</div>
	</div>
</div>