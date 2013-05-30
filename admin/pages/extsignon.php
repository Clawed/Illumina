<?php if(!defined('In_ZapHK')) { exit; } ?>

<div class="MainContentBox">
	<div class="Box">
		<div class="Title">Sign in as a user</div>
		<div class="Content" align="left;">
			Logging on to a users account can be helpful in situations where you need to see their inventory or if their account is glitching. <br />
			This system will override your website session with their account credentials and will log you out of the website but not the housekeeping. <br />
			<br />
			<form method='post'>
			User to log on as: <br />
			<input type='text' name='usernameext'> <br />
			<br />
			<input type='submit' value='Log in'>
			</form>
			<?php
			if(isset($_POST["usernameext"])) {
				$name = filter($_POST["usernameext"]);
				$pass = $users->userVar($name, 'password');
				$rank = $users->userVar($name, 'rank');
				if($rank < HK_Rank) {
					$_SESSION["Username"] = $name;
					$_SESSION["HashedPassword"] = $pass;
					echo "<br /><br />Successfully logged in as " . $name . " - click <a href='" . $light->site_url . "'/me' target='_blank'>here</a> to continue.";
				}
				else {
					echo "<br /><br />You are not allowed to log in as this user.";
				}
			}
			?>			
		</div>
	</div>
</div>
